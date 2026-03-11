<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
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


    public function index(){
        $posts = $this->post->getAllForAdmin();
        return view('admin.posts.index',compact('posts'));
    }

    public function create(){
        $categories = $this->category->getAllOrdered();
        $tags = $this->tag->getAllOrdered();
        return view('admin.posts.create',compact('categories','tags'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'body'        => 'required',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:draft,published',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $imagePath = null;
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images','public');
        }

        $post = $this->post->store($data,$imagePath);

        if (isset($data['tags'])) {
            $this->post->syncTags($post, $data['tags']);
        }

        ActivityLog::storeLog('post.created', auth()->user()->name . ' created post: ' . $post->title);

        return redirect()->route('admin.posts.index')->with('success', 'Your post has been created successfully!');

    }

    public function edit(Request $request,$id){
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'body'        => 'required',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:draft,published',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if($request->hasFile('image')){
            $post = Post::findOrFail($id);

            if($post->image){
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('images','public');
        }

        $post = $this->post->updatePost($data,$imagePath);


        $this->post->syncTags($post, $data['tags'] ?? []);


        ActivityLog::storeLog('post.updated', auth()->user()->name . ' updated post: ' . $post->title);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');



    }

    public function destroy(Request $request,$id){
        $post = Post::findOrFail($id);

        if($post->image){
            Storage::disk('public')->delete($post->image);
        }

        ActivityLog::storeLog('post.deleted', auth()->user()->name . ' deleted post: ' . $post->title);


        $this->post->deletePost($id);


        if($request->ajax()){
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Post deleted successfully!');
    }
}
