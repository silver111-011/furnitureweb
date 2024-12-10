<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Furniture;
use App\Models\FurnitureOrders;
use App\Models\Furnitures;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class sellerController extends Controller
{
    //
    public function sellerlanding(){
        $request = request();
        $user = new User();
        if ($request->session()->has('seller')) {
            $sid = $request->session()->get('seller');
            $seller = $user::where('id', '=', $sid)->get()->first();
            //query for table data
           $furnitureposts = Furnitures::where('seller_id',$seller->id)->get();
            return view('seller.landing',compact('seller','furnitureposts'));
        }else{
            return redirect()->route('login')->with('fail','you have to login first');
        }
    }

    public function furnitureform($edit = null){
        $request = request();
        $categories = Category::all();
        $user = new User();
        if ($request->session()->has('seller')) {
            $sid = $request->session()->get('seller');
            $seller = $user::where('id', '=', $sid)->get()->first();
            if ($edit !== null && is_numeric($edit)) {
              $furnitures = Furnitures::with('category')->where('id',$edit)->first();
            } else {
                // If $edit is null or not a valid ID, create a new instance
                $furnitures = new Furnitures();
            }

            return view('seller.furnitureform', compact('seller','furnitures','categories'));
                }else{
                    return redirect()->route('login')->with('fail','you have to login first');
                }

    }

    public function storefurniture(){
        $request = request();
        $furniture = new Furnitures();
        if ($request->session()->has('seller')) {
            $sid = $request->session()->get('seller');
            
        $inputs = $request->all();
        if (collect($inputs)->every(function ($value) {
            return !empty($value);
        })) {

        $furniture->name = $request->name;
        $furniture->price = $request->price;
        $furniture->quantity = $request->quantity;
        $furniture->description = $request->description;
        $furniture->category_id = $request->category;
        $furniture->seller_id = $sid;
        $furniture->switch = 0;
       

        if ($request->hasFile(key: 'furnitureimg')) {
    

            $file = $request->file(key: 'furnitureimg');

            $file = Storage::putFileAs(
                'furniture-images',
                $file,
                str()->uuid() . '.' . $file->extension(),
                'public'
            );

            $furniture->imagepath = $file;
        }

        $result = $furniture->save();
        if($result){
         return   redirect()->route('seller');

        }else{
            return back()->with('fail','upload fail, please try again');
        }


        }else{
            return back()->with('fail','All fields are required');
        }

    }else{
        return redirect()->route('login')->with('fail','You have to login first');
    }

    }

      //edit furniture
      public function furnitureedit($id)
      {
          $request = request();
          $furniture = Furnitures::find($id);
          $furniture->name = $request->name;
          $furniture->price = $request->price;
          $furniture->quantity = $request->quantity;
          $furniture->description = $request->description;
          $furniture->category_id = $request->category;
          if ($request->hasFile(key: 'furnitureimg')) {
              //delete the image in strorage
              if (Storage::exists(  $furniture->imagepath)) {
                  Storage::delete(  $furniture->imagepath);
              }
              $file = $request->file(key: 'furnitureimg');
  
              $file = Storage::putFileAs(
                'furniture-images',
                  $file,
                  str()->uuid() . '.' . $file->extension(),
                  'public'
              );
  
              $furniture->imagepath = $file;
          }
  
          $results = $furniture->save();
          if ($results) {
              return redirect()->route('seller');
          } else {
              return back()->with('fail', 'Process faild, please try again');
          }
      }


 
    //downoad image
    public function downloadimage($fid){
        $request = request();
       
           $furniture = Furnitures::where('id',$fid)->get()->first();
             return response()->download(storage_path('app/'.$furniture->imagepath??''));
    

    }

 // delete function
 public function furnituredelete($fid)
 {
     $furniture = Furnitures::find($fid);
     //delete the image in its path
     if (Storage::exists($furniture->imagepath)) {
         Storage::delete($furniture->imagepath);
     }
     $res = $furniture->delete();
     if ($res) {
         return redirect()->route('seller');
     }
 }
 public function ordercomplete($id){
   $order = Order::find($id);
    $order->status = 'completed';
  $res =  $order->save();
    if($res){
        return redirect()->route('vieworders');
    }else{
        return back()->with('fail','Process failed');
    }
 }

 public function orderedfurniture($id){
    $request = request();
 
    $user = new User();
    if ($request->session()->has('customer')) {
        $aid = $request->session()->get('customer');
        $seller = User::where('id', '=', $aid)->get()->first();
          $orderitems = FurnitureOrders::with(['furniture','order'])->where('order_id',$id)->get();
          return view('seller.orderitems',compact('seller','orderitems'));
    }else{
        return redirect()->route('login')->with('fail','you have to login first');
    }
 }


   public function deleteorder($id){
    $order = Order::find($id);
    if($order){
      $res =  $order->delete();
      if($res){
        return back()->with('success','Orderd deleted succseffuly');
      }else{
        return back()->with('fail','Orderd failed to delete');
      }
    }
   }
    // seller logout function
    public function sellerlogout()
    {
        $request = request();
        if ($request->session()->has('seller')) {
            $request->session()->pull('seller');
            return redirect()->route('login');
        }
    }
}
