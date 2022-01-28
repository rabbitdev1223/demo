<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Breed;
use App\Models\Parrot;
use App\Models\Couple;
use Auth;
use App\Http\Controllers\Controller;

class CoupleController extends Controller
{
    //
    public function index(){

        $parrots = Auth::user()->parrots->load('breed');
        
        return view('admin.parrot.index')->with('parrots',$parrots);
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
       
        
        $parrots = Auth::user()->parrots->load(['male_couple','female_couple']);
        
        return view('admin.couple.create')->with('parrots',$parrots);
    }

    public function destroy($id){
        
        $parrot = Parrot::find($id);
       

        if (is_null($parrot)){
            return "failed";
        }
        $parrot->delete();
        return "ok";
    }
    //
    public function show($id){
        $breeds = Breed::all();
        $parrot = Parrot::findOrFail($id);
        return view('admin.parrot.show')->with('current_parrot',$parrot)
                                    ->with('breeds',$breeds);    
    }

    public function edit($id){
        $breeds = Breed::all();
        $parrot = Parrot::findOrFail($id);
        
        return view('admin.parrot.edit')->with('current_parrot',$parrot)
                                    ->with('breeds',$breeds);    
    }
    public function store(Request $request){
        
        
        if (isset($request->id)){ //edit
            $parrot = Parrot::findOrFail($request->id);
            
        }
        else{
            $couple = new Couple();
            
            $couple->couple_id = strtoupper(uniqid()) . date('y');
        }
        $request->validate([
            'birth_date_of_couple'=>'required',
       
        ]);
        
        $couple = new Couple();
        
        $male_parrot = Parrot::find($request->male_id);
        //check gender is male
        if ($male_parrot==null || $male_parrot->gender != 1){
            return redirect()->back()->withErrors(['male_id' => [trans('couple.male_incorrect')]]);  
        }   
        
        $female_parrot = Parrot::find($request->female_id);
        //check gender is male
        if ($female_parrot==null || $female_parrot->gender != 2){
            return redirect()->back()->withErrors(['female_id' => [trans('couple.female_incorrect')]]);  
        }   

        $couple->male_id = $request->male_id;
        $couple->female_id = $request->female_id;

        $couple->birth_date_of_couple = $request->birth_date_of_couple;
        $couple->expected_date_of_birth = $request->expected_date_of_birth;
        $couple->note = $request->note;
        $couple->couple_id = strtoupper(uniqid()) . date('y');
        $couple->save();
        
        if (isset($request->id)){ //edit
            return redirect()->route('parrot.index')->withSuccess('Updated successfully!');
        }
        return redirect()->route('couple.create');
        // return redirect()->route('parrot.show',$parrot->id)->withSuccess('Created successfully!');

    }
}
