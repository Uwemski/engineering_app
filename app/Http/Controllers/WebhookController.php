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

class WebhookController extends Controller
{
    public function handlePayment(Request $request)
    {

         Log::info('PAYSTACK WEBHOOK HIT', [
            'payload' => $request->all()
        ]);

        Log::info('WEBHOOK HIT'); // Step 1: did we get here?
        //process the webhook data
        //check if the header came from paystack and the request was a POST
        if(!$request->header('x-paystack-signature') || !$request->isMethod('POST')){
            abort(400, 'invalid request');
        };

        $payload = $request->json()->all();
        $event = $payload['event']; //?? null
        $data = $payload['data']; //?? null

        $secretKey = config('services.paystack.secret_key');
        // validate event do all at once to avoid timing attack
        if($request->header('x-paystack-signature') !== hash_hmac('sha512', $request->getContent(), $secretKey)){
            abort(400, 'Invalid signature');
        };

         Log::info('SIGNATURE CHECK', [
        'received' => $signature,
        'computed' => $computed,
        'match'    => $signature === $computed,
        'secret_empty' => empty($secretKey), // ⚠️ critical check
    ]);

     Log::info('WEBHOOK EVENT', ['event' => $event, 'reference' => $data['reference'] ?? 'NONE']);
        // 2. Handle only the events you care about
        match ($event) {
            'charge.success' => $this->handleChargeSuccess($data),
            default          => null, // Ignore other events
        };

        //always return response 200
        return response()->json(['message' => 'Webhook received'], 200);
    }

    private function handleChargeSuccess(array $data): void
    {
        Log::info('handleChargeSuccess CALLED', ['data' => $data]);

        $reference = $data['reference'];
        if(!$reference) return;

        $order = Order::where('transaction_reference', $reference)->first();
        
        Log::info('ORDER LOOKUP', [
        'reference' => $reference,
        'found'     => $order ? 'YES' : 'NO', // ⚠️ if NO, reference mismatch
        'order_id'  => $order?->id,
    ]);
        
        if(!$order){
            Log::error('Webhook: Order not found for reference {$reference}');
            return;
        }

        //avoid processing the same payment twice
        if($order->payment_status === "paid") {
           Log::info('ALREADY PAID, SKIPPING');
            return;
        }
        $order->update(['payment_status' => 'paid']);


        Log::info('ORDER MARKED PAID');

        $cartItems = $order->cart_snapshot;
        Log::info('CART SNAPSHOT', ['items' => $cartItems]);

        if (empty($cartItems)) {
            Log::error('CART SNAPSHOT IS EMPTY OR NULL — order items will NOT be created');
            return;
        }


        foreach($cartItems as $productId => $details){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' =>  $details['quantity'],
                'price' => $details['price'],
                'subTotal'  => $details['quantity'] * $details['price'],
            ]);
             Log::info('ORDER ITEM CREATED', ['item_id' => $item->id]);
        }
    
        
        Log::info("Webhook: Order #{$order->id} marked as paid.");
        
    }
}
