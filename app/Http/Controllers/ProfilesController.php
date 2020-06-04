<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;

class ProfilesController extends Controller
{
    public function index($slug)
    {
    	$user = User::where('slug', $slug)->first();
    	return view('profiles.timeline')->with('user', $user)->with('title', $slug);
    }

    public function basic($slug)
    {
    	$user = User::where('slug', $slug)->first();
    	return view('profiles.basic')->with('user', $user)->with('title', $slug);
    }

    public function background($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('profiles.background')->with('user', $user)->with('title', $slug);
    }

    public function update(Request $request)
    {
        
        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            'city'      => 'required|string|max:255',
            'about'     => 'required|string|min:30|max:190',
        ]);

        $bind = $request['day'] .' '. $request['month'] .' '. $request['year'];
        $convert = strtotime($bind);
        $dob = date("Y-m-d H:i:s", $convert);

        if ($request['gender']) {
            $avatar = 'public/defaults/avatar/male-3.jpg';
        } else {
            $avatar = 'public/defaults/avatar/female.png';
        }

        Auth::user()->update([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'dob'       => $dob,
            'slug'      => str_slug($request->firstname .'-'. $request->lastname),
            'gender'    => $request->gender,
            'avatar'    => $avatar,
            'city'      => $request->city,
            'country'   => $request->country,
            'about'     => $request->about,
        ]);

        if ($request->hasFile('avatar')) {
            Auth::user()->update([
                'avatar' => $request->avatar->store('public/avatars')
            ]);
        }

        if ($request->hasFile('cover')) {
            Auth::user()->update([
                'cover' => $request->cover->store('public/covers')
            ]);
        }

        Session::flash('success', 'Basic profile updated successfully !');
        return redirect()->route('timeline.basic', ['slug' => str_slug($request->firstname .'-'. $request->lastname) ]);
    }

    public function background_update(Request $request)
    {
        
        $this->validate($request, [
            'location'     => 'required|string',
        ]);

        Auth::user()->profile()->update([
            'university'  => $request->university,
            'subject'     => $request->subject,
            'uni_from'    => $request->uni_from,
            'uni_to'      => $request->uni_to,
            'company'     => $request->company,
            'designation' => $request->gender,
            'from'        => $request->from,
            'to'          => $request->to,
            'location'    => $request->location,
        ]);

        Session::flash('success', 'Background profile updated successfully !');
        return redirect()->route('timeline.background', ['slug' => str_slug(Auth::user()->firstname .'-'. Auth::user()->lastname) ]);
    }

    public function notifications()
    {
        /*$type = 'App\Notifications\NewFriendRequest';
        $not = auth()->user()->unreadNotifications->where('type', $type);
        dd($not);*/

        /*$types = [
        'order' => 'App\Notifications\NewFriendRequest',
        ];
        
        foreach ($types as $key => $type) {
            $alerts[$key] = auth()->user()->unreadNotifications->where('type', $type);
            dd($alerts);
        }*/

        Auth::user()->unreadNotifications->markAsRead();
        return view('profiles.notifications')->with('nots', Auth::user()->notifications()->paginate(5));
    }

}
