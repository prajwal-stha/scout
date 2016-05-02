<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Mail;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Session;

//use Illuminate\Foundation\Auth\ThrottlesLogins;
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


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

//    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

//    protected $username = 'username';

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
//    protected $redirectTo = 'scouter';

//    protected $redirectAfterLogout = '/login';

    /**
     * Create a new authentication controller instance.
     *
     */
//    public function __construct()
//    {
//        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
//
//    }

//    public static function boot()
//    {
//        parent::boot();
//        static::creating(function($user){
//
//            $user->token = str_random(30);
//
//        });
//
//    }


//    protected function postLogin(Request $request)
//    {
//        dd($request);
//        if (Auth::attempt([
//            'username'  => $request->get('username'),
//            'password'  => $request->get('password'),
//            'verified'  => 1
//        ]))
//        {
//            return redirect()->intended('dashboard');
//        }
//
//
//    }

    public function showLoginForm()
    {
        return view('auth.login');

    }

    public function showRegistrationForm()
    {
        return view('auth.register');

    }

    public function login(Request $request)
    {
        // Set login attempts and login time
        $loginAttempts = 1;

        // If session has login attempts, retrieve attempts counter and attempts time
        if (Session::has('loginAttempts'))
        {
            $loginAttempts = Session::get('loginAttempts');
            $loginAttemptTime = Session::get('loginAttemptTime');

            // If attempts > 3 and time < 10 minutes
            if ($loginAttempts > 3 && (time() - $loginAttemptTime <= 600))
            {
                return redirect()-back()->with('error', 'Maximum login attempts reached. Try again in a while');
            }
            // If time > 10 minutes, reset attempts counter and time in session
            if (time() - $loginAttemptTime > 600)
            {
                Session::put('loginAttempts', 1);
                Session::put('loginAttemptTime', time());
            }
        } else // If no login attempts stored, init login attempts and time
        {
            Session::put('loginAttempts', $loginAttempts);
            Session::put('loginAttemptTime', time());
        }
        // If auth ok, redirect to restricted area
        if (Auth::attempt([
            'username'  => $request->get('username'),
            'password'  => $request->get('password'),
            'verified'  => 1
        ], $request->get('remember')))
        {
            if(Auth::user()->level == 1){
                return redirect()->intended('admin');
            }
            if(Auth::user()->level != 1){
                return redirect()->intended('scouter');
            }

        }else{
            return redirect()->back()->with(['not_verified', 'Please verify your email address before you can login']);
        }
        // Increment login attempts
        Session::put('loginAttempts', $loginAttempts + 1);
    }

    public function register(Request $request){
        $this->validate($request,[
            'f_name'    => 'required|max:255',
            'l_name'    => 'required|max:255',
            'email'     => 'required|email|max:255|unique:users,email',
            'username'  => 'required|max:255|unique:users,username|alpha_dash',
            'password'  => 'required|min:6|confirmed',
        ]);
        $user = User::create([
            'f_name'   => $request->get('f_name'),
            'l_name'   => $request->get('l_name'),
            'email'    => $request->get('email'),
            'token'    => bcrypt($request->get('email'). time()),
            'username' => $request->get('username'),
            'password' => $request->get('password'),
        ]);
        Mail::send('auth.emails.confirm', ['user' => $user], function ($m) use ($user) {
            $m->from('noreply@nepalscout.org.np', 'Your Application');

            $m->to($user->email, $user->name)->subject('Email Confirmation');
        });

        return redirect()->back()->with('user_created', 'You are now registered');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
//    protected function validator(array $data)
//    {
//        return Validator::make($data, [
//            'f_name'   => 'required|max:255',
//            'l_name'   => 'required|max:255',
//            'email'    => 'required|email|max:255|unique:users,email',
//            'username' => 'required|max:255|unique:users,username|alpha_dash',
//            'password' => 'required|min:6|confirmed',
//        ]);
//    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return User
     */
//    protected function create(array $data)
//    {
//        $user = User::create([
//            'f_name'   => $data['f_name'],
//            'l_name'   => $data['l_name'],
//            'email'    => $data['email'],
//            'token'    => bcrypt(str_random(30)),
//            'username' => $data['username'],
//            'password' => bcrypt($data['password']),
//        ]);
//        Mail::send('auth.emails.confirm', ['user' => $user], function ($m) use ($user) {
//            $m->from('noreply@nepalscout.org.np', 'Your Application');
//
//            $m->to($user->email, $user->name)->subject('Your Reminder!');
//        });
//
//        return $user;
//
//    }

//    protected function authenticated(){
//        if(Auth::user()->verified == 1) {
//            if (Auth::user()->level == 1) {
//                return redirect()->intended('admin');
//            }
//            if (Auth::user()->level  == 0) {
//                return redirect()->intended('scouter');
//            }
//        } else {
//            return view('auth.login')->with(['not_verified', 'Please verify your email address before you can login']);
//        }
//    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }


}
