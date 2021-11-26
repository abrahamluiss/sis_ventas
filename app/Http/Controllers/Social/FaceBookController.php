<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class FaceBookController extends Controller
{
    /**
     * Login Using Facebook
     */
    public function loginUsingFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('email', $user->getEmail())->first();
            if(!$isUser){
                $notification = 'No estas registrado como Administrador!';
                return redirect('login')->with(compact('notification'));
            }else{

                $saveUser = User::where('email',  $user->getEmail())->update([
                    'facebook_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }
            Auth::loginUsingId($saveUser->id);

            return redirect()->route('articulo.index');

            // $saveUser = User::updateOrCreate([
            //     'facebook_id' => $user->getId(),
            // ],[
            //     'name' => $user->getName(),
            //     'email' => $user->getEmail(),
            //     'role' => 'client',
            //     'password' => Hash::make($user->getName().'@'.$user->getId())
            // ]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
