<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    public function posts(){
        return $this->hasMany(Post::class);
    }


    public function getAllOrdered(){
        return Category::orderBy('name', 'asc')->get();
    }


    public function findBySlug($slug){
        return Category::where('slug', $slug)->first();
    }

    public function getWithPostCount(){
        return $this->posts()->count();
    }


    public function store($data){
       return Category::create([
           'name' => $data['name'],
           'slug' => $data['slug']
       ]);
    }



    public function updateCategory($id, $data)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $data['name'],
            'slug' => \Str::slug($data['name']),
        ]);
        return $category;
    }

    public function deleteCategory($id)
    {
        return Category::findOrFail($id)->delete();
    }

}
