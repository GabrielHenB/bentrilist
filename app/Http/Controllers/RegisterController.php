<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    //Responsavel pelo registro de usuarios
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $request = request();
        //Cool filtering stunts
        foreach($request->all() as $chave=>$valor){
            $request[$chave] = filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        //Store the data into the db validating it
        $thing = $request->validate([
            'username'=>['required','min:4','max:255', Rule::unique('users','username')],
            'name'=>['required','max:255'],
            'email'=>['required','email','max:255', Rule::unique('users','email')],
            'password'=>['required','min:10','max:20']
        ]);

        //Ja faz em um Mutator no proprio Model User
        //$thing['password'] = bcrypt($thing['password']);

        $thing = User::create($thing);

        //Works but I can use it directly after redirect()
        //session()->flash('successRegist','Cadastro realizado com sucesso!!');

        //Usa o helper para logar o usuario. O model eh authenticable
        auth()->login($thing);

        return redirect('/')->with('successMessage','Cadastro realizado com sucesso!!');
    }
}
