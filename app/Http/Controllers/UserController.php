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
    
    public function edit($id){
        $user = User::findOrFail($id);
        return view('auth.edit-profile')->with('current_user',$user);
    }
}
