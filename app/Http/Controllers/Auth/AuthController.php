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


/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
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
//    protected $redirectTo = '/login';

//    protected $redirectAfterLogout = '/login';

//    protected $loginPath = '/login';

    /**
     * Create a new authentication controller instance.
     *
     */
    public function __construct()
    {
//        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }

//    public function getCredentials($request){
//
//        $credentials = $request->only($this->loginUsername(), 'password');
//
//        return array_add($credentials, 'verified', '1');
//
//    }

//    protected function getFailedLoginMessage()
//    {
//        return 'It seems like you haven\'t registered with us or verified your email address.';
//    }


//    protected function postLogin(Request $request)
//    {
//        if (Auth::attempt([
//            'username'  => $request->get('username'),
//            'password'  => $request->get('password'),
//            'verified'  => 1
//        ]))
//        {
//            return redirect()->intended('dashboard');
//        }
//    }

    /**
     * Renders Login Form
     * @return mixed
     */
    public function showLoginForm()
    {
        return view('auth.login');

    }

    /**
     * Renders register form
     * @return mixed
     */
    public function showRegistrationForm()
    {
        return view('auth.register');

    }

    /**
     * Process the login request
     * @param Request $request
     * @return mixed
     */

    /**
     * Register a new user
     * @param Request $request
     * @return mixed
     */
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
            if ($loginAttempts > 6 && (time() - $loginAttemptTime <= 600))
            {
                return redirect()->back()->with('error', 'Maximum login attempts reached. Try again later.');
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
            ], $request->get('remember')) && Auth::user()->level == 1){
            // Redirect to admin dashboard if the user level is 1
            return redirect()->intended('admin');
        } elseif (Auth::attempt([
                'username'  => $request->get('username'),
                'password'  => $request->get('password'),
                'verified'  => 1
            ], $request->get('remember')) && Auth::user()->level == 0){
            // Redirect to public interface if the user level is 0

            return redirect()->intended('scouter');

        }else{
            // Increment login attempts
            Session::put('loginAttempts', $loginAttempts + 1);
            return redirect()->back()->with('not_verified', 'It seems like you haven\'t registered with us  or verified your email address.');
        }

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
            'token'    => generateUniqueId(),
            'username' => $request->get('username'),
            'password' => bcrypt($request->get('password')),
        ]);
        Mail::send('auth.emails.confirm', ['user' => $user], function ($m) use ($user) {
            $m->from('noreply@nepalscout.org.np', 'Your Application');

            $m->to($user->email, $user->name)->subject('Email Confirmation');
        });

        return redirect()->back()->with('user_created', 'You are now registered with us. Please Check your email before you can login.');

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
     * @param $data
     * @return User
     */
//    protected function create(array $data)
//    {
//        $user = User::create([
//            'f_name'   => $data['f_name'],
//            'l_name'   => $data['l_name'],
//            'email'    => $data['email'],
//            'token'    => generateUniqueId(),
//            'username' => $data['username'],
//            'password' => bcrypt($data['password']),
//        ]);
//        Mail::send('auth.emails.confirm', ['user' => $user], function ($m) use ($user) {
//            $m->from('noreply@nepalscout.org.np', 'Your Application');
//
//            $m->to($user->email, $user->name)->subject('Email Confirmation');
//        });
//
//        return $user;
//
//    }

//    protected function authenticated(Request $request, User $user){
//        if($user->verified == 1) {
//            if ($user->level == 1) {
//                return redirect()->intended('admin');
//            }
//            if ($user->level  == 0) {
//                return redirect()->intended('scouter');
//            }
//        } else {
//            return view('auth.login')->with(['not_verified', 'Please verify your email address before you can login.']);
//        }
//    }

    /**
     * Logout from the system and destroy auth session
     * @return mixed
     */
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
