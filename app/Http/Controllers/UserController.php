<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;

class UserController extends Controller
{
    //
    public function index()
    {
        // dd(request()->route()->getPrefix());
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


        //authenticated then use Auth
        if (Auth::check()){
            $user = Auth::user();
            if (!$user)
                return redirect()->route('login')->withErrors('Cannot find user!');
      
            $user->login_ip = $request->ip();
            $user->login_date = now();
            $user->password = $request->password;
            $user->save();
            return redirect()->route('index');
        }
        else{
            //forgot password's case
            $user = User::where('token', $request->token)->first();
       
            if (!$user)
                return redirect()->route('login')->withErrors('Cannot find user!');
      
            $user->login_ip = $request->ip();
            $user->login_date = now();
            $user->password = $request->password;
            $user->save();


            //send email
            $email_data['email'] = $user->email;
            $email_data['name'] = $user->name;
           
            Mail::send('email.password_initialized', $email_data, function ($message) use ($email_data) {
                    $message->to($email_data['email'], $email_data['name'])
                        ->subject('Password Initialized')
                        ->from('info@parots.it', 'Password initialized');
                });
            return redirect()->route('login')->withSuccess('Success! password has been changed');;
        }
    }
      /**
     * Validate token for forgot password
     * @param token
     * @return view
     */
    public function forgotPasswordValidate($token)
    {
        $user = User::where('token', $token)->first();
        if ($user) {
            return view('auth.creat-password', compact('token'));
        }
        return redirect()->route('login')->withErrors('Password reset link is expired');
    }
     /**
     * Reset password
     * @param request
     * @return response
     */
    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors('Failed! email is not registered.');
        }

        $token = Str::random(60);

        $user['token'] = $token;
        $user->save();
        
        Mail::to($request->email)->send(new ResetPassword($user->name, $token));

        if(Mail::failures() != 0) {
            return back()->withSuccess('Success! password reset link has been sent to your email');
        }
        return back()->withErrors('Failed! there is some issue with email provider');
    }
/**
     * Change password
     * @param request
     * @return response
     */
//     public function updatePassword(Request $request) {
//         $this->validate($request, [
//             'email' => 'required',
//             'password' => 'required|min:8',
//             'confirm_password' => 'required|same:password'
//         ]);

//         $user = User::where('email', $request->email)->first();
//         if ($user) {
//             $user['token'] = '';
//             $user['password'] = $request->password;
//             $user->save();
//             return redirect()->route('login')->withSuccess('Success! password has been changed');
//         }
//         return redirect()->route('forgot-password')->with('failed', 'Failed! something went wrong');
//     }
}
