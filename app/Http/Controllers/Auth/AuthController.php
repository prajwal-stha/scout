<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $username = 'username';

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    protected $redirectAfterLogout = '/login';

    protected $loginPath = '/login';

    protected $redirectPath = 'admin';

    /**
     * Create a new authentication controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    public function getCredentials($request)
    {

        $credentials = $request->only($this->loginUsername(), 'password');

        return array_add($credentials, 'verified', '1');

    }

    protected function getFailedLoginMessage()
    {
        return "It seems like you haven't registered with us or not verified your email address with us.";
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'f_name' => 'required|max:255',
            'l_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'username' => 'required|max:255|unique:users,username|alpha_dash',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * @param $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'f_name' => $data['f_name'],
            'l_name' => $data['l_name'],
            'email' => $data['email'],
            'token' => generateUniqueId(),
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
        Mail::send('auth.emails.confirm', ['user' => $user], function ($m) use ($user) {
            $m->from('noreply@nepalscout.org.np', 'Your Application');

            $m->to($user->email, $user->name)->subject('Email Confirmation');
        });

        return $user;

    }

    protected function authenticated(Request $request, User $user)
    {
        if ($user->verified == 1) {

            if ($user->level == 1) {
                return redirect('admin');
            }
            if ($user->level == 0) {
                return redirect('scouter');
            }
        } else {
            return view('auth.login')->with(['not_verified', 'Please verify your email address before you can login.']);
        }
    }


    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $this->create($request->all());

        return redirect($this->redirectPath());
    }
}