<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $users = $this->user->getAllUsersPaginated();
        return view('admin.users.index', compact('users'));
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }


    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }


    public function update(Request $request, $id){
        $data = $request->validate([
            'role' => 'required|in:user,admin',

        ]);

        if (auth()->user()->id == $id) {
            return back()->withErrors(['role' => 'You cannot change your own role.']);
        }

        $user = $this->user->updateRole($id, $data);

        ActivityLog::storeLog('user.role_updated', auth()->user()->name . ' changed role of ' . $user->name . ' to ' . $data['role']);

        return redirect()->route('admin.users.index')->with('success', 'User role updated successfully!');


    }

    public function destroy(Request $request, $id){
        if(auth()->user()->id == $id){
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'You cannot delete yourself.']);
            }

            return back()->withErrors(['error' => 'You cannot delete yourself.']);

        }

        $user = User::findOrFail($id);
        ActivityLog::storeLog('user.deleted', auth()->user()->name . ' deleted user: ' . $user->name);
        $this->user->deleteUser($id);

        if($request->ajax()){
            return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
        }


        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');

    }

}
