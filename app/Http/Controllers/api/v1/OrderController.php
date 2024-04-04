<?php

namespace App\Http\Controllers\api\v1;

use App\Constants\OrderConstants;
use App\Http\Controllers\Controller;
use App\Traits\BaseApiResponse;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    use BaseApiResponse;

    public function index()
    {
        try {
            $orders = $this->getOrdersByStatus();

            return $this->success($orders, 'Order', 'Order list completed');
        } catch (\Exception $e) {
            Log::error('Error retrieving orders: '.$e->getMessage());

            return $this->failed(null, 'Error', 'An error occurred while fetching orders.');
        }
    }

    protected function getOrdersByStatus()
    {
        return auth()->user()->orders()
            ->with('products.product', 'address')
            ->get()
            ->map(function ($order) {
                return [
                    'code' => $order->code,
                    'products' => $this->mapProducts($order->products),
                    'shipping_type' => $this->convertShippingType($order->method),
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
                'title' => $product?->product?->title,
                'image' => $product?->product?->image,
                'price' => $product?->product?->price,
            ];
        });
    }

    protected function mapAddress($address)
    {
        return [
            'address' => $address->address,
            'city' => $address->city,
            'county' => $address->county,
            'state' => $address->state,
        ];
    }

    protected function convertShippingType($type)
    {
        switch ($type) {
            case 'economy':
                return 0;
            case 'regular':
                return 1;
            case 'cargo':
                return 2;
            case 'express':
                return 3;
            default:
                return 0;
        }
    }
}
