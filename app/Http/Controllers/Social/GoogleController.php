<?php

namespace App\Http\Controllers\Social;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class GoogleController extends Controller
{
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Check Users Email If Already There
            $is_user = User::where('email', $user->getEmail())->first();
            if(!$is_user){
                return view('No estas registrado como administrador');

                // $saveUser = User::updateOrCreate([
                //     'google_id' => $user->getId(),
                // ],[
                //     'name' => $user->getName(),
                //     'email' => $user->getEmail(),
                //     'password' => Hash::make($user->getName().'@'.$user->getId())
                // ]);
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                        'google_id' => $user->getId(),
                    ]);
                    $saveUser = User::where('email', $user->getEmail())->first();
                }


                Auth::loginUsingId($saveUser->id);
                return redirect()->route('home');

            // return redirect()->route('home');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
