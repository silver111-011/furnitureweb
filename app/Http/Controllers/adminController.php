<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

class adminController extends Controller
{
    //
       //admin landing page
       public function adminlanding(){
        $request = request();
        $user = new User();
        if ($request->session()->has('admin')) {
            $aid = $request->session()->get('admin');
            $admin = $user::where('id', '=', $aid)->get()->first();
            $users = User::where('role','seller')->orderBy('id', 'desc')->get();
          
            return view('admin.landing',compact('admin','users'));
        }else{
            return redirect()->route('login')->with('fail','you have to login first');
        }
    }

    //  block user
    public function blockuser($id){
        
        $user = User::find($id);
        $user->is_blocked = 1;
        $res = $user->save();
        if($res){
            return redirect()->route('admin');
        }else{
             return back()->with('fail', 'error in blocking please try again');
        }

    }
  //unblock user
    public function unblockuser($id){
        
        $user = User::find($id);
        $user->is_blocked = 0;
        $res = $user->save();
        if($res){
            return redirect()->route('admin');
        }else{
             return back()->with('fail', 'error in blocking please try again');
        }


    }
        //category view
        public function categoryview(){
            $request = request();
            $user = new User();
            if ($request->session()->has('admin')) {
                $aid = $request->session()->get('admin');
                $admin = $user::where('id', '=', $aid)->get()->first();
                $category = Category::all();
              
                return view('admin.categories',compact('admin','category'));
            }else{
                return redirect()->route('login')->with('fail','you have to login first');
            }
        }

        //category view
        public function categoryformview($edit = null){
            $request = request();
            $user = new User();
            if ($request->session()->has('admin')) {
                $aid = $request->session()->get('admin');
                $admin = $user::where('id', '=', $aid)->get()->first();
                if ($edit !== null && is_numeric($edit)) {
                    $cat = Category::find($edit);
                
                } else {
                    // If $edit is null or not a valid ID, create a new instance
                    $cat = new Category();
                 

                }
              
                return view('admin.categoryform',compact('admin','cat'));
            }else{
                return redirect()->route('login')->with('fail','you have to login first');
            }
        }

        //post category
        public function categorypost(){
            $request = request();
            if(Category::where('name',$request->name)->count()>0){
                return back()->with('fail','This category exists');
            }else{
                $cat = new Category();
                $cat->name = $request->name;
                $res = $cat->save();
                if($res){
                    return redirect()->route('catview');

                }else{
                    return back()->with('fail','Error occured, please try again');
                }
            }
        }

          //edit category
          public function catedit($edit){
            $request = request();
           
                $cat =  Category::find($edit);
                $cat->name = $request->name;
                $res = $cat->save();
                if($res){
                    return redirect()->route('catview');

                }else{
                    return back()->with('fail','Error occured, please try again');
                }
            }

             // delete function
 public function categorydelete($fid)
 {
     $category = Category::find($fid);
     $res = $category->delete();
     if ($res) {
         return redirect()->route('catview');
     }
 }

 //modeartor view
 public function moderatorview(){
    $request = request();
    $user = new User();
    if ($request->session()->has('admin')) {
        $aid = $request->session()->get('admin');
        $admin = $user::where('id', '=', $aid)->get()->first();
           $mode = User::where('role','moderator')->get();
        return view('admin.moderatorview',compact('admin','mode'));
    }else{
        return redirect()->route('login')->with('fail','you have to login first');
    }
}
 
        //moderatorform view
        public function moderatorformview($edit = null){
            $request = request();
            $user = new User();
            if ($request->session()->has('admin')) {
                $aid = $request->session()->get('admin');
                $admin = $user::where('id', '=', $aid)->get()->first();
                if ($edit !== null && is_numeric($edit)) {
                    $mode = User::find($edit);
                
                } else {
                    // If $edit is null or not a valid ID, create a new instance
                    $mode = new User();
                 

                }
              
                return view('admin.moderatorform',compact('admin','mode'));
            }else{
                return redirect()->route('login')->with('fail','you have to login first');
            }
        }
        //moderator post
        public function moderatorpost(){
            $request = request();
            $user = new User();
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->location = $request->location;
            $user->role = 'moderator';
    
            if(User::where([['role','moderator']])->count()>0){
                return back()->with('fail','Moderator is already registered');
               
    
            }else{
                if($request->cpassword == $request->password){
                    if(strlen($request->phone)!= 10){
                        return back()->with('fail','Only 10 digits required');
                    }else{
                        $user->phone = $request->phone;
                    }
                    $user->password = Hash::make($request->password);
                   
                    //register data to database
                    $results = $user->save();
                    if($results){
                        return redirect()->route('modeview');
    
                    }else{
                        return back()->with('fail','Error occured please try again');
                    }
    
                }else{
                    return back()->with('fail','Passwords do not amtch');
                }
            }

        }

                     // delete function
 public function modedelete($fid)
 {
     $mode = User::find($fid);
     $res = $mode->delete();
     if ($res) {
         return redirect()->route('modeview');
     }
 }

    //edit category
          public function moderatoredit($edit){
            $request = request();
           
                $mode =  User::find($edit);
                $mode->fname = $request->fname;
                $mode->lname = $request->lname;
                $mode->email = $request->email;
                $mode->location = $request->location;
                $res = $mode->save();
                if($res){
                    return redirect()->route('modeview');

                }else{
                    return back()->with('fail','Error occured, please try again');
                }
            }



    // adimn logout function
    public function adminlogout()
    {
        $request = request();
        if ($request->session()->has('admin')) {
            $request->session()->pull('admin');
            return redirect()->route('login');
        }
    }
 }

