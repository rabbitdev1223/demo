<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Breed;
use App\Models\Parrot;
use Auth;
use App\Http\Controllers\Controller;

class parrotController extends Controller
{
    //
    public function index(){

    }
    public function create(){

        // $str = 'GTCAG';
        // //check length
        // if (!(1 <= strlen($str) && (strlen($str)<=1000)))
        //     return;
        // //check valid characters
        // $complement_map = ['G'=>'C','C'=>'G','T'=>'A','A'=>'T'];
        
        // $rev_str = strrev($str);
        // $arr_char = str_split($rev_str);
        // $ret_val = "";
        // foreach ($arr_char as $key => $val) {
        //     $ret_val = $ret_val . $complement_map[$val];
        // }
        // dd($ret_val);
        // dd(request()->route()->getPrefix());
       
        $breeds = Breed::all();
        return view('admin.parrot.create')->with('breeds',$breeds);
    }
    //
    public function show($id){
        $breeds = Breed::all();
        $parrot = Parrot::findOrFail($id);
        return view('admin.parrot.show')->with('current_parrot',$parrot)
                                    ->with('breeds',$breeds);    
    }
    public function store(Request $request){
        
            $parrot = new Parrot();
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
                        @mkdir("uploads/parrots",0777);
                        $fileDestination = 'uploads/parrots/'.$fileNameNew;
                        $parrot->photo = $fileNameNew;
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
        
        $parrot->name = $request->name;
        $parrot->date_of_birth = $request->date_of_birth;
        $parrot->parrot_id = strtoupper(uniqid()) . date('y');
        $parrot->color = $request->color;
        $parrot->breed_id = $request->breed;
        $parrot->registered_by = Auth::user()->id;
        $parrot->save();
     
        return redirect()->route('parrot.show',$parrot->id)->withSuccess('Created successfully!');
    }
}
