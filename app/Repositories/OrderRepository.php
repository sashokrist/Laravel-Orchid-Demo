<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAllOrders()
    {
       // dd(request()->all());
        return Order::all();
    }

    public function getOrderById($orderId)
    {
        return Order::findOrFail($orderId);
    }

    public function deleteOrder($orderId)
    {
        Order::destroy($orderId);
    }

    public function createOrder(array $orderDetails, $client = [], $product_id = [])
    {
       // dd(\request()->all());
        return Order::create([
            'details' => $orderDetails,
            'client' => $client,
            'product_id' => $product_id
        ]);
    }

    public function updateOrder($orderId, array $newDetails)
    {
        return Order::whereId($orderId)->update($newDetails);
    }

    public function getFulfilledOrders()
    {
        return Order::where('is_fulfilled', true);
    }

    /**
     * Get response data
     * @return \Illuminate\Http\JsonResponse
     */
    public function data($key = 'data')
    {
        return response()->json();
    }

    /**
     * Get paginated result data
     *
     * @param string $key       Data key to fetch items from API response, default `data`.
     * @param int $perPage      Number of items per page, default 15.
     * @param int $currentUrlPath  Current page
     * @param array $options    Paginator options
     * @return LengthAwarePaginator
     */
    public function paginate($key = 'data', $perPage = null, $page = null)
    {
        $items = $this->data();
        $items = $items instanceof Collection ? $items : Collection::make($items);
         $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
       // $currentUrlPath = Request::path();
//        $options = array_merge($options, [
//            'path' => substr($currentUrlPath, 15),
//        ]);
        return new LengthAwarePaginator($items,  $perPage = 5, $page);
    }
}
