<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Products\Product;
use Illuminate\Support\Facades\DB;
class ServiceController extends Controller
{
    public function ajaxTooltip($id)
    {
        $data = Product::find($id);
        return response()->json($data);
    }
}
