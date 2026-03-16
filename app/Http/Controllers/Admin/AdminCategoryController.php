<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    protected $category;

    public function __construct(){
        return $this->category = new Category();
    }

    public function index(){
        $categories = $this->category->getAllOrdered();
        return view('admin.categories.index',compact('categories'));
    }


    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        $category = $this->category->store($data);


        ActivityLog::storeLog('category.created', auth()->user()->name . ' created category: ' . $category->name);

        return redirect()->route('admin.categories.index')->with('success', 'Category created!');

    }


    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.posts.edit',compact('category'));
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category = $this->category->updateCategory($id,$data);

        ActivityLog::storeLog('category.updated', auth()->user()->name . ' updated category: ' . $category->name);
        return redirect()->route('admin.category.index')->with('success', 'Category updated!');
    }


    public function destroy(Request $request ,$id){
        $category = Category::findOrFail($id);
        $category->delete();

        ActivityLog::storeLog('category.deleted', auth()->user()->name . ' deleted category: ' . $category->name);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');

    }
}
