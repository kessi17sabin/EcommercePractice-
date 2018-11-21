<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Requests\CategoryDestroyRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    protected $limit=5;
    protected $uploadPath;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check-permissions');
        $this->uploadPath = public_path(config('cms.image.directory'));
    }


    public function index()
    {
            $categories=Category::with('posts')->latest()->paginate($this->limit);
            $categoriesCount=Category::count();
            return view('layouts.backend.category.index',compact('categories','categoriesCount'));
    }

    public function create(Category $category)
    {
        return view('layouts.backend.category.create', compact('category'));
    }

    public function store(CategoryStoreRequest $request, Category $category)
    {

        $values=$request->all();
        $category->title    = $values['title'];
        $category->slug     = $values['slug'];   
        $category->save();
        return redirect()->route('admin_category_index')->with('message' , 'New Category added successfully');
    }


    public function edit($id)
    {
        $category= Category::findorfail($id);
        return view('layouts.backend.category.edit',compact('category'));
    }

    public function update(CategoryUpdateRequest $request,$id)
    {
         $category=Category::find($id);    
        $data=$request->all();
        $category->fill($data);     
        $category->save();
        return redirect()->route('admin_category_index')->with('message' , 'Category updated successfully');

    }

    public function destroy(CategoryDestroyRequest $request,$id)
    {
        Post::where('category_id',$id)->update(['category_id'=>config('cms.default_category_id')]);
        $category=Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('message','Category has been deleted successfully');
    }


}
