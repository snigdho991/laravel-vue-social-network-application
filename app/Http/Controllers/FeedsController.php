<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

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
    		foreach ($friend->posts as $post) {
    			array_push($feeds, $post);
    		}
    	}

        $posts = Auth::user()->posts;
        foreach ($posts as $post) {
            array_push($feeds, $post);
        }

        usort($feeds, function($p1, $p2){
            return $p1->id < $p2->id;
        });

        /*$perPage = 5;
        return $myfeed = new Paginator($feeds, $perPage, Paginator::resolveCurrentPage(), [
            'path' => Paginator::resolveCurrentPath()
        ]);*/


        // this basically gets the request's page variable... or defaults to 1
        $page = Paginator::resolveCurrentPage('page') ?: 1;

        // Assume 15 items per page... so start index to slice our array
        $startIndex = ($page - 1) * 15;

        // Length aware paginator needs a total count of items... to paginate properly
        $total = count($feeds);

        // Eliminate the non relevant items...
        $results = array_slice($feeds, $startIndex, 15);

        $myfeed =  new LengthAwarePaginator($results, $total, 15, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        
        return $myfeed;
    }

    public function timelinefeed() {
        $feeds = array();       
        
        $posts = Auth::user()->posts;
        foreach ($posts->sortByDesc('created_at') as $post) {
            array_push($feeds, $post);
        }

        // this basically gets the request's page variable... or defaults to 1
        $page = Paginator::resolveCurrentPage('page') ?: 1;

        // Assume 15 items per page... so start index to slice our array
        $startIndex = ($page - 1) * 15;

        // Length aware paginator needs a total count of items... to paginate properly
        $total = count($feeds);

        // Eliminate the non relevant items...
        $results = array_slice($feeds, $startIndex, 15);

        $myfeed =  new LengthAwarePaginator($results, $total, 15, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        
        return $myfeed;

    }
}
