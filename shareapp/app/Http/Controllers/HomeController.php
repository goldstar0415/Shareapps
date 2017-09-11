<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('homePage');
    }

    public function create_new_application()
    {
      return view('CreateNewApplication');
    }

    public function user_profile()
    {
      return view('UserProfile');
    }

    public function user_management()
    {
      if(Auth::User()->user_role_check == 1){
        $users = DB::table('users')->get();
        return view('userManagement',['users' => $users]);
      }
      else{
        return redirect(url('create-new-application'));
      }
    }
}
