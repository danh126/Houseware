<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    function add(Request $req)
    {
        if (!Auth::guard('web')->check()) {
            return response()->json(['login' => false]);
        }

        $data = $req->validate([
            'product_id' => 'required',
            'price' => 'required'
        ]);

        $data['user_id'] = Auth::guard('web')->user()->id;

        $checkWishList = WishList::where('user_id', $data['user_id'])
            ->where('product_id', $data['product_id'])->first();

        if ($checkWishList) {
            return response()->json(['checkWishList' => true]);
        }

        $insertWishList = WishList::create($data);
        if ($insertWishList) {
            return response()->json(['addWishList' => true]);
        }

        return response()->json(['addWishList' => false]);
    }

    function delete(Request $req)
    {
        $data = $req->validate(['product_id' => 'required']);
        $data['user_id'] = Auth::guard('web')->user()->id;

        $reuslt = WishList::where('user_id', $data['user_id'])
            ->where('product_id', $data['product_id'])->delete();

        if ($reuslt) {
            return response()->json(['deleteWishList' => true]);
        }

        return response()->json(['deleteWishList' => false]);
    }
}
