<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products\GroupProduct;
use App\Models\Products\GroupTag;
use DB;
class GroupProductTagController extends Controller
{
    public function index($id)
    {
        $groupproducts = GroupProduct::withDepth()->having('depth', '<=', 1)->where('status',1)->orderBy('sort')->get()->toTree();
        $hasTag = DB::table('group_product_has_tags')->where('group_product_id',$id)->pluck("group_tag_id")->toArray();
        $grouptags = GroupTag::withDepth()->where('status',1)->orderBy('sort')->get()->toTree();
        return view('admin.products.group-product.tag.index',compact('groupproducts','grouptags','hasTag','id'));
    }

    public function saveData(Request $request)
    {
        DB::table('group_product_has_tags')->where('group_product_id',$request->id)->delete();
        if ($request->group_tag_id) {
            foreach ($request->group_tag_id as $item) {
                DB::table('group_product_has_tags')->updateOrInsert(
                    ['group_product_id' => $request->id, 'group_tag_id' => $item]
                );
            }
        }

        return redirect()->back()->with('success','Gắn thẻ thành công !');
    }
}
