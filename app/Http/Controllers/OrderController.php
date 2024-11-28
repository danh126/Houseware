<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\ProcessShipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    function index(Request $req)
    {
        $search = $req->search ?? null; // lấy giá trị search

        $orders = Orders::leftJoin('Customer', 'Orders.customer_id', '=', 'Customer.customer_id')
            ->leftJoin('Users', 'Orders.user_id', '=', 'Users.id')
            ->join('Process_shipping', 'Orders.status', '=', 'Process_shipping.id')
            ->select(
                'Orders.*',
                'Customer.fullname as customer_fullname',
                'Users.fullname as user_fullname',
                'Process_shipping.name as status_order'
            )
            ->when($search, function ($query, $search) {
                return $query->whereRaw('DATE(Orders.created_at) = :date', ['date' => $search]);
            })
            ->orderBy('Orders.created_at', 'desc')
            ->paginate(10);

        return view('order.index', ['orders' => $orders]);
    }

    function getOrderDetail(Request $req)
    {
        $data = $req->validate(['orderId' => 'required']);

        $orderId = $data['orderId'];

        $orderDetail = Orders::join('Order_detail', 'Orders.order_id', '=', 'Order_detail.order_id')
            ->join('product', 'Order_detail.product_id', '=', 'product.id')
            ->select(
                'Orders.order_id',
                'Orders.order_discount',
                'Orders.total_amount',
                'Orders.status',
                'Orders.note',
                'Orders.payment',
                'product.productName',
                'product.imageUrl',
                'Order_detail.quantity',
                'Order_detail.price'
            )
            ->where('Orders.order_id', $orderId)
            ->get();

        $processShipping = ProcessShipping::all();

        return response()->json([
            'order_detail' => $orderDetail,
            'process_shipping' => $processShipping
        ]);
    }

    function updateStatus(Request $req)
    {
        $data = $req->validate([
            'orderId' => 'required',
            'statusId' => 'required'
        ]);

        $this->updatePayment($data); //cập nhật payment

        $result = Orders::where('order_id', $data['orderId'])->update(['status' => $data['statusId']]);

        if ($result) {
            return response()->json(['update_status' => true]);
        }

        return response()->json(['update_status' => false]);
    }

    private function updatePayment($data)
    {
        $dataUpdate = $data;

        if ($dataUpdate['statusId'] < 5) {
            return;
        }

        //Chỉ cập nhật paymemt khi payment = 0
        Orders::where('order_id', $dataUpdate['orderId'])
            ->where('payment', 0)->update(['payment' => 1]);
    }

    function cancelOrder(Request $req)
    {
        $data = $req->validate(['orderId' => 'required']);

        $result = Orders::where('order_id', $data['orderId'])->delete();

        if ($result) {
            return response()->json(['cancel_order' => true]);
        }

        return response()->json(['cancel_order' => false]);
    }

    function totalRevenue(Request $req)
    {
        $totalRevenue = $this->totalRevenueByOrders();
        return view('order.total-revenue', ['data' => $totalRevenue]);
    }
}
