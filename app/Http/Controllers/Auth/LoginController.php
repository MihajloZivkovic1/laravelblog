<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\password;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }


    public function store(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            ActivityLog::storeLog('user.login',auth()->user()->name . ' logged in');

            if(auth()->user()->isAdmin()){
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy(Request $request){
        ActivityLog::storeLog('user.logout',auth()->user()->name . ' logged out');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
