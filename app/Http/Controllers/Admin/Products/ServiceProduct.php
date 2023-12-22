<?php
namespace App\Http\Controllers\Admin\Products;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Validator;

use App\Models\Products\ProductGallery;
use App\Models\Products\Product;
use App\Models\Products\GroupTag;
use App\Models\Products\GroupProduct;
use App\Models\Products\ProductTag;
use App\Models\Products\ProductOption;
use DB;
// use Str; Str::slug($this->input('name'), '-'),
use Yajra\Datatables\Datatables;
use App\Services\FileService;
use App\Services\DataTableService;
class ServiceProduct {

    const FOLDER_PRODUCT = "products";

    public static function saveProductSingle($request,$product)
    {
        return FileService::saveSingleFile($request,$product,self::FOLDER_PRODUCT);
    }

    public static function saveProductGallery($request,$product,$gallery)
    {
        $serial_id = $gallery ? $gallery->serial_id : -1;
        $galleries = FileService::saveMultipleFile($request,['data' => $product,'serial_id' => $serial_id],self::FOLDER_PRODUCT);
        foreach ($galleries as $key => $item) {
            ProductGallery::create([
                'product_id' => $product->id,
                'serial_id' => $key,
                'name' => $item,
                'type' => 'image'
            ]);
        }
    }

    public function ajaxRemoveGalleryFile(Request $request)
    {
        $id = $request->id;
        $idsub = $request->idsub;
        $gallery = ProductGallery::where([['product_id',$id],['serial_id',$idsub]]);
        FileService::deleteFile($gallery->first()->name);
        $gallery->delete();
        return response()->json(['success','Xoá hình ảnh thành công']);
    }

    public function ajaxRemoveSingleFile(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);
        self::removeAFile($product->image);
        $product->image = NULL;
        $product->save();
        return response()->json(['success','Xoá hình ảnh thành công']);
    }

    public static function removeAFile($image)
    {
        FileService::deleteFile($image);
    }

    public function dataTableProduct() {
        $item = Product::orderBy('products.id','desc');
        $datatables = DataTables::of($item);

        $datatables->editColumn('image', function ($item) {
            return DataTableService::showImage($item->image);
        });
        $datatables->editColumn('status', function ($item) {
            $checked = ($item->status == 1) ? 'checked' : '';
            $status = '<label for="status'.$item->id.'"></lable>'.
            '<input type="checkbox" id="status'.$item->id.'" ' . $checked. ' disabled
            data-toggle="toggle" data-size="xs" data-width="70"
            data-on="Hiện" data-off="Đã ẩn" data-onstyle="warning" data-offstyle="secondary">';

                return '<label class="btn-status" data-id="'.$item->id.'" data-status="'.$item->status.'" for="status'.$item->id.'"></lable>'.
                '<input type="checkbox" id="status'.$item->id.'" ' . $checked. '
                data-toggle="toggle" data-size="xs" data-width="70"
                data-on="Hiện" data-off="Đã ẩn" data-onstyle="primary" data-offstyle="secondary">';

            return $status;
        });
        $datatables->addColumn('action', function ($item) {
            $result = ''; $delete = ''; $preview = '';
                $preview = '<a href="'.$item->slug.'" data-bs-toggle="tooltip" title="Xem hiển thị sản phẩm" class="btn btn-xs" target="_blank">
                        <i class="fa-regular fa-eye"></i>
                    </a>';
                $edit = '<a href="admin/product/edit/'.$item->id.'" data-bs-toggle="tooltip" title="Chỉnh sửa" class="btn btn-xs">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>';
                $delete = '<div data-bs-toggle="tooltip" title="xóa khỏi hệ thống" class="btn btn-xs btn-destroy mx-1" data-id="'.$item->id.'">
                    <i class="fa-solid fa-trash-can"></i>
                </div>';

            $result .= $preview. $edit . $delete;
            return $result;
        });
        $datatables->rawColumns(['name','image','status','action']);
        return $datatables->make();
    }

    public function ajaxValidate(Request $request)
    {
        $rulerequest = new ProductRequest;
        $rules['name'] = $request->name != $request->oldname ? 'required|min:5|max:255|unique:products,name' : 'required|max:255';
        $validator = Validator::make($request->all(), $rules,$rulerequest->messages());
        $array = array();
        if ($validator->fails()) {
            $error = [
                'name' => $validator->errors()->first('name')
            ];
            $array["error"]=$error;
        }else{
            $array["error"]=null;
        }
    	return response()->json($array);
    }

    public static function saveProductTag($product_id,$tags)
    {
        ProductTag::where('product_id',$product_id)->delete();
        if ($tags) {
            foreach ($tags as $item) {
                ProductTag::updateOrCreate([
                    'product_id' => $product_id,
                    'group_tag_id' => $item
                ]);
            }
        }
    }

    public static function saveProductOption($product_id,$options)
    {
        ProductOption::where('product_id',$product_id)->delete();
        if ($options) {
            $sort = 0;
            foreach ($options as $item) {
                if ($item['name'] != null) {
                    ProductOption::updateOrCreate([
                        'product_id' => $product_id,
                        'serial_id' => $sort
                    ],[
                        'name' => $item['name'],
                        'cost' => str_replace(".","",$item['cost']),
                        'price' => str_replace(".","",$item['price'])
                    ]);
                    $sort++;
                }
            }
        }
    }

    public function ajaxGetTag(Request $request)
    {
        $dataTag = self::getTag($request->group_product_id,$request->product_id);
        $group_product = GroupProduct::find($request->group_product_id);
        return response()->json(['group_tags'=>$dataTag['group_tags'],'arr_checked_tags'=>$dataTag['arr_checked_tags'],'group_product'=>$group_product]);
    }
    public static function getTag($group_product_id,$product_id)
    {
        $group_tags = [];
        $arr_checked_tags = [];
        $ancestors = GroupProduct::orderBy('_lft', 'DESC')->ancestorsAndSelf($group_product_id);
        if ($ancestors) {
            foreach ($ancestors as $item) {
                $arrIdAncestor = DB::table('group_product_has_tags')
                    ->where('group_product_id',$item->id)
                    ->pluck('group_tag_id');

                if (count($arrIdAncestor) > 0) {
                    $arrTag = [];
                    foreach ($arrIdAncestor as $ii) {
                        $merge_arr = GroupTag::whereDescendantOrSelf($ii)->pluck('id')->toArray();
                        $arrTag = array_merge($merge_arr,$arrTag);
                    }
                    $group_tags = GroupTag::withDepth()->orderBy('sort')
                        ->whereIn('id', $arrTag)->where('status',1)
                        ->get()->toTree();
                    break;
                }
            }
        }
        if ($product_id) {
            $arr_checked_tags = ProductTag::where('product_id',$product_id)->pluck('group_tag_id')->toArray();
        }
        return ['group_tags'=>$group_tags,'arr_checked_tags'=>$arr_checked_tags];
    }
}
