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
     * @permission 区域列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        config(['admin.header'=>'树木管理','admin.description'=>'树木区域']);

        $data=$this->screening_conditions(request());
        $areas = Area::orderBy('order','desc')->orderBy('created_at','desc')->where($data)->paginate(10);

        return view('admin::trees.areas',compact('areas'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        config(['admin.header' => '树木区域','admin.description' => '创建']);
        return view('admin::trees.area-create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Area::create($request->all());
        return redirect()->route('admin::areas.index');
    }

    /**
     * @param Area $area
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Area $area)
    {
        config(['admin.header' => '树木区域','admin.description' => '编辑']);
        return view('admin::trees.area-edit', compact('area'));
    }

    /**
     * @param Request $request
     * @param Area $area
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Area $area)
    {
        $area->update($request->all());
        return redirect()->route('admin::areas.index');
    }

    /**
     * @param Area $area
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Area $area)
    {
        $area->delete();
        return response()->json(['status' => 1, 'message' => '成功']);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function checkName(Request $request)
    {
        if($request->get('current_name')) {
            if($request->get('current_name') == $request->get('name')) {
                return '{"valid":true}'; 
            }
        }

        $area = Area::where('name',$request->get('name'))->first();
        if($area) {
            return '{"valid":false}';
        }
        return '{"valid":true}';

    }

    /**
     * @param $request
     * @return array
     */
    protected function screening_conditions($request)
    {
        $data=[];
        if($request->get('name')) {
            $data[] = ['name','like','%'.$request->get('name').'%'];
        }
        if($request->get('status') != '') {
            $data[] = ['status','=',$request->get('status')];
        }

        return $data;
    }
}
