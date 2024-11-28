<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class VnPayController extends Controller
{
    private function doCheckoutCustomer($checkout_information)
    {
        $data = $checkout_information;

        $data['address'] = $this->getAddress(
            $data['address'],
            $data['province_id'],
            $data['district_id'],
            $data['wards_id']
        );

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
            $data['customer_id'],
        );

        return $result;
    }

    private function doCheckoutUser($checkout_information)
    {
        $data = $checkout_information;

        if (!empty($data['province_id']) && !empty($data['district_id']) && !empty($data['wards_id'])) {
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
            ''
        );

        return $result;
    }

    public function createPayment(Request $request)
    {
        if ($request->isMethod('post') && Session::has('cart')) {
            //Lưu thông tin checkout vào session
            $data = $request->all(); // lấy tất cả thông tin từ request
            $data['order_id'] = $this->autoOrderId(); // tạo id đơn hàng

            session(['checkout_information' =>  $data]); // lưu vào session

            // Lấy thông tin config: 
            $vnp_TmnCode = config('vnpay.vnp_TmnCode');
            $vnp_HashSecret = config('vnpay.vnp_HashSecret');
            $vnp_Url = config('vnpay.vnp_Url');
            $vnp_ReturnUrl = config('vnpay.vnp_Returnurl');

            // Lấy thông tin từ đơn hàng phục vụ thanh toán 
            // Dưới đây là thông tin giả định, bạn có thể lấy thông tin đơn hàng của bạn  để thay thế
            $order = (object)[
                "code" => $data['order_id'],  // Mã đơn hàng
                "total" => $request->total_amount, // Số tiền cần thanh toán (VND)
                // "bankCode" => 'NCB',   // Mã ngân hàng
                "type" => "billpayment", // Loại đơn hàng
                "info" => "Gia Dụng Xanh" // Thông tin đơn hàng
            ];

            // Thông tin đơn hàng, thanh toán
            $vnp_TxnRef = $order->code;
            $vnp_OrderInfo = $order->info;
            $vnp_OrderType =  $order->type;
            $vnp_Amount = $order->total * 100;
            $vnp_Locale = 'vn';
            // $vnp_BankCode = $order->bankCode;  // Mã ngân hàng
            $vnp_IpAddr = $request->ip(); // Địa chỉ IP

            // Tạo input data để gửi sang VNPay server
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_ReturnUrl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            // Sắp xếp mảng dữ liệu input theo thứ tự bảng chữ cái của key
            ksort($inputData);

            $query = ""; // Biến lưu trữ chuỗi truy vấn (query string)
            $i = 0; // Biến đếm để kiểm tra lần đầu tiên
            $hashdata = ""; // Biến lưu trữ dữ liệu để tạo mã băm (hash data)

            // Duyệt qua từng phần tử trong mảng dữ liệu input
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    // Nếu không phải lần đầu tiên, thêm ký tự '&' trước mỗi cặp key=value
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    // Nếu là lần đầu tiên, không thêm ký tự '&'
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1; // Đánh dấu đã qua lần đầu tiên
                }
                // Xây dựng chuỗi truy vấn
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            // Gán chuỗi truy vấn vào URL của VNPay
            $vnp_Url = $vnp_Url . "?" . $query;

            // Kiểm tra nếu chuỗi bí mật hash secret đã được thiết lập
            if (isset($vnp_HashSecret)) {
                // Tạo mã băm bảo mật (Secure Hash) bằng cách sử dụng thuật toán SHA-512 với hash secret
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                // Thêm mã băm bảo mật vào URL để đảm bảo tính toàn vẹn của dữ liệu
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }

            // return redirect($vnp_Url);
            return response()->json(['url_payment' => $vnp_Url]);
        }

        return redirect('/');
    }

    private function validateHash($inputData)
    {
        // Sắp xếp dữ liệu theo thứ tự bảng chữ cái
        ksort($inputData);
        $hashData = "";

        // Tạo chuỗi hash từ dữ liệu đầu vào
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $hashData = rtrim($hashData, '&'); // Loại bỏ ký tự '&' cuối
        return hash_hmac('sha512', $hashData, config('vnpay.vnp_HashSecret')); // Tính hash
    }

    private function clearCheckoutSession()
    {
        // Xóa thông tin thanh toán trong session
        session()->forget('checkout_information');
    }

    private function preparePaymentData($inputData)
    {
        // Chuẩn bị dữ liệu để gửi tới giao diện
        return $this->loadCategories() + [
            'orderId' => $inputData['vnp_TxnRef'] ?? null, // Mã đơn hàng
            'total_amount' => $inputData['total_amount'] ?? null // Tổng số tiền
        ];
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_SecureHash = $request->vnp_SecureHash;

        // Kiểm tra xem mã bảo mật có tồn tại không
        if (empty($vnp_SecureHash)) {
            return redirect('/')->withErrors(['error' => 'Mã bảo mật không tồn tại.']);
        }

        // Lấy tất cả dữ liệu từ request và loại bỏ vnp_SecureHash
        $inputData = $request->all();
        unset($inputData['vnp_SecureHash']);

        // Tính toán mã hash từ dữ liệu nhận được
        $secureHash = $this->validateHash($inputData);

        // Kiểm tra tính hợp lệ của mã bảo mật
        if ($secureHash !== $vnp_SecureHash) {
            Log::warning('VNPay secure hash mismatch', ['inputData' => $inputData]);
            $this->clearCheckoutSession();
            return view('payment.payment_failed', $this->preparePaymentData($inputData));
        }

        // Kiểm tra mã phản hồi từ VNPay
        if ($request->vnp_ResponseCode == '00') {
            // Lấy thông tin thanh toán từ session
            $checkout_information = session('checkout_information');
            $checkout_information['payment'] = 1; //thêm trạng thái đã thanh toán

            $inputData['total_amount'] = $checkout_information['total_amount']; //thêm tổng tiền 

            if (!$checkout_information) {
                return redirect('/')->withErrors(['error' => 'Không tìm thấy thông tin thanh toán.']);
            }

            // Xử lý khi khách hàng chưa đăng nhập
            if (!Auth::guard('web')->check()) {
                $this->doCheckoutCustomer($checkout_information);
            } else {
                // Xử lý khi khách hàng đã đăng nhập
                $this->doCheckoutUser($checkout_information);
            }

            $this->clearCheckoutSession();
            return view('payment.payment_success', $this->preparePaymentData($inputData));
        }

        // Trường hợp thanh toán không thành công hoặc hủy thanh toán
        $this->clearCheckoutSession();
        return view('payment.payment_failed', $this->preparePaymentData($inputData));
    }
}
