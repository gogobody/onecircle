console.log(' %c Theme onecircle %c https://github.com/gogobody/onecircle', 'color:#444;background:#eee;padding:5px 0', 'color:#eee;background:#444;padding:5px');

//初始化tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
    // add message function
    $.extend({
        message: function (a) {
            var b = {
                title: "",
                message: " 操作成功",
                time: "3000",
                type: "success",
                showClose: true,
                autoClose: true,
                onClose: function () {
                }
            };
            "string" == typeof a && (b.message = a), "object" == typeof a && (b = $.extend({}, b, a));
            var c, d, e, f = b.showClose ? '<div class="c-message--close">×</div>' : "",
                g = "" !== b.title ? '<h2 class="c-message__title">' + b.title + "</h2>" : "",
                h = '<div class="c-message animated animate__slideInRight"><i class=" c-message--icon c-message--' + b.type + '"></i><div class="el-notification__group">' + g + '<div class="el-notification__content">' + b.message + "</div>" + f + "</div></div>",
                i = $("body"), j = $(h);
            d = function () {
                j.addClass("animate__slideOutRight")
                j.one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                    e()
                })
            }
            e = function () {
                j.remove()
                b.onClose(b)
                clearTimeout(c)
            }
            $(".c-message").remove()
            i.append(j)
            j.one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                j.removeClass("messageFadeInDown")
            })
            i.on("click", ".c-message--close", function (a) {
                d()
            })
            b.autoClose && (c = setTimeout(function () {
                d()
            }, b.time))
        }
    });
})


