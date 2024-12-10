<?php

namespace App\Http\Controllers;

use App\Models\FurnitureOrders;
use App\Models\Furnitures;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class moderatorController extends Controller
{
    // moderator page
    public function moderatorlanding(){
        $request = request();
        $user = new User();
        if ($request->session()->has('moderator')) {
            $aid = $request->session()->get('moderator');
            $admin = $user::where('id', '=', $aid)->get()->first();
            $moderator = User::where('role','moderator')->orderBy('id', 'desc')->get()->first();
            $orders = FurnitureOrders::with(['furniture.seller', 'order.customer'])->where('is_dispute','1')->get();
          
            return view('moderator.landing',compact('moderator','orders'));
        }else{
            return redirect()->route('login')->with('fail','you have to login first');
        }
    }

     // block user moderator page
     public function moderatoruserblock(){
        $request = request();
        $user = new User();
        if ($request->session()->has('moderator')) {
            $aid = $request->session()->get('moderator');
            $admin = $user::where('id', '=', $aid)->get()->first();
            $moderator = User::where('role','moderator')->orderBy('id', 'desc')->get()->first();
            $users = User::where('role','seller')->orderBy('id', 'desc')->get();
          
            return view('moderator.blockuser',compact('moderator','users'));
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
        $sellerfurnitures = Furnitures::where('seller_id',$id)->get();
        if($sellerfurnitures){
            foreach($sellerfurnitures as $furniture){
                $furniture->switch = 0;
                $furniture->save();
            }

        }
        return redirect()->route('blockusers');
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
        $sellerfurnitures = Furnitures::where('seller_id',$id)->get();
        if($sellerfurnitures){
            foreach($sellerfurnitures as $furniture){
                $furniture->switch = 1;
                $furniture->save();
            }
        return redirect()->route('blockusers');
   } }else{
         return back()->with('fail', 'error in blocking please try again');
    }

}

//complete dispute
public function completedispute($id){
    $request = request();
    $user = new User();
    if ($request->session()->has('moderator')) {
      $order = FurnitureOrders::find($id);
      if($order){
         $order->is_dispute = 0;
        $res = $order->save();
         if($res){
            return redirect()->route('moderator');
         }

      }
      
      
    }else{
        return redirect()->route('login')->with('fail','you have to login first');
    }
}

  // seller logout function
  public function moderatorlogout()
  {
 
      $request = request();
      if ($request->session()->has('moderator')) {
          $request->session()->pull('moderator');
          return redirect()->route('login');
      }
  }

}
