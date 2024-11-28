<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\ProcessShipping;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function index()
    {
        $data =  $this->loadCategories();
        return view('user.profile', $data);
    }

    function wishList()
    {
        $user_id = Auth::guard('web')->user()->id;
        $getWishList = WishList::join('product', 'wishlist.product_id', '=', 'product.id')
            ->join('brands', 'product.brandId', '=', 'brands.id')
            ->select('wishlist.*', 'product.productName', 'product.imageUrl', 'brands.brandName')
            ->where('wishlist.user_id', $user_id)
            ->get();

        $data = $this->loadCategories() + [
            'wishlist' => $getWishList
        ];

        return view('user.wishlist', $data);
    }

    function orderHistory()
    {
        $user_id = Auth::guard('web')->user()->id;

        $getOrdersByUserId = Orders::join('order_detail', 'orders.order_id', '=', 'order_detail.order_id')
            ->join('process_shipping', 'orders.status', '=', 'process_shipping.id')
            ->join('product', 'order_detail.product_id', '=', 'product.id')
            ->select(
                'orders.order_id',
                'orders.created_at',
                'orders.total_amount',
                'process_shipping.name as status',
                'product.productName',
                'product.imageUrl',
                'order_detail.product_id',
                'order_detail.quantity'
            )
            ->where('orders.user_id', $user_id)
            ->get();

        $data = $this->loadCategories() + [
            'orders' => $getOrdersByUserId
        ];

        return view('user.order-history', $data);
    }

    function orderInformation(string $order_id)
    {
        if ($order_id) {
            $user_id = Auth::guard('web')->user()->id;

            $subTotal = Orders::join('order_detail', 'orders.order_id', '=', 'order_detail.order_id')
                ->where('orders.user_id', $user_id)
                ->where('orders.order_id', $order_id)
                ->sum('order_detail.price');

            $getOrderInformation = Orders::join('order_detail', 'orders.order_id', '=', 'order_detail.order_id')
                ->join('product', 'order_detail.product_id', '=', 'product.id')
                ->join('brands', 'product.brandId', '=', 'brands.id')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->select(
                    'orders.order_id',
                    'orders.created_at',
                    'orders.order_discount',
                    'orders.total_amount',
                    'orders.status',
                    'product.productName',
                    'product.imageUrl',
                    'brands.brandName',
                    'order_detail.quantity',
                    'order_detail.price',
                    'users.address',
                )
                ->where('orders.user_id', $user_id)
                ->where('orders.order_id', $order_id)
                ->get();

            $data = $this->loadCategories() + [
                'o' => $getOrderInformation,
                'subTotal' => $subTotal,
            ];

            return view('user.order-information', $data);
        }

        return redirect('/');
    }
}
