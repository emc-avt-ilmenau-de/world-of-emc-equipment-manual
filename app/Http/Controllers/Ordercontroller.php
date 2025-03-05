<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Exception;

class Ordercontroller extends Controller
{
    public function submit(Request $request)
{
    Log::info('OrderController@submit called.');
    
    // Get the basket from the session
    $basket = session()->get('basket', []);
    $locale = app()->getLocale();
    Log::info('Basket Contents:', $basket);
    
    if (empty($basket)) {
        Log::error('Basket is empty.');
        return redirect()->route('basket.show')->with('error', 'Your basket is empty.');
    }
    
    try {
        DB::beginTransaction();
    
        // Insert order into `Order` table
        $orderId = DB::table('Order')->insertGetId([
            'OrderCustName' => $request->input('OrderCustName'),
            'OrderOrgName'  => $request->input('OrderOrgName'),
            'OrderEmail'    => $request->input('OrderEmail'),
            'OrderPhone'    => $request->input('OrderPhone'),
            'OrderAddress'  => $request->input('OrderAddress'),
            'OrderComment'  => $request->input('OrderComment'),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
        Log::info('Order Created:', ['OrderID' => $orderId]);
    
        // Process each product in the basket
        foreach ($basket as $item) {
            $productName = 'Unnamed';
            $product = DB::table('Product')
                ->where('ProductID', $item['product_id'])
                ->first();
            if ($product) {
                $decodedProductName = json_decode($product->ProductName, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decodedProductName)) {
                    $productName = $decodedProductName[$locale]['ProductName'] 
                        ?? ($decodedProductName['en']['ProductName'] ?? 'Unnamed');
                } else {
                    $productName = !empty($product->ProductName) ? $product->ProductName : 'Unnamed';
                }
            }

            $orderItemData = [
                'OrderID'           => $orderId,
                'ProductID'         => $item['product_id'],
                'OrderItemQuantity' => $item['quantity'],
                'OrderItemPrice'    => $item['total_price'],
                'OrderItemCurrency' => 'EUR',
                'created_at'        => now(),
                'updated_at'        => now(),
            ];

            if (Schema::hasColumn('OrderItem', 'ProductName')) {
                $orderItemData['ProductName'] = $productName;
            }

            DB::table('OrderItem')->insert($orderItemData);
        }

        DB::commit();
        
        // Fetch order details for email
        $order = DB::table('Order')->where('OrderID', $orderId)->first();
        $summary = [
            'customer_name' => $order->OrderCustName,
            'email' => $order->OrderEmail,
            'items' => $basket,
            'total_price' => collect($basket)->sum('total_price'),
        ];

        // Send order confirmation email
        $this->sendOrderEmail($order, $summary, $basket);

        session()->forget('basket');
        return redirect()->route('basket.show')->with('success', 'Order placed successfully!');

    } catch (Exception $e) {
        DB::rollBack();
        Log::error('Order Submission Failed:', ['error' => $e->getMessage()]);
        return redirect()->route('basket.show')->with('error', 'Failed to place the order.');
    }
}

private function sendOrderEmail($order, $summary, $basket)
{
    $emailData = [
        'customer' => $order, // Order details
        'summary' => $summary, // Order summary
        'basket' => $basket, // Include basket
    ];

    try {
        Mail::send('emails.order_summary', $emailData, function ($message) use ($order) {
            $message->to($order->OrderEmail)
            ->subject(__('messages.order_summary'));
        });

        Log::info('Order email sent successfully to ' . $order->OrderEmail);
    } catch (Exception $e) {
        Log::error('Failed to send order email', [
            'error' => $e->getMessage(),
            'order_id' => $order->OrderID,
            'email' => $order->OrderEmail,
        ]);
    }
}



}
