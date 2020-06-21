<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class CommentController extends Controller
{
    public function index(Post $post)
    {
    	return $post->comments()->paginate(2);
    }

    public function store(Request $request, Post $post)
    {
    	return Auth::user()->comments()->create([
    		'body'    => $request->body,
    		'post_id' => $post->id,
    		'user_id' => Auth::id()
    	])->fresh();
    }
}
