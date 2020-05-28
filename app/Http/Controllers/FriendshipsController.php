<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class FriendshipsController extends Controller
{
    public function check($id)
    {
    	if (Auth::user()->is_friends_with($id)) {
    		return ['status' => 'friends'];
    	}

    	if (Auth::user()->has_pending_friend_requests_from($id)) {
    		return ['status' => 'pending'];
    	}

    	if (Auth::user()->has_pending_friend_requests_sent_to($id)) {
    		return ['status' => 'responsing'];
    	}

    	return ['status' => 0];
    }

    public function add_friend($id)
    {
        $resp = Auth::user()->add_friend($id);

        User::find($id)->notify(new \App\Notifications\NewFriendRequest(Auth::user()) );
        
        return $resp;
    }

    public function accept_friend($id)
    {
        $resp = Auth::user()->accept_friend($id);

        User::find($id)->notify(new \App\Notifications\FriendRequestAccepted(Auth::user()) );

        return $resp;
    }

    public function decline_request($id)
    {
        return Auth::user()->decline_request($id);
    }
}
