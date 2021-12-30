<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Redirect;
class HomeController extends Controller
{
    public function index() 
    {
        return view('home.index');
    }
    public function editProfile(){
        return view('auth.edit-profile');
    }
    public function updateProfile(Request $request){

        $auth_id = Auth::id();

        $user = User::find($auth_id);
        $request->validate([
                
            'nickname' => 'required|unique:users,nickname,'. $auth_id, 
            'name' => 'required',
            'surname' => 'required',
            'type' => 'gt:0',
            'password_confirmation' => 'same:password',

        ]);

        // dd(Hash::check( $request->current_password,$user->password),$user->password,$request->current_password);
        if (Hash::check($request->current_password, $user->password)){
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
       
            
        $user->save();
        return redirect()->back()->withSuccess('Updated successfully!');
    }
    
}
