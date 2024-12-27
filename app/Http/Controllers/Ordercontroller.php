<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Exception;

class Ordercontroller extends Controller
{
    public function submit(Request $request)
    {
        Log::info('OrderController@submit called.');
    
        // Get the basket from the session
        $basket = session()->get('basket', []);
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
                'OrderOrgName' => $request->input('OrderOrgName'),
                'OrderEmail' => $request->input('OrderEmail'),
                'OrderPhone' => $request->input('OrderPhone'),
                'OrderAddress' => $request->input('OrderAddress'),
                'OrderComment' => $request->input('OrderComment'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Log::info('Order Created:', ['OrderID' => $orderId]);
    
            // Process each product in the basket
            foreach ($basket as $item) {
                // Map components to include their details
                $components = collect($item['components'])->map(function ($component) {
                    $componentID = DB::table('Component')
                        ->where('ComponentName', $component['name'])
                        ->value('ComponentID');
    
                    return [
                        'id' => $componentID,
                        'name' => $component['name'],
                        'value' => $component['value'],
                        'price' => $component['price'],
                    ];
                });
    
                // Insert grouped product and components into `OrderItem`
                DB::table('OrderItem')->insert([
                    'OrderID' => $orderId,
                    'ProductID' => $item['product_id'],
                    'Components' => $components->toJson(), // Store components as JSON
                    'OrderItemQuantity' => $item['quantity'],
                    'OrderItemPrice' => $item['total_price'], // Total price for the product and components
                    'OrderItemCurrency' => 'EUR',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    
            DB::commit();
            session()->forget('basket');
    
            return redirect()->route('basket.show')->with('success', 'Order placed successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Order Submission Failed:', ['error' => $e->getMessage()]);
            return redirect()->route('basket.show')->with('error', 'Failed to place the order.');
        }
    }
    private function sendOrderEmail($order, $summary)
    {
        $emailData = [
            'order' => $order,
            'summary' => $summary,
        ];
    
        try {
            Mail::send('emails.order_summary', $emailData, function ($message) use ($order) {
                $message->to($order->OrderEmail)
                        ->subject('Order Summary');
            });
    
            Log::info('Order email sent successfully to ' . $order->OrderEmail);
        } catch (Exception $e) {
            Log::error('Failed to send order email: ' . $e->getMessage());
        }
    }
    

}
