<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\Cloner\Data;

class Schoolcontroller extends Controller
{


   public function saveschool(Request  $request)
   {

    //validate
    $messages=[
        'name.required'=>'الاسم مطلوب',
        'name.min'=>'الحد الادنى هو 7 حروف',
    ];
    $rules=[
        'name'=>'required | min:7',
    ];
    
    $validate = Validator::make($request->all(),$rules,$messages);   

             if ($validate->fails()) {
                            return response()->json([
                                'data'  => $validate->errors(),
                                'status'=>'errors'
                                ]);
                   };
                   
                   //savedate 

                     if($request->has('photo')){
                        foreach($request->file('photo')as $file)
                        {
                            $a=rand(0,100);
                            $path=public_path('images/schools');
                            $ext= $file->getClientOriginalExtension();

                            $filename=$a.time().'.'.$ext ;
                            $file->move($path,$filename);
           

                            //save 
                   School::create([
                    'user_id' => $request->myid ,
                    'name' => $request->name ,
                    'email' => $request->email ,
                    'address' => $request->address,
                    'type' => $request->type ,
                    'about' => $request->about ,
                    'image' =>$filename ,

                   ]);
                   


                        }
                        return response()->json(['status'=>'success']); 

                                          
                     }else{
                 
                   School::create([
                    'user_id' => $request->myid ,
                    'name' => $request->name ,
                    'email' => $request->email ,
                    'adress' => $request->address,
                    'type' => $request->type ,
                    'about' => $request->about ,
                    'image' =>'a.jpg' ,

                   ]);
                   
                   
                   return response()->json(['status'=>'success']); 

                   }



              
    }
//get schools

                    public function getschools(Request $request)
                    {
                        $schools=  School::find($request->myid)->get();

                             return response()->json(['data'=>$schools]);
                    
                    
                    }
//getthis school 
                 
                  public function getthisschool(Request $request)
                  {
                      $school =   School::where(['id'=> $request->sid ,'user_id'=>$request->myid])->get();
                   
                   
                   
                      return response()->json(['data'=>$school[0]]);

                  }

 // update school
 public function updateschool(Request  $request)
 {

  //validate
  $messages=[
      'name.required'=>'الاسم مطلوب',
      'name.min'=>'الحد الادنى هو 7 حروف',
  ];
  $rules=[
      'name'=>'required | min:7',
  ];
  
                $validate = Validator::make($request->all(),$rules,$messages);   

           if ($validate->fails()) {
                          return response()->json([
                              'data'  => $validate->errors(),
                              'status'=>'errors'
                              ]);
                 };
                 
                 //updaaaaatedate 

                 if($request->has('image')){
                   
                          $a=rand(0,100);
                          $path=public_path('images/schools');
                          $ext= $request->image->getClientOriginalExtension();

                          $filename=$a.time().'.'.$ext ;
                          $request->image->move($path,$filename);
         

                        //  update
                $school = School::find($request->id);
               
                   $school->name = $request->name ;
                   $school->email = $request->email ;
                   $school->address = $request->address ;
                   $school->type = $request->type ;
                   $school->about = $request->about ; 
                   $school->image =  $filename ; 
                   $school->update();
                  
                 return response()->json(['status'=>'success','data'=>$request->all()]); 
                
                }else{
                
                       //  update
                       $school = School::find($request->id);
               
                       $school->name = $request->name ;
                       $school->email = $request->email ;
                       $school->address = $request->address ;
                       $school->type = $request->type ;
                       $school->about = $request->about ; 
                       $school->update();
                  
                 
                 return response()->json(['status'=>'success','data'=>$request->all()]); 

                 }



            
  }                 




}
