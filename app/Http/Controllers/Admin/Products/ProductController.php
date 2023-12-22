<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

use App\Http\Controllers\Admin\Products\ServiceProduct;

use App\Models\Products\Product;
use App\Models\Products\ProductGallery;
use App\Models\Products\GroupProduct;
use App\Models\Products\ProductOption;
class ProductController extends Controller
{
    const FOLDER_PRODUCT = "products";

    public function index()
    {
        return view('admin.products.product.index');
    }
    public function create()
    {
        $groupproducts = GroupProduct::where('status',1)->orderBy('sort')->get()->toTree();
        $product = new Product();
        $galleries = null;
        $group_tags = null;
        $options = null;
        return view('admin.products.product.create',compact('groupproducts','product','galleries','group_tags','options'));
    }
    public function store(ProductRequest $request)
    {
        $product = new Product;
        $this->saveData($product,$request);
        $product->image = ServiceProduct::saveProductSingle($request,$product);
        $product->created_at = date('Y-m-d H:i:s');
        $product->save();
        $gallery = null;
        ServiceProduct::saveProductGallery($request,$product,$gallery);
        ServiceProduct::saveProductTag($product->id,$request->tags);
        return redirect('admin/product/edit/'.$product->id)->with('success','Thêm thành công !');
    }
    protected function saveData($product,$request)
    {
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->group_product_id = $request->group_product_id;
        $product->code = $request->code;
        $product->warranty = $request->warranty;
        $product->cost = str_replace(".","",$request->cost);
        $product->price = str_replace(".","",$request->price);
        $product->quantity = $request->quantity;
        $product->summary = $request->summary;
        $product->offer = $request->offer;
        $product->specifications = $request->specifications;
        $product->content = $request->content;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->review_video = $request->review_video;
        $product->embed_video = $request->embed_video;
        $product->views = $request->views;
        return $product;
    }
    public function edit($id)
    {
        $groupproducts = GroupProduct::where('status',1)->orderBy('sort')->get()->toTree();
        $product = Product::leftJoin('group_products','group_products.id','=','products.group_product_id')
            ->where('products.id',$id)->select('products.*','group_products.name AS group_product_name')->first();
        $galleries = ProductGallery::where('product_id',$product->id)->get();

        $dataTag = ServiceProduct::getTag($product->group_product_id,$product->id);
        $group_tags = $dataTag['group_tags'];
        $arr_checked_tags = $dataTag['arr_checked_tags'];
        $options = ProductOption::where('product_id',$id)->get();
        return view('admin.products.product.edit',compact('groupproducts','product','galleries','group_tags','arr_checked_tags','options'));
    }
    public function update(ProductRequest $request,$id)
    {
        $product = Product::find($id);
        $product = $this->saveData($product,$request);
        $product->image = ServiceProduct::saveProductSingle($request,$product);
        $product->save();
        $gallery = ProductGallery::where('product_id',$product->id)->orderBy('serial_id','desc')->first();
        ServiceProduct::saveProductGallery($request,$product,$gallery);
        ServiceProduct::saveProductTag($product->id,$request->tags);
        ServiceProduct::saveProductOption($product->id,$request->options);

        return redirect('admin/product/edit/'.$id)->with('success','Chỉnh sửa sản phẩm thành công!');
    }
    public function status(Request $request)
    {
        try {
            $product = Product::find($request->id);
            $product->status = ($request->status == 1) ? 0 : 1;
            $product->save();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function destroy(Request $request)
    {
        try {
            $product = Product::find($request->id);
            ServiceProduct::removeAFile($product->image);
            $galleries = ProductGallery::where('product_id',$product->id);
            foreach ($galleries->get() as $gallery) {
                ServiceProduct::removeAFile($gallery->name);
            }
            $galleries->delete();
            $product->delete();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }

}
