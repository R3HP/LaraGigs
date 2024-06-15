<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create(){
        return view('users.register');
    }

    public function store(Request $request){
        $userForm = $request->validate([
            'name' => 'required',
            'email' => ['required','email',Rule::unique('users','email')],
            'password' => ['required','confirmed','min:6']
        ]);

        $userForm['password'] = bcrypt($userForm['password']);

        $user = User::create($userForm);

        auth()->login($user);

        return redirect('/')->with('success','Registered and Logged In');
    }

    public function logout(Request $request){
         auth()->logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();

         return redirect('/')->with('success','We Dont know you anymore');
    }

    public function login(){
        return view('users.login');
    }

    public function authenticate(Request $request){
        $userForm = $request->validate([
            'email' => ['required','email'],
            'password' => 'required'
        ]);
        
        if(auth()->attempt($userForm)){
            $request->session()->regenerate();
            return redirect('/')->with('success','We Rememeber You Now');
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
