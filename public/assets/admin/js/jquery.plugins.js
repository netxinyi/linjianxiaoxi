(function($) {
    $.fn.alert = function(options ,callback){

        var opts = $.extend({}, $.fn.alert.opt, options);
        var  html = '<div class="alert alert-'+opts.type+'">';
            if(opts.closeButton){
                html += '<button type="button" class="close" data-dismiss="alert">×</button>';
            }

             html += opts.html +'</div>';
            $(this).html(html);

    },
    $.fn.alert.opt = {
        closeButton: true,
        type:'success',
        html:'success'
    };
})(jQuery);