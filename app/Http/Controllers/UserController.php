<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    //
    public function index()
    {
        return view('users.userlist');
    }
    public function getUsers(){
        $users = User::all();
        return $users->toJson();
    }
}
