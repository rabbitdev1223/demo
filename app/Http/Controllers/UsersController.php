<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return "<h1>Users Page</h1>";
    }

    public function getProfile(Request $request)
    {
        return view('pages.user.profile', ['user_info' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $input = $request->all();
        if(isset($input['profile_photo_path'])) {
            $input['profile_photo_path'] = time().'.'.$request->profile_photo_path->extension();
            $request->profile_photo_path->move(public_path('images'), $input['profile_photo_path']);
            
            $input['is_visible'] = $request->is_visible == 'on' ? 1 : 0;
            if (User::where('id', Auth::user()->id)->update($input)) {
                //return view('pages.user.profile', ['user_info' => Auth::user()]);
                return response()->json($input['profile_photo_path']);
            } else {
                return "ERROR";
            }
        } else {
            return User::where('id', Auth::user()->id)->update($input);
        }
    }

    public function updatePassword(Request $request)
    {
        if(Hash::check($request->password, Auth::user()->password)) {
            return User::where('id', Auth::user()->id)->update([ 'password'=> Hash::make($request->new_password) ]);
        }
    }

    public function updateEmail(Request $request)
    {
        return User::where('id', Auth::user()->id)->update($request->all());
    }
}
