<?php

class IndexController extends BaseController
{

    public function doMessage(){

        //接收数据
        $data = Input::all();


        // 创建验证规则
        $rules = array(
            'email' => 'email|required',
            'qq'    =>  'min:5|max:11|required'
        );

        //错误信息
        $messages = array(
            'email.email'=>'您填写的Email格式不正确',
            'email.required'=>'请填写您的Email',
            'qq.required'=>'请填写您的QQ号',
            'qq.min'     => 'QQ号码格式不正确',
            'qq.max'     => 'QQ号码格式不正确'
        );

        // 开始验证
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->passes()) {
            // 验证成功
           //TODO 放入邮件队列
            // 返回成功信息
            return Response::json(['msg'=>'ok','code'=>1000]);
        } else {
            // 验证失败
            return Response::json(['msg'=>$validator->messages()->first(),'code'=>1001]);

        }

    }


}