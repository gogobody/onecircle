var owoInit = function () {
    var pres = document.querySelectorAll('pre');
    var lineNumberClassName = 'line-numbers';
    pres.forEach(function (item, index) {
        item.className = item.className === '' ? lineNumberClassName : item.className + ' ' + lineNumberClassName;
    });
    var owo_ = $(".OwO")
    if(owo_.length > 0){
        var apiUrl = owo_.data("owo")
        new OwO({
            logo: 'OωO',
            container: document.getElementsByClassName('OwO')[0],
            target: document.getElementsByClassName('owo-textarea')[0]||document.getElementById('text'),
            api: apiUrl,
            position: 'up',
            width: '400px',
            maxHeight: '250px'
        });
    }
    var catalog_btn = document.getElementById('article-list-btn');
    if (catalog_btn) {
        catalog_btn.addEventListener('click',function () {
            //生成文章目录
            var index = 0;
            var depth = 0;
            var tocTreeHtml = '';
            var tocTreeObj = document.getElementById('tocTree')
            var postContentObj = document.getElementsByTagName('article')[0].querySelector('.article-content');
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
                document.getElementById('tocTree').classList.remove('animate__bounceOutRight')
                document.getElementById('tocTree').classList.add('animate__bounceInRight')
            }
        })
        // 关闭
        document.getElementById('catalog-close').addEventListener('click',
            function() {
                document.getElementById('tocTree').classList.remove('animate__bounceInRight')
                document.getElementById('tocTree').classList.add('animate__bounceOutRight')
                // document.getElementById('tocTree').classList.remove('on');
            });
    }
    $('.protected-btn').click(function() {
        var surl=$(".protected").attr("action");
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
    var holder = $('.comment-respond textarea').attr('placeholder');
// 私密
    $('#secret-button').click(function () {
        var textareaDom = $('.comment-respond textarea');
        if($(this).is(':checked')) {
            textareaDom.attr('placeholder', '私密回复中')
        }else {
            textareaDom.attr('placeholder', holder)
        }
    })
}

//增加行号
$(function () {
    owoInit()
});
