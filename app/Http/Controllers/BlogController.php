<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $limit=3;

    public function index()
    {
        $categories=Category::with('posts')->orderBy('title','asc')->get();

        $posts=Post::with('author')->orderBy('created_at','desc')->published()->paginate($this->limit);
        return view('blog.index',compact('posts' , 'categories'));

    }

    public function category($id)
    {
        $categories=Category::with(['posts'=>function($query){$query->published();}])
            ->orderBy('title','asc')->get();

        $posts=Post::with('author')->orderBy('created_at','desc')->published()->where('category_id',$id)->paginate($this->limit);

        return view('blog.index',compact('posts' , 'categories'));



    }

    public function show($id)
    {

        $post=Post::published()->findOrFail($id);
        $categories=Category::with(['posts'=>function($query){$query->published();}])
            ->orderBy('title','asc')->get();
        return view('blog.show',compact('post', 'categories'));
    }
}
