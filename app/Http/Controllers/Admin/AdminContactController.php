<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    protected $contactMessage;

    public function __construct()
    {
        $this->contactMessage = new ContactMessage();
    }

    public function index()
    {
        $messages = $this->contactMessage->getAllPaginated(20);
        return view('admin.contact.index', compact('messages'));
    }


    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        return view('admin.contact.show', compact('message'));
    }

    public function destroy(Request $request, $id)
    {
        $message = ContactMessage::findOrFail($id);
        ActivityLog::storeLog('contact.deleted', auth()->user()->name . ' deleted contact message from: ' . $message->email);
        $this->contactMessage->deleteMessage($id);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.contact.index')->with('success', 'Message deleted successfully!');
    }
}
