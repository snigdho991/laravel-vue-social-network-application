<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use Auth;
use App\User;
use App\Friendship;


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

    public function unread_notification()
    {
        return Auth::user()->unreadNotifications;
    }

    public function mark_notification_as_read()
    {
        return Auth::user()->unreadNotifications->markAsRead();
    }

    public function pending_requests()
    {
        Auth::user()->unreadNotifications->where('type', 'App\Notifications\NewFriendRequest')->markAsRead();

        $pending = Auth::user()->pending_friend_requests();
        
        $users = Friendship::where('user_requested', Auth::id())->where('status', 0)->get();
        
        return view('profiles.pending')->with(['requests' => $pending])
                                       ->with('users', $users);

    }

    public function mark_request_as_read()
    {
        return Auth::user()->unreadNotifications->where('type', 'App\Notifications\NewFriendRequest')->markAsRead();
    }
}
