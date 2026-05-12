<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Events\NewOrderRegistered;

class PaymentController extends Controller
{
    //
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

        //d
        Log::info('CART AT CHECKOUT', ['cart' => $cart]); // verify structure

        $order = Order::create([
            'total_amount' => $total,
            'status' => 'pending',
            'payment_status' => 'pending',
            'user_id' => Auth::id(),
            'transaction_reference' => $reference,
            'cart_snapshot' => $cart,
        ]);
        
        $order->load('user');
        ///event listener
        //event(new NewOrderRegistered($order));//
        Log::info('=== ORDER EVENT FIRED ===', [
            'order_id' => $order->id,
            'total' => $order->total_amount,
            'email' => Auth::user()->email
        ]);

        Log::info('ORDER CREATED', [
            'order_id'      => $order->id,
            'cart_snapshot' => $order->cart_snapshot, // should NOT be null
            'cart_raw'      => $order->getRawOriginal('cart_snapshot'), // raw JSON string in DB
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

        $order = Order::where('transaction_reference', $reference)->first();
        if(!$order) {
            return redirect()->route('cart.index')->with('error', 'Order not found.');   
        };

        if($order->payment_status === 'paid'){
            session()->forget('cart');
            return redirect()->route('cart.test', $order->id)
                ->with('success', 'Payment successful!');
        }

        session()->forget('cart');
        return redirect()->route('cart.index')
            ->with('Pending', 'Payment is being confirmed...');
    }
}
