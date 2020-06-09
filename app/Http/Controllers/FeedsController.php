<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;

class FeedsController extends Controller
{
    public function feed()
    {
    	$friends = Auth::user()->friends();

    	$feeds = array();

    	foreach ($friends as $friend) {
    		foreach ($friend->posts->sortByDesc('created_at') as $post) {
    			array_push($feeds, $post);
    		}
    	}

    	return $feeds;
    }
}
