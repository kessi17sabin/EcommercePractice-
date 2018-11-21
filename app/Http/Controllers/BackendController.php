<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BackendController extends Controller
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


    public function index(Request $request)
    {
        if (($status=$request->get('status'))&& $status == 'trash')
        {
            $posts=Post::onlyTrashed()->with('category','author')->latest()->paginate($this->limit);
            $postCount=Post::onlyTrashed()->count();
            $onlyTrashed= TRUE;
        }
        else
        {
            $posts=Post::with('category','author')->latest()->paginate($this->limit);
            $postCount=Post::count();
            $onlyTrashed= FALSE;
        }

        return view('layouts.backend.blog.index',compact('posts','postCount','onlyTrashed'));
    }

    public function create(Post $post)
    {
        return view('layouts.backend.blog.create', compact('post'));
    }

    public function store(PostRequest $request, Post $post)
    {

        $values=$request->all();
        $post->author_id = Auth::user()->id;
        $post->title    = $values['title'];
        $post->slug     = $values['slug'];
        $post->excerpt  = $values['excerpt'];
        $post->body     = $values['body'];
        $post->category_id = $values['category_id'];
        $post->published_at = $values['published_at'];

        $post=$this->handleRequest($request,$post);

        $post->save();

        return redirect()->route('admin_blog_index')->with('message' , 'Post added successfully');
    }

    public function handleRequest(PostRequest $request,Post $post)
    {
    
        if($request->hasFile('image'))
        {
            $image= $request->file('image');
            $filename=$image->getClientOriginalName();
            $destination= $this->uploadPath;

            $uploadSuccess=$image->move($destination,$filename);

            

            if ($uploadSuccess) {
                $width     = config('cms.image.thumbnail.width');
                $height    = config('cms.image.thumbnail.height');

                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $filename);

                Image::make($destination . '/' . $filename)->resize($width,$height)->save($destination . '/' . $thumbnail);  
            }

            $post->image = $filename;
        }

        return $post;
            
    }

    public function edit($id)
    {
        $post= Post::findorfail($id);
        return view('layouts.backend.blog.edit',compact('post'));
    }

    public function update(PostRequest $request,$id)
    {
        $post=Post::find($id);
        $oldImage=$post->image;
        $data=$request->all();
        $post->fill($data);
        $data = $this->handleRequest($request,$post);
        $post->save();

       if ($oldImage !== $post->image)
       {
           $this->removeImage($oldImage);
       }

        return redirect()->route('admin_blog_index')->with('message' , 'Post updated successfully');

    }

    public function destroy($id)
    {
        $post=Post::findOrFail($id);
        $post->delete();
        return redirect()->back()->with('trash-message',['Your Post has been moved to Trash',$id]);
    }

    public function forceDestroy($id)
    {
        $post=Post::withTrashed()->findOrFail($id);
        $post->forceDelete();
        $this->removeImage($post->image);
        return redirect()->back()->with('message','Your Post has been deleted from Trash');

    }

    public function restore($id)
    {
        $post=Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->back()->with('message','Your post has been moved from trash');
    }

    private function removeImage($image)
    {
        if(! empty($image))
        {
            $imagePath=$this->uploadPath . '/' . $image;
            $ext=substr(strrchr($image,'.'),1);
            $thumbext=str_replace(".{$ext}","_thumb.{$ext}",$image);
            $thumbPath=$this->uploadPath . '/' . $thumbext;

            if (file_exists($imagePath))

                unlink($imagePath);

            if (file_exists($thumbPath))
                unlink($thumbPath);
        }
    }



    
}
