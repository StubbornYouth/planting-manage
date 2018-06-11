<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'tree_categories';
    protected $fillable = ['name','introduction','subject','image_url','order','status'];
    protected $dates = ['delete_at'];

}