var indexInput = {
    init: function () {
        this.addArea = $(".add-area")
        this.addAreaBtn = $(".add-area button")
        this.addPicBtn = $("#addpic")
        this.addLinkBtn = $("#addlink")
        this.addVideoBtn = $("#addvideo")
        this.addBilibiliBtn = $("#addbilibili")
        this.uploadPic = $(".upload-pic")
        this.showPanel = $(".show-panel.fbjukw")
        this.additionArray = [] // for addPic and addLink ,....
        this.nowtype = 'default' // for addPic and addLink, 'default,link,video,bilibili'
        this.articleType = $("#articleType")
        this.funcInit()
    },
    funcInit:function(){
        this.indexEventInit()
        this.login_ajax()
        this.searchEventInit()
        this.articleClickInit()
    },
    resetInputStatus:function(){// reset status when change nowtype
        this.additionArray = []

    },
    changeType: function (type) {
        if (this.nowtype !== type) {
            this.nowtype = type
            this.articleType.val(type)
            this.resetInputStatus()
            $(".add-area input").val('')
        }
    },
    doParseDefaultFunc:function(this_,that){
        $(this_).html("解析中")
        var addAreaInput = $(".add-area input")
        var val = addAreaInput.val()
        if (checkURL(val)) {
            var node = '' +
                '<div class="sc-AxjAm sc-AxirZ ciIrlj">\n' +
                '<div class="eHTuZC" style="background-image: url(' + val + ');">\n' +
                '<div class="cPHQWG">\n' +
                '<svg viewBox="0 0 17 17" fill="currentColor">\n' +
                '<path d="M9.565 8.595l5.829 5.829a.686.686 0 01-.97.97l-5.83-5.83-5.828 5.83a.686.686 0 01-.97-.97l5.829-5.83-5.83-5.828a.686.686 0 11.97-.97l5.83 5.829 5.829-5.83a.686.686 0 01.97.97l-5.83 5.83z"></path>\n' +
                '</svg>\n' +
                '</div>\n' +
                '</div>\n' +
                '</div>'
            that.showPanel.append(node)
            that.additionArray.push(val)
            that.addPicBtn.siblings().addClass('btn-disable')
            addAreaInput.val('')
            // pic close btn click function
            $(".cPHQWG").unbind('click').bind('click',function () {
                var imgUrl = $(this).parent().css("backgroundImage").replace('url(', '').replace(')', '')
                that.additionArray.splice($.inArray(imgUrl, that.additionArray), 1);
                $(this).parent().parent().remove()
                if (that.additionArray.length === 0) {
                    that.addPicBtn.siblings().removeClass('btn-disable')
                }
            })

        } else {
            $.message({
                title:"提示",
                message:"请输入正确的图片地址",
                type:"error"
            })

        }
        $(this_).html("添加")

    },
    doParseLinkFunc:function(this_,that){
        $(this_).text("解析中")
        var val = $(".add-area input").val()
        if (checkURL(val)) {
            $.post("/oneaction", {
                type: "parsemeta",
                url: val
            }, function (res) {
                if (res) {
                    var inTextareaBlk = $(".sc-AxjAm.kgcKxQ")
                    inTextareaBlk.css("display", "block")
                    inTextareaBlk.attr("href", val)
                    $(".sc-AxjAm.kgcKxQ .hHnMup").html(res)
                    that.additionArray = [] // reset additionArr
                    that.additionArray.push(val)
                    that.additionArray.push(res)
                    // set other disable
                    that.addLink.siblings().addClass('btn-disable')
                    // close closeTextareaBlk
                    $(".sc-AxjAm.sc-AxirZ.ezTcmd").unbind('click').bind('click',function (e) {
                        $(".kgcKxQ").css("display", "none")
                        e.stopPropagation();
                        that.addLink.siblings().removeClass('btn-disable')
                        return false;
                    })
                }
                $(this_).text("添加")
            })
        } else {
            $.message({
                title:"提示",
                message:"请输入正确的地址",
                type:"error"
            })
            $(this_).text("添加")
        }
    },
    doParseVideoFunc:function(this_,that){
        var addAreaInput = $(".add-area input")
        var val = addAreaInput.val()
        if (checkURL(val)){
            that.additionArray.push(val)
            var node =
                '<div class="show-panel-inner"><div class="jLaetV"><div class="hHnMup">'+ val +'</div></div>\n' +
                '<div class="ezTcmd show-close">\n' +
                '<div class="hyliOy">\n' +
                '<svg viewBox="0 0 17 17" fill="#ccc">\n' +
                '<path d="M9.565 8.595l5.829 5.829a.686.686 0 01-.97.97l-5.83-5.83-5.828 5.83a.686.686 0 01-.97-.97l5.829-5.83-5.83-5.828a.686.686 0 11.97-.97l5.83 5.829 5.829-5.83a.686.686 0 01.97.97l-5.83 5.83z"></path>\n' +
                '</svg>\n' +
                '</div>\n' +
                '</div></div>'
            that.showPanel.append(node)
            that.addVideoBtn.siblings().addClass('btn-disable')
            addAreaInput.val('')
            $(".show-close").unbind('click').bind('click',function () {
                var videoUrl = $(this).siblings().text()
                that.additionArray.splice($.inArray(videoUrl, that.additionArray), 1);
                $(this).parent().remove()
                if (that.additionArray.length === 0) {
                    that.addVideoBtn.siblings().removeClass('btn-disable')
                }
            })
        }else {
            $.message({
                title:"提示",
                message:"请输入正确的视频地址",
                type:"error"
            })

        }

    },
    doParseBilibiliFunc:function(this_,that){
        var addAreaInput = $(".add-area input")
        var val = addAreaInput.val()
        that.additionArray.push(val)
        var node =
            '<div class="show-panel-inner"><div class="jLaetV"><div class="hHnMup">'+ val +'</div></div>\n' +
            '<div class="ezTcmd show-close">\n' +
            '<div class="hyliOy">\n' +
            '<svg viewBox="0 0 17 17" fill="#ccc">\n' +
            '<path d="M9.565 8.595l5.829 5.829a.686.686 0 01-.97.97l-5.83-5.83-5.828 5.83a.686.686 0 01-.97-.97l5.829-5.83-5.83-5.828a.686.686 0 11.97-.97l5.83 5.829 5.829-5.83a.686.686 0 01.97.97l-5.83 5.83z"></path>\n' +
            '</svg>\n' +
            '</div>\n' +
            '</div></div>'
        that.showPanel.append(node)
        that.addBilibiliBtn.siblings().addClass('btn-disable')
        addAreaInput.val('')
        $(".show-close").unbind('click').bind('click',function () {
            var bvnum = $(this).siblings().text()
            that.additionArray.splice($.inArray(bvnum, that.additionArray), 1);
            $(this).parent().remove()
            if (that.additionArray.length === 0) {
                that.addBilibiliBtn.siblings().removeClass('btn-disable')
            }
        })
    },
    indexEventInit: function () {
        // init input
        var that = this
        $("#addpic").unbind('click').bind('click',function () {
            $(".add-area input").attr("placeholder","请输入图片链接")
            if (that.nowtype !== 'default'){
                that.addArea.show()
                that.uploadPic.show()
            }else {
                that.addArea.toggle()
                that.uploadPic.toggle()
            }
            that.changeType('default')

        })


        // process add link click
        $("#addlink,#addvideo,#addbilibili").unbind('click').bind('click',function () {
            that.uploadPic.hide()
            var type = $(this).data("type")
            if (type==='link'){
                $(".add-area input").attr("placeholder","请输入链接")
            }else if (type === 'video'){
                $(".add-area input").attr("placeholder","请输入视频链接")
            }else if (type === 'bilibili'){
                $(".add-area input").attr("placeholder","请输入bv号")
            }
            if (that.nowtype !== type){
                that.addArea.show()
            }else{
                that.addArea.toggle()
            }
            that.changeType(type)

        })
        this.addAreaBtn.unbind('click').bind('click',function () {
            if (that.nowtype === 'default'){
                that.doParseDefaultFunc(this,that)
            }else if (that.nowtype === 'link'){
                that.doParseLinkFunc(this,that)
            }else if (that.nowtype === 'video'){
                that.doParseVideoFunc(this,that)
            }else if (that.nowtype === 'bilibili'){
                that.doParseBilibiliFunc(this,that)
            }
        })
        // process input
        $("#text").bind('input propertychange', function () {
            var btn = $(".pub.eynkqj")
            if ($(this).val()) {
                btn.removeAttr("disabled")
            } else {
                btn.attr("disabled", true)
                btn.css("background-color", "rgb(255, 241, 147)")
            }
        })
        $(".sc-AxjAm.bwpEWU.gsmhQy").bind('input propertychange', function () {
            var btn = $(".sc-AxjAm.eVNRGW")
            if ($(this).val()) {
                btn.removeAttr("disabled")
            } else {
                btn.attr("disabled", true)
            }
        })

        // search blk
        var topicSearchBlk = $("#topic-search-downshift-input")
        topicSearchBlk.autoComplete({
            minChars: 0,
            source: function (term, suggest) {
                term = term.toLowerCase();
                var choices = allCategories; // from index.php
                var matches = [];
                for (var i = 0; i < choices.length; i++)
                    if (~choices[i][0].toLowerCase().indexOf(term)) matches.push(choices[i]);
                if (matches.length === 0) {
                    matches.push(["未搜索到结果", -1, "", ""])
                }
                suggest(matches);
            },
            renderItem: function (item, search) {
                // search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                // var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                var tmpArr = new Array()
                tmpArr[0] = item[0]
                tmpArr[1] = item[1]
                if (item[1] === -1) {
                    return '<div class="autocomplete-suggestion" data-val="' + JSON.stringify(tmpArr).replace(/"/g, "'") + '" disabled>' +
                        '<div class="sc-AxjAm oDrAC" disabled>' + item[0] + "</div>" + '</div>';
                }
                return '<div class="autocomplete-suggestion" data-val="' + JSON.stringify(tmpArr).replace(/"/g, "'") + '">' + '<img src="' + item[2] + '" class="sc-AxjAm gLHjJQ">' +
                    "<div class=\"sc-AxjAm oDrAC\">" + item[0] + "</div>" + '</div>';
            },
            onSelect: function (e, term, item) {
                term = term.replace(/'/g, "\"")
                var info = JSON.parse(term)
                var mid = info[1]
                var category = $("#category")
                if (mid === -1) { // not found topic
                    $("#topic-search-downshift-input").val('')
                    category.val(1)
                    return
                }
                topicSearchBlk.val(info[0])
                category.val(mid)

            }
        });

        $(".post-content-inner-link a").click(function (event) {
            event.stopPropagation();
        })

    },
    searchEventInit: function () {
        // search blk
        var searchBtn = $('.search-block-icon')
        var searchBlk = $('#search-block')
        searchBtn.unbind('click').bind('click',function () {
            // console.log(searchBlk.css('display'))
            if (searchBlk.css('display') === 'none') {
                searchBlk.slideDown()
            } else {
                $('.search-block').slideUp()
            }
        })
        $('.close').unbind('click').bind('click', function () {
            $('.search-block').slideUp()
        })
    },
    login_ajax: function () {
        var that = this
        var loginSubmitForm = $("#login-submit")
        var navLoginUser = $("#navbar-login-user")
        var navLoginPsw = $("#navbar-login-password")

        function showbtn() {
            loginSubmitForm.attr("disabled", true).fadeTo("", 1)
        }
        this.canLogin = true // prevent multi submit
        $("#Login_form").submit(function () {
            if (!that.canLogin) return
            that.canLogin = false

            if ($(this).hasClass("banLogin")) return location.reload(), !1;
            loginSubmitForm.attr("disabled", !0).fadeTo("slow", .5);
            var b = navLoginUser.val(), c = navLoginPsw.val();
            return "" === b ? ($.message({
                title: "登录通知",
                message: "必须填写用户名",
                type: "warning"
            }), navLoginUser.focus(), showbtn(), !1) : "" === c ? ($.message({
                title: "登录通知",
                message: "请填写密码",
                type: "warning"
            }), navLoginPsw.focus(), showbtn(), !1) : (loginSubmitForm.addClass("active"), $("#spin-login").addClass("show inline"),
                $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: $(this).serializeArray(),
                error: function () {
                    that.canLogin = true
                    return $.message({
                        title: "登录通知",
                        message: "提交出错",
                        type: "error"
                    }), showbtn()
                },
                success: function (b) {
                    b = $.parseHTML(b)
                    loginSubmitForm.removeClass("active")
                    $("#spin-login").removeClass("show inline");

                    try {
                        if ($("#Logged-in", b).length <= 0){
                            that.canLogin = true
                            showbtn()
                            return $.message({
                                title: "登录通知",
                                message: "用户名或者密码错误，请重试",
                                type: "error"
                            })
                        }

                        showbtn()
                        b = $("#easyLogin", b).html(), $("#easyLogin").html(b)
                        $.message({
                            title: "登录通知",
                            message: "登录成功:" + '&nbsp;<a onclick="location.reload();">' + "点击这里刷新页面，或等待自动刷新" + "</a>",
                            type: "success"
                        })
                        setTimeout(function () {
                            location.reload()
                        }, 500)
                    } catch (a) {
                        alert("按下F12，查看输出错误信息")
                        that.canLogin = true
                    }
                }
            }), !1)
        })
    },
    loginBan: function() { // no use now
        var loginform = $("#Login_form")
        loginform.hasClass("banLogin") || (loginform.addClass("banLogin"),
            $("#navbar-login-user").attr("disabled", "disabled"),
            $("#navbar-login-password").attr("disabled", "disabled"))
    },
    resetLoginAction:function (){
        $.post('/oneaction',{type:"getsecurl",url:window.location.href},function (res) {
            $("#Login_form").attr('action',res)
            //
            // if (checkURL(res)){
            //
            // }
        })
    },
    articleClickInit:function(){
        if ($.support.pjax) {
            $("article[do-pjax]").unbind('click').bind('click',function (e){
                var url = $(this).data('url')

                $.pjax({url:url,container:'#pjax-container'});
            })
        }
        // 首页点赞
        $('.content-action').each(function (i, n) {
            $(n).find('.btn-like').on('click', function (e) {
                $(this).get(0).disabled = true;  //  禁用点赞按钮
                $.ajax({
                    url:$(this).data('link'),
                    type: 'post',
                    data: 'agree=' + $(this).attr('data-cid'),
                    async: true,
                    timeout: 30000,
                    cache: false,
                    //  请求成功的函数
                    success: function (data) {
                        var re = /\d/;  //  匹配数字的正则表达式
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
    },
    pjax_complete:function () {
        this.init()
        // this.loginBan()
        this.resetLoginAction()
    }
};
var archiveInit = {
    init:function (){
        this.archAuthorTabs = $(".react-tabs__tab-list")
        this.funcInit()
    },
    funcInit:function(){
        this.archiveEventInit()
        this.commentInit()
        this.fansFuncInit()
        this.circleFuncInit()
        this.archAuthorTabShowInit()
        this.archAuthorTabsClickInit()
    },
    fansFuncInit:function(){
        // 关注 event
        var fanBtn = $(".fan-event")
        fanBtn.unbind('click').bind('click',function (e) {
            if (userId > 0) {
                var status
                var authorid = parseInt($(this).data("authorid"))
                if ($.trim($(this).text()) === "关注") {
                    status = "follow"
                } else {
                    status = "unfollow"
                }
                if (parseInt(userId) === authorid) {
                    $.message({
                        title: "提示",
                        message: "自己不能关注自己！",
                        type: "warning"
                    })
                    return ;
                }
                $(this).attr("disabled", true);
                var btnThis = this
                $.post('/', {
                    followuser:1,
                    follow: status,
                    uid: userId,
                    fid: authorid
                }, function (res) {
                    if (res) {
                        if (status === "unfollow") {
                            $(btnThis).text("关注")
                            $(btnThis).addClass("fans")
                            $(btnThis).removeClass("fansed")
                            // window.location.reload()
                        } else {
                            $(btnThis).text("已关注")
                            $(btnThis).addClass("fansed")
                            $(btnThis).removeClass("fans")
                            // window.location.reload()

                        }
                    }
                    $(btnThis).attr("disabled", false);

                })
            } else {
                $.message({
                    title: "提示",
                    message: "没有登录！",
                    type: "warning"
                })

            }
        })
    },
    circleFuncInit:function(){
        // 关注 圈子event
        var circleBtn = $(".circle-event")
        circleBtn.unbind('click').bind('click',function (e) {
            if (userId > 0) {
                var status
                var circleid = parseInt($(this).data("categoryid"))
                if ($.trim($(this).text()) === "加入") {
                    status = "follow"
                } else {
                    status = "unfollow"
                }

                $(this).attr("disabled", true);
                var btnThis = this
                $.post('/', {
                    followcircle:1,
                    follow: status,
                    uid: userId,
                    mid: circleid
                }, function (res) {
                    if (res) {
                        if (status === "unfollow") {
                            $(btnThis).text("加入")
                            $(btnThis).addClass("fans")
                            $(btnThis).removeClass("fansed")
                            // window.location.reload()
                        } else {
                            $(btnThis).text("已加入")
                            $(btnThis).addClass("fansed")
                            $(btnThis).removeClass("fans")
                            // window.location.reload()

                        }
                    }
                    $(btnThis).attr("disabled", false);

                })
            } else {
                $.message({
                    title: "提示",
                    message: "没有登录！",
                    type: "warning"
                })

            }
        })
    },
    archAuthorTabShowInit:function(){
        // archive author tabs
        var react_tabs = $(".react-tabs__tab-list")
        if(react_tabs.length > 0 ){
            var baseoffset = react_tabs.first().offset().left
            var init_offset = $('.react-tabs__tab-list li').first().offset().left-baseoffset
            var line =  $('.line')
            line.css({
                'transform': 'translateX(' + init_offset + 'px)'
            })
            line.show()
        }
    },
    archAuthorTabsClickInit:function(){
        // archive tabs
        var that = this
        var react_tabs = $(".react-tabs__tab-list")
        if(react_tabs.length > 0 ){
            var baseoffset = react_tabs.first().offset().left
            var line =  $('.line')
            react_tabs.children().each(function (index, val) {
                $(val).click(function (e) {
                    var tabindex = $(val).data("tabindex")
                    $(this).addClass('react-tabs__tab--selected').siblings().removeClass('react-tabs__tab--selected');
                    line.width($(val).width());
                    var left = $(val).offset().left - baseoffset;
                    line.css({
                        'transform': 'translateX(' + left + 'px)'
                    })
                    // $.pjax({url:'?tabindex=' + tabindex,container:'.react-tabs'});

                    $.ajax({
                        url:'?tabindex=' + tabindex,
                        method:'get',
                        success:function (res){
                            var html_node = $.parseHTML(res)
                            try {
                                var items = $(".item-container",html_node)
                                if (items.length <= 0){
                                    return $.message({
                                        title: "通知",
                                        message: "服务器返回错误，请重试",
                                        type: "error"
                                    })
                                }else {
                                    var real_html = items.html()
                                    if ($(".pagination",html_node).length <= 0){
                                        $(".pagination").css("display","none")
                                    }else {
                                        $(".pagination").css("display","flex")
                                    }
                                    $(".item-container").html(real_html)
                                    // reinit click functions
                                    that.fansFuncInit()
                                    indexInput.articleClickInit()
                                }
                            }catch (e) {
                                console.log(e)
                            }
                        }
                    })
                })
            })
        }
    },
    archiveEventInit: function () {
        var that = this

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
                    var re = /\d/;  //  匹配数字的正则表达式
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
    },
    commentInit: function () {
        var $body = $('html,body');
        var g = '.comment-list'
            , h = '.comment-num'
            , i = '.comment-reply a'
            , j = '#textarea'
            , k = ''
            , l = '';
        c();
        var commentForm = $('#comment-form')
        var commentBtn = $(".submit.btn.comment-submit")
        commentBtn.unbind('click').bind('click',function (e) {
            $(this).attr("disabled",true)
            commentForm.submit()
        })
        commentForm.submit(function () {
            $.ajax({
                url: $(this).attr('action'),
                type: 'post',
                data: $(this).serializeArray(),
                error: function () {
                    alert("提交失败，请检查网络并重试或者联系管理员。");
                    commentBtn.attr("disabled",false)
                    return false
                },
                success: function (d) {
                    commentBtn.attr("disabled",false)
                    if (!$(g, d).length) {
                        alert("您输入的内容不符合规则或者回复太频繁，请修改内容或者稍等片刻。");
                        return false
                    } else {
                        k = $(g, d).html().match(/id=\"?comment-\d+/g).join().match(/\d+/g).sort(function (a, b) {
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
                        var f;
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
            $(i).click(function () {
                l = $(this).parent().parent().parent().attr("id")
            });
            $('#cancel-comment-reply-link').click(function () {
                l = ''
            })
        }
    },
    pjax_complete:function () {
        this.archiveEventInit()
        this.commentInit()
    }
}
$(function () {


    indexInput.init()
    archiveInit.init()

    // 根据时间
    var timeNow = new Date();
// 获取当前小时
    var hours = timeNow.getHours();
    // if (hours > 6 && hours < 19) {
    //     $('body').removeClass('theme-dark')
    // } else {
    //     $('body').addClass('theme-dark')
    // }
    // 加载不出时触发
    $(function(){
        $('img').on('error',function(){
            $(this).attr("src","https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=3031618999,450259559&fm=11&gp=0.jpg");
        })
    })

})

// index input prev link click event
function submitForm(ele) {
    // jquery 表单提交
    // add title
    var i = $(ele)
    i.val("发送中...")
    var title = $("#post-title")
    // var inputForm = $("#input-form")
    // add pic and links
    var textarea = $("#text")
    // var realtext = $("#realtext")

    var val = textarea.val()
    var myDate = new Date;
    var year = myDate.getFullYear(); //获取当前年
    var mon = myDate.getMonth() + 1; //获取当前月
    var date = myDate.getDate(); //获取当前日
    var datetime = year+"/"+mon+"/"+date

    if(val.length > 0 && val!==''){
        title.val(val.substring(0,15))
    }
    if (indexInput.nowtype === 'default'){
        if(val.length === 0 || val ===''){
            title.val("图文小记事~"+datetime)
        }
        if (indexInput.additionArray.length === 1){
            val = val + '\n\n'
            indexInput.additionArray.forEach(function (value){
                val = val + "![](" + value +")"
            })
            val = val + '\n\n'
        }else if (indexInput.additionArray.length > 1){
            val = val + '\n[gallery]'
            indexInput.additionArray.forEach(function (value){
                val = val + "![](" + value +")"
            })
            val = val + '[endgallery]\n'
        }
    }else if (indexInput.nowtype === 'link'){
        if (indexInput.additionArray.length > 0){
            if(indexInput.additionArray[1].length > 0 && indexInput.additionArray[1] !== ''){
                title.val(indexInput.additionArray[1].substring(0,15))
            }else{
                title.val("分享一个链接~"+datetime)
            }
            val = val + "["+indexInput.additionArray[1] + "](" + indexInput.additionArray[0] +")"
        }else {
            $.message({
                title:"提示",
                message:"请输入正确链接",
                type:'warning'
            })
            i.val("发送")
            return false;
        }
    }else if (indexInput.nowtype === 'video'){
        if (indexInput.additionArray.length > 0){
            if(val.length === 0 || val ===''){
                title.val("分享视频~"+datetime)
            }
            indexInput.additionArray.forEach(function (value){
                val = val+ '\n[video src="'+ value +'"]\n'
            })
        }
    }else if (indexInput.nowtype === 'bilibili'){
        if (indexInput.additionArray.length > 0){
            if(val.length === 0 || val ===''){
                title.val("分享bilibili视频~"+datetime)
            }
            indexInput.additionArray.forEach(function (value){
                val = val+ '\n[bilibili bv="'+ value +'" p="1"]\n'
            })
        }
    }
    // realtext.val(val)
    var len = val.length;
    if (len === 0 || val === '') {
        $.message({
            title:"提示",
            message:"要不输入点东西吧~",
            type:'warning'
        })
        i.val("发送")
        return false
    }
    var data = {
        title: title.val(),
        text: val,
        'fields[articleType]': indexInput.nowtype,
        'markdown': 1,
        'category[]': $("#category").val(),
        visibility: 'publish',
        allowComment: 1,
        allowPing: 1,
        allowFeed: 1,
        do: 'publish'
    }
    $.post('/oneaction',{
        type:'getsecuritytoken'
    },function (res) {
        if (res!=='error'){
            // console.log(res)
            $.ajax({
                url:'/action/contents-post-edit?do=publish&_='+res,
                type:'post',
                data:data,
                success:function (res) {
                    setTimeout(function (){
                        $.pjax.reload('#pjax-container', {
                            container: '#pjax-container',
                            fragment: '#pjax-container',
                            timeout: 8000
                        })
                        $.message({
                            title: "提示",
                            message: "发布成功，没出来的话就刷新一下吧",
                            type: "success"
                        })
                    },600)
                },
                error:function (err){
                    return $.message({
                        title: "提示",
                        message: "err:"+err,
                        type: "error"
                    })
                }
            })
        }
    })
    // inputForm.ajaxSubmit(function (result) {
    //     setTimeout(function () {
    //         $.pjax.reload('#pjax-container', {
    //             container: '#pjax-container',
    //             fragment: '#pjax-container',
    //             timeout: 8000
    //         })
    //     }, 1000)
    // });

    return false;
}

// video toggle
function videoToggle(idselector,this_){
    if(!$(this_).hasClass('video-slim')){
        $(this_).children().children('span:first-child').html('<svg width=".7em" height=".7em" viewBox="0 0 16 16" class="bi bi-arrows-angle-expand" fill="currentColor" xmlns="http://www.w3.org/2000/svg">\n' +
            '<path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707z"/>\n' +
            '</svg>')
        $(this_).children().children('span:last-child').text('展开')
        $(this_).addClass('video-slim')
    }else {
        $(this_).children().children('span:first-child').html('<svg class="bi bi-arrows-angle-contract" width=".7em" height=".7em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">\n' +
            '  <path fill-rule="evenodd" d="M9.5 2.036a.5.5 0 0 1 .5.5v3.5h3.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5z"/>\n' +
            '  <path fill-rule="evenodd" d="M14.354 1.646a.5.5 0 0 1 0 .708l-4.5 4.5a.5.5 0 1 1-.708-.708l4.5-4.5a.5.5 0 0 1 .708 0zm-7.5 7.5a.5.5 0 0 1 0 .708l-4.5 4.5a.5.5 0 0 1-.708-.708l4.5-4.5a.5.5 0 0 1 .708 0z"/>\n' +
            '  <path fill-rule="evenodd" d="M2.036 9.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V10h-3.5a.5.5 0 0 1-.5-.5z"/>\n' +
            '</svg>')
        $(this_).children().children('span:last-child').text('收缩')
        $(this_).removeClass('video-slim')


    }

    $(idselector).collapse('toggle');
}
function checkURL(URL) {
    var str = URL;
    var Expression = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[\-;:&=\+\$,\w]+@)?[A-Za-z0-9\.\-]+|(?:www\.|[\-;:&=\+\$,\w]+@)[A-Za-z0-9\.\-]+)((?:\/[\+~%\/\.\w\-_]*)?\??(?:[\-\+=&;%@\.\w_]*)#?(?:[\.\!\/\\\w]*))?)/;
    var objExp = new RegExp(Expression);
    return objExp.test(str) === true;
}

// comment
$(function () {
    $(window).scroll(function () {
        var scroHei = $(window).scrollTop();
        if (scroHei > 400) {
            // $('.back-to-top').show()

            $('.back-to-top').slideDown('fast');
        }else {

            $('.back-to-top').slideUp('fast');
        }
    })
    $('.back-to-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
    })

})
// 另一种 backTotop
// var scrolltotop={
//
//     //startline: Integer. Number of pixels from top of doc scrollbar is scrolled before showing control
//
//     //scrollto: Keyword (Integer, or "Scroll_to_Element_ID"). How far to scroll document up when control is clicked on (0=top).
//
//     setting: {startline:100, scrollto: 0, scrollduration:500, fadeduration:[500, 100]},
//
//     controlHTML: '<img src="https://down.inwao.com/img/arrow5.png" />', //HTML for control, which is auto wrapped in DIV w/ ID="topcontrol"
//
//     controlattrs: {offsetx:30, offsety:30}, //offset of control relative to right/ bottom of window corner
//
//     anchorkeyword: 'javascript:scroll(0,0)', //Enter href value of HTML anchors on the page that should also act as "Scroll Up" links
//
//     state: {isvisible:false, shouldvisible:false},
//
//
//     scrollup:function(){
//
//         if (!this.cssfixedsupport) //if control is positioned using JavaScript
//
//             this.$control.css({opacity:0}) //hide control immediately after clicking it
//
//         var dest=isNaN(this.setting.scrollto)? this.setting.scrollto : parseInt(this.setting.scrollto)
//
//         if (typeof dest=="string" && jQuery('#'+dest).length==1) //check element set by string exists
//
//             dest=jQuery('#'+dest).offset().top
//
//         else
//
//             dest=0
//
//         this.$body.animate({scrollTop: dest}, this.setting.scrollduration);
//
//     },
//
//
//     keepfixed:function(){
//
//         var $window=jQuery(window)
//
//         var controlx=$window.scrollLeft() + $window.width() - this.$control.width() - this.controlattrs.offsetx
//
//         var controly=$window.scrollTop() + $window.height() - this.$control.height() - this.controlattrs.offsety
//
//         this.$control.css({left:controlx+'px', top:controly+'px'})
//
//     },
//
//
//     togglecontrol:function(){
//
//
//
//         var scrolltop=jQuery(window).scrollTop()
//
//         if (!this.cssfixedsupport)
//
//             this.keepfixed()
//
//         this.state.shouldvisible=(scrolltop>=this.setting.startline)? true : false
//
//         if (this.state.shouldvisible && !this.state.isvisible){
//
//             this.$control.stop().animate({opacity:1}, this.setting.fadeduration[0])
//
//             this.state.isvisible=true
//
//         }
//
//         else if (this.state.shouldvisible==false && this.state.isvisible){
//
//             this.$control.stop().animate({opacity:0}, this.setting.fadeduration[1])
//
//             this.state.isvisible=false
//
//         }
//     },
//
//     init:function(){
//         jQuery(document).ready(function($){
//             var mainobj=scrolltotop
//             var iebrws=document.all
//             mainobj.cssfixedsupport=!iebrws || iebrws && document.compatMode=="CSS1Compat" && window.XMLHttpRequest //not IE or IE7+ browsers in standards mode
//             mainobj.$body=(window.opera)? (document.compatMode=="CSS1Compat"? $('html') : $('body')) : $('html,body')
//             mainobj.$control=$('<div id="topcontrol">'+mainobj.controlHTML+'</div>')
//                 .css({position:mainobj.cssfixedsupport? 'fixed' : 'absolute', bottom:mainobj.controlattrs.offsety, right:mainobj.controlattrs.offsetx, opacity:0, cursor:'pointer'})
//                 .attr({title:'Scroll to Top'})
//                 .click(function(){mainobj.scrollup(); return false})
//                 .appendTo('body')
//             if (document.all && !window.XMLHttpRequest && mainobj.$control.text()!='') //loose check for IE6 and below, plus whether control contains any text
//                 mainobj.$control.css({width:mainobj.$control.width()}) //IE6- seems to require an explicit width on a DIV containing text
//             mainobj.togglecontrol()
//
//             $('a[href="' + mainobj.anchorkeyword +'"]').click(function(){
//                 mainobj.scrollup()
//                 return false
//             })
//             $(window).bind('scroll resize', function(e){
//                 mainobj.togglecontrol()
//             })
//         })
//     }
// }
// scrolltotop.init()



