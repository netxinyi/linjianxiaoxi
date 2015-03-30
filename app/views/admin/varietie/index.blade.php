@extends('admin.layouts.master')

@section('title')
    首页
@stop
@section('css')
    @parent
    <link href="/assets/admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@stop

@section('content')
    @breadCrumb(array('首页'=>'/','鹦鹉列表'=>route('product.index')))
    <div class="row">

        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>品种列表</h2>

                    <div class="box-icon">
                        <a href="{{route('varietie.create')}}" class="btn btn-round btn-default"><i
                                    class="glyphicon glyphicon-plus"></i></a>
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                    class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                    class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>名称{{ order_by('name') }}</th>
                            <th>特性</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $key => $varietie)

                            <tr>
                                <td>{{$key + 1}}</td>
                                <td class="center">{{$varietie->name}}</td>
                                <td class="center">{{$varietie->features}}</td>


                                <td class="center">
                                    <span class="label-success label label-default">Active</span>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-9 center-block">
                            {{ pagination($datas->appends(Input::except('page'))) }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@stop

@section('js_footer')
    @parent
    <script type="text/javascript" src="/assets/admin/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">

    </script>
@stop
