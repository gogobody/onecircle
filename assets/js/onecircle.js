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

// obj 2 arr
function toArray(obj) {
    let arr = [];
    for (let k in obj) {
        if (obj.hasOwnProperty(k)) {
            /*检测obj对象中是否有k这个属性*/
            arr.push(obj[k])
        }

    }
    return arr;
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

Date.prototype.format = function(fmt) {
    var o = {
        "M+" : this.getMonth()+1,                 //月份
        "d+" : this.getDate(),                    //日
        "h+" : this.getHours(),                   //小时
        "m+" : this.getMinutes(),                 //分
        "s+" : this.getSeconds(),                 //秒
        "q+" : Math.floor((this.getMonth()+3)/3), //季度
        "S"  : this.getMilliseconds()             //毫秒
    };
    if(/(y+)/.test(fmt)) {
        fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
    }
    for(var k in o) {
        if(new RegExp("("+ k +")").test(fmt)){
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
        }
    }
    return fmt;
}

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
        this.messagePageInit()
        this.userCenterInit()
        this.hightInit()
        this.annouceInit()
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
                } else {
                    $.message({
                        title: "提示",
                        message: "解析失败",
                        type: "error"
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
    load_10years_blog: function (page,load=false) {
        if (load){
            $(".j-loadmore a").text('loading...')
        }
        $.post({
            url: gconf.index,
            data:{
                recommendRest: 1,
                type: "fetch10apis",
                page: page,
            },
            success: function (res) {
                res=JSON.parse(res);
                if (res.code===1){
                    let data = res.data.data;
                    let current_page= res.data.current_page;
                    let total_page = res.data.last_page;
                    let genhtml='';
                    data.forEach(function (ele) {
                        let tmp = `<article class="post-article"><div class="post-article-left"><a href="javascript:void(0);"><img class="avatar" src="${ele.avatar}" alt="${ele.author}"></a></div><div class="post-article-right"><div class="post-author"><div class="author-name"><a href="javascript:void(0);">${ele.author}</a></div><div class="post-addr"><a href="javascript:void(0);"><time>${new Date(ele.created_at).format("yyyy-MM-dd hh:mm")}</time></a></div></div><div class="post-content"><div class="row"><div class="post-content-inner-link col-xl-12"><p></p><div class=""><p>${ele.desc?ele.desc:ele.title}</p><a class="link-a" href="${ele.link}" target="_blank"><div class="link-container link-a"><div class="link-banner"><img src="/usr/themes/onecircle/assets/img/link.png"><div class="link-text">${ele.title}</div></div></div></a></div><p></p></div></div></div></div></article>`;
                        genhtml=genhtml+tmp;
                    })
                    let next = current_page+1;
                    if(next < total_page){
                        genhtml=genhtml+`<div class="j-loadmore" data-type="article"><a onclick="indexInput.load_10years_blog(${next},true)" class="next" title="">查看更多</a></div>`;
                    }
                    if(load){
                        // 删掉之前的 load
                        $(".j-loadmore").remove();
                        $(".item-container").append(genhtml);
                    }else{
                        $(".item-container").html(genhtml);
                    }
                }
                $.rmloading();
                index_tab_loadfinish=true;
                $(".j-loadmore a").text('查看更多')

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
        topicSearchBlk && topicSearchBlk.autoComplete({
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
                var tmpArr = []
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
        // lazy load
        document.addEventListener('lazybeforeunveil', function (e) {
            let bg = e.target.getAttribute('data-bg');
            if (bg) {
                e.target.style.backgroundImage = 'url(' + bg + ')';
            }
        });
        /* 头部滚动 */
        {
            if (!gconf.IS_MOBILE) {
                let flag = true;
                let headH = $('header').height()
                const handleHeader = diffY => {
                    if (window.pageYOffset >= headH && diffY <= 0) {
                        if (flag) return;
                        // $('#sidebar div.card:last-child').css('top', headH - 60 + 15);
                        flag = true;
                    } else {
                        if (!flag) return;
                        $('#sidebar div.card:last-child').css('top', headH + 15);
                        flag = false;
                    }
                };
                let Y = window.pageYOffset;
                handleHeader(Y);
                let _last = Date.now();
                document.addEventListener('scroll', () => {
                    let _now = Date.now();
                    if (_now - _last > 15) {
                        handleHeader(Y - window.pageYOffset);
                        Y = window.pageYOffset;
                    }
                    _last = _now;
                });
            }
        }

        /* 侧边栏舔狗日记 */
        {
            if ($('.joe_aside__item.flatterer').length) {
                const arr = ['你昨天晚上又没回我信息，我却看见你的游戏在线，在我再一次孜孜不倦的骚扰你的情况下，你终于跟我说了一句最长的话“**你他妈是不是有病**”，我又陷入了沉思，这一定有什么含义，我想了很久，你竟然提到了我的妈妈，原来你已经想得那么长远了，想和我结婚见我的父母，我太感动了，真的。那你现在在干嘛，我好想你，我妈妈说她也很喜欢你。', '今天我观战了一天你和别人打游戏，**你们玩的很开心**；我给你发了200多条消息，你说没流量就不回；晚上发说说没有人爱你，我连滚带爬评论了句有“我在”，你把我拉黑了，我给你打电话也无人接听。对不起，我不该打扰你，我求求你再给我一次当好友的机会吧！', '我爸说再敢网恋就打断我的腿，幸好不是胳膊，这样我还能继续**和你打字聊天**，就算连胳膊也打断了，我的心里也会有你位置。', '你说你情侣头像是一个人用的，空间上锁是因为你不喜欢玩空间，情侣空间是和闺蜜开的，找你连麦时你说你在忙工作，每次聊天你都说在忙，你真是一个**上进的好女孩**，你真好，我好喜欢你！', '你跟他已经醒了吧？我今天捡垃圾挣了一百多，明天给你打过去。你快点休息吧，我明天叫你起床，给你点外卖买烟，给你点你最喜欢的奶茶。晚上我会继续去摆地摊的，你不用担心我，你床只有那么大睡不下三个。**你要好好照顾好自己，不要让他抢你被子**。我永远爱你！', '她三天没回我的消息了，在我孜孜不倦地骚扰下她终于舍得回我“**nmsl**”，我想这一定是有什么含义吧，噢！我恍然大悟原来是**尼美舒利颗粒**，她知道我有关节炎让我吃尼美舒利颗粒，她还是关心我的，但是又不想显现的那么热情。天啊！她好高冷，我好像更喜欢她了！', '你想我了吧？可以回我消息了吗？我买了万通筋骨贴，你**运动一个晚上腰很疼**吧？今晚早点回家，我炖了排骨汤，我永远在家等你。', '昨晚你和朋友打了一晚上游戏，你破天荒的给我看了战绩，虽然我看不懂但是我相信你一定是最厉害的、最棒的。我给你发了好多消息夸你，告诉你我多崇拜你，你回了我一句“**啥B**”，我翻来覆去思考这是什么意思，Sha[傻]，噢你是说我傻，那B就是Baby的意思了吧，原来你是在叫我**傻宝**，这么宠溺的语气，我竟一时不敢相信，其实你也是喜欢我的对吧。', '今天我还是照常给你发消息，汇报日常工作，你终于回了我四个字：“**嗯嗯，好的。**”。你开始愿意敷衍我了，我太感动了，受宠若惊。我愿意天天给你发消息，就算你天天骂我，我也不觉得烦。', '你昨天晚上又没回我的消息，在我孜孜不倦的骚扰下，你终于舍得回我了，你说“**滚**”，这其中一定有什么含义，我想了很久，滚是三点水，这代表你对我的思念也如**滚滚流水**一样汹涌，我感动哭了，不知道你现在在干嘛，我很想你。', '听说你想要一套化妆品，我算了算，明天我去工地上**搬一天砖**，就可以拿到200块钱，再加上我上个月攒下来的零花钱，刚好给你买一套迪奥。', '今天表白被拒绝了，她对我说能不能脱下裤子**撒泡尿照照自己**。当我脱下裤子，她咽了口水，说我们可以试一下。', '刚从派出所出来，原因前几天14号情人节，我想送你礼物，我去偷东西的时候被抓了。我本来想反抗，警察说了一句老实点别动，我立刻就放弃了反抗，因为我记得你说过，你喜欢**老实人**。', '疫情不能出门，现在是早上八点，你肯定饿了吧。我早起做好了早餐来到你小区，保安大哥不让进。我给你打了三个电话你终于接了“**有病啊，我还睡觉呢，你小区门口等着吧**”。啊，我高兴坏了！你终于愿意吃我做的早餐了，还让我等你，啊！啊！啊！好幸福噢！', '我存了两个月钱，给你买了一双**北卡蓝**，你对我说一句“谢谢”，我好开心。这是你第一次对我说两个字，以前你都只对我说滚。今天晚上逛**闲鱼**，看到了你把我送你的北卡蓝发布上去了。我想你一定是在考验我，再次送给你，给你一个惊喜，我爱你。', '昨天**你领完红包就把我删了**，我陷入久久地沉思。我想这其中一定有什么含义，原来你是在欲擒故纵，嫌我不够爱你。无理取闹的你变得更加可爱了，我会坚守我对你的爱的。你放心好啦！今天发工资了，发了1850，给你微信转了520，支付宝1314，还剩下16。给你发了很多消息你没回。剩下16块我在小卖部买了你爱吃的老坛酸菜牛肉面，给你寄过去了。希望你保护好食欲，我去上班了爱你~~', '在保安亭内看完了最新一集的梨泰院，曾经多么倔强的朴世路因为伊瑞给张大熙跪下了，亭外的树也许感受到了**我的悲伤**，枯了。我连树都保护不了，怎么保护你，或许保安才是真的需要被保护的吧。我难受，我想你。over', '难以言喻的下午。说不想你是假的，说爱你是真的。昨天他们骂**我是你的舔狗**，我不相信，因为我知道你肯定也是爱我的，你一定是在考验我对你的感情，只要我坚持下去你一定会被我的真诚所打动，加油！不过我要批评你一下，昨晚你说**去酒店跟人斗地主**，我寻思两个人也玩不了呀。算了，不想了，毕竟打牌是赌博行为，不太好。', '明天就周六了我知道你不上班，但是我怕你睡懒觉不吃早饭饿坏自己。我早晨4点去菜市场买了新鲜活鸡**给你炖鸡汤**，阿姨给我用箱子装了起来，我骑上我280买的电动车哼着小调回家，心想你一定会被我感动的，箱子半路开了，鸡跑了，拐到了一个胡同里，凌晨4点的胡同还有穿超短裙和大叔聊天的美女，不禁感叹这个世界变了，她问我找什么，…………。对不起，我爱你', '12点队长过来准时交班，出去的车辆按喇叭我也没听到，只因我在监控中看到了穿睡衣出来倒垃圾的你，**望你望的入神**不由的傻笑了起来，队长过来骂我扣了我一天工资。我委屈，想抱你。你送的泡面真好吃。', '今天的我排位输了好多把，我将这些事情分享给你，但是你一个字都没有讲，我在想你是不是在忙？我头痛欲裂，终于在我给你发了几十条消息之后，你回了我一个“**脑子是不是有病？**”，原来你还是关心我的，看到这句话，我的脑子一下就不疼了，今天也是爱你的一天。', '我存了半年的工资，给你买了一只LV，你对我说了一句“**你真好**”，我好开心，这是你第一次这么认可我，以前你都只对我说滚。今天晚上逛闲鱼，看到你把我送你的LV发布上去了。我想，你一定是在考验我，于是我用借呗里的钱把它买了下来，再次送给你，给你一个惊喜，我爱你。', '其实我每月工资6000，但我只给你转2000，你以为我给你了全部。才不是，我一共舔了3个啦，**我要舔的雨露均沾**，才不会把你当成唯一。', '昨天你把我拉黑了，我看着红色感叹号陷入了久久的沉思，我想这其中一定有什么含义？红色红色？我明白了！红色代表热情，你对我很热情，你想和我结婚，我愿意。', '今天你问我借了两千块钱，说要做个手术，你果然还是爱我的，**不是我的孩子，你不要**。 ', '中午你无故扇了我一巴掌，我握着你的手说“手怎么这么凉，都怪我没有照顾好你，一定要更加对你好”。', '我给你打了几通电话，你终于接了。听到了**你发出啊啊啊啊的声音**，你说你肚子痛，我想你一定是很难受吧。电话还有个男的对你说“来换个姿势”，一定是**在做理疗**了。期待你早日康复，我好担心。', '昨天晚上好冷，本来以为街上没人，结果刚刚**偷电动车**的时候被抓了，本来想反抗，但警察说了一句老实点别动，我立刻就放弃了抵抗，因为我记得你说过，你喜欢**老实人**。', '找你连麦时你说你在忙工作，每次聊天你都说在忙，你真是一个**上进的好女孩**，你真好，发现我越来越喜欢这样优秀的你。', '你从来没说过爱我，聊天记录搜索了一下“爱”，唯一的一条是：**你好像乡村爱情里的刘能啊**。', '今天好开心啊，和你一起在峡谷嬉戏，打完一波团战之后看到你在打大龙，残血的我跳过去直接被龙爪拍死，但这一刻我觉得好浪漫，**死在你的脚旁边，这是我离你最近的一次**。', '哥们，求你和她说句话吧，这样她就不会那么难过了。', '今天你把我的微信拉黑了，这下我终于解放了！以前我总担心太多消息会打扰你，现在我终于不用顾忌，不管我怎么给你发消息，都不会让你不开心了。等我**攒够5201314条**我就拿给你看，你一定会震惊得说不出话然后哭着说会爱我一辈子。哈哈。', '昨天你把我删了，我陷入了久久的沉思 。我想这其中一定有什么含义，你应该是欲擒故纵吧，嫌我不够爱你。突然觉得**无理取闹的你变得更加可爱**了，我会坚守我对你的爱的 你放心好啦！这么一想，突然对我俩的未来更有期望了呢。', '今天上班不是太忙，百无聊赖，又翻出了你的相片，看了又看。今天是我认识你的第302天，也是我爱你的第302天，可是这些你并不知道，也许**你知道了，也不会在意**吧。 此刻的我好想你！ ', '今天你跟我说我很丑，让我不要骚扰你了。我听了很高兴，小说里的主角都像你这样，最开始表现的很厌恶，但最后**总会被我的真心打动**。你现在有多讨厌我，以后就会有多爱我。嘻嘻。', '我坐在窗边给你发了99条消息，你终于肯回我了，你说“**发你妈啊**”，我一下子就哭了。原来努力真的有用，你已经开始考虑想见我的妈妈了，你也是挺喜欢我的。', '刚才我找你说话，你回了一个滚，我陷入了沉思，你还是如此的关心我，知道我腿受伤了，让我这样走，好感动！看来你还是爱我的！', '今天下雨了，我去你公司接你下班。看见我你不耐烦的说“**烦不烦啊，不要再找我了**”，一头冲进雨里就跑开了。我心里真高兴啊，你宁愿自己淋雨，都不愿让我也淋湿一点，你果然还是爱我的。', '晚上和你聊天，10点钟不到，你就说“**困了，去睡觉了**”。现在凌晨1点钟，看到你给他的朋友圈点赞评论，约他明天去吃火锅，一定是你微信被盗了吧。', '今天我主动给你发了游戏邀请，邀请你和我单挑安琪拉，虽然我安琪拉很菜，可是为了和你打游戏，我还是毅然决然给你发了邀请。你说你不接受，你在打其他游戏。联想到我自己很菜，我突然明白，原来你还是在乎我的，只是不想一遍遍连招一套的在泉水送我走。我再一次感动哭了，因此，我好像更喜欢你了，你可真是一个宝藏男孩！', '你的头像是一个女孩子左手边牵着一条秋田犬，犬=狗，而**我是一条舔狗**。是不是代表你的小手在牵着我呢？', '今天发工资了，我一个月工资3000，你猜我会给你多少，是不是觉得我会给你2500，自己留500吃饭？你想多了，我3000都给你，因为厂里包吃包住。', '昨天就为你充了710点卷，虽然知道你不会玩不知去向，但你说好看，你刚才说小号想要还想要一个，爱你的我还是满心欢喜的把剩下的100元伙食费又给你充了710，然后看到你小号并没有买，而是你送给了你的一个弟弟，你对弟弟真好，好有爱心，我感觉对你陷得很深了。', '今天我给你发消息，你回复我“**nmsl**”，我想了半天才知道你是在夸我，原来是**你美死了**，你嘴真甜，我爱你。', '你说你想买口红，今天我去了叔叔的口罩厂做了一天的打包。拿到了两百块钱，加上我这几天**省下的钱刚好能给你买一根小金条**。即没有给我自己剩下一分钱，但你不用担心，因为厂里包吃包住。对了打包的时候，满脑子都是你，想着你哪天突然就接受我的橄榄枝了呢。而且今天我很棒呢，主管表扬我很能干，其实也有你的功劳啦，是你给了我无穷的力量。今天我比昨天多想你一点，比明天少想你一点。', '在我一如既往的每天跟她问早安的时候，她今天终于回我了。我激动地问她我是不是今天第一个跟她说话的人，她说不是，是**她男朋友把她叫起来退房**的。', '听说你朋友说今天出门了，我打扮成精神小伙来找你，没想到你竟然对我说“**给我爬，别过来**”我当场就哭了，原来真心真的会感动人，你一定是知道，穿豆豆鞋走路脚会很累，让我爬是因为这样不会累着脚，其实你是喜欢我的吧', '今天把你的备注改成了「**对方正在输入...**」，这样我就知道你不是不想回我，刚又给你发了消息，看到你在思考怎么回我，我就知道你和我一样，心里有我。', '今天在楼上窗户上看见你和他在公园里接吻，我看见哭了出来，并打电话给你，想问问你为什么？但你说怎么了，声音是那么好听。于是我说“**以后你和他接吻的时候，能不能用我送给你的口红啊？**”', '我退了无关紧要的群，唯独这个群我没有退，因为这里有一个对我来说很特别的女孩子，我们不是好友，**我每天只能通过群名片看看她**，虽然一张照片也看不到，我也知足了，我不敢说她的名字，但我知道她是群里面最美的女孩子，她说我们这样会距离产生美~ 我想想发现她说的挺对的，我心里很开心。', '今天早上我告诉你我想你了，你没理我。今天中午我给你打电话，你不接，打第二个你就关机。晚上我在你公司楼下等你，你对我说的第一句话就是滚“**滚，别烦我，别浪费时间了**”，我真的好感动，你居然为我考虑了，怕我浪费时间。呜呜呜，这是我爱你的第74天。', '我坐在窗边给你发了99条消息，你终于肯回我了你说“**发你妈啊**”，我一下子就哭了，原来努力真的有用，你已经开始考虑想见我的妈妈了，你其实也是挺喜欢我的。', '你一个小时没回我的消息，在我孜孜不倦地骚扰下你终于舍得回我了“**在做爱**”，这其中一定有什么含义，我想了很久，“在做爱”这简简单单的三个字肯定是三句话，分别是**我在忙、做你女朋友、我爱你**，想到这里我不禁流下了眼泪，我这么长时间的喜欢没有白费，不知道你现在忙干嘛，但我很想你。', '最近我暗恋的女生每天都和不同的男生约会，我想总有一天会轮到我，我问她什么时候能见见我？她说**下辈子吧**。她真好，下辈子还要和我在一起。', '你好像从来没有对我说过晚安，我在我们的聊天记录里搜索了关键字：“晚安”，你说过一次：**我早晚安排人弄死你**。'];
                const random = (min, max) => {
                    min = Math.ceil(min);
                    max = Math.floor(max);
                    return Math.floor(Math.random() * (max - min + 1)) + min;
                };
                const toggle = () => {
                    $('.joe_aside__item.flatterer .content').html(arr[random(0, arr.length - 1)].replace(/\*\*(.*?)\*\*/g, '<mark>$1</mark>'));
                    $('.joe_aside__item.flatterer .content').attr('class', 'content type' + random(1, 6));
                };
                toggle();
                $('.joe_aside__item.flatterer .change').on('click', () => toggle());
            }
        }
        {

            let react_tabs = $("#recommend-tabs")
            if (react_tabs.length > 0) {
                const baseoffset = react_tabs.first().offset().left;
                const line = $('.line');
                clicktabs=-1;// 防止重复点击
                index_tab_loadfinish=false;
                react_tabs.children().each(function (index, val) {
                    $(val).click(function (e) {
                        var tabindex = $(val).data("tabindex")
                        $(this).addClass('react-tabs__tab--selected').siblings().removeClass('react-tabs__tab--selected');
                        line.width($(val).width());
                        var left = $(val).offset().left - baseoffset;
                        line.css({
                            'transform': 'translateX(' + left + 'px)'
                        })
                        if(tabindex === clicktabs && index_tab_loadfinish === false) return;
                        clicktabs = tabindex;
                        index_tab_loadfinish=false;
                        // gen url
                        let tmp_url='';
                        $.showloading({
                            selector:'.react-tabs .item-container',
                            choice: 'prepend'
                        })
                        if(tabindex===0){
                            tmp_url = '/';
                            $.ajax({
                                url: tmp_url,
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
                                            $(".item-container").html(real_html)
                                            // 删除某个前缀开头的类
                                            var archiveContent = $(".archive-content")
                                            archiveContent.removeClass(function (index, className) {
                                                return (className.match(/(^|\s)tabindex-\S+/g) || []).join('');
                                            });
                                            archiveContent.addClass('tabindex-' + tabindex)
                                        }
                                    } catch (e) {
                                        console.log(e)
                                    }
                                    $.rmloading();
                                    index_tab_loadfinish=true
                                }
                            })
                        }else if(tabindex===1){
                            let page = 1;
                            indexInput.load_10years_blog(page)
                        }

                    })
                })
            }
        }
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
    messagePageInit: function () {

        // 搜索 联系 人
        let csearch = $('#contact-search');
        if (csearch) {
            csearch.autoComplete({
                minChars: 1,
                source: function (term, suggest) {
                    term = term.toLowerCase();
                    $.post(gconf.index, {
                            getallfollowers: 1,
                            type: "getallfollowers",
                            uid: userId,
                            keyword: term
                        }, function (res) {
                            res = JSON.parse(res)
                            let su =[];
                            res.forEach(function (val,index) {
                                su.push(toArray(val))
                            })
                            suggest(su);
                        }
                    )

                },
                renderItem: function (item, search) {
                    search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                    let re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                    let name = item[3] ? item[3] : item[1];
                    return '<div class="autocomplete-suggestion" style="background: #fff" data-uid="' + item[0] + '"><img class="sc-AxjAm jZLHXc" src="'+item[4]+'">' + name.replace(re, "<b>$1</b>") + '</div>';
                },
                onSelect: function (e, term, item) {
                    // alert('Item "' + item.data('langname') + ' (' + item.data('lang') + ')" selected by ' + (e.type == 'keydown' ? 'pressing enter' : 'mouse click') + '.');
                    let uid = item.data('uid');
                    userMsg.buildChatBox(uid)
                }
            });
        }
        // 初始化联系人点击
        $("#contact-list ul.list-group.contact-list li").unbind('click').bind('click',function (e) {
            let uid = $(this).data('uid')
            if(uid){
                userMsg.buildChatBox(uid)
                let oldName = $(this).children('.media-body p.font-bold')
                oldName.text(oldName.text().replace("[未读]",""))
            }
        })

        // 初始化 发消息
        let sendBtn = $("#sendUserMsg")
        let msgarea = $("#usermsg-input")
        sendBtn.unbind('click').bind('click',function (e) {
            let to = $('#chat-tab a').data('uid')
            if(to){
                let text = $("#usermsg-input").val()
                text = text.trim()
                text = safe.stripscript(text)
                if(text.length<2){
                    return $.message({
                        title:'提示',
                        message:'输入字符太少',
                        type:'info'
                    })
                }
                if(text.length > 500){
                    return $.message({
                        title:'提示',
                        message:'输入字符太多',
                        type:'info'
                    })
                }
                sendBtn.text('发送中..')
                sendBtn.attr('disabled',"true")
                let time = 3 ;//倒计时初值
                timer = setInterval(function () {
                    if ( time === 0){
                        clearInterval(timer) ;
                        sendBtn.removeAttr("disabled");
                        sendBtn.text("发送");
                    } else{
                        sendBtn.text("还剩" + time + "秒" );
                        time--;
                    }
                },1000)//1秒钟递减一次
                userMsg.sendMsg(to,text,function (res) {
                    if (res.code){
                        $("#usermsg-input").val('')
                        let sender = res.data.sender
                        let obj = {
                            text:text,
                            datetime: '刚刚'
                        }
                        let msglist = $('#contact-message-list')
                        msglist.append(userMsg.gensSenderTemplate(sender,obj))
                    }else{
                        $.message({
                            title:'提示',
                            message: "错误："+res.msg,
                            type:'error'
                        })
                    }

                })

            }else {
                $.message({
                    title:'提示',
                    message:'获取联系人出错',
                    type:'error'
                })
            }
        })

        // 消息事件
        userMsg.eventInit()
    },
    userCenterInit:function () {
      userCenter.persenalInit()
    },
    hightInit:function () {
        Prism.highlightAll();
        $("pre").each(function (index, item) {
            let text = $(item).find("code").text();
            let span = $(`<span class="copy"><i class="fa fa-clone"></i></span>`);
            new ClipboardJS(span[0], { text: () => text }).on('success', () => Qmsg.success('复制成功！'));
            $(item).append(span);
        });
    },
    annouceInit:function () {
        let toast_ = $("#liveToast");
        let tco = OneLocalStorage.get('one_toast');
        if(toast_.length > 0 && !tco){
            toast_.toast('show');
            let date = new Date().getTime();
            OneLocalStorage.set('one_toast', '1',date + 604800)
        }
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
        let that = this
        let react_tabs = $("#archive_tabs")
        if (react_tabs.length > 0) {
            const baseoffset = react_tabs.first().offset().left;
            const line = $('.line');
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
            formdata[0]["value"] = safe.stripscript(formdata[0]["value"])
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
                    data: formdata,
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
                if (json.status && json.data.jskey) {
                    localStorage.setItem("amapkey", json.data)
                    AMapLoader.load({
                        "key": json.data.jskey,              // 申请好的Web端开发者Key，首次调用 load 时必填
                        "version": "1.4.15",   // 指定要加载的 JSAPI 的版本，缺省时默认为 1.4.15
                        "plugins": ['AMap.Autocomplete', 'AMap.Geolocation', 'AMap.Geocoder', 'AMap.Marker'],      // 需要使用的的插件列表，如比例尺'AMap.Scale'等
                    }).then(function (AMap) {
                        oneMap.init(AMap)
                    }).catch(function (e) {
                        console.error(e);  //加载错误提示
                        // $.message({
                        //     type: "error",
                        //     title: "提示",
                        //     message: "获取amapJsKey失败"
                        // })
                    });
                } else {
                    // console.log("获取amapJsKey失败")
                    // $.message({
                    //     type: "error",
                    //     title: "提示",
                    //     message: "获取amapJsKey失败"
                    // })
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
var userMsg = {
    eventInit:function (){
        // 定时刷新未读消息
        let title=$("title");
        let oldtittle = title.html()
        let msgTip = $("#msg-tip")
        // 闪烁标题
        function start(){
            let flag=true
            let change=function(){
                if(flag){
                    flag=false;
                    title.html('【新消息】'+oldtittle);
                    msgTip.hide()
                }else {
                    flag=true;
                    title.html('【　　　】'+ oldtittle);
                    msgTip.show()
                }
                window._titleMsgTime=setTimeout(function () {
                    change();
                },600);
            };
            change();
        }
        function stop(){
            if(!title) return;
            title.html(oldtittle)
            window.clearTimeout(window._titleMsgTime)
        }

        this.getUnread(function (res) {
            if(res.code){
                if(res.data.num > 0){
                    start()
                }else{
                    stop()
                }
            }else{
                stop()
            }
        })
        // 消息框滚动事件
        let contab = $('#chat-tab')
        contab.unbind('shown.bs.tab').bind('shown.bs.tab',function (event){
            userMsg.scrollToBottom()
        })
    },
    getUnread:function (func) {
        if(userId === "" || userId===undefined){
            return
        }
        $.post(gconf.index, {
            handleMsg: 1,
            type: "getUnRead",
        },function (res) {
            res=JSON.parse(res)
            if(res.code){
                if(res.data.num > 0){
                    let headmsg = $("#my-message")
                    headmsg.html(headmsg.html()+` (${res.data.num})`)
                }
            }
            func(res)
        })
    },
    getMsg:function (fid,func) {
        $.post(gconf.index, {
            handleMsg: 1,
            type: "getUserMsg",
            fid: fid,
        },function (res) {
            res=JSON.parse(res)
            func(res)
            userMsg.scrollToBottom()
        })
    },
    sendMsg:function (to, text, func){
        $.post(gconf.index, {
            handleMsg: 1,
            type: "sendMsg",
            to: to,
            text: text
        },function (res) {
            res=JSON.parse(res)
            func(res)
            userMsg.scrollToBottom()
        })
    },
    gensSenderTemplate: function (sender,val) {
        return `<div class="media sender"><div class="media-content"><div class="media-left"><figure class="image is-circle is-32"><img src="${sender.avatar}" title="gogobody"></figure></div>
                                            <div class="media-body"><div class="contact-message-item">${val.text}</div></div></div>
                                            <div class="media-right text-xs text-muted">${val.datetime}</div></div>`
    },
    gensReceiverTemplate: function (receiver,val) {
        return `<div class="media receiver"><div class="media-content"><div class="media-left"><figure class="image is-circle is-32"><img src="${receiver.avatar}" title="gogobody"></figure></div>
                                            <div class="media-body"><div class="contact-message-item">${val.text}</div></div></div>
                                            <div class="media-right text-xs text-muted">${val.datetime}</div></div>`
    },
    buildChatBox:function (uid) {
        userMsg.getMsg(uid,function (res) {
            if(res.code){
                let receiver = res.data.receiver
                let sender = res.data.sender
                let contab = $('#chat-tab')
                let msglist = $('#contact-message-list')
                if(receiver.uid){
                    contab.children('a').text(receiver.name)
                    contab.children('a').data('uid',receiver.uid)
                    let msgs = res.data.message
                    let html =''
                    msgs.forEach(function (val) {
                        if(val.from === "sender"){
                            html+= userMsg.gensSenderTemplate(sender,val)
                        }else{
                            html+= userMsg.gensReceiverTemplate(receiver,val)
                        }
                    })
                    msglist.html(html)
                    contab.show()
                    let ctabs = document.querySelector("#chat-tab a")
                    if(ctabs){
                        let tmp = new bootstrap.Tab(ctabs)
                        tmp.show()
                    }
                }
            }
            userMsg.scrollToBottom()
        })
    },
    // 滚动聊天框到底部
    scrollToBottom:function () {
        let contactArea = $("#contact-messages")
        contactArea.scrollTop(contactArea[0].scrollHeight)
    },
    pjax_complete:function () {

    }

}
var userCenter = {
    persenalInit:function () {
        let personalForm = $("#OneCircle")
        let personalFormBtn = $("#OneCircle button[type='submit']")
        personalFormBtn.unbind('click').bind('click', function (e) {
            $(this).attr("disabled", true)
            personalForm.submit()
        })
        personalForm.submit(function () {
            let formdata = $(this).serializeArray()
            $.ajax({
                url: $(this).attr('action'),
                type: 'post',
                data: formdata,
                error: function () {
                    alert("提交失败，请检查网络并重试或者联系管理员。");
                    personalFormBtn.attr("disabled", false)
                    return false
                },
                success: function (d) {
                    personalFormBtn.attr("disabled", false)
                    window.location.reload()
                }
            });
            return false
        })
        // avatar uploader
        let uploader = $("#avatar-uploader")
        uploader.show()
    }
}

var safe = {
    stripscript:function (s) {
        return s.replace(/<script.*?>.*?<\/script>/ig, '');
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
    init: function () {
        this.init_load_more()
    },
    pjax_complete: function () {
        this.init_load_more()
    },
    eventInit: function () {

    },
    /* 初始化加载更多 */
    init_load_more: function () {
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
                success: function (data) {
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

const OneLocalStorage = {
    set: function (key, value, ttl_s) {
        var data = { value: value, expirse: new Date(ttl_s*1000).getTime() };
        localStorage.setItem(key, JSON.stringify(data));
    },
    get: function (key) {
        var data = JSON.parse(localStorage.getItem(key));
        if (data !== null) {
            if (data.expirse != null && data.expirse < new Date().getTime()) {
                localStorage.removeItem(key);
            } else {
                return data.value;
            }
        }
        return null;
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
    $('[data-toggle="tooltip"]').tooltip()
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
    // reinit tabs
    userMsg.pjax_complete()
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
        } else {
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
function delComments(url, needRefresh) {
    if (confirm("您真的确定要删除吗？")) {
        $.post(gconf.oneaction, {
            type: 'getsecuritytoken'
        }, function (res) {
            if (res.code) {
                // console.log(res)
                $.ajax({
                    url: gconf.index + url + '&_=' + res.data,
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
                        if (re.success) {
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
        title.val(val.substring(0, 40))
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
    } else {
        $.message({
            title: "提示",
            message: "还没有创建圈子",
            type: "error"
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
