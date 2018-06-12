<div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">筛选</h4>
            </div>
            <form action="{{ route('admin::categories.index') }}" method="get" pjax-container>
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group">
                            <div class="form-group">
                                <label>分类名称</label>
                                <input type="text" class="form-control" placeholder="分类名称" name="name" value="{{ request('name') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>状态</label>
                                <select class="form-control" name="status" >
                                    <option value=''>请选择</option>
                                    <option value='0' {{ request('status')=='0'?'selected':'' }} >禁用</option>
                                    <option value='1' {{ request('status')?'selected':'' }} >启用</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary submit">提交</button>
                    <button type="reset" class="btn btn-warning pull-left">撤销</button>
                </div>
            </form>
        </div>
    </div>
</div>
