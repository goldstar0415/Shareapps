<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use \App\User;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/create-new-application';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function gotologinform()
    {
        return redirect(url('admin/login'));
    }

    public function validateLogin($request)
    {
        $this->validate($request, [
            $this->useremail() => 'required', 'password' => 'required'
        ]);
    }

    protected function credentials(Request $request)
    {
        return array_merge($request->only('email', 'password'));
    }

    public function login(Request $request)
    {
      $this->validateLogin($request);
      $remember = $request->input('remember');
      $getuserinfo = $this->credentials($request);
      $availablecheck = Auth::guard()->attempt($getuserinfo, $remember);

      if ($availablecheck) {

        $user = User::find(Auth::id());
        if ($user->verified == 0) {
            $this->guard()->logout();
            return redirect()->back()->with('status','Confirmation email has been send. please check your email.');
        }
        else if($user->user_role < 1) {
            $this->guard()->logout();
            return redirect()->back()->with('status','Your account is not an administrator account..');
        } else {
            $this->isRemember($request);
            return redirect('/create-new-application');
        }
      }
      return redirect()->back()->with('error', 'These credentials do not match our records.');
    }

    public function showLoginForm()
    {
        return view('admin.adminLogin');
    }

    public function useremail()
    {
        return 'email';
    }

    public function cookieSet($name, $value, $time)
    {
        setcookie($name, $value, $time, "/");
    }

    public function isRemember($request){
        if($request->input('remember')){
            //for 30 days
            $time = time() + (86400 * 30);
            $this->cookieSet("email",$request->input('email'),$time);
            $this->cookieSet("password",$request->input('password'),$time);
        }
    }
}
