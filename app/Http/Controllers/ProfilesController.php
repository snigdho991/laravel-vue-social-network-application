<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfilesController extends Controller
{
    public function index($slug)
    {
    	$user = User::where('slug', $slug)->first();
    	return view('profiles.timeline')->with('user', $user)->with('title', $slug);
    }

    public function friends($slug)
    {
        $user = User::where('slug', $slug)->first();

        $muarr = array();
        $find = $user->friends();

        $mu = collect($find)->pluck('id')->toArray();
        
        foreach ($mu as $new) {
            array_push($muarr, Auth::user()->is_friends_with($new));
        }
        
        $result = array_sum($muarr);

        return view('profiles.friendlist')->with('user', $user)->with('title', $slug)->with('result', $result);
    }

    public function friendlist($slug)
    {
    	$user = User::where('slug', $slug)->first();
        $find = $user->friends();

        // this basically gets the request's page variable... or defaults to 1
        $page = Paginator::resolveCurrentPage('page') ?: 1;

        // Assume 15 items per page... so start index to slice our array
        $startIndex = ($page - 1) * 2;

        // Length aware paginator needs a total count of items... to paginate properly
        $total = count($find);

        // Eliminate the non relevant items...
        $results = array_slice($find, $startIndex, 2);

        $list =  new LengthAwarePaginator($results, $total, 2, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        
        return $list;

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
        Auth::user()->unreadNotifications->markAsRead();
        return view('profiles.notifications')->with('nots', Auth::user()->notifications()->paginate(5));
    }

}
