console.log(' %c Theme onecircle %c https://github.com/gogobody/onecircle', 'color:#444;background:#eee;padding:5px 0', 'color:#eee;background:#444;padding:5px');

//初始化tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

//
$('.close').on('click',function () {
    $('.search-block').collapse('hide')
})
$('#search-block').on('show.bs.collapse', function () {
    $('.nav-menu').css({'position':'relative','z-index':'-1'})
    $('#carouselExampleIndicators').css({'position':'relative','z-index':'-1'})
    $('.user-container').css({'position':'relative','z-index':'-1'})
})
$('#search-block').on('hidden.bs.collapse', function () {
    $('.nav-menu').removeAttr('style')
    $('#carouselExampleIndicators').removeAttr('style')
    $('.user-container').removeAttr('style')
})

var indexInput = {
    init:function(){
        this.addPic = $(".addpic")
        this.addLink = $(".addlink")
        this.addPicBtn = $("#addpic")
        this.addLinkBtn = $("#addlink")
        this.picParent = $(".sc-AxjAm.sc-AxirZ.fbjukw")
        this.additionArray = [] // for addPic and addLink
        this.nowtype = 'default' // for addPic and addLink, 'default,link'
        this.articleType = $("#articleType")
        this.indexEventInit()
        this.archiveEventInit()
    },
    changeType:function (type){
        let that = this
        if(type === 'default'){
            if(that.nowtype !== 'default'){
                that.nowtype = 'default'
                this.additionArray = []
                this.articleType.val('default')
            }
        }else if (type === 'link'){
            if(that.nowtype !== 'link'){
                that.nowtype = 'link'
                this.additionArray = []
                this.articleType.val('link')
            }
        }
    },
    indexEventInit:function () {
        // init input
        let that = this
        $("#addpic").click(function () {
            that.changeType('default')
            if (that.addPic.css("display") === "none") {
                that.addPic.css("display", "flex")
                that.addLink.css("display", "none")

            } else {
                that.addPic.css("display", "none")
            }
        })

        $(".addpic button").click(function () {
            $(this).html("解析中")
            let addPicInput = $(".addpic input")
            let val = addPicInput.val()
            if (checkURL(val)) {
                let node = '' +
                    '<div class="sc-AxjAm sc-AxirZ ciIrlj">\n' +
                    '<div class="eHTuZC" style="background-image: url('+ val +');">\n' +
                    '<div class="cPHQWG">\n' +
                    '<svg viewBox="0 0 17 17" fill="currentColor">\n' +
                    '<path d="M9.565 8.595l5.829 5.829a.686.686 0 01-.97.97l-5.83-5.83-5.828 5.83a.686.686 0 01-.97-.97l5.829-5.83-5.83-5.828a.686.686 0 11.97-.97l5.83 5.829 5.829-5.83a.686.686 0 01.97.97l-5.83 5.83z"></path>\n' +
                    '</svg>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>'
                that.picParent.append(node)
                that.additionArray.push(val)
                that.addLinkBtn.addClass('btn-disable')
                addPicInput.val('')
                // pic close btn click function
                $(".cPHQWG").click(function (){
                    let imgUrl = $(this).parent().css("backgroundImage").replace('url(','').replace(')','')
                    that.additionArray.splice($.inArray(imgUrl,that.additionArray),1);
                    $(this).parent().parent().remove()
                    if (that.additionArray.length === 0){
                        that.addLinkBtn.removeClass('btn-disable')
                    }
                })

            } else {
                console.log("false")

            }
            $(this).html("添加")
        })


        // process add link
        $("#addlink").click(function () {
            that.changeType('link')

            if (that.addLink.css("display") === "none") {
                that.addPic.css("display", "none")
                that.addLink.css("display", "flex")
            } else {
                that.addLink.css("display", "none")
            }
        })
        $(".addlink button").click(function () {
            $(this).text("解析中")
            let val = $(".addlink input").val()
            let innerThat = this
            if (checkURL(val)) {
                $.post("/oneaction", {
                    type: "parsemeta",
                    url: val
                }, function (res) {
                    if (res) {
                        let inTextareaBlk = $(".sc-AxjAm.kgcKxQ")
                        inTextareaBlk.css("display", "block")
                        inTextareaBlk.attr("href", val)
                        $(".sc-AxjAm.kgcKxQ .hHnMup").html(res)
                        that.additionArray = [] // reset additionArr
                        that.additionArray.push(val)
                        that.additionArray.push(res)
                        // set addPic disable
                        that.addPicBtn.addClass('btn-disable')
                        // close closeTextareaBlk
                        $(".sc-AxjAm.sc-AxirZ.ezTcmd").click(function (e){
                            $(".kgcKxQ").css("display", "none")
                            e.stopPropagation();
                            that.addPicBtn.removeClass('btn-disable')
                            return false;
                        })
                    }
                    $(innerThat).text("添加")
                })
            } else {
                console.log("false")
                $(innerThat).text("添加")
            }

        })
        // process input
        $("#text").bind('input propertychange', function () {
            let btn = $(".pub.eynkqj")
            if ($(this).val()) {
                btn.removeAttr("disabled")
            } else {
                btn.attr("disabled", true)
                btn.css("background-color", "rgb(255, 241, 147)")
            }
        })
        $(".sc-AxjAm.bwpEWU.gsmhQy").bind('input propertychange', function () {
            let btn = $(".sc-AxjAm.eVNRGW")
            if ($(this).val()) {
                btn.removeAttr("disabled")
            } else {
                btn.attr("disabled", true)
            }
        })

        // search blk
        let topicSearchBlk = $("#topic-search-downshift-input")
        topicSearchBlk.autoComplete({
            minChars: 0,
            source: function(term, suggest){
                term = term.toLowerCase();
                let choices = allCategories; // from index.php
                let matches = [];
                for (let i=0; i<choices.length; i++)
                    if (~choices[i][0].toLowerCase().indexOf(term)) matches.push(choices[i]);
                if(matches.length === 0){
                    matches.push(["未搜索到结果",-1,"",""])
                }
                suggest(matches);
            },
            renderItem:function (item, search){
                // search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                // let re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                let tmpArr = new Array(...[item[0],item[1]])
                if (item[1] === -1){
                    return '<div class="autocomplete-suggestion" data-val="' +JSON.stringify(tmpArr).replace(/"/g,"'") + '" disabled>'+
                        '<div class="sc-AxjAm oDrAC" disabled>' + item[0] + "</div>" + '</div>';
                }
                return '<div class="autocomplete-suggestion" data-val="' + JSON.stringify(tmpArr).replace(/"/g,"'") + '">'+'<img src="'+ item[2] + '" class="sc-AxjAm gLHjJQ">'+
                    "<div class=\"sc-AxjAm oDrAC\">" + item[0] + "</div>" + '</div>';
            },
            onSelect: function(e, term, item){
                term = term.replace(/'/g,"\"")
                let info = JSON.parse(term)
                let mid = info[1]
                let category = $("#category")
                if(mid === -1){ // not found topic
                    $("#topic-search-downshift-input").val('')
                    category.val(1)
                    return
                }
                topicSearchBlk.val(info[0])
                category.val(mid)

            }
        });

    },
    archiveEventInit:function () {
        let that = this
        // 关注 event
        let fanBtn = $("#fans")
        fanBtn.click(function (e){
            if (userId > 0 ){
                let status
                if (fanBtn.text() === "关注"){
                    status = "follow"
                }else {
                    status = "unfollow"
                }
                if(userId ===fanBtn.data("authorid")){
                    alert("自己不能关注自己！")
                }
                $.post('/',{
                    follow:status,
                    uid:userId,
                    fid:fanBtn.data("authorid")
                },function (res) {
                    if (res){
                        if (status === "unfollow"){
                            fanBtn.text("关注")
                            fanBtn.addClass("fans")
                            fanBtn.removeClass("fansed")
                        }else {
                            fanBtn.text("已关注")
                            fanBtn.addClass("fansed")
                            fanBtn.removeClass("fans")
                        }
                    }
                })
            }else {
                alert("没有登录")

            }
        })
        // archive tabs
        $(".react-tabs__tab-list").children().each(function (index,val) {
            $(val).click(function (e) {
                let tabindex = $(val).data("tabindex")
                window.location.search = '?tabindex='+tabindex
            })
        })
    }
}
$(function () {


    $(".post-content-inner-link a").click(function (event) {
        event.stopPropagation();
    })
    indexInput.init()


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

// prev link click event
function submitForm() {
    // jquery 表单提交
    // add title
    let title = $("#post-title")
    // add pic and links
    let textarea = $("#text")
    let val = textarea.val()
    let myDate = new Date;
    let year = myDate.getFullYear(); //获取当前年
    let mon = myDate.getMonth() + 1; //获取当前月
    let date = myDate.getDate(); //获取当前日
    let datetime = year+"/"+mon+"/"+date
    if(val.length > 0){
        title.val(val.substring(0,15))
    }
    if (indexInput.nowtype === 'default'){
        if (indexInput.additionArray.length > 0){
            title.val("图文小记事~"+datetime)
            indexInput.additionArray.forEach(function (value){
                val = val + "![](" + value +")"
            })

        }
    }else if (indexInput.nowtype === 'link'){
        if (indexInput.additionArray.length > 0){
            title.val("分享一个链接~"+datetime)
            val = val + "["+indexInput.additionArray[1] + "](" + indexInput.additionArray[0] +")"
        }
    }
    textarea.val(val)
    const len = textarea.length;
    if (len === 0 || textarea.val() === '') {
        return false
    }


    // $("#postForm").submit()

    $("#input-form").ajaxSubmit(function (result) {
        setTimeout(function () {
            window.location.reload()
        }, 1000)
    });
    return false;
}

function checkURL(URL) {
    var str = URL;
    var Expression = /http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/;
    var objExp = new RegExp(Expression);
    return objExp.test(str) === true;
}

//

function ac() {
    let $body = $('html,body');
    let g = '.comment-list'
        , h = '.comment-num'
        , i = '.comment-reply a'
        , j = '#textarea'
        , k = ''
        , l = '';
    c();
    $('#comment-form').submit(function() {
        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            data: $(this).serializeArray(),
            error: function() {
                alert("提交失败，请检查网络并重试或者联系管理员。");
                return false
            },
            success: function(d) {
                if (!$(g, d).length) {
                    alert("您输入的内容不符合规则或者回复太频繁，请修改内容或者稍等片刻。");
                    return false
                } else {
                    k = $(g, d).html().match(/id=\"?comment-\d+/g).join().match(/\d+/g).sort(function(a, b) {
                        return a - b
                    }).pop();
                    if ($('.page-navigator .prev').length && l == "") {
                        k = ''
                    }
                    if (l) {
                        d = $('#comment-' + k, d).hide();
                        if ($('#' + l).find(".comment-children").length <= 0) {
                            $('#' + l).append("<div class='comment-children'><ol class='comment-list'><\/ol><\/div>")
                        }
                        if (k)
                            $('#' + l + " .comment-children .comment-list").prepend(d);
                        l = ''
                    } else {
                        d = $('#comment-' + k, d).hide();
                        if (!$(g).length)
                            $('.comment-detail').prepend("<h2 class='comment-num'>0 条评论<\/h2><ol class='comment-list'><\/ol>");
                        $(g).prepend(d)
                    }
                    $('#comment-' + k).fadeIn();
                    let f;
                    $(h).length ? (f = parseInt($(h).text().match(/\d+/)),
                        $(h).html($(h).html().replace(f, f + 1))) : 0;
                    TypechoComment.cancelReply();
                    $(j).val('');
                    $(i + ', #cancel-comment-reply-link').unbind('click');
                    c();
                    if (k) {
                        $body.animate({
                            scrollTop: $('#comment-' + k).offset().top - 50
                        }, 300)
                    } else {
                        $body.animate({
                            scrollTop: $('#comments').offset().top - 50
                        }, 300)
                    }
                }
            }
        });
        return false
    });
    function c() {
        $(i).click(function() {
            l = $(this).parent().parent().parent().attr("id")
        });
        $('#cancel-comment-reply-link').click(function() {
            l = ''
        })
    }
}
ac();
$(function () {
    $(window).scroll(function () {
        var scroHei = $(window).scrollTop();
        if (scroHei > 500) {
            $('.back-to-top').fadeIn();
            $('.back-to-top').css('top', '-200px');
        }else {
            $('.back-to-top').fadeOut();
        }
    })
    $('.back-to-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
    })
})
// 首页点赞
$('.content-action').each(function (i, n) {
    $(n).find('.btn-like').on('click', function (e) {
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
        e.stopPropagation()
        return false;
    })
})
// 文章点赞
$('#agree-btn').on('click', function () {
    $(this).get(0).disabled = true;  //  禁用点赞按钮
    $(this).children().css("fill","rgb(228, 88, 62)")
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
                $('.agree-num').html(data);
            }
        },
        error: function () {
            //  如果请求出错就恢复点赞按钮
            $(this).get(0).disabled = false;
        },
    });
});
