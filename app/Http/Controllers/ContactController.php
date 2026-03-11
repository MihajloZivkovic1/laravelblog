<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    protected $contactMessage;

    public function __construct(){
        $this->contactMessage = new ContactMessage();
    }


    public function index()
    {
        return view('contact.index');
    }


    public function store(Request $request)
    {

        try {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required'
            ]);

            $this->contactMessage->store($data);


            Mail::send('emails.contact', ['data' => $data], function ($m) use ($data) {
                $m->to(config('mail.admin_email', 'admin@blog.com'))
                    ->subject('New Contact Message: ' . $data['subject'])
                    ->replyTo($data['email'], $data['name']);
            });


            ActivityLog::storeLog('contact.sent', $data['name'] . ' sent a contact message: ' . $data['subject']);


            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your message has been sent successfully!'
                ]);
            }

            return back()->with('success', 'Your message has been sent successfully!');


        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => ['message' => [$e->getMessage()]]
                ], 500);
            }


        }

        return back()->with('error', 'Something went wrong!');
    }
}
