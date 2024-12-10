<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FurnitureOrders;
use App\Models\Furnitures;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class orderController extends Controller
{

    //create order
    public function createorder($id = null){
        if($id != null){
            $productlist = Furnitures::find($id);
        }else{
            $productlist = new Furnitures();
        }
     
        return view('customer.createorder',compact('productlist'));

    }
     //post order
     public function orderpost($idf = null ){
        $request = request();
        $customer = new Customer();
       
        if($customer::where('email',$request->email)->count()>0){
            //if the customer exists, there are three posibilites, creating furniture order only
            //creating furture with cart and creating cart order only
            //retreiving the custoer
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $customerdata = Customer::where('email',$request->email)->get()->first();
            if($idf != null ){
             // means the furniture exists, thus there only two posibility here
             //furniture only order or furniture and  cart order
             //retreive the furniture
         $furniture = Furnitures::find($idf);
              //checking if cart also exists
              if(session()->has('cart') && !empty(session('cart'))){
                //means both orders exists
                $carttotal = 0;
                $itemcount =1;
                foreach(session('cart') as $id => $details){
                    $carttotal += $details['quantity'] * $details['price']; 
                    $itemcount++;
                }
                $itemnumber = $itemcount + 1;
                //obtain the total amount from furniture order
                $furniturecost = $furniture->price * $request->quantity;
                $totalcost = $carttotal + $furniturecost;
                // save the order to orders table
                $order  = new Order();
                $order->is_paid =  0;
                $order->has_dispute = 0;
                $order->item_number =   $itemnumber;
                $order->total_amount = $totalcost;
                $order->order_status = 'onprocess';
                $order->customer_id = $customerdata->id;
                $resultsorder = $order->save();
                if($resultsorder){
                     //add to furniture_order_table
                     //to btain id where need the order with the most recent data of customerid
                     $recentorder = Order::where('customer_id',$customerdata->id)->first();
                     if($recentorder){
                      // inset itmes ordered to the furniture_orders table
                      $orderitems = new FurnitureOrders();
                      $orderitems->item_status = 'onprocess';
                      $orderitems->location = $request->location;
                      $orderitems->quantity_ordered = $request->quantity;
                      $orderitems->is_dispute = 0;
                      $orderitems->feedback = 'null';
                      $orderitems->order_id =  $recentorder->id;
                      $orderitems->furniture_id = $furniture->id;
                      $itemsresult = $orderitems->save();
                      if($itemsresult){
                        //add cart orders to the furniture order table
                        foreach(session('cart') as $id => $details){
                            $cartorder = new FurnitureOrders();
                            $cartorder->item_status = 'onprocess';
                            $cartorder->location = $request->location;
                            $cartorder->quantity_ordered = $details['quantity'];
                            $cartorder->is_dispute = 0;
                            $cartorder->feedback = 'null';
                            $cartorder->order_id =  $recentorder->id;
                            $cartorder->furniture_id = $id;
                            $cartorder->save();
      
                        }
                        if ($request->session()->has('cart')) {
                            $request->session()->pull('cart');
                        }
                    
                        $sellerphone = '0754888888';
                        $orderid = $recentorder->id;
                        return view('customer.payment',compact('totalcost','sellerphone','orderid'));

                      }else{
                        return back()->with('fail','error occured during orderitems data insertion, please try again');
                      }

                     }else{
                        return back()->with('fail','the order is not present in table orders');
                     }

                }

              }else{
                //means only furniture order exists
                 //obtain the total amount from furniture order
                 $furniturecost = $furniture->price * $request->quantity;
                 $totalcost =  $furniturecost;
                 // save the order to orders table
                 $order  = new Order();
                 $order->is_paid = 0;
                 $order->has_dispute = 0;
                 $order->item_number = 1;
                 $order->total_amount = $totalcost;
                 $order->order_status = 'onprocess';
                 $order->customer_id = $customerdata->id;
                 $resultsorder = $order->save();
                 if($resultsorder){
                       //add to furniture_order_table
                     //to btain id where need the order with the most recent data of customerid
                     $recentorder = Order::where('customer_id',$customerdata->id)->first();
                     if($recentorder){
                      // inset itmes ordered to the furniture_orders table
                      $orderitems = new FurnitureOrders();
                      $orderitems->item_status = 'onprocess';
                      $orderitems->location = $request->location;
                      $orderitems->quantity_ordered = $request->quantity;
                      $orderitems->is_dispute = 0;
                      $orderitems->feedback = 'null';
                      $orderitems->order_id =  $recentorder->id;
                      $orderitems->furniture_id = $furniture->id;
                      $itemsresult = $orderitems->save();
                      if($itemsresult){
                     
                        $sellerphone = '0754888888';
                        $orderid = $recentorder->id;
                        return view('customer.payment',compact('totalcost','sellerphone','orderid'));

                      }else{
                        return back()->with('fail','fail to add data in furniture orders table');
                      }
                     }else{
                        return back()->with('fail','the recent order is not obtained');
                     }
                 }else{
                    return back()->with('fail to insert data to orders table');
                 }
              }
                
     }else{
        //means only  cart order is present
        $carttotal = 0;
        $itemcount =1;
        if(session()->has('cart') && !empty(session('cart'))){
        foreach(session('cart') as $id => $details){
            $carttotal += $details['quantity'] * $details['price']; 
            $itemcount++;
        }
        //send to orders table
        $orderitemnumber = $itemcount;
        $total = $carttotal;
          // save the order to orders table
          $order  = new Order();
          $order->is_paid = 0;
          $order->has_dispute = 0;
          $order->item_number = $orderitemnumber;
          $order->total_amount = $total;
          $order->order_status = 'onprocess';
          $order->customer_id = $customerdata->id;
          $resultsorder = $order->save();
          if($resultsorder){
            //submit to orders table
         //to btain id where need the order with the most recent data of customerid
          $recentorder = Order::where('customer_id',$customerdata->id)->first();
            foreach(session('cart') as $id => $details){
                $cartorder = new FurnitureOrders();
                $cartorder->item_status = 'onprocess';
                $cartorder->location = $request->location;
                $cartorder->quantity_ordered = $details['quantity'];
                $cartorder->is_dispute = 0;
                $cartorder->feedback = 'null';
                $cartorder->order_id =  $recentorder->id;
                $cartorder->furniture_id = $id;     
                $cartorder->save();

            }

            if ($request->session()->has('cart')) {
                $request->session()->pull('cart');
            }
            $totalcost = $carttotal;
    
            $sellerphone = '0754888888';
            $orderid = $recentorder->id;
            return view('customer.payment',compact('totalcost','sellerphone','orderid'));

          }else{
            return back()->with('fail','order data did not sent');
          }}else{
            return redirect()->route('home');
          }
   //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++=
     }
    }else{
        //the customer does not exist
        //save the customer to customer table
        $customer = new Customer();
        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->location = $request->location;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->orderedtimes = 1;
        $customer->password = Hash::make('123');
        $custresults = $customer->save();
        if($custresults){
            //retreive the customer data
              //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $customerdata = Customer::where('email',$request->email)->get()->first();
            if($idf != null ){
             // means the furniture exists, thus there only two posibility here
             //furniture only order or furniture and  cart order
             //retreive the furniture
             $furniture = Furnitures::find($idf);
              //checking if cart also exists
              if(session()->has('cart') && !empty(session('cart'))){
                //means both orders exists
                $carttotal = 0;
                $itemcount =1;
                foreach(session('cart') as $id => $details){
                    $carttotal += $details['quantity'] * $details['price']; 
                    $itemcount++;
                }

                 $itemcount;
                //obtain the total amount from furniture order
                $furniturecost = $furniture->price * $request->quantity;
                $totalcost = $carttotal + $furniturecost;
                // save the order to orders table
                $order  = new Order();
                $order->is_paid = 0;
                $order->has_dispute = 0;
                $order->item_number = $itemcount + 1;
                $order->total_amount = $totalcost;
                $order->order_status = 'onprocess';
                $order->customer_id = $customerdata->id;
                $resultsorder = $order->save();
                if($resultsorder){
                     //add to furniture_order_table
                     //to btain id where need the order with the most recent data of customerid
                     $recentorder = Order::where('customer_id',$customerdata->id)->first();
                     if($recentorder){
                      // inset itmes ordered to the furniture_orders table
                      $orderitems = new FurnitureOrders();
                      $orderitems->item_status = 'onprocess';
                      $orderitems->location = $request->location;
                      $orderitems->quantity_ordered = $request->quantity;
                      $orderitems->is_dispute = 0;
                      $orderitems->feedback = 'null';
                      $orderitems->order_id =  $recentorder->id;
                      $orderitems->furniture_id = $furniture->id;
                      $itemsresult = $orderitems->save();
                      if($itemsresult){
                        //add cart orders to the furniture order table
                        foreach(session('cart') as $id => $details){
                            $cartorder = new FurnitureOrders();
                            $cartorder->item_status = 'onprocess';
                            $cartorder->location = $request->location;
                            $cartorder->quantity_ordered = $details['quantity'];
                            $cartorder->is_dispute = 0;
                            $orderitems->feedback = 'null';
                            $cartorder->order_id =  $recentorder->id;
                            $cartorder->furniture_id = $id;
                            $cartorder->save();
      
                        }
                        if ($request->session()->has('cart')) {
                            $request->session()->pull('cart');
                        }
                        
                        $sellerphone = '0754888888';
                        $orderid = $recentorder->id;
                        return view('customer.payment',compact('totalcost','sellerphone','orderid'));

                      }else{
                        return back()->with('fail','error occured during orderitems data insertion, please try again');
                      }

                     }else{
                        return back()->with('fail','the order is not present in table orders');
                     }

                }

              }else{
                //means only furniture order exists
                 //obtain the total amount from furniture order
                 $furniturecost = $furniture->price * $request->quantity;
                 $totalcost =  $furniturecost;
                 // save the order to orders table
                 $order  = new Order();
                 $order->is_paid = 0;
                 $order->has_dispute = 0;
                 $order->item_number = 1;
                 $order->total_amount = $totalcost;
                 $order->order_status = 'onprocess';
                 $order->customer_id = $customerdata->id;
                 $resultsorder = $order->save();
                 if($resultsorder){
                       //add to furniture_order_table
                     //to btain id where need the order with the most recent data of customerid
                     $recentorder = Order::where('customer_id',$customerdata->id)->first();
                     if($recentorder){
                      // inset itmes ordered to the furniture_orders table
                      $orderitems = new FurnitureOrders();
                      $orderitems->item_status = 'onprocess';
                      $orderitems->location = $request->location;
                      $orderitems->quantity_ordered = $request->quantity;
                      $orderitems->is_dispute = 0;
                      $orderitems->feedback = 'null';
                      $orderitems->order_id =  $recentorder->id;
                      $orderitems->furniture_id = $furniture->id;
                      $itemsresult = $orderitems->save();
                      if($itemsresult){
                        $sellerphone = '0754888888';
                        $orderid = $recentorder->id;
                        return view('customer.payment',compact('totalcost','sellerphone','orderid'));

                      }else{
                        return back()->with('fail','fail to add data in furniture orders table');
                      }
                     }else{
                        return back()->with('fail','the recent order is not obtained');
                     }
                 }else{
                    return back()->with('fail to insert data to orders table');
                 }
              }
                
     }else{
        //means only  cart order is present
        $carttotal = 0;
        $itemcount =0;
        if(session()->has('cart') && !empty(session('cart'))){
        foreach(session('cart') as $id => $details){
            $carttotal += $details['quantity'] * $details['price']; 
            $itemcount++;
        }
        //send to orders table
          // save the order to orders table
          $itemcount;
          $order  = new Order();
          $order->is_paid = 0;
          $order->has_dispute = 0;
          $order->item_number = $itemcount;
          $order->total_amount = $carttotal;
          $order->order_status = 'onprocess';
          $order->customer_id = $customerdata->id;
          $resultsorder = $order->save();
          if($resultsorder){
            //submit to orders table
         //to btain id where need the order with the most recent data of customerid
          $recentorder = Order::where('customer_id',$customerdata->id)->first();
            foreach(session('cart') as $id => $details){
                $cartorder = new FurnitureOrders();
                $cartorder->item_status = 'onprocess';
                $cartorder->location = $request->location;
                $cartorder->quantity_ordered = $details['quantity'];
                $cartorder->is_dispute = 0;
                $cartorder->feedback = 'null';
                $cartorder->order_id =  $recentorder->id;
                $cartorder->furniture_id = $id; 
                $cartorder->save();

            }

            if ($request->session()->has('cart')) {
                $request->session()->pull('cart');
            }
            $totalcost = $carttotal;
           
            $sellerphone = '0754888888';
            $orderid = $recentorder->id;
            return view('customer.payment',compact('totalcost','sellerphone','orderid'));

          }else{
            return back()->with('fail','order data did not sent');
          }
        }else{
            return redirect()->route('home');
        }
   //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++=
     }
        }else{
            return back()->with('fail','data insertion to customers table failed');
        }
    }
}

   public function orderview() {
    $request = request();
    $user = new User();

    if ($request->session()->has('seller')) {
        $sid = $request->session()->get('seller');
        $seller = $user::where('id', '=', $sid)->first();

        // Query for table data
        $orders = Order::whereHas('furnitureitems.furniture', function ($query) use ($sid) {
            $query->where('seller_id', $sid);
        })->get();

        return view('seller.orders', compact('seller', 'orders'));
    } else {
        return redirect()->route('login')->with('fail', 'you have to login first');
    }
}

}
