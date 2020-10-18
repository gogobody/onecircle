$(function () {

    if ($('#wmd-button-row').length > 0) {
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-hide-button" style="" title="插入隐藏内容"><i class="far fa-eye-slash"></i></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-bili-button" style="" title="插入B站视频"><i class="fab fa-bimobject"></i></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-video-button" style="" title="插入其它视频"><i class="fas fa-video"></i></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-cid-button" style="" title="文章跳转"><i class="far fa-newspaper"></i></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-gallery-button" style="" title="插入相册"><i class="fab fa-images aria-hidden="true"></i></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-owo-button" style="" title="插入表情"><span class="OwO" data-owo="/usr/themes/onecircle/assets/owo/OwO_02.json"></span></li>');

        var owo_ = $(".OwO")
        var apiUrl = owo_.data("owo")
        new OwO({
            logo: '<i class="far fa-grin-alt"></i>',
            container: document.getElementsByClassName('OwO')[0],
            target: document.getElementById('text'),
            api: apiUrl,
            position: 'down',
            width: '400px',
            maxHeight: '250px'
        });
        $(document).on('click', '#wmd-hide-button', function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[hide]\n\n[/hide]\n');
        });
        $(document).on('click', '#wmd-bili-button', function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[bilibili bv="" p="1"]\n');
        });
        $(document).on('click', '#wmd-video-button', function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[video src=""]\n');
        });
        $(document).on('click', '#wmd-cid-button', function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[cid=""]\n');
        });
        $(document).on('click', '#wmd-gallery-button', function () {
            //显示弹窗的主界面
            $('.pop_main').show("fast")
            //设置animate动画初始值
            $('.pop_con').css({'top': 0, 'opacity': 0})
            $('.pop_con').animate({'top': '50%', 'opacity': 1})
        });
        //取消按钮和关闭按钮添加事件
        $('.cancel,.pop_title a').click(function () {
            $('.pop_con').animate({'top': 0, 'opacity': 0}, function () {
                //隐藏弹窗的主界面
                $('.pop_main').hide()
            })
        })
        $(".pop_footer .confirm").click(function () {
            $('.pop_con').animate({'top': 0, 'opacity': 0}, function () {
                //隐藏弹窗的主界面
                var imgarr = $("#input-num").val().split('\n')
                myField = document.getElementById('text');
                var text = '\n\n[gallery]';
                for (var i = 0; i < imgarr.length; i++) {
                    var j = i + 1
                    text = text + '!['+j+'](' + imgarr[i] + ')'
                }
                text = text + '[endgallery]\n\n'
                insertAtCursor(myField, text);
                $('.pop_main').hide("fast")
            })

        })
    }
});
