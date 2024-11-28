<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ShippingService
{
    // Hàm gọi API tính phí vận chuyển
    public function calculateShipping($data)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('SHIPPING_API_KEY'),
        ])
            ->post(env('SHIPPING_API_URL'), $data);

        if ($response->successful()) {
            return $response->json(); // Trả về kết quả tính phí vận chuyển
        }

        return null; // Hoặc xử lý lỗi nếu cần
    }
}
