<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class SiteHelpController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
     {
         return view('welcome');
     }

    public function update_terms(Request $request)
    {
        DB::table('site_service')->where('id', 1)->update(['terms_service' => $request->terms]);
        return 'successfully';
    }

    public function update_privacy(Request $request)
    {
        DB::table('site_service')->where('id', 1)->update(['privacy_policy' => $request->privacy]);
        return 'successfully';
    }


    public function update_aboutus(Request $request)
    {
        DB::table('site_service')->where('id', 1)->update(['about_us' => $request->aboutus]);
        return 'successfully';
    }

    public function getsitehelpdata()
    {
        $servicedata = DB::table('site_service')->where('id', 1)->get();
        return $servicedata;
    }

    public function termsCondition()
    {
        $allservicedata = DB::table('site_service')->where('id', 1)->get();
        return view('auth.termsCondition',['helpdata' => $allservicedata[0]]);
    }
    public function about_us()
    {
        $allservicedata = DB::table('site_service')->where('id', 1)->get();
        return view('auth.aboutUs',['helpdata' => $allservicedata[0]]);
    }
    public function privacy_policy()
    {
        $allservicedata = DB::table('site_service')->where('id', 1)->get();
        return view('auth.privacyPolicy',['helpdata' => $allservicedata[0]]);
    }
}
