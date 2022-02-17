<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Parrot;
use App\Models\Couple;
use Auth;
use Hash;
use Redirect;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() 
    {
        $parrot_count = count(Auth::user()->parrots);
        $couple_count =  count(Couple::whereHas('male', function($q)  {
            $q->where('registered_by', Auth::user()->id);
        })->get());

        
        return view('admin.home.index')->with('couple_count',$couple_count)
                                        ->with('parrot_count',$parrot_count);
    }
    public function editProfile(){
        
        return view('admin.auth.edit-profile')->with('current_user',Auth::user());
    }
    public function updateProfile(Request $request){

        if (!isset($request->id)){ //create new user
            $user = new User();
            $request->validate([
                'email'=>'required|unique:users',
                'nickname' => 'required|unique:users', 
                'name' => 'required',
                
                'surname' => 'required',
                'type' => 'gt:0',
                'password_confirmation' => 'same:password',
                'rna'=>['sometimes','nullable','alpha_num','size:4','unique:users',
                        'regex:/[a-zA-Z0-9]/'],
                'password'=>'required']);
            $user->email = $request->email;
        }
        else{
            $auth_id = $request->id ;

            $user = User::findOrFail($auth_id);
            $request->validate([
                    
                'nickname' => 'required|unique:users,nickname,'. $auth_id, 
                'name' => 'required',
                
                'surname' => 'required',
                'type' => 'gt:0',
                'rna'=>['sometimes','nullable','alpha_num','size:4','unique:users,rna,' . $auth_id,
                        'regex:/[a-zA-Z]/'],
                'password_confirmation' => 'same:password',

            ]);
        }
            

        // dd(Hash::check( $request->current_password,$user->password),$user->password,$request->current_password);
        
        if (Auth::user()->role == 1) {//super admin
            
            // $request->validate([
            //     'password' => 'required|min:8',
            //     'password_confirmation' => 'same:password',

            // ]);
            if ($request->password!="")
                $user->password = $request->password;
            
        }
        
        else if (Hash::check($request->current_password, $user->password)){
            $request->validate([
                'password' => 'required|min:8',
                'password_confirmation' => 'same:password',

            ]); 
            $user->password = $request->password; 
        }
        else if ($request->current_password!="" ){
            
            return redirect()->back()->withErrors(['current_password' => ['Wrong current password.']]);
        }
        
        if($request->hasFile('profileImage'))
        {
            
            $file= $_FILES['profileImage'];
            $fileName = $_FILES['profileImage']['name'];
            $fileTmp = $_FILES['profileImage']['tmp_name'];
            $fileSize = $_FILES['profileImage']['size'];
            $filesError = $_FILES['profileImage']['error'];
            $fileType = $_FILES['profileImage']['type'];
            
            $fileExt = explode('.',$_FILES['profileImage']['name']);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg','jpeg','png');
            
            if(in_array($fileActualExt,$allowed)){
                if($_FILES['profileImage']['error'] ===  0){
                    if($_FILES['profileImage']['size'] < 200000){
                                   
                        $fileNameNew = time() .".".$fileActualExt;
                        @mkdir("uploads",0777);
                        $fileDestination = 'uploads/'.$fileNameNew;
                        $user->profile = $fileNameNew;
                        move_uploaded_file($_FILES['profileImage']['tmp_name'],$fileDestination);
                      
                    }else{
                        return redirect()->back()->withErrors(['profile' => ['Size is limited to 200KB !']]);
                    }
                }else{
                    echo "You have an error uploading your file!";
                }
            }else{
                return redirect()->back()->withErrors(['profile' => ['Only png and jpg file are allowed!']]);
            }
        }
        
        $user->name = $request->name;
        $user->nickname = $request->nickname;
        $user->surname = $request->surname;
        $user->age = $request->age;
        $user->type = $request->type;   
           
        $user->farm_address = $request->farm_address;
        $user->city = $request->city;     
        $user->zipcode = $request->zipcode;

        
        if (isset($request->public_profile))
            $user->public_profile = $request->public_profile;  
        
        //update the old RNA of parrots to new RNA of user
     
        if ($user->RNA!=''){
            Parrot::where('RNA', $user->RNA)
            ->update([
                'RNA' => strtoupper($request->rna)
                ]);
        }
        $user->RNA = strtoupper($request->rna);
            
        $user->save();

        //when superadmin create a new user
        if (!isset($request->id)){
            //send welcome email with password
            $user->email_verified_at = now(); //made email verified
            $user->save();
              $email_data['email'] = $user->email;
                $email_data['name'] = $user->name;
                $email_data['password'] = $request->password;        
                // send email with the template
                Mail::send('email.welcome_email', $email_data, function ($message) use ($email_data) {
                    $message->to($email_data['email'], $email_data['name'])
                        ->subject('Welcome to Parots')
                        ->from('info@parots.it', 'Welcom');
                });

                // Mail::send('email.password_initialized', $email_data, function ($message) use ($email_data) {
                //     $message->to($email_data['email'], $email_data['name'])
                //         ->subject('Password Initialized')
                //         ->from('info@parots.it', 'Password initialized');
                // });

                // Mail::send('email.password_reset', $email_data, function ($message) use ($email_data) {
                //     $message->to($email_data['email'], $email_data['name'])
                //         ->subject('Password init')
                //         ->from('info@parots.it', 'Password init');
                // });
            return redirect()->route('user.index');
        }
        return redirect()->back()->withSuccess('Updated successfully!');
    }
    
}
