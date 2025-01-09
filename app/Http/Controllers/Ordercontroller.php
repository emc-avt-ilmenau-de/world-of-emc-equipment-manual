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
                $components = collect($item['components'])->map(function ($component) use ($locale) {
                    $componentName = $component['name'] ?? 'Unnamed Component';
                    $componentValueName = $component['value'] ?? 'No Value Provided';
                    $componentID = null;

                    // ✅ Check if 'value_id' exists and fetch it correctly
                    if (!empty($component['value_id'])) {
                        $componentModel = DB::table('Component')->where('ComponentID', $component['component_id'])->first();
                        $componentValueModel = DB::table('ComponentValue')->where('ComponentValueID', $component['value_id'])->first();

                        // ✅ Fetch the component name
                        if ($componentModel) {
                            $decodedComponentName = json_decode($componentModel->ComponentName, true);
                            $componentName = $decodedComponentName[$locale]['ComponentName'] 
                                            ?? $decodedComponentName['en']['ComponentName'] 
                                            ?? 'Unnamed Component';
                        }

                        // ✅ Fetch the component value
                        if ($componentValueModel) {
                            $decodedValueName = json_decode($componentValueModel->ComponentValueName, true);
                            $componentValueName = $decodedValueName[$locale]['ComponentValueName'] 
                                                ?? $decodedValueName['en']['ComponentValueName'] 
                                                ?? 'Unnamed Value';
                        }
                    }

                    // ✅ Handle 'name' and 'value' directly from the component if available
                    elseif (isset($component['name'])) {
                        $decodedName = json_decode($component['name'], true);
                        $componentName = $decodedName[$locale]['ComponentName'] 
                                        ?? $decodedName['en']['ComponentName'] 
                                        ?? $component['name'];
                    }

                    return [
                        'id' => $component['component_id'] ?? null,
                        'name' => $componentName,
                        'value' => $componentValueName,
                        'price' => $component['price'] ?? 0,
                    ];
                });

                // Insert grouped product and components into `OrderItem`
                DB::table('OrderItem')->insert([
                    'OrderID' => $orderId,
                    'ProductID' => $item['product_id'],
                    'Components' => $components->toJson(),
                    'OrderItemQuantity' => $item['quantity'],
                    'OrderItemPrice' => $item['total_price'],
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
