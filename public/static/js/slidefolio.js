define(function(require, exports, module){
    var $ = require('jquery');
    require('jqVegas');
    require('jqValidate');
    require('jqMixitup');
    require('jqScrollToFixed');
    require('bootstrap');


    $.vegas('slideshow', {
        delay: 5000,
        backgrounds: [
            {src: '/static/img/slideshow/yingwu1.jpg', fade: 2000},
            {src: '/static/img/slideshow/yingwu5.jpg', fade: 2000},
            {src: '/static/img/slideshow/yingwu1.jpg', fade: 2000},
            {src: '/static/img/slideshow/yingwu2.jpg', fade: 2000},
            {src: '/static/img/slideshow/yingwu3.jpg', fade: 2000},
            {src: '/static/img/slideshow/yingwu4.jpg', fade: 2000},
            {src: '/static/img/slideshow/forest.jpg', fade: 2000}
        ]
    })('overlay', {
        src: '/static/img/slideshow/overlay.png'
    });
    $('#nav').scrollToFixed();
    $('a[href*=#]:not([href=#])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
            || location.hostname == this.hostname) {

            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
    $('#Grid').mixitup();
    $('#contact-form').validate({
        rules: {
            name: {
                minlength: 2,
                required: true
            },
            email: {
                required: true,
                email: true
            },
            qq: {
                minlength: 5,
                maxlength:11,
                required: true
            },
            message: {
                minlength: 10,
                required: true
            }
        },
        messages:{
            name:{
                required:'请填写您的姓名',
                minlength:"您填写的姓名格式不正确"
            },
            email:{
                required:"请填写您的邮箱",
                email:"您填写的邮箱格式不正确"
            },
            qq:{
                required:"请输入您的QQ号",
                minlength:"QQ号最少为5位数",
                maxlength:"QQ号最大为11位"
            },
            message:{
                required:"请填写留言内容",
                minlength:"留言内容最少填写10个字"
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('success').addClass('error');
        },
        success: function(element) {
            element.text('OK!').addClass('valid').closest('.form-group').removeClass('error').addClass('success');
        }
    });
});
