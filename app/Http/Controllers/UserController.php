<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
       
        return view('users.userlist')->with('users',$users);
    }
    
    public function create(){
       return view('users.create');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('auth.edit-profile')->with('current_user',$user);
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('users.show')->with('current_user',$user);
    }

    public function create_password(){
        return view('auth.creat-password');
    }
    public function password_init(Request $request){

        $request->validate([
            'password_confirmation' => 'same:password',
            'password'=>'required']);
        Auth::user()->login_ip = $request->ip();
        Auth::user()->login_date = now();
        Auth::user()->password = $request->password;
        Auth::user()->save();
        return redirect()->route('index');
    }
    
}
