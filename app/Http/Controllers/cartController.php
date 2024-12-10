<?php

namespace App\Http\Controllers;

use App\Models\Furnitures;
use Illuminate\Http\Request;

class cartController extends Controller
{
    //add to cart function
    public function addtocart($id)
    {
        $furniture = Furnitures::findOrFail($id);
        
        // Retrieve the existing cart or initialize an empty array if the cart doesn't exist
        $cart = session()->get('cart', []);

        // Check if the item already exists in the cart
        if (isset($cart[$id])) {
            // If the item exists, increment its quantity
            $cart[$id]['quantity']++;
        } else {
            // If the item doesn't exist, add it with quantity 1
            $cart[$id] = [
                "name" => $furniture->name,
                "quantity" => 1,
                "price" => $furniture->price,
                "photo" => $furniture->imagepath
            ];
        }

        // Update the session cart
        session()->put('cart', $cart);

        // Redirect to the product list page
        return redirect()->route('productlists');
    }
    public function showCart()
    {
        // Retrieve cart items from the session
        $cart = session()->get('cart', []);

        // Pass cart items to the view for display
        return view('cart', compact('cart'));
    }

    public function removeFromCart(Request $request)
    {
        // Retrieve product ID to be removed from the request
        $productId = $request->input('product_id');

        // Retrieve cart items from the session
        $cart = session()->get('cart', []);

        // Remove the item from the cart
        unset($cart[$productId]);

        // Store cart items back into the session
        session()->put('cart', $cart);
        
        // Redirect back or return a response
    }
}
