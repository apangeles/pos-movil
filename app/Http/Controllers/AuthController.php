<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        //Verificar si el usuario existe y esta activo
        $credentials=$request->only('email','password');

        if(Auth::attempt($credentials)){
            $user = Auth::user();

            if($user->activo){
                return redirect()->route('dashboard');
            }else{
                Auth::logout();
                require back()->with('error','Su cuenta esta inactiva. Contacte al administrador');
            } 
        }

        return back()->with('error','Las credenciales no son correctas.');
    }
}
