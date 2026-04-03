<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //

    protected Comment $comment;
    public function __construct()
    {
        $this->comment = new Comment();
    }

    public function store(Request $request){
        $data = $request->validate([
            'post_id' => ['required','exists:posts,id'],
            'body' => ['required','min:3','max:1000'],
        ]);

        $data['user_id'] = auth()->id(); // add this

        $comment = $this->comment->store($data);
        $comment->load('user');

        ActivityLog::storeLog('comment.created', auth()->user()->name . ' commented on post #' . $data['post_id']);

        if($request->ajax()){
            return response()->json([
                'success' => true,
                'comment' => [
                    'id' => $comment->id,
                    'body' => $comment->body,
                    'user' => $comment->user,
                    'created_at' => $comment->created_at->diffForHumans(),
                ]
            ]);
        }

        return back()->with('success', 'Comment posted successfully!');


    }

    public function destroy(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        if (auth()->user()->id !== $comment->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $this->comment->deleteComment($id);
        ActivityLog::storeLog('comment.deleted', auth()->user()->name . ' deleted comment #' . $id);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Comment deleted!');
    }
}
