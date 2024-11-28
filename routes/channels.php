<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('user', function () {
    return true;
});


// Broadcast::channel('user.{user_id}', function ($user_id) {
//     // if (Auth::guard('web')->check()) {
//     //     // Lấy thông tin người dùng đã đăng nhập
//     //     $user = Auth::guard('web')->user();

//     //     // So sánh ID người dùng với {user_id}
//     //     return $user->id === $user_id;
//     // }

//     // // Không đăng nhập -> từ chối quyền truy cập
//     return true;
// });
