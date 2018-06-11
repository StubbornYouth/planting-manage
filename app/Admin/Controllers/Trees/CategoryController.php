<?php

namespace App\Admin\Controllers\Trees;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

/**
 * @module 树木管理
 *
 * Class CategoryController
 * @package App\Admin\Controllers\Trees
 */
class CategoryController extends Controller
{
    /**
     * @permission 分类列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        config(['admin.header'=>'树木管理','admin.description'=>'树木分类']);

        //$data=$this->screening_conditions(request());
        $categories = Category::orderBy('order','desc')->orderBy('created_at','desc')->paginate(10);

        return view('admin::trees.categories',compact('categories'));
    }

    public function create()
    {
        config(['admin.header'=>'树木分类','admin.description'=>'创建']);
        return view('admin::trees.category-create');
    }

    public function store(Request $request){
        $path = $request->file('image_url')->store('covers','public');
        $category = new Category();
        $category->name = $request->name;
        $category->subject = $request->subject;
        $category->introduction = $request->introduction;
        $category->order = $request->order;
        $category->status = $request->status;
        $category->image_url = $path;
        $category->save();
        return redirect()->route('admin::categories.index');
    }

    public function edit(Category $category){

    }

    public function checkName(Request $request)
    {
        if($request->get('current_name')) {
            if($request->get('current_name') == $request->get('name')) {
                return '{"valid":true}';
            }
        }

        $area = Category::where('name',$request->get('name'))->first();
        if($area) {
            return '{"valid":false}';
        }
        return '{"valid":true}';

    }
}
