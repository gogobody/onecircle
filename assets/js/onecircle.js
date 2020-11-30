console.log(' %c Theme onecircle %c https://github.com/gogobody/onecircle', 'color:#444;background:#eee;padding:5px 0', 'color:#eee;background:#444;padding:5px');
// tools functions

// 过滤所有特殊字符
var stripscript = function (s) {
    var pattern = new RegExp("[`^()|{}'\\[\\].<>/?~！……*——|{}‘”“↵\r\n]");
    var rs = "";
    for (var i = 0; i < s.length; i++) {
        rs = rs + s.substr(i, 1).replace(pattern, '');
    }
    return rs;
}


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
        },
        showloading: function (options) {
            var defaultOptions = {
                selector: 'header',
                choice: 'append'// prepend ,after ,before
            }
            var newoption = $.extend({}, defaultOptions, options)
            var htm = '<div class="loading-container"><svg width="120" height="12px" viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="#03A9F5" class="loading-svg"><circle cx="15" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="60" cy="15" r="9" fill-opacity="0.3"><animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="105" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle></svg></div>'
            if (typeof newoption.selector === "string") {
                var selec = $(newoption.selector)
                if (newoption.choice === 'append') {
                    selec.append(htm)
                } else if (newoption.choice === 'prepend') {
                    selec.prepend(htm)
                } else if (newoption.choice === 'after') {
                    selec.after(htm)
                } else if (newoption.choice === 'before') {
                    selec.before(htm)
                }
            }
        },
        rmloading: function () {
            $(".loading-container").remove()
        }
    });
})


