<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breed;
use App\Models\Parot;
use Auth;
class ParotController extends Controller
{
    //
    public function index(){

    }
    public function create(){
        $breeds = Breed::all();
        return view('parots.create')->with('breeds',$breeds);
    }
    public function store(Request $request){
        
            $parot = new Parot();
            $request->validate([
                'name'=>'required',
                'color' => 'required', 
                'date_of_birth' => 'required',
                
                ]);
        
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
                    if($_FILES['profileImage']['size'] < 2000000){
                                   
                        $fileNameNew = time() .".".$fileActualExt;
                        @mkdir("uploads/parots",0777);
                        $fileDestination = 'uploads/parots/'.$fileNameNew;
                        $parot->photo = $fileNameNew;
                        move_uploaded_file($_FILES['profileImage']['tmp_name'],$fileDestination);
                      
                    }else{
                        return redirect()->back()->withErrors(['profileImage' => ['Size is limited to 2MB !']]);
                    }
                }else{
                    echo "You have an error uploading photo file!";
                }
            }else{
                return redirect()->back()->withErrors(['profileImage' => ['Only png and jpg file are allowed!']]);
            }
        }
        
        $parot->name = $request->name;
        $parot->date_of_birth = $request->date_of_birth;
        $parot->parot_id = strtoupper(uniqid()) . date('y');
        $parot->color = $request->color;
        $parot->breed_id = $request->breed;
        $parot->registered_by = Auth::user()->id;
        $parot->save();
     
        return redirect()->back()->withSuccess('Created successfully!');
    }
}
