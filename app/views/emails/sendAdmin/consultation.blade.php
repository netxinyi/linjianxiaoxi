<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>林间小溪-用户咨询邮件</title>
</head>
<body>
<div style="background:#f4f4f4; font-family:'微软雅黑'; padding:30px 0; margin:0;">
    <div style="width:900px; margin:0 auto; background:#fafafa;">
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="900px" style="font-family: '微软雅黑';font-size: 14px;color: #393737;">
            <tbody>
            <tr bgcolor="#35bdbc" height="100">
                <td width="170" align="center"><img src="http://www.linjianxiaoxi.com/static/img/slideshow/logo.jpg"></td>
                <td width="550" style="line-height:30px;" align="center">
                    <span style="font-size:20px; color:#fff;">收到【{{$name}}】在网站上的咨询留言</span><br/>
                <td width="180"></td>
            </tr>
            </tbody>
        </table>
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="860px" style="font-family: '微软雅黑';font-size: 14px;color: #393737;">
            <tbody>
            <tr height="20px"></tr>
            <tr>
                <td width="150" align="center" rowspan="2"><img src="http://www.linjianxiaoxi.com/static/img/head_mail.png"></td>
                <td width="750" style="line-height:30px;font-family:'微软雅黑';font-size:16px;">
                    Hi，亲爱的石双存场长：

                </td>
            </tr>

            <tr>
                <td height="30px" style="color: #000;">{{$content}}</td>
            </tr>

            <tr height="60" ><td colspan="2" style="border-bottom: 1px dashed #ddd;"></td></tr>
            <tr height="20px"></tr>
            <tr>
                <td></td>
                <td height="30px">这是我的联系方式，抓紧时间我吧：</td>
            </tr>
            <tr>
                <td></td>
                <td height="30px">我的邮箱：{{$email}}</td>
            </tr>
            <tr>
                <td></td>
                <td height="30px">我的QQ：{{$qq}}</td>
            </tr>
            <tr height="40"></tr>
            <tr>
                <td></td>
                <td height="30px"><a href="http://www.linjianxiaoxi.com" target="_blank">林间小溪鹦鹉养殖场</a></td>
            </tr>
            <tr>
                <td></td>
                <td height="30px">{{date('Y-m-d H:i:s',time())}}</td>
            </tr>
            <tr height="60"></tr>
            </tbody>
        </table>

    </div>
</div>
</body>
</html>