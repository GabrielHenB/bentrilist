<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesController extends Controller
{
    //Classe responsavel por controle de sessao

    public function destroy()
    {
        //This will destruct the login
        auth()->logout();

        return redirect('/')->with('successMessage','Logout Efetuado');
    }

    public function create()
    {
        return view('register.login');
    }

    public function store()
    {
        //This effectively logs in the user

        if(request()->has('forgot')){
            return back()->withErrors(['password'=>"Funcao ainda nao implementada!!"]);
        }
        //Sanitize
        $request = request();
        foreach($request->all() as $key=>$value){
            $request[$key] = strip_tags(htmlspecialchars($value));
        }
        //Validate
        $attributes = $request->validate([
           'email' => "required|email",
           'password' => "required"
        ]);
        //Attempt
        if(auth()->attempt($attributes)){
            session()->regenerate(); //Session fixation
            return redirect('/')->with('successMessage','Logado!');
        }
        //Failed attempt
        return back()->withInput()
            ->withErrors(['email' => "Credenciais Inválidas!"]);
    }
}
