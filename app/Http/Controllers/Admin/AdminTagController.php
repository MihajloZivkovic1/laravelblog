<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminTagController extends Controller
{
    protected $tag;

    public function __construct(){
        $this->tag = new Tag();
    }


    public function index(){
        $tags = $this->tag->getAllOrdered();
        return view('admin.tags.index',compact('tags'));
    }

    public function create(){
        return view('admin.tags.create');
    }


    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',

        ]);

        $this->tag->create($data);
        ActivityLog::storeLog('tag.created',auth()->user()->name . ' created a new tag.');

        return redirect()->route('admin.tags.index')->with('success','Tag created successfully');

    }


    public function edit($id){
        $tag = $this->tag->findOrFail($id);
        return view('admin.tags.edit',compact('tag'));
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => 'required|string|max:255' . $id,

        ]);

        $tag = $this->tag->updateTag($id,$data);

        ActivityLog::storeLog('tag.updated', auth()->user()->name . ' updated tag: ' . $tag->name);


        return redirect()->route('admin.tags.index')->with('success', 'Tag updated successfully!');


    }


    public function destroy(Request $request, $id){

        $tag = Tag::findOrFail($id);
        ActivityLog::storeLog('tag.deleted', auth()->user()->name . ' deleted tag: ' . $tag->name);

        $this->tag->deleteTag($id);


        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.tags.index')->with('success', 'Tag deleted successfully!');


    }
}
