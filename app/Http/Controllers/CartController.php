<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_Details;
use App\Models\Customer;
use App\Models\District;
use App\Models\Order_detail;
use App\Models\Orders;
use App\Models\Province;
use App\Models\User;
use App\Models\Wards;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartController extends Controller
{
    function getCartsData(Request $req)
    {
        if ($req->isMethod('post')) {
            $data = $this->CartsData();
            $items = [];
            $subTotal = 0;

            if (!empty($data)) {
                $items = $data['cart'];
                foreach ($items as  $i) {
                    $subTotal += $i['price'] * $i['quantity'];
                }
            }

            return response()->json([
                'items' => $items,
                'subTotal' => $subTotal
            ]);
        }
    }

    function index()
    {
        $data = $this->loadCategories() + $this->CartsData();
        return view('home.cart', $data);
    }

    function add(Request $req)
    {
        if ($req->isMethod('post')) {
            $data = $req->validate([
                'id_product' => 'required',
                'quantity' => 'required',
                'price' => 'required'
            ]);

            $id_product = $data['id_product'];
            $quantity = $data['quantity'];
            $price = $data['price'];

            $id_session = Session::has('cart') ? Session::get('cart', Session::getId()) : Session::put('cart', Session::getId());

            //Check User Login
            if (Auth::guard('web')->check()) {
                $id_user = Auth::guard('web')->user()->id;
                $cart = Cart::firstOrCreate(
                    ['id_session' => $id_session],
                    ['id' => Str::random(32), 'id_user' => $id_user, 'id_session' => $id_session]
                );

                //Update Id_User
                if ($cart) {
                    $cart->id_user = $id_user;
                    $cart->save();
                }
            } else {
                $cart = Cart::firstOrCreate(
                    ['id_session' => $id_session],
                    ['id' => Str::random(32), 'id_session' => $id_session]
                );
            }

            //Create Cart Details By Cart Id
            $cartDetails = Cart_Details::where('id_cart', $cart->id)
                ->where('id_product', $id_product)
                ->first();

            if ($cartDetails) {
                $cartDetails->quantity += $quantity;
                $cartDetails->save();
            } else {
                Cart_Details::create([
                    'id' => Str::random(32),
                    'id_cart' => $cart->id,
                    'id_product' => $id_product,
                    'quantity' => $quantity,
                    'price' => $price
                ]);
            }

            return response()->json(['addCart' => true]);
        }

        return response()->json(['addCart' => false]);
    }

    function delete(Request $req)
    {
        if ($req->isMethod('post') && Session::has('cart')) {
            $data = $req->validate(['id_product' => 'required']);

            $cart = Cart::where('id_session', Session::get('cart'))->first();

            $cartDetails = Cart_Details::where('id_cart', $cart->id)
                ->where('id_product', $data['id_product'])->first();

            $result = $cartDetails->delete();

            if ($result) {
                return response()->json(['deleteCart' => true]);
            }

            return response()->json(['deleteCart' => false]);
        }
    }

    function updateQuantity(Request $req)
    {
        if ($req->isMethod('post') && Session::has('cart')) {
            $data = $req->validate([
                'id_product' => 'required',
                'quantity' => 'required|int'
            ]);

            $cart = Cart::where('id_session', Session::get('cart'))->first();

            $cartDetails = Cart_Details::where('id_cart', $cart->id)
                ->where('id_product', $data['id_product'])->first();

            $cartDetails->quantity = $data['quantity'];
            $result = $cartDetails->save();

            if ($result) {
                return response()->json(['updateCart' => true]);
            }

            return response()->json(['updateCart' => false]);
        }
    }

    function checkout()
    {
        if (Session::has('cart')) {
            $user = '';

            if (Auth::guard('web')->check()) {
                $user = User::where('id', Auth::guard('web')->user()->id)
                    ->select('fullname', 'email', 'phone', 'address')->first();
            }

            $data = $this->loadCategories() + $this->CartsData() + [
                'province' => Province::all(),
                'user' => $user
            ];

            return view('home.checkout', $data);
        }
    }

    function doCheckoutCustomer(Request $req)
    {
        if (Session::has('cart') && $req->isMethod('post')) {
            $data = $req->validate([
                'fullname' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'province_id' => 'required',
                'district_id' => 'required',
                'wards_id' => 'required',
                'order_discount' => 'required',
                'total_amount' => 'required',
            ]);

            $data['address'] = $this->getAddress(
                $data['address'],
                $data['province_id'],
                $data['district_id'],
                $data['wards_id']
            );

            $data['note'] = $req->note;
            $data['order_id'] = $this->autoOrderId();
            $data['payment'] = 0; //thêm trạng thái chưa thanh toán


            $data_customer = [
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address']
            ];

            $checkCustomer = Customer::where('email', $data_customer['email'])
                ->where('phone', $data_customer['phone'])->first();

            if ($checkCustomer) {
                $data['customer_id'] = $checkCustomer->customer_id;
            } else {
                $insertCustomer = Customer::create($data_customer);
                $data['customer_id'] = $insertCustomer->id;
            }

            $result = $this->doCheckout(
                $data['order_id'],
                $data['note'],
                $data['order_discount'],
                $data['total_amount'],
                $data['payment'],
                '',
                $data['customer_id']
            );

            if ($result) {
                return response()->json(['checkout' => true, 'orderId' => $result]);
            }

            return response()->json(['checkout' => false]);
        }
    }

    function doCheckoutUser(Request $req)
    {
        if (Session::has('cart') && $req->isMethod('post') && Auth::guard('web')->check()) {
            $data = $req->validate([
                'fullname' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'order_discount' => 'required',
                'total_amount' => 'required',
            ]);

            $data['note'] = $req->note;
            $data['order_id'] = $this->autoOrderId();
            $data['payment'] = 0; //thêm trạng thái chưa thanh toán

            if ($req->has('province_id') && $req->has('district_id') && $req->has('wards_id')) {
                $data += $req->validate([
                    'province_id' => 'required',
                    'district_id' => 'required',
                    'wards_id' => 'required'
                ]);

                $data['address'] = $this->getAddress(
                    $data['address'],
                    $data['province_id'],
                    $data['district_id'],
                    $data['wards_id']
                );
            }

            $data['user_id'] = Auth::guard('web')->user()->id;
            $user = User::find($data['user_id']);

            if ($user) {
                $user->fullname = $user->fullname ?: $data['fullname'];
                $user->phone = $user->phone ?: $data['phone'];
                $user->address = $user->address ?: $data['address'];
                $user->save();
            }

            $result = $this->doCheckout(
                $data['order_id'],
                $data['note'],
                $data['order_discount'],
                $data['total_amount'],
                $data['payment'],
                $data['user_id'],
                '',
            );

            if ($result) {
                return response()->json(['checkout' => true, 'orderId' => $result]);
            }

            return response()->json(['checkout' => false]);
        }
    }

    function checkMark(string $orderId)
    {
        if (!empty($orderId)) {
            $data = $this->loadCategories() + ['orderId' => $orderId];
            return view('home.checkmark', $data);
        }

        return redirect('/');
    }

    function districts(Request $req)
    {
        if ($req->isMethod('post')) {
            $data = $req->validate(['province_id' => 'required']);

            $districts = District::where('province_id', $data['province_id'])->get();

            return response()->json(['districts' => $districts]);
        }
    }

    function wards(Request $req)
    {
        if ($req->isMethod('post')) {
            $data = $req->validate(['district_id' => 'required']);

            $wards = Wards::where('district_id', $data['district_id'])->get();

            return response()->json(['wards' => $wards]);
        }
    }
}
