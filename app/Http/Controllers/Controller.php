<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\District;
use App\Models\Order_detail;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Province;
use App\Models\Wards;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

abstract class Controller
{
    protected function uploadImg($f, $url, $length = 31)
    {
        $ext = $f->getClientOriginalExtension();
        $imgUrl = Str::random($length - strlen($ext)) . '.' . $ext;
        $f->move($url, $imgUrl);

        return $imgUrl;
    }

    // protected function uploadImage($f, $url, $length = 32)
    // {
    //     // Lấy tên gốc của hình không bao gồm phần mở rộng
    //     $originalName = pathinfo($f->getClientOriginalName(), PATHINFO_FILENAME);
    //     $ext = $f->getClientOriginalExtension();

    //     // Tạo tên mới với tên gốc, thêm đuôi 'web' và giữ phần mở rộng
    //     $imgUrl = Str::slug($originalName, '-')  . $ext;

    //     // Nếu độ dài vượt quá `$length`, cắt bớt tên
    //     if (strlen($imgUrl) > $length) {
    //         $imgUrl = Str::limit(Str::slug($originalName, '-'), $length - strlen($ext) - 5, '') . $ext;
    //     }

    //     // Di chuyển file vào thư mục được chỉ định
    //     $f->move($url, $imgUrl);

    //     return $imgUrl;
    // }


    protected function loadCategories()
    {
        // Đặt thời gian hết hạn cho Cache
        $cacheDuration = 60;

        // Lưu vào Cache * now()->addMinute() lưu theo phút
        return Cache::remember('load_categories', now()->addMinute($cacheDuration), function () {
            $crr = Category::all();
            $arr = [];
            $dict = [];

            foreach ($crr as $v) {
                if ($v->parent == 0) {
                    $arr[] = $v;
                } else {
                    $k = $v->parent;
                    if (!isset($dict[$k])) {
                        $dict[$k] = [];
                    }
                    $dict[$k][] = $v;
                }
            }

            foreach ($crr as $v) {
                if (isset($dict[$v->id])) {
                    $v->children = $dict[$v->id];
                }
            }

            $data = ['crr' => $arr];
            return $data;
        });
    }

    protected function loadProductsByCategoryId(int $parentId)
    {
        $parentCategoryId = $parentId;

        $categories = Category::where('id', $parentCategoryId)
            ->orWhere('parent', $parentCategoryId)
            ->with('children') // Đây là phương thức đệ quy lấy tất cả các con
            ->inRandomOrder()
            ->take(10)
            ->get();

        // Sau đó lấy sản phẩm của từng danh mục
        $products = collect();

        foreach ($categories as $category) {
            $products = $products->merge($category->products);
        }

        return $products;
    }

    protected function autoOrderId()
    {
        $prefix = "GDX";
        $date = date("Ymd");
        $randomString = substr(md5(uniqid(mt_rand(), true)), 0, 5);

        $orderCode = $prefix . $date . $randomString;
        return strtoupper($orderCode);
    }

    protected function CartsData()
    {
        // Lấy hoặc tạo session cart
        $id_session = Session::get('cart', function () {
            $newSessionId = Session::getId();
            Session::put('cart', $newSessionId);
            return $newSessionId;
        });

        // Xác định user ID nếu người dùng đã đăng nhập
        $id_user = Auth::guard('web')->check() ? Auth::guard('web')->user()->id : null;

        // Lấy thông tin giỏ hàng
        $cart = Cart::where('id_session', $id_session)
            ->when($id_user, function ($query, $id_user) {
                return $query->where('id_user', $id_user);
            })
            ->first();

        // Nếu không có giỏ hàng, trả về mảng trống
        if (!$cart) {
            return [];
        }

        // Lấy chi tiết giỏ hàng
        $cartDetails = Cart::join('Cart_Details', 'Cart.id', '=', 'Cart_Details.id_cart')
            ->join('Product', 'Cart_Details.id_product', '=', 'Product.id')
            ->join('Brands', 'Product.brandId', '=', 'Brands.id')
            ->select(
                'Cart.id',
                'Cart_Details.id AS id_details',
                'Product.imageUrl',
                'Product.productName',
                'Brands.brandName',
                'Cart_Details.id_product',
                'Cart_Details.quantity',
                'Cart_Details.price'
            )
            ->where('Cart.id', $cart->id)
            ->get();

        // Trả về dữ liệu giỏ hàng
        return ['cart' => $cartDetails];
    }

    private function updataQuantityProduct($productId, $quantity)
    {
        $product = Product::find($productId);

        // Kiểm tra sản phẩm có tồn tại không
        if (!$product) {
            Log::error("Product not found. ID: {$productId}");
            return false;
        }

        // Kiểm tra số lượng hàng tồn kho
        if ($product->quantity < $quantity) {
            Log::error("Insufficient stock for product ID: {$productId}. Requested: {$quantity}, Available: {$product->quantity}");
            return false;
        }

        //Cập nhật số lượng
        $product->quantity -= $quantity;
        $product->save();

        Log::info("Product ID: {$productId} quantity updated successfully. Remaining stock: {$product->quantity}");

        return true;
    }

    protected function doCheckout($order_id, $note, $order_discount, $total_amount, $payment, $userId, $customerId)
    {
        try {
            // Tạo đơn hàng
            $data_orders = [
                'order_id' => $order_id,
                'note' => $note,
                'order_discount' => $order_discount,
                'total_amount' => $total_amount,
                'payment' => $payment,
                'user_id' => $userId ?: null,
                'customer_id' => $userId ? null : $customerId,
            ];
            $order = Orders::create($data_orders);

            if (!$order) {
                throw new Exception('Failed to create order');
            }

            // Lấy dữ liệu giỏ hàng
            $carts = $this->CartsData();
            $data_order_details = [];

            foreach ($carts['cart'] as $v) {
                $this->updataQuantityProduct($v->id_product, $v->quantity);

                $data_order_details[] = [
                    'order_id' => $order_id,
                    'product_id' => $v->id_product,
                    'quantity' => $v->quantity,
                    'price' => $v->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Thêm chi tiết đơn hàng
            $insert_order_detail = Order_detail::insert($data_order_details);
            if (!$insert_order_detail) {
                throw new Exception('Failed to insert order details');
            }

            // Xóa giỏ hàng
            $deleteCarts = Cart::where('id_session', Session::get('cart'))->delete();
            if ($deleteCarts === false) {
                throw new Exception('Failed to clear cart');
            }

            return $order_id;
        } catch (Exception $e) {
            // Log lỗi
            Log::error('Checkout failed: ' . $e->getMessage());
            return false;
        }
    }

    protected function getAddress($address, $provinceId, $districtId, $wardsId)
    {
        $province = Province::where('province_id', $provinceId)->first();
        $district = District::where('district_id', $districtId)->first();
        $wards = Wards::where('wards_id', $wardsId)->first();

        $result = $address . ' ,' . $wards->name . ' ,' . $district->name . ',' . $province->name;

        return $result;
    }

    protected function totalRevenueByOrders()
    {
        $totalRevenue = Orders::selectRaw('DATE(created_at) as day, SUM(total_amount) as totalRevenue')
            ->where('payment', 1)->groupBy('day')->orderBy('day', 'desc')->get();

        return $totalRevenue;
    }
}
