/**
 * 注册全局jquery 函数
 */

$.extend({
    //弹出错误提示
    errorTip: function(message) {
        let errorTipDom = $('#error_tip');

        if (errorTipDom.length === 0) {     //第一次初始化弹框html
            let tipHtml =
                '<div class="" id="error_tip" role="alert">' +
                    '<span class="msg">' + message + '</span>' +
                '</div>';
            $('body').append(tipHtml);
        } else {
            $('#error_tip span.msg').html(message);
            errorTipDom.show();
        }

        setTimeout(function() {
            $('#error_tip').fadeOut(1500);
        }, 2000);
    },
});