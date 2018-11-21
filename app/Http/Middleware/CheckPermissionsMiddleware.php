<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;

class CheckPermissionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $currentUser=$request->user();
        $currentActionName=$request->route()->getActionName(); 
    
        list($controller,$method)=explode('@',$currentActionName );
        $controller = str_replace(["App\Http\Controllers\\","Controller"], "" , $controller);

        $crudPermissionsMap = [
            'crud' => ['create','store','edit','update','destroy','restore','forceDestroy','index','view']
        ];

        $classesMap = [
            'Backend' => 'post',
            'Category' => 'category',
            'User' => 'user',
        ];

        foreach ($crudPermissionsMap as $permission => $methods) {
            //if the current methos exists in current list
            //we will check the permission
            if (in_array($method, $methods) && isset($classesMap[$controller])) {
                $className = $classesMap[$controller];
 
                if ($className=="post" && in_array($method, ['edit','update','destroy','restore','forceDestroy']))
                 {
                   //if the user have no permissons to update other posts and delete others post
                    //he can only edit his own posts
                 if (($id = $request->route("blog"))&&(!$currentUser->can('update-others-post') || !$currentUser->can('delete-others-post')))
                     {
                        $post=Post::find($id);
                        if ($post->author_id !== $currentUser->id) 
                        {
                            abort(403,"forbidden access");
                     }

                  } 
                  }             
                //if the user has no permission dont allow request
                elseif (! $currentUser ->can("{$permission}-{$className}")) {
                    abort(403,"forbidden access");
                }
                break;
            }

            
        }

         return $next($request);
    }
}
