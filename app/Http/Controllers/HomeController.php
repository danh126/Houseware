<?php

namespace App\Http\Controllers;

use App\Events\UserSessionChange;
use App\Models\Brands;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Banner;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    private function updateUserIdByCarts()
    {
        if (Auth::guard('web')->check()) {
            $userId = Auth::guard('web')->user()->id;
            $sessionCartId = Session::get('cart');

            Cart::where('id_session', $sessionCartId)
                ->update(['id_user' => $userId]);
        }
    }

    public function index()
    {
        $this->updateUserIdByCarts(); //cập nhật giỏ hàng khi user login

        $cacheDuration = 10; // đặt thời gian hết hạn cache

        $cacheKey = 'load_data_index';
        $data = Cache::get($cacheKey); //Lấy data từ Cache

        if (!$data) {
            $categoriesIds = [9, 10, 12, 7, 39];
            $listProducts = [];

            foreach ($categoriesIds as $id) {
                $listProducts["listProducts{$id}"] = $this->loadProductsByCategoryId($id);
            }

            //Get banner
            $allBanners = Banner::whereIn('banner_type', [1, 2, 3, 4, 5])->get()->groupBy('banner_type');

            $data = $this->loadCategories() + [
                'itemRandom' => Product::inRandomOrder()->take(1)->first(),
                'productsHot' => Product::inRandomOrder()->take(20)->get(),
                'brands' => Brands::all(),
                'banner_top' => $allBanners->get(1, collect()),
                'banner_hot_1' => $allBanners->get(2, collect())->take(3),
                'banner_hot_2' => $allBanners->get(3, collect())->take(3),
                'banner_sale_1' => $allBanners->get(4, collect())->take(1),
                'banner_sale_2' => $allBanners->get(5, collect())->take(1),
                'categories' => Category::where('parent', '<>', 0)
                    ->whereHas('parent', function ($query) {
                        $query->where('parent', '<>', 0);
                    })
                    ->where('id', '<', 40)
                    ->inRandomOrder()
                    ->take(10)
                    ->get(),
            ] + $listProducts;

            // Lưu $data vào Cache
            Cache::put($cacheKey, $data, now()->addMinutes($cacheDuration));
        }

        return view('home.index', $data);
    }

    public function quickview($id)
    {
        $o = Product::with('brand')->find($id);
        // $brand = Brands::where('id', $o->brandId)->first();
        $imageProduct = ImageProduct::where('productId', $o->id)->get();

        return view('home.quickview', ['o' => $o, 'img' => $imageProduct]);
    }

    public function detail($id)
    {
        $o = Product::find($id);
        $brand = Brands::where('id', $o->brandId)->first();
        $category = Category::where('id', $o->categoryId)->first();
        $imageProduct = ImageProduct::where('productId', $o->id)->get();

        $attr = Attribute::leftJoin('ProductAttribute', 'attribute.id', '=', 'ProductAttribute.attributeId')
            ->select('Attribute.*', 'ProductAttribute.name AS value')
            ->where('ProductAttribute.productId', '=', $o->id)->get();

        $relatedProducts = Product::where('categoryId', $o->categoryId)
            ->where('id', '!=', $o->id)->inRandomOrder()->limit(10)->get();

        $data = $this->loadCategories() + [
            'o' => $o,
            'brand' => $brand,
            'arr' => $relatedProducts,
            'img' => $imageProduct,
            'category' => $category,
            'attr' => $attr
        ];

        return view('home.details', $data);
    }

    public function subCategory($id, Request $req)
    {
        $subCategory = Category::findOrFail($id);
        $parent = Category::where('id', $subCategory->parent)->first();
        $groupSubCategories = Category::where('parent', $parent->id)->get();

        //lấy key cần lọc và chuyển thành mảng nếu key có nhiều giá trị
        $bid = request('bid') ? explode(',', request('bid')) : [];

        $page = $req->get('page') ?? 1;

        $cacheTime = 10;

        $key_subCategory = 'sub_category_id_' . $id . '_bid_' . implode('_', $bid) . '_page_' . $page;

        $data = Cache::get($key_subCategory);

        if (!$data) {
            $data = $this->getDataSubCategory($id, $bid, $subCategory, $parent, $groupSubCategories);
            Cache::put($key_subCategory, $data, now()->addMinute($cacheTime)); // lưu cache
        }

        return view('home.categories', $data);
    }

    private function getDataSubCategory($id, $bid, $subCategory, $parent, $groupSubCategories)
    {
        //Lấy sản phẩm thuộc sub category
        $arr = Product::where('categoryId', $id)
            ->when($bid, function ($query, $bid) {
                return $query->whereIn('brandId', $bid); //dùng whereIn để so sánh 1 cột vs nhiều giá trị
            })->inRandomOrder()->paginate(6)->withQueryString();

        //Lấy sản phảm mới
        $latestProduct = Product::inRandomOrder()->limit(4)->get();

        //Lấy thương hiệu thuộc product.categoryId
        $brands = Product::join('brands', 'product.brandId', '=', 'brands.id')
            ->select('brands.*')
            ->selectRaw('COUNT(brands.id) as Total')
            ->where('product.categoryId', $id)
            ->groupBy('brands.id', 'brands.brandName')
            ->get();

        //Gộp dữ liểu trả về views
        $data = $this->loadCategories() + [
            'sub' => $subCategory,
            'parent' => $parent,
            'groupSub' => $groupSubCategories,
            'arr' => $arr,
            'latestProduct' => $latestProduct,
            'brands' => $brands
        ];

        return $data;
    }

    public function search(Request $req)
    {
        if (!empty($req->search)) {
            $page = $req->get('page', 1); //lấy số trang

            $search = $req->search;

            $cid = $req->cid ? explode(',', $req->cid) : [];
            $bid = $req->bid ? explode(',', $req->bid) : [];

            $cacheTime = 15;

            $key_products_search = 'products_search_' . $search
                . '_cid_' . implode('_', $cid)
                . '_bid_' . implode('_', $bid)
                . '_page_' . $page;

            $data = Cache::get($key_products_search);

            if (!$data) {
                $data =  $this->getDataSearch($search, $cid, $bid);
                Cache::put($key_products_search, $data, now()->addMinute($cacheTime));
            }

            return view('home.search', $data);
        }

        return redirect('/');
    }

    private function getDataSearch($search, $cid, $bid)
    {
        //Lấy sản phẩm từ kết quả tìm kiếm
        $products = Product::search($search)
            ->when($cid, function ($query, $cid) {
                return $query->whereIn('categoryId', $cid);
            })
            ->when($bid, function ($query, $bid) {
                return $query->whereIn('brandId', $bid);
            })
            ->paginate(18)->withQueryString();

        //Lấy sản phảm mới
        $latestProduct = Product::inRandomOrder()->limit(4)->get();

        $data = $this->loadCategories() +  [
            'products' => $products,
            'latestProduct' => $latestProduct,
            'search' => $search
        ];

        return $data;
    }

    public function loadDataCategorieSearch(Request $req)
    {
        $data = $req->validate(['search' => 'required', 'page' => 'required|int']);

        if (!$data) {
            return response()->json(['load_data_categories_search' => 'failed']);
        }

        $req->get($data['page'], 1); // lấy số trang client truyền vào defaut = 1

        //Lấy danh mục tương ứng vói sản phẩm từ kết quả tìm kiếm
        $categories = Product::join('category', 'product.categoryId', '=', 'category.id')
            ->select('category.*')
            ->selectRaw('COUNT(category.id) as Total')
            ->search($data['search'])
            ->groupBy('category.id', 'category.name')
            ->paginate(5);

        return response()->json([
            'load_data_categories_search' => 'success',
            'categories' => $categories,
        ]);
    }

    public function loadDataBrandsSearch(Request $req)
    {
        $data = $req->validate(['search' => 'required', 'page' => 'required|int']);

        if (!$data) {
            return response()->json(['load_data_brands_search' => 'failed']);
        }

        $perPage = 5; // mỗi trang hiển thị 5 sản phẩm

        //Lấy thương hiệu tương ứng vói sản phẩm từ kết quả tìm kiếm
        $brands = Product::join('brands', 'product.brandId', '=', 'brands.id')
            ->select('brands.*')
            ->selectRaw('COUNT(brands.id) as Total')
            ->search($data['search'])
            ->groupBy('brands.id', 'brands.brandName')
            ->skip(($data['page'] - 1) * $perPage) // tính toán phân trang thủ công (skip -> loại bỏ)
            ->take($perPage)
            ->get();

        return response()->json([
            'load_data_brands_search' => 'success',
            'brands' => $brands
        ]);
    }

    public function searchSuggestions(Request $req)
    {
        $data = $req->validate(['q' => 'required']);

        if (!$data) {
            return response()->json(['search_suggestions' => 'failed', 'query' => null]);
        }

        $query = $data['q'];
        $products = Product::search($query)->take(10)->get();

        if (!$products) {
            return response()->json(['search_suggestions' => 'failed', 'products' => null]);
        }

        return response()->json(['search_suggestions' => 'success', 'products' => $products]);
    }

    public function contact()
    {
        $data = $this->loadCategories();
        return view('home.contact', $data);
    }
}
