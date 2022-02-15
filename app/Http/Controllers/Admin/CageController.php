<?php

namespace App\Http\Controllers\admin;

use App\Models\Cage;
use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CageController extends Controller
{
    //
    public function create(){
        return view('admin.cage.create');
    }
    public function index(){
         
        $cages =  Auth::user()->cages;
       //  dd(\DB::getQueryLog()); 
         return view('admin.cage.index',compact('cages'));
     }

     public function show($id){
        $cage = Cage::findOrFail($id);
        return view('admin.cage.show')->with('current_cage',$cage);    
    }
     public function store(Request $request){
        
        if (isset($request->id)){ //edit
            $cage = Cage::findOrFail($request->id);
            
        }
        else{
            $cage = new Cage();
            $cage->cage_id = strtoupper(uniqid()) . date('y');
        }
            $request->validate([
            'name'=>'required',
            'max_parrot' => 'required', 
            // 'date_of_birth' => 'required',
            
            ]);
        
        if($request->hasFile('profileImage'))
        {
            @unlink("uploads/cages/".$cage->photo);
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
                        @mkdir("uploads/cages",0777);
                        $fileDestination = 'uploads/cages/'.$fileNameNew;
                        $cage->photo = $fileNameNew;
                        move_uploaded_file($_FILES['profileImage']['tmp_name'],$fileDestination);
                      
                    }else{
                        return redirect()->back()->withErrors(['profileImage' => [trans('parrot.size_limit_2mb')]]);
                    }
                }else{
                    echo "You have an error uploading photo file!";
                }
            }else{
                return redirect()->back()->withErrors(['profileImage' => [trans('parrot.allow_png_jpg')]]);
            }
        }
        
        $cage->name = $request->name;
        $cage->width = $request->width;
        $cage->height = $request->height;
        $cage->depth = $request->depth;
        $cage->max_parrot = $request->max_parrot;
        $cage->note = $request->note;
        if (isset($request->possibility_add_parrot))
            $cage->possibility_add_parrot = $request->possibility_add_parrot;
        $cage->registered_by = Auth::user()->id;
        $cage->save();
        
        if (isset($request->id)){ //edit
            return redirect()->route('cage.index')->withSuccess(trans('parrot.updated_success'));
        }
        return redirect()->route('cage.show',$cage->id)->withSuccess(trans('parrot.success_to_add_parrot'));

    }
}
