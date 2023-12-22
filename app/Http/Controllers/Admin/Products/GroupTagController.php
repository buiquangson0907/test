<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products\GroupTag;
use Str;
class GroupTagController extends Controller
{
    public function index()
    {
        $parent_id = isset($_GET['parent_id']) ? $_GET['parent_id'] : NULL;
        $grouptags = GroupTag::withDepth()->orderBy('sort')->get()->toTree();
        return view('admin.products.group-tag.index',compact('grouptags','parent_id'));
    }
    public function ajaxList(Request $request)
    {
        $grouptags = GroupTag::withDepth()->having('depth', '<=', 0)->orderBy('sort')->where('status',1)->get()->toTree();
        $parent_id = $request->parent_id;
        $id = $request->id;
        $grouptag = GroupTag::find($id);
        $name = $grouptag ? $grouptag->name : '';
        $grouped = [
            'id' => $id,
            'parent_id' => $parent_id,
            'name' => $name,
        ];
        return response()->json([$grouptags,$grouped]);
    }
    public function saveData(Request $request)
    {
        if ($request->id) {
            $id = $request->id;
            $result = GroupTag::descendantsAndSelf($id)->pluck('id')->toArray();
            if (!in_array($request->parent_id, $result))
            {
                $node = GroupTag::find($id);
                $node->name = $request->name;
                $node->slug = Str::slug($request->name, '-');
                $node->parent_id = $request->parent_id;
                $node->status = ($request->status == 'on') ? 1 : 0;
                $node->save();
                return redirect('admin/group-tag')->with('success','Sửa thành công !');
            }else{
                return redirect()->back()->with('error','Không được ghép vào danh mục nhỏ cấp hơn');
            }
        } else {
            $node = new GroupTag();
            $node->name = $request->name;
            $node->slug = Str::slug($request->name, '-');
            $node->parent_id = $request->parent_id;
            $node->status = ($request->status == 'on') ? 1 : 0;
            $node->save();
            return redirect('admin/group-tag')->with('success','Thêm thành công !');
        }
    }
    public function ajaxMove(Request $request)
    {
        $id = $request->id;
        $result = GroupTag::descendantsAndSelf($id)->pluck('id')->toArray();
        if (!in_array($request->parent_id, $result))
        {
            // save parent
            $node = GroupTag::find($id);
            $node->parent_id = $request->parent_id;
            $node->save();
            // update sort
            $arrId = $request->arr_id;
            foreach ($arrId as $keyid => $sortid) {
                GroupTag::where('id', $sortid)->update(['sort' => $keyid]);
            }
            return response()->json(['success','Di chuyển danh mục thành công']);
        }else{
            return response()->json('error');
        }
    }

    public function status(Request $request)
    {
        try {
            $node = GroupTag::find($request->id);
            $node->status = ($request->status == 1) ? 0 : 1;
            $node->save();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function destroy(Request $request)
    {
        try {
            $node = GroupTag::find($request->id);
            if ($node->status == 0) {
                $node->delete();
            }
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
}
