<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use Auth;
use Storage;

class PostsController extends Controller
{
    public function store(Request $request)
    {
        $post = Post::create([
    		'user_id' => Auth::id(),
    		'content' => $request->content
    	]);

        return Post::find($post->id);
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
    	
    	if (file_put_contents($path, $decode)) {
	    	$post = new Post;
	        $post->user_id = Auth::id();
            $post->content = $request->content;
	        $post->image = asset(Storage::url('posts/'.$filename));
	        $post->save();
            return Post::find($post->id);
    	}
    }

    public function like($id)
    {
        $post = Post::find($id);

        $like = Like::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);

        return Like::find($like->id);
    }

    public function unlike($id)
    {
        $post = Post::find($id);

        $like = Like::where('user_id', Auth::id())
                    ->where('post_id', $post->id)
                    ->first();

        $like->delete();

        return $like->id;
    }
}
