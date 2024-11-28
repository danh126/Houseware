<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Brands;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    function index(Request $req)
    {
        // Lưu lại URL hiện tại vào session để quay lại sau khi xử lý tác vụ
        session(['previous_url' => request()->fullUrl()]);

        //Lấy giá trị nếu có request search
        $search = $req->search ?? null;

        $crr = Category::all();
        $brr = Brands::all();

        $products = Product::when($search, function ($query, $search) {
            return $query->where('productName', 'like', "%$search%");
        })->paginate(10)->withQueryString();

        return view('product.index', [
            'products' => $products,
            'crr' => $crr,
            'brr' => $brr
        ]);
    }

    public function add(Request $req)
    {
        if ($req->isMethod('post')) {
            $data = $req->validate([
                'brandId' => 'required',
                'categoryId' => 'required',
                'productName' => 'required',
                'description' => 'required',
                'quantity' => 'required',
                'price' => 'required'
            ]);

            if ($req->hasFile('f')) {
                $data['imageUrl'] = $this->uploadImg($req->file('f'), 'image/product');
            }

            $product = Product::create($data);

            if ($product) {
                $this->createProductAttributes($product->id, $req->ids, $req->values);
                $this->createImageProducts($product->id, $req->file('imageProduct'));

                return redirect()->route('product.index')
                    ->with(['success' => 'Thêm sản phẩm thành công!']);
            }

            return redirect()->route('product.add')
                ->withErrors(['product_add' => 'Đã xảy ra lỗi!']);
        }

        $data =  $this->loadCategories() + [
            'brr' => Brands::all(),
            'attr' => Attribute::all()
        ];

        return view('product.add', $data);
    }

    private function createProductAttributes($productId, $ids, $values)
    {
        if (empty($ids) || empty($values)) {
            return;
        }

        $attributes = array_map(function ($id, $value) use ($productId) {
            return [
                'productId' => $productId,
                'attributeId' => $id,
                'name' => $value
            ];
        }, $ids, $values);

        ProductAttribute::insert($attributes);
    }

    private function createImageProducts($productId, $imageFiles)
    {
        if (empty($imageFiles)) {
            return;
        }

        $images = array_map(function ($file) use ($productId) {
            return [
                'productId' => $productId,
                'imageUrl' => $this->uploadImg($file, 'image/product')
            ];
        }, $imageFiles);

        ImageProduct::insert($images);
    }

    function edit(int $id)
    {
        $o = Product::find($id);

        $attr = Attribute::leftJoin('ProductAttribute', 'attribute.id', '=', 'ProductAttribute.attributeId')
            ->select('Attribute.*', 'ProductAttribute.name AS value')
            ->where('ProductAttribute.productId', '=', $o->id)->get();

        $data = $this->loadCategories() + [
            'brr' => Brands::all(),
            'attr' => $attr,
            'images' => ImageProduct::where('productId', '=', $o->id)->get(),
            'o' => $o,
        ];

        return view('product.edit', $data);
    }

    function doEdit(Request $req)
    {
        if (!$req->isMethod('post')) {
            return  redirect('/manage/product');
        }

        $product = Product::findOrFail($req->id);

        $data = $req->validate([
            'brandId' => 'required',
            'categoryId' => 'required',
            'productName' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'imageUrl' => 'required'
        ]);

        //Xử lý cập nhật ảnh chính
        if ($req->hasFile('f')) {
            File::delete('image/product/' . $product->imageUrl);
            $imageUrl = $this->uploadImg($req->file('f'), 'image/product');
            $data['imageUrl'] = $imageUrl;
        }

        if (!$product->update($data)) {
            return redirect()->route('product.edit')
                ->withErrors(['product_edit' => 'Cập nhật sản phẩm thất bại!']);
        }

        //Cập nhật thuộc tính sản phẩm
        $this->updateProductAttribute($req, $product->id);

        //Tạo mới ảnh sản phẩm
        $this->createImageProducts($product->id, $req->file('imageProduct'));

        //Redirect và trang bắt đầu khi click cập nhật
        return redirect(session('previous_url', route('product.index')))
            ->with(['success' => 'Cập nhật sản phẩm ' . $data['productName'] . ' thành công!']);
    }

    private function updateProductAttribute(Request $req, $productId)
    {
        if ($req->has('ids') && $req->has('values')) {
            $attributes = array_map(null, $req->ids, $req->values);

            foreach ($attributes as [$attributeId, $value]) {
                ProductAttribute::updateOrCreate(
                    ['productId' => $productId, 'attributeId' => $attributeId],
                    ['name' => $value]
                );
            }
        }
    }
}
