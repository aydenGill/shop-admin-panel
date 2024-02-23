<?php

namespace App\Http\Controllers\api\v1;

use App\Constants\OrderConstants;
use App\Http\Controllers\Controller;
use App\Traits\BaseApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    use BaseApiResponse;


    public function index(Request $request)
    {
        try {
            $status = OrderConstants::getStatusFromId($request->get('status', 0));
            $orders = auth()->user()->orders()
                ->where('status', $status)
                ->with('products.product', 'address')
                ->get()
                ->map(function ($order) {
                    return [
                        'code' => $order->code,
                        'products' => $order->products->map(function ($product) {
                            return [
                                'title' => $product->product->title,
                                'image' => $product->product->image
                            ];
                        }),
                        'shipping_type' => $order->method,
                        'status' => $order->status,
                        'address' => [
                            "address" => $order->address->address,
                            "city" => $order->address->city,
                            "county" => $order->address->county,
                            "state" => $order->address->state,
                        ],
                        'created_at' => $order->created_at,
                    ];
                });

            return $this->success($orders, 'Order', 'Order list completed');
        } catch (\Exception $e) {
            Log::error('Error retrieving orders: ' . $e->getMessage());
            return $this->error('An error occurred while fetching orders.');
        }
    }
}
