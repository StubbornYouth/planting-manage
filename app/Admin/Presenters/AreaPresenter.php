<?php
namespace App\Admin\Presenters;

use App\Models\Area;

class AreaPresenter
{
    /**
     * @param $obj
     * @return string
     */
    public function order($obj)
    {
        return '<span class="badge bg-green">' . $obj->order . '</span>';
    }

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