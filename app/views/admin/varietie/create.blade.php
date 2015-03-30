@extends('admin.layouts.master')

@section('title')
    添加鹦鹉
@stop


@section('content')

    @breadCrumb(array('首页'=>route('admin'),'添加品种'=>route('varietie.create')))

    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>添加品种</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                    class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                    class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form role="form">
                        <div class="form-group">
                            <div class="form-group input-group ">
                                <label for="title" class="input-group-addon">名称</label>
                                <input class="form-control" placeholder="请输入品种名" name="title" type="text" id="title">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="features" class="input-group-addon">特性</label>
                                <input class="form-control" placeholder="请输入特性" name="features" type="text" id="features">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default btn-primary center-block">提交</button>
                    </form>
                </div>
            </div>

        </div>

    </div>

@stop
