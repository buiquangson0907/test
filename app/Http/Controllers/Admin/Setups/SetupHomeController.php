<?php

namespace App\Http\Controllers\Admin\Setups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products\GroupProduct;
use Illuminate\Support\Facades\DB;
class SetupHomeController extends Controller
{
    public function index()
    {
        $parent_id = isset($_GET['parent_id']) ? $_GET['parent_id'] : NULL;
        $groupproducts = GroupProduct::leftJoin('set_home_menu','set_home_menu.group_product_id','=','group_products.id')
            ->withDepth()->where('status',1)->having('depth', '<=', 1)
            ->orderBy('sort_home')->groupBy('id')->get()->toTree();
            return view('admin.setups.setup-home.index',compact('groupproducts','parent_id'));
    }

    public function ajaxMove(Request $request)
    {
        $id = $request->id;
        $result = GroupProduct::descendantsAndSelf($id)->pluck('id')->toArray();
        if (!in_array($request->parent_id, $result))
        {
            $arrId = $request->arr_id;
            foreach ($arrId as $keyid => $sortid) {
                DB::table('set_home_menu')->updateOrInsert(
                    ['group_product_id' => $sortid],
                    ['sort_home' => $keyid,'parent_home_id' => $request->parent_id]
                );
            }
            return response()->json(['success','Di chuyển danh mục thành công']);
        }else{
            return response()->json('error');
        }
    }


    public function status(Request $request)
    {
        try {
            $node = GroupProduct::find($request->id);
            $status_home = ($request->status == 1) ? 0 : 1;

            DB::table('set_home_menu')->updateOrInsert(
                ['group_product_id'=>$request->id],
                ['status_home' => $status_home,'parent_home_id' => $node->parent_id]);
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function destroy(Request $request)
    {
        try {
            DB::table('set_home_menu')->where('group_product_id',$request->id)->update(
                ['status_home' => 0]);
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
}
