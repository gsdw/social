<?php
namespace Gsdw\Social\Controllers;

use App\Http\Controllers\Auth\AuthController as AuthControllerCore;
use Socialite;
use Auth;
use App\Models\User;

class AuthController extends AuthControllerCore
{
    /**
     * redirect to social oauth
     * 
     * @param type $provider
     * @return type
     */
    public function getSocialRedirect($provider)
    {
        $providerKey = \Config::get('services.' . $provider);
        if (empty($providerKey)) {
            return redirect($this->redirectTo)->withErrors('No such provider');
        }
        return Socialite::driver( $provider )->redirect();
    }
    
    /**
     * get social response
     * 
     * @param type $provider
     * @return type
     */
    public function getSocialHandle($provider)
    {
        $userSocial = Socialite::driver( $provider )->user();
        $email = $userSocial->email;
        if (!$email) {
            redirect($this->redirectTo)->withErrors('Error Social connect');
        }
        //not email of rikkeisoft
        if (!preg_match('/@rikkeisoft\.com$/', $email)) {
            return redirect($this->redirectTo)->withErrors('Please use Rikkisoft\'s Email!');
        }        
        $userSite = User::where('email', '=', $email)->first();
        if (!$userSite || !count($userSite)) {
            $password = substr((mt_rand() . time()), 0, 6);
            $password = bcrypt($password);
            $userSite = User::create([
                'name' => $userSocial->name,
                'email' => $email,
                'password' => $password,
            ]);
        }
        if (!Auth::login($userSite)) {
            return redirect('/login')->withErrors('Error login, please try again!');
        }
        return redirect('/');
    }
}