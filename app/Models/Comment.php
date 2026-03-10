<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id', 'user_id', 'body'];


    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function getForPost($postId)
    {
        return Comment::where('post_id', $postId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
    }


    public function store(){
        return Comment::create([
            'post_id' => request('post_id'),
            'user_id' => request('user_id'),
            'body' => request('body'),
        ]);
    }

    public function deleteComment($id){
        return Comment::findOrFail($id)->delete();
    }

    public function getAllForAdmin(){
        return Comment::with(['user', 'post'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }
}
