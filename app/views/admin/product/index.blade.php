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
        <div class="box col-md-4">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>搜索</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                    class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                    class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form role="form">
                        <div class="form-group has-feedback ">
                            {{Form::label('keyword','关键词：')}}
                            {{Form::text('keyword',Input::get('keyword'),['class'=>'form-control','placeholder'=>'输入标题或编码搜索'])}}

                            <i class="glyphicon glyphicon-search form-control-feedback" id="keywordSearchButton"></i>

                        </div>
                        <div class="form-group">
                            {{ Form::label('varietieId', '品种：') }}
                            {{ Form::select('varietieId',  $varieties,  Input::get('varietieId',0), ['class' => 'form-control']) }}
                        </div>
                        <div class="">
                            {{Form::label('priceLt','价格：')}}
                        </div>
                        <div class="input-group form-group">

                            {{ Form::label('priceLt', '从', ['class'=>'input-group-addon']) }}
                            {{Form::text('priceLt',Input::get('priceLt'),['class'=>'form-control'])}}

                            {{ Form::label('priceGt', '到', ['class'=>'input-group-addon']) }}

                            {{Form::text('priceGt',Input::get('priceGt'),['class'=>'form-control'])}}

                        </div>
                        <div class="">
                            {{Form::label('ageLt','年龄：')}}
                        </div>
                        <div class="input-group form-group">



                            {{Form::selectRange('ageY',0,10,Input::get('ageY',0),['class'=>'form-control'])}}
                            {{ Form::label('ageY', '年', ['class'=>'input-group-addon']) }}


                            {{Form::selectRange('ageM',0,12,Input::get('ageM',0),['class'=>'form-control'])}}
                            {{ Form::label('ageM', '月', ['class'=>'input-group-addon']) }}



                            {{Form::selectRange('ageD',0,31,Input::get('ageD',0),['class'=>'form-control'])}}
                            {{ Form::label('ageD', '天', ['class'=>'input-group-addon']) }}

                        </div>

                        <button type="submit" class="btn btn-default btn-block btn-primary">搜索</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="box col-md-8">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>鹦鹉列表</h2>

                    <div class="box-icon">
                        <a href="{{route('product.create')}}" class="btn btn-round btn-default"><i
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
                            <th>编号</th>
                            <th>标题{{ order_by('title') }}</th>
                            <th>价格{{ order_by('price') }}</th>
                            <th>品种{{ order_by('varietieId')}}</th>
                            <th>年龄{{ order_by('birthday') }}</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $key => $product)

                            <tr>
                                <td>{{$key + 1}}</td>
                                <td class="center">{{$product->code}}</td>
                                <td class="center">{{$product->title}}</td>
                                <td class="center">{{$product->price}}</td>
                                <td class="center">{{$product->varietie->name}}</td>
                                <td class="center">{{$product->date_to_age($product->birthday)}}</td>

                                <td class="center">
                                    <a class="btn  btn-success btn-xs" href="{{route('product.index')}}">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </a>
                                    <a class="btn btn-warning btn-xs" href="{{route('product.edit',$product->id)}}">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <a class="btn btn-danger btn-xs" href="#" data-method="delete" data-url="{{route('product.destroy',array($product->id,'_token'=>csrf_token()))}}" data-befor="confirm('您确定要删除吗？')">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
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
@stop

@section('common_footer')
    @parent

@stop