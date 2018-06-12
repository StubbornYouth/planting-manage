<?php
namespace App\Admin\Presenters;

use App\Models\Area;
use Illuminate\Support\Facades\Storage;

class CategoryPresenter
{
    public function introduction($obj)
    {
        $lable= '<button type="button" class="btn btn-link btn-sm popover-show" title="分类简介" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="'.$obj->introduction.'">查看</button>';
        return $lable;
    }

    public function imageUrl($obj)
    {
        return '<button type="button" class="btn btn-link btn-sm show-image" data-toggle="modal" data-target="#myModal" data-img="'.Storage::url($obj->image_url).'">预览</button>';
    }

    /**
     * @param $obj
     * @return string
     */
    public function order($obj)
    {
        return '<span class="badge bg-green">' . $obj->order . '</span>';
    }

    /**
     * @param $obj
     * @return string
     */
    public function status($obj)
    {
        $label = '<span class="label label-warning">错误</span>';

        if ($obj->status == 1) {
            $label = '<span class="label label-primary">启用</span>';
        }

        if ($obj->status == 0) {
            $label = '<span class="label label-danger">禁用</span>';
        }

        return $label;
    }
}