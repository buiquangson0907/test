<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
class GroupTag extends Model
{
    use HasFactory;
    use NodeTrait;
    public $timestamps = false;
}
