<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $post;
    protected $category;
    protected $tag;




    public function __construct()
    {
        $this->post = new Post();
        $this->category = new Category();
        $this->tag = new Tag();
    }

    public function index()
    {
        $posts = $this->post->getPaginated(10);
        $categories = $this->category->getAllOrdered();
        $tags = $this->tag->getAllOrdered();

        return view('posts.index', compact('posts', 'categories', 'tags'));

    }

    public function show($slug){
        $post = $this->post->findBySlug($slug);
        $categories = $this->category->getAllOrdered();
        $tags = $this->tag->getAllOrdered();


        ActivityLog::log('post.view', auth()->check() ? auth()->user()->name . ' viewed post: ' . $post->title : 'Guest viewed post: ' . $post->title);


        return view('posts.show', compact('post', 'categories', 'tags'));

    }


    public function byCategory($slug){
        $category = $this->category->findBySlug($slug);
        $posts = $this->post->getByCategory($category->id,10);
        $categories = $this->category->getAllOrdered();
        $tags = $this->tag->getAllOrdered();

        return view('posts.index', compact('posts', 'categories', 'tags'));
    }


    public function byTag($slug)
    {
        $tag        = $this->tag->findBySlug($slug);
        $posts      = $this->post->getByTag($tag->id, 10);
        $categories = $this->category->getAllOrdered();
        $tags       = $this->tag->getAllOrdered();

        return view('posts.index', compact('posts', 'categories', 'tags', 'tag'));
    }
}
