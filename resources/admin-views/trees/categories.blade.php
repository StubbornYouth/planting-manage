@extends('admin::layouts.main')

@section('content')

    {{--@include('admin::search.trees-areas')--}}

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">分类列表</h3>

                    <div class="btn-group pull-right">
                        <a href="{{ route('admin::categories.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;新增
                        </a>
                    </div>

                    @include('admin::widgets.filter-btn-group', ['resetUrl' => route('admin::categories.index')])
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>简介</th>
                            <th>图片</th>
                            <th>科属</th>
                            <th>排序序号</th>
                            <th>状态</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        @inject('categoryPresenter', "App\Admin\Presenters\CategoryPresenter")
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{!! $categoryPresenter->introduction($category) !!}</td>
                                <td>{!! $categoryPresenter->imageUrl($category) !!}</td>
                                <td>{{ $category->subject }}</td>
                                <td>{!! $categoryPresenter->order($category) !!}</td>
                                <td>{!! $categoryPresenter->status($category) !!}</td>
                                <td>{{ optional($category->created_at)->toDateTimeString() }}</td>
                                <td>
                                    <a href="{{ route('admin::categories.edit', $category->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" data-id="{{ $category->id }}" class="grid-row-delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $categories->links('admin::widgets.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin::js.grid-row-delete', ['url' => route('admin::categories.index')])
    <script>
        $(function (){
            $('.popover-show').popover();
            $('.popover-show').on('click', function () {
                if($(this).text() == '查看'){
                    $(this).html('关闭');
                }
                else {
                    $(this).html('查看');
                }
            })
        });
    </script>
@endsection