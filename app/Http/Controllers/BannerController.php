<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    function index()
    {
        $banner = Banner::paginate(5);
        return view('banner.index', ['banner' => $banner]);
    }

    public function add(Request $req)
    {
        if ($req->isMethod('post')) {
            return $this->handleBannerCreation($req);
        }

        return view('banner.add');
    }

    protected function handleBannerCreation(Request $req)
    {
        $data = $req->validate(['banner_type' => 'required']);

        $files = $req->file('image_url');
        $files = is_array($files) ? $files : [$files];

        foreach ($files as $file) {
            $image_url = $this->uploadImg($file, 'image/banner');
            Banner::create([
                'image_url' => $image_url,
                'banner_type' => $data['banner_type']
            ]);
        }

        return redirect()->route('banner.add')
            ->with(['success' => 'Thêm quảng cáo thành công!']);
    }
}
