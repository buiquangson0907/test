<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Products\GroupProduct;
use App\Models\Products\Product;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function home()
    {
        $groupproducts = GroupProduct::withDepth()->having('depth', '<=', 1)
            ->leftJoin('set_home_menu','set_home_menu.group_product_id','=','group_products.id')
            ->where('status',1)
            ->where('status_home',1)
            ->orderBy('sort_home','asc')->get()->toTree();
            $menu_products = [];
            foreach ($groupproducts as $groupproduct) {
                $result1 = GroupProduct::descendantsAndSelf($groupproduct->id)->pluck('id')->toArray();
                $result2 = GroupProduct::ancestorsOf($groupproduct->id)->pluck('id')->toArray();
                $group_product_arr = array_merge($result1,$result2);
                $products = DB::table('products')->whereIn('group_product_id',$group_product_arr)->get();
                array_push($menu_products,['groupproducts'=>$groupproduct,'products'=>$products]);
            }
        return view('front.home',compact('menu_products'));
    }
    public function showBySlug($slug)
    {
        $group_products = GroupProduct::where('slug', $slug)->first();

        $product = Product::where('slug', $slug)->first();

        if ($group_products) {
            return view('front.group-product',compact('group_products'));
        } elseif ($product) {
            $product_galleries = DB::table('product_galleries')->where('product_id',$product->id)->get();
            $breadcrumbs = GroupProduct::ancestorsAndSelf($product->group_product_id);
            return view('front.product',compact('product','product_galleries','breadcrumbs'));
        } else {
            abort(404);
        }
    }
    public function buildPC() {
        return view('front.build-pc');
    }
}
