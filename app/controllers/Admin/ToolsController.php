<?php

class Admin_ToolsController extends BaseController
{

    private $service = null;


    public function index(){

    }


    public function showPayLink(){
        $default = array(
            'account'   =>  '1519493493',
            'bankName' => '中国农业银行',
            'cardNo'        => '6228481256463971264',
            'cardName'      =>  '石会迁'
        );
        return View::make('admin.tools.payLink.index')->with($default);
    }

    public function doPayLink(){
        $payData = Input::all();
        $rules  = array(
            'price'      => 'required|numeric',
            'payment'   => 'required'
        );
        $message = array(
            'price.required' =>'必须填写支付金额',
            'payment.required' =>'必须选择支付方式'
        );


        // 自定义验证消息
        // 开始验证
        $validator = Validator::make($payData, $rules, $message);
        if ($validator->passes()) {
            $payLink = 'https://shenghuo.alipay.com/transfercore/fill.htm?optEmail=17090025057&payAmount='.floatval($payData['price']).'&title='.$payData['title'];
            // 添加失败
            return Redirect::back()
                ->withInput()
                ->with('success','生成成功：'.$payLink );
        }else {
            // 验证失败
            return Redirect::back()->withInput()->withErrors($validator);
        }

    }

}
