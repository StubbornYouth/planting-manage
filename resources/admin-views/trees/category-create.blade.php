@extends('admin::layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">创建分类</h3>
                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <a href="{{ route('admin::categories.index') }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i>&nbsp;列表</a>
                        </div> <div class="btn-group pull-right" style="margin-right: 10px">
                            <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;返回</a>
                        </div>
                    </div>
                </div>
                <form id="post-form" class="form-horizontal" action="{{ route('admin::categories.store') }}" method="post" enctype="multipart/form-data" pjax-container>
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="fields-group">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">树木类型名称</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="name" name="name" value="" class="form-control" placeholder="输入 类型名称">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subject" class="col-sm-2 control-label">科目</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="subject" name="subject" value="" class="form-control" placeholder="输入 科目">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="introduction" class="col-sm-2 control-label">简介</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <textarea name="introduction" id="introduction" rows="8" class="form-control" placeholder="输入 简介"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image_url" class="col-sm-2 control-label">图片</label>
                                <div class="col-sm-8">
                                    <input type="file" class="image_url" name="image_url" id="mage_url" accept="image/*">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="order" class="col-sm-2 control-label">排序序号</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" id="order" name="order" value="0" class="form-control order" placeholder="输入 排序序号">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">是否启用</label>
                                <div class="col-sm-8">
                                    <input type="checkbox" class="status la_checkbox" checked/>
                                    <input type="hidden" class="status" name="status" value="1"/>
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

            $(".image_url").fileinput({
                overwriteInitial: false,
                initialPreviewAsData: true,
                browseLabel: "浏览",
                showRemove: false,
                showUpload: false,
                allowedFileTypes: [
                    "image"
                ]
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
                                message: '请输入分类名称'
                            },
                            stringLength:{
                                max: 20,
                                message: '分类名称长度必须在20个字符内'
                            },
                            remote: {
                                url: "{{ route('admin::categories.check') }}" ,
                                message: '该分类已存在',
                                delay: 200,
                                type: 'get'
                            },
                        }
                    },
                    subject:{
                        validators:{
                            notEmpty:{
                                message: '请输入所属科目'
                            },
                            stringLength:{
                                max: 20,
                                message: '科目名称长度必须在20个字符以内'
                            },
                        }
                    },
                    introduction:{
                        validators:{
                            notEmpty:{
                                message: '请输入简介'
                            },
                            stringLength:{
                                max: 500,
                                message: '简介必须在500个字符以内'
                            },
                        }
                    },
                    image_url:{
                        validators:{
                            notEmpty:{
                                message: '请选择图片'
                            }
                        }
                    }
                }
            });

            $("#submit-btn").click(function () {
                var $form = $("#post-form");

                $form.bootstrapValidator('validate');
                if ($form.data('bootstrapValidator').isValid()) {
                    $form.submit();
                }
            })
        });
    </script>
@endsection