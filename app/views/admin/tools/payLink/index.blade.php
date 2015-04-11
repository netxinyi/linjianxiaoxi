@extends('admin.layouts.master')

@section('title')
支付链接生成
@stop


@section('content')
@breadCrumb(array('首页'=>route('admin'),'工具'=>route('tools.index'),'支付链接'=>'tools.payLink'))
    <div class="row">
           <div class="box col-md-12">
               <div class="box-inner">
                   <div class="box-header well" data-original-title="">
                       <h2><i class="glyphicon glyphicon-edit"></i> 生成收款链接</h2>

                       <div class="box-icon">
                           <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                       class="glyphicon glyphicon-chevron-up"></i></a>
                           <a href="#" class="btn btn-close btn-round btn-default"><i
                                       class="glyphicon glyphicon-remove"></i></a>
                       </div>

                   </div>

                   <div class="box-content ">
                       {{ Form::open( ['route'=>['tools.payLink']]) }}
                       <input type="hidden" name="payment" value="alipay">
                        <ul class="nav nav-tabs" id="myTab">
                               <li class="active"><a href="#payLink-alipay" data-payment="alipay">支付宝收款</a></li>
                               <li><a href="#payLink-bankCard"   data-payment="bankCard">银行卡收款</a></li>
                        </ul>
                         <br>
                       <div id="myTabContent" class="tab-content col-md-8">
                          @include('admin.common.notice')
                           <div class="tab-pane active " id="payLink-alipay" >

                                    <div class="form-group input-group">
                                       {{ Form::label('account', '收款账号', ['class'=>'input-group-addon']) }}
                                       {{ Form::text('account',Form::old('account',$account),['class'=>'form-control']) }}
                                   </div>
                                   <div class="form-group input-group">
                                       {{ Form::label('price', '价格', ['class'=>'input-group-addon']) }}
                                       {{ Form::text('price',Form::old('price'),['class'=>'form-control','placeholder'=>'请输入价格，两位小数']) }}
                                       {{ Form::label('price', '元', ['class'=>'input-group-addon']) }}
                                   </div>
                                   <div class="form-group input-group">
                                       {{ Form::label('title', '收款说明', ['class'=>'input-group-addon']) }}
                                       {{ Form::text('title',Form::old('title'),['class'=>'form-control','placeholder'=>'请输入收款说明']) }}
                                   </div>


                           </div>
                           <div class="tab-pane" id="payLink-bankCard">
                                <div class="form-group input-group">
                                {{ Form::label('bankName', '开户银行', ['class'=>'input-group-addon']) }}
                                {{ Form::text('bankName',Form::old('bankName'),['class'=>'form-control','placeholder'=>$bankName]) }}
                                </div>
                                <div class="form-group input-group">
                                {{ Form::label('cardNo', '银行卡号', ['class'=>'input-group-addon']) }}
                                {{ Form::text('cardNo',Form::old('cardNo',$cardNo),['class'=>'form-control']) }}
                                </div>
                                <div class="form-group input-group">
                                {{ Form::label('cardName', '开户人', ['class'=>'input-group-addon']) }}
                                {{ Form::text('cardName',Form::old('cardName',$cardName),['class'=>'form-control']) }}
                                </div>
                              <div class="form-group input-group">
                                 {{ Form::label('price', '价格', ['class'=>'input-group-addon']) }}
                                 {{ Form::text('price',Form::old('price'),['class'=>'form-control','placeholder'=>'请输入价格，两位小数']) }}
                                 {{ Form::label('price', '元', ['class'=>'input-group-addon']) }}

                             </div>
                             <div class="form-group input-group">
                                 {{ Form::label('title', '收款说明', ['class'=>'input-group-addon']) }}
                                 {{ Form::text('title',Form::old('title'),['class'=>'form-control','placeholder'=>'请输入收款说明']) }}
                             </div>
                               <br>
                           </div>

                       </div>
                           <br>
                       <div class="form-group col-md-8 input-group">
                           {{ Form::submit('提交',['class'=>'btn btn-success']) }}
                       </div>
                       {{ Form::close() }}

                   </div>

               </div>
           </div>
           <!--/span-->

       </div>
    <script type="text/javascript">
            $('#myTab li a[href]').click(function(){
                    var payment = $(this).data('payment');
                    $('input:hidden[name="payment"]').val(payment);
            });
    </script>

@stop
