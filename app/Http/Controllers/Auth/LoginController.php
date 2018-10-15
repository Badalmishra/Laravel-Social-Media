<?php

namespace App\Http\Controllers\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToProvider()
    {
    return Socialite::driver('google')->redirect();
    }
    /**
    * Obtain the user information from Google.
    *
    * @return \Illuminate\Http\Response
    */
   public function handleProviderCallback()
   {
       try {
           $user = Socialite::driver('google')->user();
       } catch (\Exception $e) {
           return redirect('/login');
       }
       // only allow people with @company.com to login
       // if(explode("@", $user->email)[1] !== 'company.com'){
       //     return redirect()->to('/');
       // }
       // check if they're an existing user
       $existingUser = User::where('email', $user->email)->first();
       if($existingUser){
           // log them in
           auth()->login($existingUser, true);
       } else {
           // create a new user
           $newUser                  = new User;
           $newUser->name            = $user->name;
           $newUser->email           = $user->email;
           $newUser->pic             = $user->avatar;
           $newUser->password        = Hash::make(str_random(10));
           $newUser->api_token       = str_random(60);
           $newUser->email_verified_at =Carbon::now()->toDateTimeString();
           $newUser->save();
           auth()->login($newUser, true);
       }
       return redirect()->to('/home');
   }
}
