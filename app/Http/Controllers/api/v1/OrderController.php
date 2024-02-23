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

    public function index()
    {
        try {
            $ordersActive = $this->getOrdersByStatus(OrderConstants::ACTIVE);
            $ordersSuccess = $this->getOrdersByStatus(OrderConstants::SUCCESS);
            $ordersFail = $this->getOrdersByStatus(OrderConstants::FAILED);

            return $this->success([
                'active' => $ordersActive,
                'success' => $ordersSuccess,
                'fail' => $ordersFail
            ], 'Order', 'Order list completed');
        } catch (\Exception $e) {
            Log::error('Error retrieving orders: ' . $e->getMessage());
            return $this->error('An error occurred while fetching orders.');
        }
    }

    protected function getOrdersByStatus($status)
    {
        return auth()->user()->orders()
            ->where('status', $status)
            ->with('products.product', 'address')
            ->get()
            ->map(function ($order) {
                return [
                    'code' => $order->code,
                    'products' => $this->mapProducts($order->products),
                    'shipping_type' => $order->method,
                    'status' => OrderConstants::getStatusFromString($order->status),
                    'address' => $this->mapAddress($order->address),
                    'created_at' => $order->created_at,
                ];
            });
    }

    protected function mapProducts($products)
    {
        return $products->map(function ($product) {
            return [
                'title' => $product->product->title,
                'image' => $product->product->image
            ];
        });
    }

    protected function mapAddress($address)
    {
        return [
            "address" => $address->address,
            "city" => $address->city,
            "county" => $address->county,
            "state" => $address->state,
        ];
    }
}
