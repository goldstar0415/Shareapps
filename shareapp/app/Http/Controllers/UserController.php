<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use \App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Jrean\UserVerification\Facades\UserVerification;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function __construct()
    {
        // parent::__construct();
    }

    public function changeUserinfo(Request $request)
    {
        if(Auth::User()->id){
          $obj_user = User::find(Auth::User()->id);
          $obj_user->first_name = $request->input('fname');
          $obj_user->last_name = $request->input('lname');
          $obj_user->save();
          return back()->with('status', 'User Name changed successfully');
        }
        return back()->with('error', 'Went somthing wrong');
    }

    public function changePassword(Request $request)
    {
        if (Auth::Check()) {
            $requestData = $request->All();
            $this->validateChangePassword($requestData);
            $current_password = Auth::User()->password;
            // print_r($current_password);
            // print_r('=>');
            // print_r(Hash::Check($requestData['current-password'], $current_password));
            // exit;
            if (Hash::Check($requestData['current-password'], $current_password)) {
                $user_id = Auth::User()->id;
                $obj_user = User::find($user_id);
                $obj_user->password = bcrypt($requestData['password']);
                $obj_user->save();
                return back()->with('status', 'Password changed successfully');
            } else {
                return back()->with('error', 'Please enter correct current password');
            }
        } else {
            return redirect()->to('/');
        }
    }

    private function validateChangePassword(array $data)
    {
        $messages = [
            'current-password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
            'password.regex' => 'Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters'
        ];

        $validator = Validator::make($data, [
            'current-password' => 'required',
        ], $messages);

        return $validator->validate();
    }

    public function changePhoneNumber(Request $request)
    {
        if(Auth::User()->id){
          $obj_user = User::find(Auth::User()->id);
          $obj_user->phone_number = $request->input('phone_number');
          $obj_user->save();
          return back()->with('status', 'User Phone Number changed successfully');
        }
        return back()->with('error', 'Went somthing wrong');
    }

    public function changeEmailAddress(Request $request)
    {
        if (Auth::User()->id) {
            $obj_user = User::find(Auth::User()->id);

            //if Verified email
            if($obj_user->email == $request->input('email'))
                return back()->with('error', 'You have already this email address.');
            //if Email already exist
            if($this->isExistEmail($request->input('email')) == true)
                return back()->with('error', 'This email address has already been taken.');

            $obj_user->email = $request->input('email');
            $obj_user->verified = 0;
            $obj_user->save();
            if($obj_user->email == $request->input('email')){
              UserVerification::generate($obj_user);

              UserVerification::send($obj_user, 'please verify your email');

              return back()->with('status','Confirmation email has been send. please check your email.');
            }else
                return back()->with('error', 'Something went wrong in email updating or email verification sending.');
        } else {
            return back()->with('error', 'You have no access for this action');
        }
    }

    public function changeAvatar(Request $request)
    {
        if (Auth::User()->id) {
            $this->validate($request, [
                'user_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $img = $request->user_image;
            $dst = public_path('../../assets/images/avatar/') . Auth::User()->id;
            $thumbnail = public_path('../../assets/images/avatar/') . Auth::User()->id.'_thumbnail';
            if (($img_info = getimagesize($img)) === FALSE)
                return back()->with('error', 'Image not found or not an image');

            $width = $img_info[0];
            $height = $img_info[1];

            switch ($img_info[2]) {
              case IMAGETYPE_GIF  : $src = imagecreatefromgif($img);  break;
              case IMAGETYPE_JPEG : $src = imagecreatefromjpeg($img); break;
              case IMAGETYPE_PNG  : $src = imagecreatefrompng($img);  break;
              default : return back()->with('error', 'Unknown file type');
            }

            $tmp = imagecreatetruecolor($width, $height);
            $tmp_thumbnail = imagecreatetruecolor(200,  200);
            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
            imagecopyresized($tmp_thumbnail, $src, 0, 0, 0, 0, 200, 200, $width, $height);
            imagejpeg($tmp, $dst . ".jpg");
            imagejpeg($tmp_thumbnail, $thumbnail . ".jpg");
            // $imageName = time().'.'.$request->image->getClientOriginalExtension();
            // $request->image->move(public_path('images/avatar'), $imageName);

            return back()->with('status', 'Your avatar changed successfully');
        } else {
            return back()->with('error', 'You have no access for this action');
        }
    }

    public function userCountry(Request $request)
    {
        if (Auth::User()->id) {
            $obj_user = User::find(Auth::User()->id);

            $obj_user->country = $request->input('country');
            $obj_user->save();
            return back()->with('done', '');
        } else {
            return back()->with('error', 'You have no country for this action');
        }
    }

    public function isExistEmail($email){
        $user = DB::table('users')->where(array('email' => $email))->count();
        if($user != 0){
            return true;
        }else{
            return false;
        }
    }
    public function delete_user(Request $request)
    {
      $user_id = $request->user_id;
      DB::table('users')->where('id', '=', $user_id)->delete();
      Cache::flush();
    }
    public function changelevelmode()
    {
      // print_r(Auth::User()->id);
      // exit;
      if (Auth::User()->id) {
          $obj_user = User::find(Auth::User()->id);
          if($obj_user->user_role_check == 1){
            $obj_user->user_role_check = 0;
          }
          else{
            $obj_user->user_role_check = 1;
          }
          $obj_user->save();
          return back()->with('done', '');
      }
      else {
          return back()->with('error', 'You have no country for this action');
      }
    }
    public function changelevel(Request $request)
    {
      $user_id = $request->user_id;
      $obj_user = User::find($user_id);
      if($obj_user->user_role == 1){
        $obj_user->user_role = 0;
      }
      else if($obj_user->user_role == 0){
        $obj_user->user_role = 1;
      }
      $obj_user->save();
      return $obj_user->user_role;
    }
}
