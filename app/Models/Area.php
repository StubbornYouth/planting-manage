<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;

    protected $table = "tree_area";
    protected $fillable = ['name','order'];
    protected $dates = ['delete_at'];
}
