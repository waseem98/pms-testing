<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Input;
use Auth;
use Redirect;
use Illuminate\Support\MessageBag;
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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    protected $redirectPath = '/patient';
    protected $loginPath = '/patient';
    
//
    public function postLogin()
    {
           //echo "abc";exit();
        $userdata = array(
            'name' => Input::get('name'),
            'password' => Input::get('password')
          );
      // doing login.
      if (Auth::validate($userdata)) {
        if (Auth::attempt($userdata)) {
          return Redirect::intended('/dashboard');
        }
      } 
      else {
        // if any error send back with message.
       // Session::flash('error', 'Something went wrong'); 
       
       $errors = new MessageBag(['password' => ['UserName or Password is invalid'],'uname' => [ Input::get('name')]]);
       return Redirect::back()->withErrors($errors)->withInput(Input::except('password'));
       
        //return Redirect::to('login')->with('err','eror');
      }
    }

   public function getLogout()
   {
      // echo "abc";exit();
       Auth::logout();
       return Redirect::to('login');
   }


    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            // 'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:1',
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
            'password' => bcrypt($data['password']),
            'type' => $data['type1'],
        ]);
    }
}