var indexInput = {
    init: function () {
        this.loginUserName = ""
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
    funcInit: function () {
        this.indexEventInit()
        this.login_ajax()
        this.searchEventInit()
        this.articleClickInit()
        this.asideEventInit()
    },
    resetInputStatus: function () {// reset status when change nowtype
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
    doParseDefaultFunc: function (this_, that) {
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
            $(".cPHQWG").unbind('click').bind('click', function () {
                var imgUrl = $(this).parent().css("backgroundImage").replace('url(', '').replace(')', '')
                that.additionArray.splice($.inArray(imgUrl, that.additionArray), 1);
                $(this).parent().parent().remove()
                if (that.additionArray.length === 0) {
                    that.addPicBtn.siblings().removeClass('btn-disable')
                }
            })

        } else {
            $.message({
                title: "提示",
                message: "请输入正确的图片地址",
                type: "error"
            })

        }
        $(this_).html("添加")

    },
    doParseLinkFunc: function (this_, that) {
        $(this_).text("解析中")
        var val = $(".add-area input").val()
        if (checkURL(val)) {
            $.post(gconf.oneaction, {
                type: "parsemeta",
                url: val
            }, function (res) {
                if (res.code) {
                    var inTextareaBlk = $(".sc-AxjAm.kgcKxQ")
                    inTextareaBlk.css("display", "block")
                    inTextareaBlk.attr("href", val)
                    $(".sc-AxjAm.kgcKxQ .hHnMup").html(res.data)
                    that.additionArray = [] // reset additionArr
                    that.additionArray.push(val)
                    that.additionArray.push(stripscript(res.data))
                    $(this_).text("添加")
                    // set other disable
                    that.addLinkBtn.siblings().addClass('btn-disable')
                    // close closeTextareaBlk
                    $(".sc-AxjAm.sc-AxirZ.ezTcmd").unbind('click').bind('click', function (e) {
                        $(".kgcKxQ").css("display", "none")
                        e.stopPropagation();
                        that.addLinkBtn.siblings().removeClass('btn-disable')
                        return false;
                    })
                }else {
                    $.message({
                        title:"提示",
                        message:"解析失败",
                        type:"error"
                    })
                    console.log(res)
                }
                $(this_).text("添加")
            })
        } else {
            $.message({
                title: "提示",
                message: "请输入正确的地址",
                type: "error"
            })
            $(this_).text("添加")
        }
    },
    doParseVideoFunc: function (this_, that) {
        var addAreaInput = $(".add-area input")
        var val = addAreaInput.val()
        if (checkURL(val)) {
            that.additionArray.push(val)
            var node =
                '<div class="show-panel-inner"><div class="jLaetV"><div class="hHnMup">' + val + '</div></div>\n' +
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
            $(".show-close").unbind('click').bind('click', function () {
                var videoUrl = $(this).siblings().text()
                that.additionArray.splice($.inArray(videoUrl, that.additionArray), 1);
                $(this).parent().remove()
                if (that.additionArray.length === 0) {
                    that.addVideoBtn.siblings().removeClass('btn-disable')
                }
            })
        } else {
            $.message({
                title: "提示",
                message: "请输入正确的视频地址",
                type: "error"
            })

        }

    },
    doParseBilibiliFunc: function (this_, that) {
        var addAreaInput = $(".add-area input")
        var val = addAreaInput.val()
        that.additionArray.push(val)
        var node =
            '<div class="show-panel-inner"><div class="jLaetV"><div class="hHnMup">' + val + '</div></div>\n' +
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
        $(".show-close").unbind('click').bind('click', function () {
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
        $("#addpic").unbind('click').bind('click', function () {
            $(".add-area input").attr("placeholder", "请输入图片链接")
            if (that.nowtype !== 'default') {
                that.addArea.show()
                that.uploadPic.show()
            } else {
                that.addArea.toggle()
                that.uploadPic.toggle()
            }
            that.changeType('default')

        })

        // process add link click
        $("#addlink,#addvideo,#addbilibili").unbind('click').bind('click', function () {
            that.uploadPic.hide()
            var type = $(this).data("type")
            if (type === 'link') {
                $(".add-area input").attr("placeholder", "请输入链接")
            } else if (type === 'video') {
                $(".add-area input").attr("placeholder", "请输入视频链接")
            } else if (type === 'bilibili') {
                $(".add-area input").attr("placeholder", "请输入bv号")
            }
            if (that.nowtype !== type) {
                that.addArea.show()
            } else {
                that.addArea.toggle()
            }
            that.changeType(type)

        })
        this.addAreaBtn.unbind('click').bind('click', function () {
            if (that.nowtype === 'default') {
                that.doParseDefaultFunc(this, that)
            } else if (that.nowtype === 'link') {
                that.doParseLinkFunc(this, that)
            } else if (that.nowtype === 'video') {
                that.doParseVideoFunc(this, that)
            } else if (that.nowtype === 'bilibili') {
                that.doParseBilibiliFunc(this, that)
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
        searchBtn.unbind('click').bind('click', function () {
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

        function enableBtn() {
            loginSubmitForm.attr("disabled", false).fadeTo("", 1)
        }

        this.canLogin = true // prevent multi submit
        $("#Login_form").submit(function () {
            if (!that.canLogin) return
            that.canLogin = false
            var formThis = this
            if ($(this).hasClass("banLogin")) return location.reload(), !1;
            loginSubmitForm.attr("disabled", !0).fadeTo("slow", .5);
            var username_ = navLoginUser.val(), c = navLoginPsw.val();
            return "" === username_ ? (
                that.canLogin = true,
                    $.message({
                        title: "登录通知",
                        message: "必须填写用户名",
                        type: "warning"
                    }), navLoginUser.focus(), showbtn(), !1) : "" === c ? (that.canLogin = true, $.message({
                title: "登录通知",
                message: "请填写密码",
                type: "warning"
            }), navLoginPsw.focus(), showbtn(), !1) : (loginSubmitForm.addClass("active"), $("#spin-login").addClass("show inline"),
                $.post(gconf.oneaction, {type: "getsecurl", url: window.location.href}, function (res) {
                    if (!res.code) return $.message({
                        title: "提示",
                        message: "获取securl失败",
                        type: "error"
                    })
                    $("#Login_form").attr('action', res.data)
                    $.ajax({
                        url: res.data,
                        type: $(formThis).attr("method"),
                        data: $(formThis).serializeArray(),
                        error: function () {
                            that.canLogin = true
                            return $.message({
                                title: "登录通知",
                                message: "提交出错",
                                type: "error"
                            }), enableBtn()
                        },
                        success: function (b) {
                            b = $.parseHTML(b)
                            loginSubmitForm.removeClass("active")
                            $("#spin-login").removeClass("show inline");

                            try {
                                if ($("#Logged-in", b).length <= 0) {
                                    that.canLogin = true
                                    enableBtn()
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
                                that.canLogin = true
                                that.loginUserName = username_
                                setTimeout(function () {
                                    location.reload()
                                }, 500)
                            } catch (a) {
                                alert("按下F12，查看输出错误信息")
                                that.canLogin = true
                            }
                        }
                    })
                }), !1)
        })
    },
    loginBan: function () { // no use now
        var loginform = $("#Login_form")
        loginform.hasClass("banLogin") || (loginform.addClass("banLogin"),
            $("#navbar-login-user").attr("disabled", "disabled"),
            $("#navbar-login-password").attr("disabled", "disabled"))
    },
    resetLoginAction: function (func) {
        if (userId > 0) {
            return
        }
        $.post(gconf.oneaction, {type: "getsecurl", url: window.location.href}, function (res) {
            if (!res.code) return $.message({
                title: "提示",
                message: "获取securl失败",
                type: "error"
            })
            $("#Login_form").attr('action', res.data)
            //
            // if (checkURL(res)){
            //
            // }
            func()
        })
    },
    articleClickInit: function () {
        if ($.support.pjax) {
            var articleEle = $("article[do-pjax]")
            articleEle.unbind().bind('click', function (e) {
                var url = $(this).data('url')
                // filter
                if (e.target.tagName === "IMG") {
                    // console.log(e.target.tagName)
                    // return false; //阻止默认行为
                } else {
                    $.pjax({url: url, container: '#pjax-container'});
                }
            })


        }
        // 首页点赞
        $('.content-action').each(function (i, n) {
            $(n).find('.btn-like').on('click', function (e) {
                $(this).get(0).disabled = true;  //  禁用点赞按钮
                $.ajax({
                    url: $(this).data('link'),
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
    asideEventInit: function () {
        var asideBtn = $(".aside-btn")
        var aside = $('#aside')
        var footer = $('footer')
        asideBtn.unbind('click').bind('click', function () {
            if (aside.hasClass('off-screen')) {
                aside.removeClass('off-screen')
                footer.show()
            } else {
                aside.addClass('off-screen')
                footer.hide()
            }
        })
        $(".off-screen-toggle").unbind('click').bind('click', function () {
            $("#aside").toggleClass("off-screen")
        })
        $("#aside .nav-menu").unbind('click').bind('click', function () {
            $("#aside").toggleClass("off-screen")
        })
    },
    pjax_complete: function () {
        this.init()
        // this.loginBan()

    }
};
var archiveInit = {
    init: function () {
        this.funcInit()
    },
    funcInit: function () {
        this.archiveEventInit()
        this.commentInit()
        this.fansFuncInit()
        this.circleFuncInit()
        this.repostFuncInit()
        this.archAuthorTabShowInit()
        this.archAuthorTabsClickInit()
        this.iasInit()
        this.lazyloadInit()

    },
    postRepostArticle: function (posthref, excert, rbannerimg, repousername, repostext, category) {
        // 转发 默认 发到 category 1
        if (userId < 0) {
            $.message({
                title: "提示",
                message: "请登录后操作",
                type: "error"
            })
            return false
        }
        var fromusernm = indexInput.loginUserName
        var data = {
            title: fromusernm + "转发了" + repostext.substring(0, 20),
            text: "[repost href=\"" + posthref + "\" bannerimg=\"" + rbannerimg + "\" repousername=\"" + repousername + "\" repostext=\"" + repostext + "\" category=\'" + category + "\']",
            'fields[articleType]': 'repost',
            'fields[excerpt]': excert,
            'markdown': 1,
            'category[]': 1,
            visibility: 'publish',
            allowComment: 1,
            allowPing: 1,
            allowFeed: 1,
            do: 'publish'
        }
        postArticle(data, false);

    },
    repostFuncInit: function () {
        var repostComment = $("#repostComment")
        $(".share-btn").unbind('click').bind('click', function (e) {
            $("#repostModal").modal('show')
            $('#repostModal').on('shown.bs.modal', function () {
                repostComment.focus();//获取焦点
            });
        })
        $("#repostBtn").unbind("click").bind("click", function (e) {
            var comment = repostComment.val()
            var posthref = repostComment.data("posthref")
            // get article img
            var imgReg = /<img.*?(?:>|\/>)/i;
            var srcReg = /src=[\'\"]?([^\'\"]*)[\'\"]?/i;
            var str = $(".article-content").html()
            var arr = str.match(imgReg);
            var imgurl = ''
            if (arr && arr.length > 0) {
                var img_ = arr[0].match(srcReg)
                if (img_ && img_.length > 0) {
                    imgurl = img_[1]
                }
            }
            //try onece more, like baidu src="hts//xxxx&src=hxxx"
            var more = imgurl.match(srcReg)
            if (more && more.length > 0) {
                imgurl = more[1]
            }
            // get article img end
            var repousername = repostComment.data("username")
            var repostext = repostComment.data("excerpt")
            var category = repostComment.data("category")
            if (repostext === 'undefine') repostext = ''
            archiveInit.postRepostArticle(posthref, comment, imgurl, repousername, repostext, category)
            $("#repostModal").modal('hide')
        })
        // fix repost a click
        $(".repost-row a").unbind('cilck').bind('click', function (e) {
            var url = $(this).attr("href")
            $.pjax({url: url, container: '#pjax-container'})
            e.stopPropagation()
        })
    },
    postFansArticle: function (tohref, toavatar, tousername, tosign) {
        $.post(gconf.oneaction, {type: "getfocusmid"}, function (res) {
            if (res) {
                var mid = parseInt(res)
                var fromusernm = indexInput.loginUserName
                var data = {
                    title: fromusernm + "关注了圈友" + tousername,
                    text: "[focususer href=\"" + tohref + "\" avatar=\"" + toavatar + "\" username=\"" + tousername + "\" sign=\"" + tosign + "\" ]",
                    'fields[articleType]': 'focususer',
                    'fields[excerpt]': "关注了圈友" + tousername,
                    'markdown': 1,
                    'category[]': mid,
                    visibility: 'publish',
                    allowComment: 1,
                    allowPing: 1,
                    allowFeed: 1,
                    do: 'publish'
                }
                postArticle(data, false);
            } else {
                console.log(res)
            }
        })

    },
    fansFuncInit: function () {
        // 关注 event
        var fanBtn = $(".fan-event")
        var that = this
        fanBtn.unbind('click').bind('click', function (e) {
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
                    return;
                }
                $(this).attr("disabled", true);
                var btnThis = this
                $.post(gconf.index, {
                    followuser: 1,
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
                            // 关注事件有 30% 概率发一条 post
                            var rate_ = Math.random()
                            if (rate_ <= 0.3) {
                                var userhref, usreavatr, username, usersign
                                if ($(btnThis).attr("data-author_page")) { // btn in author page banner
                                    userhref = $(btnThis).parent().siblings().data("authorhref")
                                    usreavatr = $(".author-avatar").attr("src")
                                    username = $(".author_page-name").text()
                                    usersign = $(".author-sign").text()
                                } else { // btn in focus list
                                    var focusEle = $(btnThis).parent().siblings()
                                    userhref = focusEle.attr("href")
                                    usreavatr = focusEle.children("img").attr("src")
                                    username = focusEle.children("div").children(".oDrAC").text()
                                    usersign = focusEle.children("div").children(".ezzhLs").text()
                                }
                                that.postFansArticle(userhref, usreavatr, username, usersign)
                            }
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
    circleFuncInit: function () {
        // 关注 圈子event
        var circleBtn = $(".circle-event")
        circleBtn.unbind('click').bind('click', function (e) {
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
                $.post(gconf.index, {
                    followcircle: 1,
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
    archAuthorTabShowInit: function () {
        // archive author tabs
        var react_tabs = $(".react-tabs__tab-list")
        var react_tabs_li = react_tabs.find('li:first-child')
        if (react_tabs.length > 0) {
            setTimeout(function () { // 延迟100s 让css 充分渲染
                var baseoffset = react_tabs.first().offset().left
                var init_offset = react_tabs_li.first().offset().left - baseoffset
                // alert(baseoffset+",  "+react_tabs_li.first().offset().left +",  "+init_offset)
                var line = $('.line')
                line.css({
                    'transform': 'translateX(' + init_offset + 'px)'
                })
                line.show()
            }, 100)
        }
    },
    archiveLoadRebindInit: function () {
        // reinit click functions after 加载更多或者 tabs 切换
        archiveInit.fansFuncInit()
        indexInput.articleClickInit()
        archiveInit.lazyloadInit()
    },
    archAuthorTabsClickInit: function () {
        // archive tabs
        var that = this
        var react_tabs = $(".react-tabs__tab-list")
        if (react_tabs.length > 0) {
            var baseoffset = react_tabs.first().offset().left
            var line = $('.line')
            react_tabs.children().each(function (index, val) {
                $(val).click(function (e) {
                    var tabindex = $(val).data("tabindex")
                    $(this).addClass('react-tabs__tab--selected').siblings().removeClass('react-tabs__tab--selected');
                    line.width($(val).width());
                    var left = $(val).offset().left - baseoffset;
                    line.css({
                        'transform': 'translateX(' + left + 'px)'
                    })

                    $.ajax({
                        url: '?tabindex=' + tabindex,
                        method: 'get',
                        success: function (res) {
                            var html_node = $.parseHTML(res)
                            try {
                                var items = $(".item-container", html_node)
                                if (items.length <= 0) {
                                    return $.message({
                                        title: "通知",
                                        message: "服务器返回错误，请重试",
                                        type: "error"
                                    })
                                } else {
                                    var real_html = items.html()
                                    if ($(".pagination", html_node).length <= 0 && (tabindex === 1 || tabindex === 2)) {
                                        $(".pagination").css("display", "none")
                                    } else if ($(".pagination", html_node).length > 0 && (tabindex === 0 || tabindex === 3)) {
                                        $(".pagination").css("display", "flex")
                                    }
                                    $(".item-container").html(real_html)
                                    // 删除某个前缀开头的类
                                    var archiveContent = $(".archive-content")
                                    archiveContent.removeClass(function (index, className) {
                                        return (className.match(/(^|\s)tabindex-\S+/g) || []).join('');
                                    });
                                    archiveContent.addClass('tabindex-' + tabindex)
                                    // reinit click functions
                                    archiveInit.archiveLoadRebindInit()
                                }
                            } catch (e) {
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
            $(this).children().css("fill", "rgb(228, 88, 62)")
            //  发送 AJAX 请求
            $.ajax({
                //  请求方式 post
                url: gconf.index,
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
        commentBtn.unbind('click').bind('click', function (e) {
            $(this).attr("disabled", true)
            commentForm.submit()
        })
        commentForm.submit(function () {
            var formdata = $(this).serializeArray()
            if ($.trim(formdata[0]["value"]) === "") {
                $.message({
                    title: "提示",
                    message: "请输入内容",
                    type: "error"
                })
                commentBtn.attr("disabled", false)
                return false;
            } else {
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'post',
                    data: $(this).serializeArray(),
                    error: function () {
                        alert("提交失败，请检查网络并重试或者联系管理员。");
                        commentBtn.attr("disabled", false)
                        return false
                    },
                    success: function (d) {
                        commentBtn.attr("disabled", false)
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
            }

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
    lazyloadInit: function () {

    },
    iasInit: function () { // 无限加载
        var a_pagelink = $(".a-pageLink .next")
        if (a_pagelink.length > 0) {
        } else {
            a_pagelink.attr("style", "display:none");
        }
        a_pagelink.unbind('click').bind('click', function () {
            var href = $(this).attr("href");
            var donut = $(".a-pageLink .donut")
            if (href !== undefined) {
                $.ajax({
                    url: href,
                    type: "get",
                    beforeSend: function () {
                        a_pagelink.hide();
                        donut.fadeIn();
                    },
                    error: function (res) {
                    },
                    success: function (data) {
                        var $res = $(data).find(".post-article");
                        donut.hide();
                        $('.list').append($res).fadeIn();
                        var newhref = $(data).find(".a-pageLink .next").attr("href");
                        if (newhref !== undefined) {
                            a_pagelink.attr("href", newhref);
                            a_pagelink.fadeIn();
                        } else {
                            a_pagelink.attr("style", "display:none");
                            $(".a-pageLink").append('<a href="javascript:;" rel="nofollow">加载完毕</a>');
                        }
                        archiveInit.archiveLoadRebindInit()
                    }
                });
            }
            return false;
        });
        var comments_pagelink = $(".a-pageLink .comments-next")
        if (comments_pagelink.length > 0) {
        } else {
            comments_pagelink.attr("style", "display:none");
        }
        comments_pagelink.unbind('click').bind('click', function () {
            var href = $(this).attr("href");
            var donut = $(".a-pageLink .donut")
            if (href !== undefined) {
                $.ajax({
                    url: href,
                    type: "get",
                    beforeSend: function () {
                        comments_pagelink.hide();
                        donut.fadeIn();
                    },
                    error: function (res) {
                    },
                    success: function (data) {
                        var $res = $(data).find(".comment-detail>.comment-list>.comment-list-item");
                        donut.hide();
                        $('.comment-detail>.comment-list').append($res).fadeIn();
                        var newhref = $(data).find(".a-pageLink .comments-next").attr("href");
                        if (newhref !== undefined) {
                            comments_pagelink.attr("href", newhref);
                            comments_pagelink.fadeIn();
                        } else {
                            comments_pagelink.attr("style", "display:none");
                            $(".a-pageLink").append('<a href="javascript:;" rel="nofollow">加载完毕</a>');
                        }
                    }
                });
            }
            return false;
        });
    },
    pjax_complete: function () {
        this.archiveEventInit()
        this.commentInit()
        this.repostFuncInit()
        this.archAuthorTabShowInit()
        this.iasInit()
        this.lazyloadInit()
    }
};
var recommendInit = {
    init: function () {
        this.autoDirayWith()
    },
    autoDirayWith: function () {
        var bgs = document.getElementsByClassName("diary-item");
        for (var i = 0; i < bgs.length; i++) {
            bgs[i].style.height = bgs[i].offsetWidth + 'px';
        }
    },
    pjax_complete: function () {
        this.autoDirayWith()
    }
}
var tagsManageInit = {
    init: function () {
        this.circleEditBtn()
    },
    circleEditBtn: function () {
        var ebtn = $(".circle-item .edit-btn button")
        var editSaveBtn = $("#circle-edit-save")
        var catiod = -1
        ebtn.unbind('click').bind('click', function (e) {

            catiod = parseInt($(this).data("categoryid"))
            var name = $(this).data("name")
            $("#selectCircle").val(name)
            $('#changeCatagModal').modal('show')

        })
        editSaveBtn.unbind('click').bind('click', function (e) {
            if (!catiod > 0) return
            var selectId = $("#changeCircle").val()
            $.ajax({
                data: {
                    url: gconf.index,
                    changeCircleCat: 1,
                    mid: catiod,
                    changetomid: selectId
                },
                method: 'POST',
                success: function (res) {
                    if (res === 'success') {
                        $.message({
                            title: "通知",
                            message: "更改成功，刷新后可见",
                            type: "info"
                        })
                    }
                    $('#changeCatagModal').modal('hide')
                },
                error: function (e) {
                    console.log(e)
                    $('#changeCatagModal').modal('hide')
                }
            })
        })
    },
    pjax_complete: function () {
        this.circleEditBtn()
    },

};
var oneMap = { // use js only!
    AMapUrl: "https://webapi.amap.com/loader.js",
    init: function (AMap) {
        if (!AMap) return false;
        this.AMap = AMap
        this.autoCompleteInit(AMap)
        this.geolocationInit(AMap)
        this.mapContainerInit(AMap, this.geolocation)
    },
    pjax_complete: function () {
        if (!oneMap.AMap) {
            $.getScript(oneMap.AMapUrl, function () {
                oneMap.amapLoadInit()
            })
        } else {
            oneMap.autoCompleteInit(oneMap.AMap)
            oneMap.mapContainerInit(oneMap.AMap, oneMap.geolocation)
        }
        this.restoreFromLocal()
    },
    amapLoadInit: function () {
        if (userId < 0) return; // not login
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('POST', gconf.oneaction, true);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//设置请求头 注：post方式必须设置请求头（在建立连接后设置请求头）
        httpRequest.send('type=amapKey');//发送请求 将情头体写在send中
        httpRequest.onreadystatechange = function () {//请求后的回调接口，可将请求成功后要执行的程序写在其中
            if (httpRequest.readyState === 4 && httpRequest.status === 200) {//验证请求是否发送成功
                var json = httpRequest.responseText;//获取到服务端返回的数据
                json = JSON.parse(json)
                if (json.status) {
                    localStorage.setItem("amapkey", json.data)
                    AMapLoader.load({
                        "key": json.data.jskey,              // 申请好的Web端开发者Key，首次调用 load 时必填
                        "version": "1.4.15",   // 指定要加载的 JSAPI 的版本，缺省时默认为 1.4.15
                        "plugins": ['AMap.Autocomplete', 'AMap.Geolocation', 'AMap.Geocoder', 'AMap.Marker'],      // 需要使用的的插件列表，如比例尺'AMap.Scale'等
                    }).then(function (AMap) {
                        oneMap.init(AMap)
                    }).catch(function (e) {
                        console.error(e);  //加载错误提示
                        $.message({
                            type: "error",
                            title: "提示",
                            message: "获取amapJsKey失败"
                        })
                    });
                } else {
                    $.message({
                        type: "error",
                        title: "提示",
                        message: "获取amapJsKey失败"
                    })
                }
            }
        };
    },
    restoreFromLocal: function () {
        var obj = localStorage.getItem('address')
        if (obj) {
            obj = JSON.parse(obj)
            var add = document.getElementById("ad-address")
            if (add) {
                var addinputBtn = document.getElementById("address-input")
                addinputBtn.value = obj.name
                addinputBtn.style.width = "fit-content"
                document.getElementById("ad-name").value = obj.name
                document.getElementById("ad-district").value = obj.district
                add.value = obj.address
            }
        }
    },
    save2local: function (name, district, address) {
        var obj = JSON.stringify({'name': name, 'district': district, 'address': address})
        localStorage.setItem('address', obj)
    },
    geolocationInit: function (AMap) {
        var geolocation = new AMap.Geolocation({
            enableHighAccuracy: true,//是否使用高精度定位，默认:true
            position: 'RB',    //定位按钮的停靠位置
            buttonOffset: new AMap.Pixel(10, 20),//定位按钮与设置的停靠位置的偏移量，默认：Pixel(10, 20)
            zoomToAccuracy: true,   //定位成功后是否自动调整地图视野到定位点
            getCityWhenFail: true,
            needAddress: true
        });
        this.geolocation = geolocation
        geolocation.getCurrentPosition(function (status, result) {
            if (status === 'complete') {
                // console.log(result);
                if (result.status) {
                    var addBtn = document.getElementById("address-input")
                    if (addBtn) {
                        new AMap.Autocomplete().search(result.formattedAddress, function (status, res) {
                            if (res.count > 0) {
                                addBtn.value = res.tips[0].name
                                addBtn.style.width = "fit-content"
                                document.getElementById("ad-name").value = res.tips[0].name
                                document.getElementById("ad-district").value = res.tips[0].district
                                document.getElementById("ad-address").value = res.tips[0].address
                                oneMap.save2local(res.tips[0].name, res.tips[0].district, res.tips[0].address)
                            }
                        })
                    }
                } else {

                }
            } else {
                $.message({
                    title: '定位失败',
                    message: '失败原因排查信息:' + result.message,
                    type: 'error'
                })
            }
        });
    },
    autoCompleteInit: function (AMap) {
        // init auto complete
        var add_name = document.getElementById("ad-name")
        if (add_name) {
            var autoOptions = {
                city: '全国',
                input: 'address-input'
            }
            this.autoComplete = new AMap.Autocomplete(autoOptions)
            this.autoComplete.on("select", function (e) {
                add_name.value = e.poi.name
                document.getElementById("ad-district").value = e.poi.district
                document.getElementById("ad-address").value = e.poi.address
                oneMap.save2local(e.poi.name, e.poi.district, e.poi.address)
            })
        }

    },
    mapContainerInit: function (AMap, geoLocation) {
        if (!this.geocoder || !this.marker) {
            this.geocoder = new AMap.Geocoder({});
            this.marker = new AMap.Marker();
        }

        if (document.getElementById("amap-container")) {
            var map = new AMap.Map('amap-container', {
                resizeEnable: true,
                zoom: 15,
                mapStyle: "amap://styles/fresh"
            });
            var addr = utils.getQueryString('name') // this is for neighbor widget
            if (addr) {
                var marker = this.marker
                this.geocoder.getLocation(district + addr, function (status, result) {
                    if (status === 'complete' && result.geocodes.length) {
                        var lnglat = result.geocodes[0].location
                        marker.setPosition(lnglat)
                        map.add(marker)
                        map.setFitView(marker)
                    } else {
                        console.error('根据地址查询位置失败')
                    }
                });
            } else {
                map.addControl(geoLocation)
            }
        }

    }
}

// 浮动按钮
var floatEle = {
    init: function () {
        this.fabtns = $('#float_action_buttons')
        this.backToTopBtn = $('#fabtn_back_to_top')
        this.toggleSidesBtn = $('#fabtn_toggle_sides')
        this.readingProgressBar = $('#fabtn_reading_progress_bar')
        this.readingProgressDetails = $('#fabtn_reading_progress_details')
        this.goToComment = $('#fabtn_go_to_comment')
        this.isScrolling = false
        this.eventInit()
        this.changefabtnDisplayStatus()
    },
    eventInit: function () {
        var that = this
        this.backToTopBtn.on("click", function () {
            if (!floatEle.isScrolling) {
                floatEle.isScrolling = true;
                setTimeout(function () {
                    floatEle.isScrolling = false;
                }, 600);
                $("body,html").animate({
                    scrollTop: 0
                }, 600);
            }
        })

        if ($("#comment").length > 0) {
            $("#fabtn_go_to_comment").removeClass("d-none")
        } else {
            $("#fabtn_go_to_comment").addClass("d-none")
        }
        //
        this.goToComment.on("click", function () {
            gotoHash("#comment", 600)
            $("#post_comment_content").focus()
        })
        if (localStorage['Argon_fabs_Floating_Status'] === "left") {
            this.fabtns.addClass("fabtns-float-left");
        }
        this.toggleSidesBtn.on("click", function () {
            that.fabtns.addClass("fabtns-unloaded");
            setTimeout(function () {
                that.fabtns.toggleClass("fabtns-float-left");
                if (that.fabtns.hasClass("fabtns-float-left")) {
                    localStorage['Argon_fabs_Floating_Status'] = "left"
                } else {
                    localStorage['Argon_fabs_Floating_Status'] = "right"
                }
                that.fabtns.removeClass("fabtns-unloaded")
                that.hideAlltoolTip()
            }, 300);
        })
        this.fabtns.removeClass("fabtns-unloaded")
    },
    changefabtnDisplayStatus: function () {
        //阅读进度
        var readingProgress = $(window).scrollTop() / Math.max($(document).height() - $(window).height(), 0.01);
        this.readingProgressDetails.html((readingProgress * 100).toFixed(0) + "%");
        this.readingProgressBar.css("width", (readingProgress * 100).toFixed(0) + "%");
        //是否显示回顶
        if ($(window).scrollTop() >= 400 || readingProgress >= 0.5) {
            this.backToTopBtn.removeClass("fabtn-hidden");
        } else {
            this.backToTopBtn.addClass("fabtn-hidden");
        }
    },
    hideAlltoolTip: function () {
        $("#float_action_buttons button").tooltip('hide')
    }

}
var blog = {
    init:function () {
        this.init_load_more()
    },
    pjax_complete:function () {
        this.init_load_more()
    },
    eventInit:function () {

    },
    /* 初始化加载更多 */
    init_load_more:function () {
        var _this = this;
        var jloadmore = $('.j-loadmore a')
        jloadmore.attr('data-href', jloadmore.attr('href'));
        jloadmore.removeAttr('href');
        jloadmore.on('click', function () {
            if ($(this).attr('disabled')) return;
            $(this).html('loading...');
            $(this).attr('disabled', true);
            var url = $(this).attr('data-href');
            var that = this
            if (!url) return;
            $.ajax({
                url: url,
                type: 'get',
                success:function (data){
                    $(that).removeAttr('disabled');
                    $(that).html('查看更多');
                    var list = $(data).find('.article-list:not(.sticky)');
                    $('.j-index-article.article').append(list);
                    // window.scroll({
                    //     top: $(list).first().offset().top - ($('.j-header').height() + 20),
                    //     behavior: 'smooth'
                    // });
                    var newURL = $(data).find('.j-loadmore a').attr('href');
                    if (newURL) {
                        $(that).attr('data-href', newURL);
                    } else {
                        $('.j-loadmore').remove();
                    }
                }
            });
        });
    }
}

var utils = {
    getQueryString: function (name) {
        name = name.replace(/[]/, "\[").replace(/[]/, "\[").replace(/[]/, "\\\]")
        var regexS = "[\\?&]" + name + "=([^&#]*)"
        var regex = new RegExp(regexS)
        var results = regex.exec(window.parent.location.href)
        if (results == null)
            return ""
        else {
            return decodeURI(results[1])
        }
    },
    debounce: function (func, wait, immediate) {
        var timeout, args, context, timestamp, result;
        if (null == wait) wait = 100;

        function later() {
            var last = Date.now() - timestamp;

            if (last < wait && last >= 0) {
                timeout = setTimeout(later, wait - last);
            } else {
                timeout = null;
                if (!immediate) {
                    result = func.apply(context, args);
                    context = args = null;
                }
            }
        }

        var debounced = function () {
            context = this;
            args = arguments;
            timestamp = Date.now();
            var callNow = immediate && !timeout;
            if (!timeout) timeout = setTimeout(later, wait);
            if (callNow) {
                result = func.apply(context, args);
                context = args = null;
            }

            return result;
        };

        debounced.clear = function () {
            if (timeout) {
                clearTimeout(timeout);
                timeout = null;
            }
        };

        debounced.flush = function () {
            if (timeout) {
                result = func.apply(context, args);
                context = args = null;

                clearTimeout(timeout);
                timeout = null;
            }
        };

        return debounced;
    }

}

// rady
$(function () {
    // comment
    $(window).unbind("scroll").bind("scroll", function () {
        // 阅读进度
        floatEle.changefabtnDisplayStatus()
    })
    window.onscroll = utils.debounce(function () {
        floatEle.hideAlltoolTip()
    }, 300)
    indexInput.init()
    tagsManageInit.init()
    recommendInit.init()
    archiveInit.init()
    floatEle.init()
    blog.init()
})

var pjaxInit = function () {
    indexInput.pjax_complete()
    archiveInit.init()
    recommendInit.pjax_complete()
    owoInit();
    //
    tagsManageInit.pjax_complete()
    oneMap.pjax_complete()
    blog.pjax_complete()
    if ($("article.post")) {
        Prism.highlightAll()
    }
}

// post article
function postArticle(data, needRefresh) {
    $.post(gconf.oneaction, {
        type: 'getsecuritytoken'
    }, function (res) {
        if (res.code) {
            // console.log(res)
            $.ajax({
                url: gconf.index + '/action/contents-post-edit?do=publish&_=' + res.data,
                type: 'post',
                data: data,
                success: function (res) {
                    if (needRefresh) {
                        setTimeout(function () {
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
                        }, 800)
                    }
                },
                error: function (err) {
                    return $.message({
                        title: "提示",
                        message: "code:" + err.status + "err:" + err.responseText + err,
                        type: "error"
                    })
                }
            })
        }else {
            $.message({
                title: "提示",
                message: "请检查插件是否正确安装！",
                type: "error"
            })
        }
        return false
    })
}
// delete comments
function delComments(url,needRefresh) {
    if (confirm("您真的确定要删除吗？")){
        $.post(gconf.oneaction, {
            type: 'getsecuritytoken'
        }, function (res) {
            if (res !== 'error') {
                // console.log(res)
                $.ajax({
                    url: gconf.index + url+'&_=' + res,
                    type: 'post',
                    success: function (re) {
                        if (needRefresh) {
                            setTimeout(function () {
                                $.pjax.reload('#pjax-container', {
                                    container: '#pjax-container',
                                    fragment: '#pjax-container',
                                    timeout: 8000
                                })
                                $.message({
                                    title: "提示",
                                    message: "删除成功",
                                    type: "success"
                                })
                            }, 800)
                        }
                        if (re.success){
                            $.message({
                                title: "提示",
                                message: "删除成功",
                                type: "success"
                            })
                        }
                        return false;
                    },
                    error: function (err) {
                        $.message({
                            title: "提示",
                            message: "code:" + err.status + "err:" + err.responseText + err,
                            type: "error"
                        })
                        return false;
                    }
                })
                return false;
            }
            return false;
        })
    }
    return false;
}
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
    var datetime = year + "/" + mon + "/" + date

    if (val.length > 0 && val !== '') {
        title.val(val.substring(0, 25))
    }
    if (indexInput.nowtype === 'default') {
        if (val.length === 0 || val === '') {
            title.val("图文小记事~" + datetime)
        }
        if (indexInput.additionArray.length === 1) {
            val = val + '\n\n'
            indexInput.additionArray.forEach(function (value) {
                val = val + "![](" + value + ")"
            })
            val = val + '\n\n'
        } else if (indexInput.additionArray.length > 1) {
            val = val + '\n[gallery]'
            indexInput.additionArray.forEach(function (value) {
                val = val + "![](" + value + ")"
            })
            val = val + '[endgallery]\n'
        }
    } else if (indexInput.nowtype === 'link') {
        if (indexInput.additionArray.length > 0) {
            if (indexInput.additionArray[1].length > 0 && indexInput.additionArray[1] !== '') {
                title.val(indexInput.additionArray[1].substring(0, 15))
            } else {
                title.val("分享一个链接~" + datetime)
            }
            if (val) { // 有用户评论显示评论
                val = '[pureLink comment="' + val + '..." text="' + indexInput.additionArray[1] + '" link="' + indexInput.additionArray[0] + '"]'
            } else {
                val = '[pureLink comment="' + indexInput.additionArray[1].substring(0, 60) + '..." text="' + indexInput.additionArray[1] + '" link="' + indexInput.additionArray[0] + '"]'
            }
        } else {
            $.message({
                title: "提示",
                message: "请输入正确链接",
                type: 'warning'
            })
            i.val("发送")
            return false;
        }
    } else if (indexInput.nowtype === 'video') {
        if (indexInput.additionArray.length > 0) {
            if (val.length === 0 || val === '') {
                title.val("分享视频~" + datetime)
            }
            indexInput.additionArray.forEach(function (value) {
                val = val + '\n[video src="' + value + '"]\n'
            })
        } else {
            $.message({
                title: "提示",
                message: "请输入正确链接",
                type: 'warning'
            })
            i.val("发送")
            return false;
        }
    } else if (indexInput.nowtype === 'bilibili') {
        if (indexInput.additionArray.length > 0) {
            if (val.length === 0 || val === '') {
                title.val("分享bilibili视频~" + datetime)
            }
            indexInput.additionArray.forEach(function (value) {
                val = val + '\n[bilibili bv="' + value + '" p="1"]\n'
            })
        } else {
            $.message({
                title: "提示",
                message: "请输入正确链接",
                type: 'warning'
            })
            i.val("发送")
            return false;
        }
    }
    // realtext.val(val)
    var len = val.length;
    if (len === 0 || val === '') {
        $.message({
            title: "提示",
            message: "要不输入点东西吧~",
            type: 'warning'
        })
        i.val("发送")
        return false
    }
    // check if category in allcategories
    var inAllcate = false
    var cmid = $("#category").val()
    if (typeof allCategories !== "undefined") {
        allCategories.forEach(function (val) {
            if (val[1] === cmid) inAllcate = true
        })
        if (inAllcate === false) cmid = allCategories[0][1] // 默认使用第一个的mid
    }else {
        $.message({
            title:"提示",
            message:"还没有创建圈子",
            type:"error"
        })
        return false
    }
    var data = {
        title: title.val(),
        text: val,
        'fields[articleType]': indexInput.nowtype,
        'markdown': 1,
        'category[]': cmid,
        name: $("#ad-name").val(),
        district: $("#ad-district").val(),
        address: $("#ad-address").val(),
        visibility: 'publish',
        allowComment: 1,
        allowPing: 1,
        allowFeed: 1,
        do: 'publish'
    }
    postArticle(data, true);
    return false;
}

// delete post
function del_article(this_, $cid) {
    var msg = "您真的确定要删除吗？";
    var url = $(this_).attr("href")
    if (confirm(msg) === true) {
        $.ajax({
            url: url,
            method: 'post',
            success: function (res) {
                // console.log("aaa",res)
                $.message({
                    title: "提示",
                    message: "删除成功！",
                    type: "success"
                })
            },
            error: function (res) {
                // console.log("err",res)
                $.message({
                    title: "提示",
                    message: "删除成功！",
                    type: "success"
                })
            }
        })
    }
    return false;
}

// video toggle
function videoToggle(idselector, this_, ev) {
    if (!$(this_).hasClass('video-slim')) {
        $(this_).children().children('span:first-child').html('<svg width=".7em" height=".7em" viewBox="0 0 16 16" class="bi bi-arrows-angle-expand" fill="currentColor" xmlns="http://www.w3.org/2000/svg">\n' +
            '<path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707z"/>\n' +
            '</svg>')
        $(this_).children().children('span:last-child').text('展开')
        $(this_).addClass('video-slim')
    } else {
        $(this_).children().children('span:first-child').html('<svg class="bi bi-arrows-angle-contract" width=".7em" height=".7em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">\n' +
            '  <path fill-rule="evenodd" d="M9.5 2.036a.5.5 0 0 1 .5.5v3.5h3.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5z"/>\n' +
            '  <path fill-rule="evenodd" d="M14.354 1.646a.5.5 0 0 1 0 .708l-4.5 4.5a.5.5 0 1 1-.708-.708l4.5-4.5a.5.5 0 0 1 .708 0zm-7.5 7.5a.5.5 0 0 1 0 .708l-4.5 4.5a.5.5 0 0 1-.708-.708l4.5-4.5a.5.5 0 0 1 .708 0z"/>\n' +
            '  <path fill-rule="evenodd" d="M2.036 9.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V10h-3.5a.5.5 0 0 1-.5-.5z"/>\n' +
            '</svg>')
        $(this_).children().children('span:last-child').text('收缩')
        $(this_).removeClass('video-slim')
    }
    $(idselector).collapse('toggle')
    ev.stopPropagation()
    return false
}

function checkURL(URL) {
    var str = URL;
    var Expression = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[\-;:&=\+\$,\w]+@)?[A-Za-z0-9\.\-]+|(?:www\.|[\-;:&=\+\$,\w]+@)[A-Za-z0-9\.\-]+)((?:\/[\+~%\/\.\w\-_]*)?\??(?:[\-\+=&;%@\.\w_]*)#?(?:[\.\!\/\\\w]*))?)/;
    var objExp = new RegExp(Expression);
    return objExp.test(str) === true;
}

function gotoHash(hash, durtion) {
    if (hash.length === 0) {
        return;
    }
    if ($(hash).length === 0) {
        return;
    }
    if (durtion == null) {
        durtion = 200;
    }
    $("body,html").animate({
        scrollTop: $(hash).offset().top - 80
    }, durtion);
}
