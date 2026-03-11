<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    protected $comment;

    public function __construct()
    {
        $this->comment = new Comment();
    }



    public function index(){
        $comments = $this->comment->getAllForAdmin();

        return view('admin.comments.index', compact('comments'));
    }


    public function show($id){
        $comment = $this->comment->find($id);
        return view('admin.comments.show', compact('comment'));
    }

    public function destroy(Request $request,$id){
        $comment = Comment::findOrFail($id);

        ActivityLog::storeLog('comment.deleted', auth()->user()->name . ' deleted comment #' . $id . ' on post: ' . $comment->post->title);

        $this->comment->deleteComment($id);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.comments.index')->with('success', 'Comment deleted successfully!');

    }


}
