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
    $('#contact-form').validate({rules:{name:{minlength:2,required:true},email:{required:true,email:true},subject:{minlength:2,required:true},message:{minlength:2,required:true}},highlight:function(element){$(element).closest('.form-group').removeClass('success').addClass('error');},success:function(element){element.text('OK!').addClass('valid').closest('.form-group').removeClass('error').addClass('success');}});
});
