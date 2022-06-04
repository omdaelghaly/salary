<?php

namespace App\Http\Controllers;

use App\Http\Requests\Logreq;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class logcontroller extends Controller
{
    //

    public function register(Request $request)
        {
            $messages=[
                'name.required'=>'الاسم مطلوب',
                'name.min'=>'الحد الادنى هو 5 حروف',
                'email.required'=>'الايميل مطلوب',
                'email.email'=>'اكتب ايميل صحيح',
                'email.unique'=>'هذا الايميل موجود ',
                'password.required'=>'كلمة المرور مطلوبة',
                'confirm.required'=>'تاكيد كلمه المرور مطلوب',
                'password.min'=>'الحد الادنى لكلمة المرور 5 احرف او ارقام ',
                'confirm.min'=>'الحد الادنى لكلمة المرور 5 احرف او ارقام ',
                'password.same'=>'لابد ان تكون كلمتا المرور متطابقتان',
                'confirm.same'=>'لابد ان تكون كلمتا المرور متطابقتان',
            ];
            $rules=[
                'name'=>'required | min:5 |  ',
                'email'=>'required | email ',
                'password'=>'required | min:5 |same:confirm',
                'confirm'=>'required |min:5|same:password'

            ];
            
            $validate = Validator::make($request->all(),$rules,$messages);   

                     if ($validate->fails()) {
                                    return response()->json([
                                                            'data'  => $validate->errors(),
                                                            'status'=>'errors'
                                                            ]);
                                               }       
                    //    save data
                
               User::create([
                
                   'name' => $request->name,
                   'email'=> $request->email,
                   'password'=>Hash::make($request->password),
               ]) ;
                return response()->json(['status'=>'success']); 
                                                
                                        

        }




        public function login(Request $request)
        {

            // $messages=[
            //     'email.required'=>'الايميل مطلوب',
            //     'email.email'=>'اكتب ايميل صحيح',
            //     'password.required'=>'كلمة المرور مطلوبة',
            //           ];
            // $rules=[
            //     'email'=>'required | email ',
            //     'password'=>'required ',
            //        ]; 

            //        $validate = Validator::make($request->all(),$rules,$messages);   

                   
            //        if ($validate->fails()) {
            //                           return response()->json([
            //                                     'data'  => $validate->errors(),
            //                                      'status'=>'errorv'
            //                                        ]);
            //                                    }


            //           if(Auth::attempt($request->only('email','password')))
            //              {
            //                  return response()->json(Auth::user(),200);
            //                  return response()->json([
            //                      'sucess'=>'تم تسجيل الدخول بنجاح',
            //                  ]);
            //              }else{
                            
            //              return response()->json([
            //                  'data'=>['برجاء التاكد من الايميل والباس وورد '],
            //                  'status'=>'errorauth'
            //              ]);
            //              }
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'device_name' => 'required',
            ]);
         
            $user = User::where('email', $request->email)->first();
         
            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['هناك خطا فى الايميل او الباس وورد'],
                ]);
            }
         
            return $user->createToken($request->device_name)->plainTextToken;
          







        }

}
