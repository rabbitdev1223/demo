<?php

namespace App\Http\Controllers\admin;

use App\Models\Cage;
use Auth;
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CageController extends Controller
{
    //
    public function create(){
        $cageFriendlyName = "gabbia " . count(Auth::user()->cages);
        return view('admin.cage.create',compact('cageFriendlyName'));
    }
    public function index(){
         
        $cages =  Auth::user()->cages;
       //  dd(\DB::getQueryLog()); 
         return view('admin.cage.index',compact('cages'));
     }

     public function show($cageId){
        $cage = Cage::where('cage_id',$cageId)->first();

        if (!$cage){
            return abort(404);
        }
        return view('admin.cage.show')->with('current_cage',$cage);    
    }

    public function destroy($cageId){
        
        $cage = Cage::where('cage_id',$cageId)->first();

        if (is_null($cage)){
            return "failed";
        }
        $cage->delete();
        return "ok";
    }

    public function edit($cageId){

        $current_cage = Cage::where('cage_id',$cageId)->first();

        return view('admin.cage.edit',compact('current_cage'));    
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
            'width'=>'required',
            'height'=>'required',
            'depth'=>'required',
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
            return redirect()->route('cage.index')->withSuccess(trans('cage.updated_success'));
        }
        return redirect()->route('cage.addParrotPage',$cage->cage_id);
        return redirect()->route('cage.show',$cage->cage_id)->withSuccess(trans('cage.success_to_add_cage'));

    }

    public function addParrotPage($cageId){

        $current_cage = Cage::where('cage_id',$cageId)->first();

        if (!$current_cage){
            return abort(404);
        }

        $parrots = Auth::user()->parrots()->whereDoesntHave('cage')->get();
        return view('admin.cage.addParrot',compact('parrots','current_cage'));

    }

    public function addParrot($cageId,Request $request){
        
        $current_cage = Cage::where('cage_id',$cageId)->first();
        
        if (!$current_cage){
            $ret['error'] = 2;
            $ret['message'] = "no cage!";
            return json_encode($ret);
        }

        $parrots = explode(',',$request->parrots);
        
        if (count($parrots) > $current_cage->max_parrot){
            $ret['error'] = 1;
            $ret['message'] = "max parrot!";
            return json_encode($ret);
        }
        DB::table('parrots')
            ->whereIn('id', $parrots)
            ->update(['cage_id' => $current_cage->id]);

        $ret['error'] = 0;
        $ret['message'] = "success!";
        return json_encode($ret);
    }
}
