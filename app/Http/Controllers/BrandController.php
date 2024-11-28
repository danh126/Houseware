<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    function index(Request $req)
    {
        //Lưu url vào session để trả về đúng url khi xử lý tác vụ
        session(['back_url_brand' => request()->fullUrl()]);

        //Lấy giá trị search
        $search = $req->search ?? null;

        $brands = Brands::when($search, function ($query, $search) {
            return $query->where('brandName', 'like', "%$search%");
        })->paginate(10)->withQueryString();

        $data = ['brands' => $brands];
        return view('brand/index', $data);
    }

    function add(Request $req)
    {
        if ($req->isMethod('post')) {
            $data = $req->validate(['brandName' => 'required']);

            if ($req->hasFile('logo')) {
                $brandLogo = $this->uploadImg($req->file('logo'), 'image/brands');
                $data['brandLogo'] = $brandLogo;
            }

            $result = Brands::create($data);

            if ($result) {
                return redirect()->route('brand.index')
                    ->with(['success' => 'Thêm thương hiệu ' . $data['brandName'] . ' thành công!']);
            }
        }

        return view('brand/add');
    }

    function edit(Request $req, int $id)
    {
        $o = Brands::find($id);

        if ($req->isMethod('post')) {
            $data = $req->validate(['brandName' => 'required']);

            if ($req->has('description')) {
                $data['description'] = $req->input('description');
            }

            if ($req->hasFile('logo')) {
                File::delete('image/brands/' . $o->brandLogo);
                $brandLogo = $this->uploadImg($req->file('logo'), 'image/brands');
                $data['brandLogo'] = $brandLogo;
            }

            $result = $o->update($data);

            if ($result) {
                return redirect(session('back_url_brand', route('brand.index')))
                    ->with(['success' => 'Cập nhật thương hiệu ' . $data['brandName'] . ' thành công!']);
            }
        }

        return view('brand.edit', ['o' => $o]);
    }
}
