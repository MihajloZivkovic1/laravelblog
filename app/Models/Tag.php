<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];


    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }


    public function getAllOrdered(){
        return Tag::orderBy('name', 'asc')->get();
    }


    public function findBySlug($slug)
    {
        return Tag::where('slug', $slug)->firstOrFail();
    }

    public function getWithPostCount(){
        return Tag::withCount('posts')->orderBy('name', 'asc')->get();
    }

    public function store($data)
    {
        return Tag::create([
            'name' => $data['name'],
            'slug' => \Str::slug($data['name']),
        ]);
    }
    public function updateTag($id, $data)
        {
            $tag = Tag::findOrFail($id);
            $tag->update([
                'name' => $data['name'],
                'slug' => \Str::slug($data['name']),
            ]);
            return $tag;
        }

    public function deleteTag($id)
    {
        return Tag::findOrFail($id)->delete();
    }


}
