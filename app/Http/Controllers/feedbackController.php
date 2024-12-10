<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Feedbacks;
use App\Models\FurnitureOrders;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class feedbackController extends Controller
{
    //
    public function feedbackview(){
        $request = request();
        $user = new User();
        if ($request->session()->has('seller')) {
            $sid = $request->session()->get('seller');
            $seller = $user::where('id', '=', $sid)->get()->first();
            //query for table data
            // Query to get furniture orders where feedback is not null and seller_id is equal to $sid
        $feedbacks = FurnitureOrders::where('feedback', '!=','null')
        ->whereHas('furniture', function ($query) use ($sid) {
            $query->where('seller_id', $sid);
        })
        ->get();
          
            return view('seller.feedbacks',compact('seller','feedbacks'));
        }else{
            return redirect()->route('login')->with('fail','you have to login first');
        }
    }
}
