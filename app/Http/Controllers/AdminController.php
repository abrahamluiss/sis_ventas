<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $admins  = User::admins()->get();
        return view('admins.index', compact('admins'));
    }
    public function create()
    {
        return view('admins.create');
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'dni' => 'required|digits:8|numeric|unique:users',
        ];
        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo es necesario.',
            'email.email' => 'EL correo no es valido.',
            'dni.required' => 'El dni es obligatorio.',
            'dni.unique' => 'El dni se esta repitiendo.',
        ];
        $this->validate($request, $rules, $messages);
        $user = User::create(
            $request->only('name', 'email', 'dni')
            + [
                'role' => 'admin',
                'password' => bcrypt($request->input('password')),
            ]
        );
        $notification = 'Admin registrado correctamente';
        return redirect('admins')->with(compact('notification'));
    }
}
