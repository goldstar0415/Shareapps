<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use Jrean\UserVerification\Facades\UserVerification as UserVerificationFacade;
use App\Mail\OrderShipped;
use PragmaRX\Countries\Facade as Countries;
use Propaganistas\LaravelIntl\Facades\Country;
use Propaganistas\LaravelPhone\PhoneNumber;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberType;
use SimpleSoftwareIO\SMS\Facades\SMS;
use GuzzleHttp\Client as Guzzle;
use Mail;

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
    use VerifiesUsers;
    /**
     * Where to redirect users after registration.
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
      $this->middleware('guest', ['except' => ['getVerification', 'getVerificationError']]);
    }

    public function showRegistrationForm()
    {
        $countrylists = [];
        $countries = Country::all();

        foreach ($countries as $key => $country) {
            try {
                $dialNumber = Countries::where('cca2', $key)->first()->callingCode[0];
                $countrylists[$key] = $country.' +'.$dialNumber;
            }
            catch (\Exception $ex) {
                continue;
            }
        }
        return view('auth.register',['countries' => $countrylists]);
    }


    // Check for phone number validation
    public function phoneValidation($phonenumber, $countrycode) {
        $fullNumber = '';
        $phonenumber = ltrim($phonenumber, '0');
        $dialNumber = Countries::where('cca2', $countrycode)->first()->callingCode[0];

        if (strlen($phonenumber) < 11) {
            return false;
        }
        else if (strlen($phonenumber) == 11) {
            if (strpos($phonenumber, $dialNumber) === 0)
                return false;

            $fullNumber = $dialNumber.$phonenumber;
        }
        else {
            if (strpos($phonenumber, $dialNumber) !== 0)
                return false;

            $fullNumber = $phonenumber;
        }

        return $fullNumber;
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
            'fname' => 'required',
            'lname' => 'required',
            'company_name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'phonenumber' => 'required',
            'password' => 'required|string|min:6|confirmed',
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
        $country_name = Countries::where('cca2', $data['phoneCountry'])->first()->name->common;

        return User::create([
            'first_name' => $data['fname'],
            'last_name' => $data['lname'],
            'company_name' => $data['company_name'],
            'email' => $data['email'],
            'phone_number' => $data['phonenumber'],
            'password' => bcrypt($data['password']),
            'country_code' => $data['phoneCountry'],
            'country_name' => $country_name,
            'phone_code' => $data['phone_code'],
        ]);
    }
    /**
   * Handle a registration request for the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
    public function register(Request $request)
    {
        $data = $request->all();

        // Standard validation
        $this->validator($data)->validate();

        // Phone validation
        if (($data['phonenumber'] = $this->phoneValidation($data['phonenumber'], $data['phoneCountry'])) == false) {
            return redirect()->back()
                        ->with('status', 'Phone Validation Error!')
                        ->withInput();
        }

        // Random phone verification number
        $data['phone_code'] = rand(1000, 9999);
        $data = $this->create($data);

        $user = User::find($data['id']);

        // Email Verification
        UserVerification::generate($user);

        UserVerification::send($user, 'please verify your email');
        // Phone Verification
        $this->SendVerifyCode($data['phone_number'], $data['phone_code']);

        return $this->registered($request, $user)
                        ? : redirect(url('login-page'))->with('status','Confirmation email has been send. please check your email.');
    }

    public function SendVerifyCode($phone_number, $verify_code) {
        $url = 'http://api.infobip.com/sms/1/text/single';

        $header = [
            'defaults' => array(
                "exceptions" => true,
                "decode_content" => true),
            'verify' => false,
            // 'proxy' => '127.0.0.1:8888',
        ];

        $param = [
            'from' => 'ShareApps',
            'to' => $phone_number,
            'text' => 'Verify Code : '.$verify_code,
        ];

        $meta = [
            'accept' => 'application/json',
            'authorization' => 'Basic TXljb3JlbW9iaWxlOkhhcHB5MTIzNA==',
            'content-type' => 'application/json',
        ];

        $client = new Guzzle($header);
        $response = $client->request('POST', $url, ['json' => $param, 'headers' => $meta]);

        // Check response ...
        $response = $response->getBody()->getContents();

        // Your code here ..

    }

    public function getVerification(Request $request, $token)
    {
        if (! $this->validateRequest($request)) {
            return redirect($this->redirectIfVerificationFails());
        }

        try {
            $user = UserVerificationFacade::process($request->input('email'), $token, $this->userTable());
        } catch (UserNotFoundException $e) {
            return redirect($this->redirectIfVerificationFails());
        } catch (UserIsVerifiedException $e) {
            return redirect(url('create-new-application'));
        } catch (TokenMismatchException $e) {
            return redirect($this->redirectIfVerificationFails());
        }

        if (config('user-verification.auto-login') === true) {
            auth()->loginUsingId($user->id);
        }

        return redirect(url('login-page'))->with('status','congratulations Your email Verified.');
    }
}
