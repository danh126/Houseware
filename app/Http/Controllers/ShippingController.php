<?php

namespace App\Http\Controllers;

use App\Services\ShippingService;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    protected $shippingService;

    public function __construct(ShippingService $shippingService)
    {
        $this->shippingService = $shippingService;
    }

    public function getShippingCost(Request $req)
    {
        $data = [
            // "from_district_id" => 1454,
            // "from_ward_code" => "21211",
            "service_id" => 53320, // gói dịch vụ vận chuyển
            "service_type_id" => null, // 1: Express, 2: Standard, 3: Saving
            "to_district_id" => $req->district_id, // Quận / Huyện người nhận
            "to_ward_code" => "$req->ward_id", // Phường / Xã người nhận
            "height" => 50, // chiều cao gói hàng (cm)
            "length" => 20, // chiều dài gói hàng (cm)
            "weight" => 200, // trọng lượng hàng hóa (gram)
            "width" => 20, // chiều rộng gói hàng (cm)
            "insurance_value" => $req->total_amount, // giá sản phẩm
            "coupon" =>  null
        ];

        $result = $this->shippingService->calculateShipping($data);

        if ($result) {
            return response()->json($result);
        }

        return response()->json(['getShipping' => $result]);
    }
}
