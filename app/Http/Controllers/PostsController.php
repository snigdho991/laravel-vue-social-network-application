<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Storage;

class PostsController extends Controller
{
    public function store(Request $request)
    {
    	return Post::create([
    		'user_id' => Auth::id(),
    		'content' => $request->content
    	]);
    }

    public function save_image(Request $request)
    {
    	$file = $request->get('image');

    	$exploded = explode(",", $file);
    	
    	if (str_contains($exploded[0], 'gif')) {
    		$extension = 'gif';
    	} else if(str_contains($exploded[0], 'jpg')) {
    		$extension = 'jpg';
    	} else if(str_contains($exploded[0], 'jpeg')) {
    		$extension = 'jpeg';
    	} else {
    		$extension = 'png';
    	}

    	$decode = base64_decode($exploded[1]);

    	$filename = str_random($length = 7) . time() . "." . $extension;

    	$path = storage_path() . '/app/public/posts/' . $filename;
    	
    	if (file_put_contents($path, $decode)){
	    	$post = new Post;
	        $post->user_id = Auth::id();
            $post->content = $request->content;
	        $post->image = asset(Storage::url('posts/'.$filename));
	        $post->save();
    	}
    }
}
