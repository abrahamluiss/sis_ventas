<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function show()
    {
        Auth::guard('api');
        $users = User::admins()->get();
        return $users;
    }

    public function update(Request $request)
    {
    }
    public function store(Request $request)
    {
        Auth::guard('api');

        $user = User::create(
            $request->only('name', 'email', 'dni')
            + [
                'role' => 'admin',
                'password' => bcrypt($request->input('password')),
            ]
        );
        if(!$user){

            return response()->json(['message' => 'No se registro']);
        }else{

            return response()->json(['message' => 'Admin registrado']);
        }

    }
}

