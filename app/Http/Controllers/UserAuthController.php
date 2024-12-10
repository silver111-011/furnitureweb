<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    //seller authentication
    public function auth(){
        $request = request();
        if(User::where('email',$request->email)->count()>0){
           $role = User::where('email',$request->email)->get()->first();
          
           if($role->role == 'seller'){
            if($role->is_blocked == 1){
               return back()->with('fail','Your account is blocked, contact with administration to restore it');
            }else{
            $sellerpass = $role->password;
            
            if(Hash::check($request->password, $sellerpass )){
             
               // create a session
              $request->session()->put('seller', $role->id);
            
               //redirect to flanding pag;
               return redirect()->route('seller');
            }else{
                return back()->with('fail','wrong username or password');
            }}
             

           }elseif($role->role == 'admin'){
            $adminpass = $role->password;

            if(Hash::check($request->password, $adminpass )){
               // create a session
            
               $request->session()->put('admin', $role->id);
               //redirect to flanding pag;
               return redirect()->route('admin');
            }else{
                return back()->with('fail','wrong username or password');
            }

           }elseif($role->role == 'moderator'){
            $modepass = $role->password;

            if(Hash::check($request->password, $modepass )){
               // create a session
            
               $request->session()->put('moderator', $role->id);
               //redirect to flanding pag;
               return redirect()->route('moderator');
            }else{
                return back()->with('fail','wrong username or password');
            }
            
           }
        }
           else{
          
            //check if the email is in customer table
            if(Customer::where('email',$request->email)->count() > 0){
             $customerdata =   Customer::where('email',$request->email)->first();
            $customerpass = $customerdata->password;

            if(Hash::check($request->password, $customerpass )){
               // create a session
            
               $request->session()->put('customer', $customerdata->id);
               //redirect to flanding pag;
               return redirect()->route('customer');
            }else{
                return back()->with('fail','wrong username or password');
            }
            
           }else{
            return back()->with('fail','The email is not registered');
        }
        
        }
   


}
}
