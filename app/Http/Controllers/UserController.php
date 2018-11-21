<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserDestroyRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserController extends Controller
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
            $users=User::orderBy('name')->paginate($this->limit);
            $usersCount=User::count();
            return view('layouts.backend.users.index',compact('users','usersCount'));
    }

    public function create(User $user)
    {
        return view('layouts.backend.users.create', compact('user'));
    }

    public function store(UserStoreRequest $request, User $user)
    {

        $values=$request->all();
        $user->name    = $values['name'];
        $user->email     = $values['email']; 
        $user->password = $values['password'];  
        $user->save();
        return redirect()->route('admin_users_index')->with('message' , 'New User added successfully');
    }


    public function edit($id)
    {
        $user= User::findorfail($id);
        return view('layouts.backend.users.edit',compact('user'));
    }

    public function update(UserUpdateRequest $request,$id)
    {
         $user=User::find($id);    
        $data=$request->all();
        $user->fill($data);     
        $user->save();
        return redirect()->route('admin_users_index')->with('message' , 'User updated successfully');

    }

    public function destroy(UserDestroyRequest $request,$id)
    {
    	$user=User::findOrFail($id);
    	$users=User::all();
    	$userid = $user->id;
    	$posts= Post::where('author_id', '=', $userid)->get();
    	
        $deleteOption=$request->delete_option;
        $selectUser=$request->select_user;
        
        if($deleteOption == "delete")
        {
			foreach($posts as $post){
				$post->delete();
			}   
			$user->delete();
        return redirect(route('admin_users_index'))->with('message','User has been deleted successfully');     	
        }
        elseif ($deleteOption == "attribute") {
        	foreach($posts as $post){
        		
				$post->update(['author_id' => $selectUser]);
			} 
			//$user->delete();
        return redirect()->back()->with('message','User has been deleted successfully');  	
        }		
    }

    public function confirm(UserDestroyRequest $request, $id)
    {
    	$user=User::findOrFail($id);
    	$users=User::where('id','!=',$user->id)->pluck('name','id');
    	return view('layouts.backend.users.confirm',compact('user','users'));
    }


}
