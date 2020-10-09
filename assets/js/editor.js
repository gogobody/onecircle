$(function() {
    let owo_ = $(".OwO")
    let apiUrl = owo_.data("owo")
    if($('#wmd-button-row').length>0){
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-hide-button" style="" title="插入隐藏内容"><i class="far fa-eye-slash"></i></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-bili-button" style="" title="插入B站视频"><i class="fab fa-bimobject"></i></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-video-button" style="" title="插入其它视频"><i class="fas fa-video"></i></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-cid-button" style="" title="文章跳转"><i class="far fa-newspaper"></i></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-owo-button" style="" title="插入表情"><span class="OwO"></span></li>');
        new OwO({
            logo: '<i class="far fa-grin-alt"></i>',
            container: document.getElementsByClassName('OwO')[0],
            target: document.getElementById('text'),
            api: apiUrl,
            position: 'down',
            width: '400px',
            maxHeight: '250px'
        });
        $(document).on('click','#wmd-hide-button',function() {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[hide]\n\n[/hide]\n');
        });
        $(document).on('click','#wmd-bili-button',function() {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[bilibili bv="" p="1"]\n');
        });
        $(document).on('click','#wmd-video-button',function() {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[video src=""]\n');
        });
        $(document).on('click','#wmd-cid-button',function() {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[cid=""]\n');
        });
    }
});
