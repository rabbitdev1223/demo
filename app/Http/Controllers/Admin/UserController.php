<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function index()
    {
        // dd(request()->route()->getPrefix());
        $users = User::all();
       
        return view('admin.users.userlist')->with('users',$users);
    }
    
    public function create(){
       return view('admin.users.create');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.auth.edit-profile')->with('current_user',$user);
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('admin.users.show')->with('current_user',$user);
    }

    public function create_password(){
        return view('admin.auth.creat-password');
    }
    public function password_init(Request $request){
        
       
        $request->validate([
            'password_confirmation' => 'same:password',
            'password'=>'required']);


        //authenticated then use Auth
        if (Auth::check()){
            $user = Auth::user();
            if (!$user)
                return redirect()->route('login.show')->withErrors(trans('user.not_find_user'));
      
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
                return redirect()->route('login.show')->withErrors(trans('user.not_find_user'));
      
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
            return redirect()->route('login.show')->withSuccess(trans('user.success_password_changed'));
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
            return view('admin.auth.creat-password', compact('token'));
        }
        return redirect()->route('login.show')->withErrors(trans('user.password_link_expired'));
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
            return back()->withErrors(trans('user.failed_email_not_registered'));
        }

        $token = Str::random(60);

        $user['token'] = $token;
        $user->save();
        
        Mail::to($request->email)->send(new ResetPassword($user->name, $token));

        if(Mail::failures() != 0) {
            return back()->withSuccess(trans('user.success_to_send_password_reset_link'));
        }
        return back()->withErrors(trans('user.issue_email_provider'));
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
//             return redirect()->route('login.show')->withSuccess('Success! password has been changed');
//         }
//         return redirect()->route('forgot-password')->with('failed', 'Failed! something went wrong');
//     }
}
