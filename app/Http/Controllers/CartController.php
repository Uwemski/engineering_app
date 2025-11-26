<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Events\NewOrderRegistered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addToCart(Request $request, $id) {
        //find the id
        $product = Product::findOrFail($id);

        //use session helper
        $cart = session('cart', []);

        $quantity = $request->input('quantity', 1); 
        if(isset($cart[$id]) ){
            $cart[$id]['quantity'] += $quantity;
        }else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image' => $product->image, 
                'description' => $product->description
            ];
        }
        
        // dd($cart);

        // Add or update the product in the cart
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added successfully');//anything after return doesn't work
    }

    public function cart(){

        return view('client.cart');
    }

    //a method to update cart
    public function cartUpdate(Request $request) {

        info($request->all());

        $cart = session('cart');

        $cart[$request->product_id]['quantity'] = $request->quantity;
    
        session()->put('cart', $cart);

        return response()->json(["success" => 1]);
    }

    //a method to delete cart
    public function cartDelete($id){
        //find product
        // dd("uefhefhefhefhe"); working like declan rice

        $product = Product::findOrFail($id);

        $cart = session('cart');

        //check if the product is in session  
        if(isset($cart[$id])){
            unset($cart[$id]);
            
            session(['cart' => $cart]);
        }

        // return response()->json(["success" => 1]); if we use ajax but i'm having issue with the ajax method
        return redirect()->back()->with('success', 'Item has been deleted successfully');
    }

    public function checkout() {
        
        $cart = session('cart', []);

        //check if cart is empty
        if(empty($cart)){
            return redirect()->route('cart')->with('error', 'cart is empty');
        }

        return view('cart.checkout', compact('cart'));
    }

    //a method to process checkout
    public function checkoutProcess(Request $request) {
        $cart = session('cart', []);
        if(empty($cart)){
            return redirect()->route('cart')->with('error', 'cart is empty');
        }

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        $reference = 'DONPAS_' . Str::upper(Str::random(10));

        // Convert to kobo (Paystack expects amount in kobo)
        $amountInKobo = $total * 100;

        $order = Order::create([
            'total_amount' => $total,
            'status' => 'pending',
            'payment_status' => 'pending',
            'user_id' => Auth::id(),
            'transaction_reference' => $reference
        ]);
        
        $order->load('user');
        ///event listener
        event(new NewOrderRegistered($order));
        Log::info('=== ORDER EVENT FIRED ===', [
    'order_id' => $order->id,
    'total' => $order->total_amount,
    'email' => Auth::user()->email
]);

        $response = Http::withToken(env('PAYSTACK_SECRET_KEY')) 
                    ->post(env('PAYSTACK_PAYMENT_URL') . '/transaction/initialize', 
                    [
                        'email' =>Auth::user()->email,
                        'amount' => $amountInKobo,
                        'reference' => $reference,
                        'callback_url' => route('payment.callback')
                    ]);


        if(!$response['status']){
            return redirect()->back()->with('error', 'Unable to initiate payment');
        }

        return redirect($response['data']['authorization_url']);
    }


    public function handleGatewayCallback(Request $request){
        $reference = $request->query('reference');

        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))->get(
            env('PAYSTACK_PAYMENT_URL') . "/transaction/verify/{$reference}"
        )->json();

        if (!$response['status']) {
            return redirect()->route('cart.index')->with('error', 'Payment verification failed.');
        } 

        $order = Order::where('transaction_reference', $reference)->firstOrFail();

        if ($response['data']['status'] === 'success') {
            $order->update([
                'payment_status' => 'paid',
            ]);

            // Save order items
            $cart = session('cart', []);
            foreach ($cart as $productId => $details) {
                $orderItem= OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                    'subTotal' => $details['quantity'] * $details['price'],
                ]);
            }

            session()->forget('cart');

            return redirect()->route('cart.test', $order->id)
                ->with('success', 'Payment successful!');
        }

        $order->update([
            'payment_status' => 'failed',
            'status' => 'cancelled',
        ]);

        return redirect()->route('cart.test')->with('error', 'Payment failed or was cancelled.');
    }
}
