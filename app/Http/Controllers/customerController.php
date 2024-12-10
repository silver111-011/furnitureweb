<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\FurnitureOrders;
use App\Models\Furnitures;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class customerController extends Controller
{
    public function home(){
        return view('customer.index');
    }

    //customerlanding
    public function customerlanding(){
        $request = request();
        $user = new User();
        if ($request->session()->has('customer')) {
            $aid = $request->session()->get('customer');
            $customer = Customer::where('id', '=', $aid)->get()->first();
            
            $orders = Order::where('customer_id',$aid)->get();
          
            return view('customer.customerlanding',compact('customer','orders'));
        }else{
            return redirect()->route('login')->with('fail','you have to login first');
        }
    }



    // productlist function
    public function productlists(){
       // Retrieve the existing cart or initialize an empty array if the cart doesn't exist
       $cart = session()->get('cart', []);
       $search = null;
       $officeid= 0;
       $homeid = 0;
       $schoolid=0;
       $luxuryid =0;
       $categories = Category::all();
       foreach($categories as $cat){
        if($cat->name == 'Home'){
            $homeid =$cat->id;
        }
        if($cat->name == 'Office'){
            $officeid =$cat->id;
        }
        if($cat->name == 'School'){
            $schoolid =$cat->id;
        }
        if($cat->name == 'Luxury'){
            $luxuryid =$cat->id;
        }
       
       }
        $furnitureall = Furnitures::where('switch',0)->get();
        $furniturehome = Furnitures::where([['category_id',$homeid],['switch',0]])->get();
        $furnitureoffice = Furnitures::where([['category_id',$officeid],['switch',0]])->get();
        $furnitureschool = Furnitures::where([['category_id',$schoolid],['switch',0]])->get();
        $furnitureluxury = Furnitures::where([['category_id',$luxuryid],['switch',0]])->get();
        $searchfurnitures = collect();
        return view('customer.productlist',compact('search','searchfurnitures','furnitureall','furniturehome','furnitureoffice','furnitureschool','furnitureluxury','cart'));
    }

    //product detail page
    public function productdetail($id){
        $furniture = Furnitures::with('seller')->find($id);
        return view('customer.productdetail',compact('furniture'));

    }

   

    //login page
    public function login($cus = null){
        if($cus == null){
            $toorders = 0;
        }
        else{
            $toorders = 1;
        }
        return view('login', compact('toorders'));
    }

    //signup page
    public function signup(){
        return view('signup');
    }
       
    //seller register
    public function sellerregistration(){
        $request = request();
        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->location = $request->location;
        $user->role = 'seller';

        if(User::where('email', $request->email)->count()>0){
            return back()->with('fail','The user with this email exists');
           

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
                    return redirect()->route('login');

                }else{
                    return back()->with('fail','Error occured please try again');
                }

            }else{
                return back()->with('fail','Passwords do not amtch');
            }
        }

    }

    //search function
    public function searchfurniture(){
          // Retrieve the existing cart or initialize an empty array if the cart doesn't exist
          $cart = session()->get('cart', []);
          $search = 1;
          $officeid= 0;
          $homeid = 0;
          $schoolid=0;
          $luxuryid =0;
          $categories = Category::all();
          foreach($categories as $cat){
           if($cat->name == 'Home'){
               $homeid =$cat->id;
           }
           if($cat->name == 'Office'){
               $officeid =$cat->id;
           }
           if($cat->name == 'School'){
               $schoolid =$cat->id;
           }
           if($cat->name == 'Luxury'){
               $luxuryid =$cat->id;
           }
          
          }
           $request = request();
          $furnitureall = Furnitures::all();
          $furniturehome = Furnitures::where('category_id',$homeid)->get();
          $furnitureoffice = Furnitures::where('category_id',$officeid)->get();
          $furnitureschool = Furnitures::where('category_id',$schoolid)->get();
          $furnitureluxury = Furnitures::where('category_id',$luxuryid)->get(); 
          $searchinput = $request->search;
          $searchfurnitures = Furnitures::where('name','LIKE',"%{$searchinput}%")
                                       ->orWhere('price','LIKE',"%{$searchinput}%")
                                       ->get();
         return view('customer.productlist',compact('search','searchfurnitures','furnitureall','furniturehome','furnitureoffice','furnitureschool','furnitureluxury','cart'));
        
    }
    //disbute function
    public function dispute($id){
        $request = request();
     
        if ($request->session()->has('customer')) {
            $aid = $request->session()->get('customer');
           $orderitems = FurnitureOrders::find($id);
           if($orderitems){
            if($orderitems->feedback == 'null'){
                $orderitems->is_dispute = 1;
                $res = $orderitems->save();
                if($res){
                    $order = Order::where('id',$orderitems->id)->first();
                    if($order){
                       $order->has_dispute = 1;
                       $orderes = $order->save();
                       if($orderes){
                        return redirect()->route('customer');
                       }else{
                        return back()->with('fail','dispute failed');
                       }
                    }else{
                        return back()->with('fail','dispute failed');
                    }
                    
                }
            }else{
                return back()->with('fail','You have already provided feedback for this order you can not create a dispute');
            }
           
           }
        }else{
            return redirect()->route('login')->with('fail','you have to login first');
        }
    }

    //
    public function feedpostpage($id){
        $request = request();
     
        if ($request->session()->has('customer')) {
            $aid = $request->session()->get('customer');
            $customer = Customer::where('id', '=', $aid)->get()->first();
              $furniture = FurnitureOrders::find($id);
            return view('customer.postfeed',compact('customer','furniture'));
        }else{
            return redirect()->route('login')->with('fail','you have to login first');
        }
    }


    public function feedbackpost($id){
        $request = request();
        $order = FurnitureOrders::find($id);
        if($order){
            if($order->is_dispute == 1){
                return back()->with('fail','No feedback is provided to dispute order');
            }else{
                if($order->status != 'completed'){
                    return back()->with('fail','The order is still on process, You can not provide feedback');
                }else{
               if($order->feedback == 'null'){
                $order->feedback = $request->feedback;
                $res = $order->save();
                if($res){
                    return redirect()->route('customer')->with('success','feedback sent successfully');
                }else{
                    return back()->with('fail','Error occured please try again');
                }
               }else{
                return back()->with('fail', 'you have arleady provided feedback for this order');
               }
            }
            }
            
            
        }
    }

     public function topayments($totalcost, $id){
        $request = request();
        $user = new User();
        if ($request->session()->has('customer')) {
            $aid = $request->session()->get('customer');
            $customer = Customer::where('id', '=', $aid)->get()->first();
               $orderid = $id;
               $sellerphone = '0754888888';
              return view('customer.payment',compact('totalcost','sellerphone','orderid'));
        }else{
            return redirect()->route('login')->with('fail','you have to login first');
        }
     }

     public function orderedfurniture($id){
        $request = request();
     
        $user = new User();
        if ($request->session()->has('customer')) {
            $aid = $request->session()->get('customer');
            $customer = Customer::where('id', '=', $aid)->get()->first();
              $orderitems = FurnitureOrders::with(['furniture','order'])->where('order_id',$id)->get();
              return view('customer.orderitems',compact('customer','orderitems'));
        }else{
            return redirect()->route('login')->with('fail','you have to login first');
        }
     }
    public function orderpayments($id){
        $order = Order::find($id);
        if($order){
          $order->is_paid = 1;
          $res = $order->save();
        
          if($res){
            if(request()->session()->has('customer')){
            return redirect()->route('customer')->with('success','Order Paid Successfully');
            }else{
                return redirect()->route('productlists')->with('success','Order paid succellfully Login to track status ');
            }
          }
        }else{
            return back()->with('fail','order not found');
        }

    }

    //customer logout
    public function customerlogout()
    {
        $request = request();
        if ($request->session()->has('customer')) {
            $request->session()->pull('customer');
            return redirect()->route('login');
        }
    }
}
