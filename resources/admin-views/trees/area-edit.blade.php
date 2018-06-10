@extends('admin::layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">编辑区域</h3>
                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <a href="{{ route('admin::areas.index') }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i>&nbsp;列表</a>
                        </div> <div class="btn-group pull-right" style="margin-right: 10px">
                            <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;返回</a>
                        </div>
                    </div>
                </div>
                <form id="post-form" class="form-horizontal" action="{{ route('admin::areas.update',$area->id) }}" method="post" enctype="multipart/form-data" pjax-container>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="fields-group">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">区域名称</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="name" name="name" value="{{ $area->name }}" class="form-control" placeholder="输入 区域名称">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="order" class="col-sm-2 control-label">排序序号</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" id="order" name="order" value="{{ $area->order }}" class="form-control order" placeholder="输入 排序序号">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">是否启用</label>
                                <div class="col-sm-8">
                                    <input type="checkbox" class="status la_checkbox" @if($area->status == 1) checked @endif/>
                                    <input type="hidden" class="status" name="status" value="{{ $area->status }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="btn-group pull-left">
                            <button type="reset" class="btn btn-warning">重置</button>
                        </div>
                        <div class="btn-group pull-right">
                            <button type="submit" id="submit-btn" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin'></i> 提交">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            $('.form-history-back').on('click', function (event) {
                event.preventDefault();
                history.back();
            });

            $(".order").bootstrapNumber({
                'upClass': 'success',
                'downClass': 'primary',
                'center': true
            });


            $('.status.la_checkbox').bootstrapSwitch({
                size:'small',
                onText: '启用',
                offText: '禁用',
                onColor: 'primary',
                offColor: 'danger',
                onSwitchChange: function(event, state) {
                    $(event.target).closest('.bootstrap-switch').next().val(state ? '1' : '0').change();
                }
            });

            $("#post-form").bootstrapValidator({
                live: 'enable',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    name:{
                        validators:{
                            notEmpty:{
                                message: '请输入区域名称'
                            },
                            stringLength:{
                                max: 40,
                                message: '区域名称长度必须在40个字符内'
                            },
                            threshold: 1,
                            remote: {
                                url: "{{ route('admin::areas.check') }}" ,
                                message: '该区域已存在',
                                delay: 200,
                                type: 'get',
                                data :{
                                    name: $('#name').val(),
                                    current_name: "{{ $area->name }}"
                                },
                            },
                        }
                    }
                }
            })

            $("#submit-btn").click(function () {
                var $form = $("#post-form");
                var name = $("#name").val();  
                if(name == "{{$area->name}}") {  
                    $('#post-form').bootstrapValidator('enableFieldValidators', 'name', false);  
                } else {  
                    $('#post-form').bootstrapValidator('enableFieldValidators', 'name', true);
                }

                $form.bootstrapValidator('validate');
                if ($form.data('bootstrapValidator').isValid()) {
                    $form.submit();
                }
            })
        });
    </script>
@endsection