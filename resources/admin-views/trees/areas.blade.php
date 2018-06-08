@extends('admin::layouts.main')

@section('content')

    {{--@include('admin::search.items-items')--}}

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">区域列表</h3>

                    <div class="btn-group pull-right">
                        <a href="{{ route('admin::areas.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;新增
                        </a>
                    </div>

                    @include('admin::widgets.filter-btn-group', ['resetUrl' => route('admin::areas.index')])
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>排序序号</th>
                            <th>状态</th>
                            <th>创建时间</th>
                            <th>最近更新时间</th>
                            <th>操作</th>
                        </tr>
                        @inject('areaPresenter', "App\Admin\Presenters\AreaPresenter")
                        @foreach($areas as $area)
                            <tr>
                                <td>{{ $area->id }}</td>
                                <td>{{ $area->name }}</td>
                                <td>{!! $areaPresenter->order($area) !!}</td>
                                <td>{!! $areaPresenter->status($area) !!}</td>
                                <td>{{ optional($area->created_at)->toDateTimeString() }}</td>
                                <td>{{ optional($area->updated_at)->toDateTimeString() }}</td>
                                <td>
                                    <a href="{{ route('admin::areas.edit', $area->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" data-id="{{ $area->id }}" class="grid-row-delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $areas->links('admin::widgets.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin::js.grid-row-delete', ['url' => route('admin::areas.index')])
@endsection