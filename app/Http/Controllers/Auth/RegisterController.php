<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/newsfeed';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'reg_firstname' => 'required|string|max:255',
            'reg_lastname'  => 'required|string|max:255|unique:users,lastname',
            'reg_email'     => 'required|string|email|max:255|unique:users,email',
            'reg_password'  => 'required|string|min:6',
            'day'           => 'required',
            'month'         => 'required',
            'year'          => 'required',
            'gender'        => 'required',
            'city'          => 'required|string|max:255',
            'country'       => 'required',
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $bind = $data['day'] .' '. $data['month'] .' '. $data['year'];
        $convert = strtotime($bind);
        $dob = date("Y-m-d H:i:s", $convert);

        if ($data['gender']) {
            $avatar = 'public/defaults/avatar/male-3.jpg';
        } else {
            $avatar = 'public/defaults/avatar/female.png';
        }

        $cover = 'public/covers/static/cover.gif';


        $user = User::create([
            'firstname' => $data['reg_firstname'],
            'lastname'  => $data['reg_lastname'],
            'email'     => $data['reg_email'],
            'password'  => bcrypt($data['reg_password']),
            'dob'       => $dob,
            'slug'      => str_slug($data['reg_firstname'] .'-'. $data['reg_lastname']),
            'avatar'    => $avatar,
            'gender'    => $data['gender'],
            'city'      => $data['city'],
            'country'   => $data['country'],
            'cover'     => $cover,
            
        ]);

        $user->profile()->save(new Profile());
        return $user;
    }
}
