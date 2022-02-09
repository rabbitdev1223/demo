<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('admin.auth.register');
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {
        $data = $request->all();
        $data['login_ip'] = $request->ip();
        $data['login_date'] = now();
        
        $user = User::create($data);
        
        
        event(new Registered($user));
        
        auth()->login($user);
        

        return redirect('/')->with('success', trans('user.create_new_user_success'));
    }
}
