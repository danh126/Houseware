<?php

namespace App\Http\Controllers;

use App\Events\UserSessionChange;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    function google()
    {
        return Socialite::driver('google')->redirect();
    }

    function googleSignIn()
    {
        $user = Socialite::driver('google')->user();

        $passwordRandom = Str::random(32);

        $obj = User::updateOrCreate(['id' => $user->id], [
            'id' => $user->id,
            'user_name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'password' => $passwordRandom
        ]);

        if ($obj) {
            $data = ['email' => $user->email, 'password' => $passwordRandom];
            return $this->checkLoginWithGoogle($data);
        }

        return redirect('/tai-khoan/dang-nhap');
    }

    private function checkLoginWithGoogle($data)
    {
        if (Auth::attempt($data)) {
            return redirect('/');
        }

        return redirect('/tai-khoan/dang-nhap');
    }

    function index()
    {
        $data = $this->loadCategories();
        return view('auth.index', $data);
    }

    function loginAdmin(Request $req)
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/manage');
        }

        if (!$req->isMethod('post')) {
            return view('admin.login');
        }

        // Xác thực dữ liệu đầu vào
        $data = $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Tìm quản trị viên bằng email
        $admin = User::where('email', $data['email'])->where('role', 1)->first();

        // Kiểm tra email
        if (!$admin) {
            return response()->json([
                'check_email_admin' => false
            ]);
        }

        // Kiểm tra mật khẩu
        if (!Hash::check($data['password'], $admin->password)) {
            return response()->json([
                'check_password_admin' => false
            ]);
        }

        // Đăng nhập nếu tất cả đều hợp lệ
        Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']]);

        return response()->json([
            'admin_login' => true
        ]);
    }

    function register(Request $req)
    {
        $data = $req->validate([
            'user_name' => 'required|max:32',
            'email' => 'required',
            'password' => 'required'
        ]);

        $data['id'] = Str::random(32);

        $email = $data['email'];

        $checkEmail = DB::select(
            'SELECT email FROM Users WHERE email = :eml',
            ['eml' => $email]
        );

        if (!$checkEmail) {
            User::create($data);
            return response()->json(['register' => true]);
        }

        return response()->json(['register' => false]);
    }

    function login(Request $req)
    {
        $data = $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $data['email'];
        $password = $data['password'];

        $checkEmail = DB::select(
            'SELECT email, password FROM Users WHERE email = :eml AND Role = 0',
            ['eml' => $email]
        );

        if (!empty($checkEmail)) {
            $checkPass = Hash::check($password, $checkEmail[0]->password);
            if ($checkPass) {
                Auth::guard('web')->attempt($data);
                broadcast(new UserSessionChange('Xin chào', 1));
                return response()->json(['login_success' => true]);
            }
            return response()->json(['check_pass' => false]);
        }

        return response()->json(['check_email' => false]);
    }

    function logoutUser()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }

    function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    function forgot(Request $req)
    {
        if ($req->isMethod('post')) {
            $data = $req->validate(['email' => 'required']);

            $email = $data['email'];

            $checkEmail = DB::select(
                'SELECT email FROM Users WHERE email = :eml',
                ['eml' => $email]
            );

            if (!empty($checkEmail)) {
                return response()->json(['check_email_forgot' => true, 'email' => $email]);
            }

            return response()->json(['check_email_forgot' => false]);
        }

        $data = $this->loadCategories();
        return view('auth.forgot', $data);
    }

    function resetPassword(Request $req)
    {
        $data = $req->validate(['email' => 'required', 'password' => 'required']);

        $user = User::where('email', $data['email'])->first();

        if (!empty($user)) {
            $user->update(['password' => bcrypt($data['password'])]);
            return response()->json(['reset_password' => true]);
        }

        return redirect('/tai-khoan/dang-nhap');
    }
}
