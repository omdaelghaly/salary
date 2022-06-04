<?php

namespace App\Http\Controllers;

use App\Models\Emp;
use App\Models\School;
use Illuminate\Http\Request;

class empcontroller extends Controller
{
      public function getschoolsinfo($myid)
      {
        $school = School::select('id','name')->where(['user_id'=>$myid])->get();
                   
        return response()->json(['data'=>$school]);
      }



      public function addemp(Request $request)
      {
          Emp::create([
            'school_id'=>$request->school_id,
            'name'=>$request->name,
            'email'=>$request->email,
            'address'=>$request->address,
            ]);
       
        return response()->json(['status'=>'success' , 'data'=>$request->all()]);

      }



       public function getallempsinfo(Request $request)
       {
         $sid  =$request->sid;
         $myid =$request->myid;
         $emp = Emp::where(['school_id'=>$sid])
         ->with('getempsalary')->get();
              
        return response()->json(['data'=>$emp]);
       }




}
