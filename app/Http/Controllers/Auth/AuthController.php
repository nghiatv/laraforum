<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use  ThrottlesLogins, RedirectsUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'terms' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),

        ]);
    }



    // socical login

    public function redirectToFacebook()
    {
        return Socialite::with('facebook')->redirect();
    }


    public function getFacebookCallback()
    {

        $data = Socialite::with('facebook')->user();

//        dd($data);$data
        $user = User::where('email', $data->email)->first();

        if(!is_null($user)) { // neu da ton tai email

            $user->name = $data->user['name'];
            $user->avatar_link = $data->avatar;
            $user->facebook_id = $data->id; // cap nhat facebook id cho ho
            $user->save();
            Auth::login($user); // dang nhap cho user do
            alert()->success('Bạn đã đăng nhập thành công', 'Welcome!');
            return redirect($this->redirectTo);
        } else {  // neu chua ton ai user co email nhu vay
            $user = User::where('facebook_id', $data->id)->first(); // tim kiem user co facebook_id nay
            if(is_null($user)){ // neu khong co
                // Create a new user
                $user = new User();
                $user->name = $data->user['name'];
                $user->email = $data->email;
                $user->confirmation_code = null;
                $user->confirmed = 1;
                $user->avatar_link = $data->avatar;
                $user->password = bcrypt($data->email);
                $user->facebook_id = $data->id;
                $user->save();

                Auth::login($user);
                alert()->success('Bạn đã đăng nhập thành công', 'Welcome!');
                return redirect()->intended($this->redirectPath());
            }


        }

    }
}
