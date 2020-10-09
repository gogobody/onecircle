let owo_ = $(".OwO")
if(owo_.length > 0){
    let apiUrl = owo_.data("owo")
    new OwO({
        logo: 'OωO',
        container: document.getElementsByClassName('OwO')[0],
        target: document.getElementsByClassName('owo-textarea')[0],
        api: apiUrl,
        position: 'down',
        width: '400px',
        maxHeight: '250px'
    });
}
//增加行号
(function(){
    let pres = document.querySelectorAll('pre');
    let lineNumberClassName = 'line-numbers';
    pres.forEach(function (item, index) {
        item.className = item.className === '' ? lineNumberClassName : item.className + ' ' + lineNumberClassName;
    });
})();
let catalog_btn = document.getElementById('article-list-btn');
if (catalog_btn) {
    catalog_btn.addEventListener('click',function () {
        //生成文章目录
        let index = 0;
        let depth = 0;
        let tocTreeHtml = '';
        let tocTreeObj = document.getElementById('tocTree')
        let postContentObj = document.getElementsByTagName('article')[0].querySelector('.article-content');
        postContentObj.innerHTML = postContentObj.innerHTML.replace(/<h([1-6])(.*?)>(.*?)<\/h\1>/ig, function (match, num, attrs, html) {
            index++;

            if (depth < num) {
                if (index > 1) {
                    tocTreeHtml += '</li><li><ul class="article-catalog-list"><li><a href="#index-' + index + '">' + html + '</a>';
                } else {
                    tocTreeHtml += '<li><a href="#index-' + index + '">' + html + '</a>';
                }
            } else if (depth === num) {
                tocTreeHtml += '</li><li><a href="#index-' + index + '">' + html + '</a>';
            } else if (depth > num) {
                tocTreeHtml += '</li>' + (new Array(depth - num + 1).join('</ul></li>')) + '<li><a href="#index-' + index + '">' + html + '</a>';
            }
            depth = num;
            return '<h' + num + attrs + ' id="index-' + (index) + '">' + html + '</h' + num + '>';
        })

        if (tocTreeHtml) {
            tocTreeObj.classList.add('on');
            tocTreeObj.querySelector('.article-catalog-list').innerHTML = tocTreeHtml;
        }
    })
    // 关闭
    document.getElementById('catalog-close').addEventListener('click',
        function() {
            document.getElementById('tocTree').classList.remove('on');
        });
}
$('.protected-btn').click(function() {
    let surl=$(".protected").attr("action");
    $.ajax({
        type: "POST",
        url:surl,
        data:$('.protected').serialize(),
        error: function(request) {
            alert("密码提交失败，请刷新页面重试！");
        },
        success: function(data) {

            if(data.indexOf("密码错误") >= 0 && data.indexOf("<title>Error</title>") >= 0) {
                alert("密码错误，请重试！");
            }else{
                location.reload();
            }
        }
    });
});
let holder = $('.comment-respond textarea').attr('placeholder');
// 私密
$('#secret-button').click(function () {
    let textareaDom = $('.comment-respond textarea');
    if($(this).is(':checked')) {
        textareaDom.attr('placeholder', '私密回复中')
    }else {
        textareaDom.attr('placeholder', holder)
    }
})