<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    function index(Request $req)
    {
        session(['back_url_category' => request()->fullUrl()]); //lưu url vào session

        $search = $req->search ?? null; // lấy giá trị search

        $crr = Category::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        })->paginate(10)->withQueryString();

        return view('category.index', ['crr' => $crr]);
    }

    function add(Request $req)
    {
        if ($req->isMethod('post')) {
            $data = $req->validate(['parent' => 'required|int', 'name' => 'required|max:64']);

            if ($req->hasFile('f')) {
                $iconUrl = $this->uploadImg($req->file('f'), 'image/category-icon');
                $data['iconUrl'] = $iconUrl;
            }
            $ret = Category::create($data);

            if ($ret) {
                return redirect()->route('category.index')
                    ->with(['success' => 'Thêm danh mục ' . $data['name'] . ' thành công!']);
            }
        }

        $crr = $this->loadCategories();
        return view('category.add', $crr);
    }

    function edit(Request $req, int $id)
    {
        $o = Category::find($id);

        if ($req->isMethod('post')) {
            $data = $req->validate(['name' => 'required|max:64']);
            if ($req->hasFile('f')) {
                File::delete('image/category-icon/' . $o->iconUrl);
                $iconUrl = $this->uploadImg($req->file('f'), 'image/category-icon');
                $data['iconUrl'] = $iconUrl;
            }

            $ret = $o->update($data);
            if ($ret) {
                return redirect(session('back_url_category', route('category.index')))
                    ->with(['success' => 'Cập nhật danh mục ' . $data['name'] . ' thành công!']);
            }
        }

        $data = $this->loadCategories();
        $data['o'] = $o;

        return view('category.edit', $data);
    }
}
