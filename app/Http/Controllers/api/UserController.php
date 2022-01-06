<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class UserController extends Controller
{
    //
    public function getUsers(){
        $users = User::all();
        $ret['data']=$users;
        return json_encode($ret);
    }


    //status : 1 =>suspended
    public function setSuspendStatus($id,Request $request){
        $user = User::find($id);
        
        if ($request->status == 1){
            $user->suspended_at = now(); 
        }
        else
            $user->suspended_at = NULL;
        
        $user->save();
        return "ok";
    }
    public function destroy($id){
       
      
        $user = User::find($id);
        $user->delete();
        return "ok";
    }
}
