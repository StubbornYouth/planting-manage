<?php

namespace App\Admin\Controllers\Trees;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;

/**
 * @module 树木管理
 *
 * Class AreaController
 * @package App\Admin\Controllers\Trees
 */

class AreaController extends Controller
{
    /**
     * @permission 树木列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        config(['admin.header'=>'树木管理','admin.description'=>'树木区域']);
        $areas = Area::orderBy('order','desc')->orderBy('created_at','desc')->paginate(10);

        return view('admin::trees.areas',compact('areas'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        config(['admin.header' => '树木区域','admin.description' => '编辑']);
        return view('admin::trees.area-create');
    }

    public function store(Request $request)
    {
        Area::create($request->all());
        return redirect()->route('admin::areas.index');
    }

    public function checkName(String $name)
    {
        $area=Area::where('name',$name)->first();
        if($area) {
            return false;
        }
        return true;
    }
}
