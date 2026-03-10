<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
   protected $fillable = ['user_id', 'category_id', 'title', 'slug', 'body', 'featured_image', 'status'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }


    public function getAllPublishedPosts(){
        return Post::where('status', 'published')
            ->with(['user', 'category', 'tags'])
            ->orderBy('created_at', 'desc')
            ->get();
    }


    public function getPaginated($perPage = 10)
    {
        return Post::where('status', 'published')
            ->with(['user', 'category', 'tags'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function searchPaginated($keyword, $perPage = 10)
    {
        return Post::where('status', 'published')
            ->where(function($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('body', 'like', '%' . $keyword . '%');
            })
            ->with(['user', 'category', 'tags'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }


    public function findBySlug($slug)
    {
        return Post::where('slug', $slug)
            ->with(['user', 'category', 'tags', 'comments.user'])
            ->firstOrFail();
    }



    public function getByCategory($categoryId, $perPage = 10)
    {
        return Post::where('status', 'published')
            ->where('category_id', $categoryId)
            ->with(['user', 'category', 'tags'])
            ->paginate($perPage);
    }


    public function getByTag($tagId, $perPage = 10)
    {
        return Post::where('status', 'published')
            ->whereHas('tags', function($query) use ($tagId) {
                $query->where('tags.id', $tagId);
            })
            ->with(['user', 'category', 'tags'])
            ->paginate($perPage);
    }



    public function store($data, $imagePath = null)
    {
        return Post::create([
            'user_id'        => auth()->id(),
            'category_id'    => $data['category_id'],
            'title'          => $data['title'],
            'slug'           => \Str::slug($data['title']),
            'body'           => $data['body'],
            'featured_image' => $imagePath,
            'status'         => $data['status'] ?? 'draft',
        ]);
    }


    public function updatePost($id, $data, $imagePath = null)
    {
        $post = Post::findOrFail($id);
        $post->update([
            'category_id'    => $data['category_id'],
            'title'          => $data['title'],
            'slug'           => \Str::slug($data['title']),
            'body'           => $data['body'],
            'featured_image' => $imagePath ?? $post->featured_image,
            'status'         => $data['status'],
        ]);
        return $post;
    }



    public function deletePost($id)
    {
        return Post::findOrFail($id)->delete();
    }


    public function syncTags($post, $tagIds)
    {
        $post->tags()->sync($tagIds);
    }


    public function getAllForAdmin()
    {
        return Post::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }



}
