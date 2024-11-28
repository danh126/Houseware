<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    function index()
    {
        $data = ['coupon' => Coupon::all()];
        return view('coupon.index', $data);
    }

    function add(Request $req)
    {
        if ($req->isMethod('post')) {
            $data = $req->validate([
                'code_coupon' => 'required',
                'coupon_apply' => 'required'
            ], [
                'code_coupon.required' => 'Mã giảm giá là bắt buộc.',
                'coupon_apply.required' => 'Tỷ lệ giảm giá là bắt buộc.'
            ]);

            $result = Coupon::create($data);

            if ($result) {
                return redirect('/manage/coupon');
            }
        }

        return view('coupon.add');
    }

    function edit(Request $req, int $id)
    {
        $o = Coupon::find($id);
        if ($req->isMethod('post')) {
            $data = $req->validate([
                'code_coupon' => 'required|max:9',
                'coupon_apply' => 'required'
            ], [
                'code_coupon.required' => 'Mã giảm giá là bắt buộc.',
                'code_coupon.max' => 'Mã giảm giá không được vượt quá 9 ký tự.',
                'coupon_apply.required' => 'Tỷ lệ giảm giá là bắt buộc.'
            ]);

            $result = $o->update($data);

            if ($result) {
                return redirect('/manage/coupon');
            }
        }

        return view('coupon.edit', ['o' => $o]);
    }

    function checkCodeCoupon(Request $req)
    {
        $data = $req->validate(['code_coupon' => 'required']);
        $codeCoupon = $data['code_coupon'];

        $couponCheck = Coupon::whereRaw('BINARY code_coupon = :code', ['code' => $codeCoupon])->first();

        if (!empty($couponCheck)) {
            $couponApply = $couponCheck->coupon_apply;
            return response()->json(['checkCoupon' => true, 'coupon_apply' => $couponApply]);
        }

        return response()->json(['checkCoupon' => false]);
    }
}
