console.log(' %c Theme onecircle %c https://github.com/dyedd/onecircle', 'color:#444;background:#eee;padding:5px 0', 'color:#eee;background:#444;padding:5px');

// prev link click event
$(".post-content-inner-link a").click(function (event) {
    event.stopPropagation();
})

//初始化tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
$(function (){
    // 根据时间
    let timeNow = new Date();
// 获取当前小时
    let hours = timeNow.getHours();
    // if (hours > 6 && hours < 19) {
    //     $('body').removeClass('theme-dark')
    // } else {
    //     $('body').addClass('theme-dark')
    // }
})
// 首页点赞
$('.content-action').each(function (i, n){
    $(n).find('.btn-like').on('click', function (){
        $(this).get(0).disabled = true;  //  禁用点赞按钮
        $.ajax({
            type: 'post',
            data: 'agree=' + $(this).attr('data-cid'),
            async: true,
            timeout: 30000,
            cache: false,
            //  请求成功的函数
            success: function (data) {
                let re = /\d/;  //  匹配数字的正则表达式
                //  匹配数字
                if (re.test(data)) {
                    //  把点赞按钮中的点赞数量设置为传回的点赞数量
                    $($('.btn-like').find('span.agree-num')[i]).html(data);
                }
            },
            error: function () {
                //  如果请求出错就恢复点赞按钮
                $(this).get(0).disabled = false;
            },
        });
    })
})
// 文章点赞
$('#agree-btn').on('click', function () {
    $(this).get(0).disabled = true;  //  禁用点赞按钮
    //  发送 AJAX 请求
    $.ajax({
        //  请求方式 post
        type: 'post',
        //  url 获取点赞按钮的自定义 url 属性
        //  发送的数据 cid，直接获取点赞按钮的 cid 属性
        data: 'agree=' + $(this).attr('data-cid'),
        async: true,
        timeout: 30000,
        cache: false,
        //  请求成功的函数
        success: function (data) {
            let re = /\d/;  //  匹配数字的正则表达式
            //  匹配数字
            if (re.test(data)) {
                //  把点赞按钮中的点赞数量设置为传回的点赞数量
                $('#agree-btn .agree-num').html(data);
            }
        },
        error: function () {
            //  如果请求出错就恢复点赞按钮
            $(this).get(0).disabled = false;
        },
    });
});

