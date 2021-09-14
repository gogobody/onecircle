(() => {
    class JKHelper {
        constructor(options){
            this.init();
        }
        init(){
            this.init_resource_page();
            this.init_load_more();
        }
        /* resources page event init */
        init_resource_page(){
            let category,tag,price,order = null;

            function queryHtml(){
                $.ajax({
                    url:window.location.href,
                    method:'get',
                    data:{
                        'category':category,
                        'tag':tag,
                        'price':price,
                        'order':order
                    },
                    success:function (res) {
                        let res_content = $(".row.posts-wrapper", res).html()
                        $(".row.posts-wrapper").html(res_content)
                    }
                })
            }
            $(".filter-tag.category li a").unbind('click').bind('click',function (e) {
                e.preventDefault()
                category = $(this).data("mid")
                if($(this).hasClass('on')){
                    category = null
                }
                queryHtml()
                $(this).toggleClass('on')
                $(".term-bar .term-title").text($(this).text())
                $(this).parent().siblings('li').find('a').removeClass('on')
            })
            $(".filter-tag.tag li a").unbind('click').bind('click',function (e) {
                e.preventDefault()
                tag = $(this).data("mid")
                if($(this).hasClass('on')){
                    tag = null
                }
                queryHtml()
                $(this).toggleClass('on')
                $(this).parent().siblings('li').find('a').removeClass('on')
            })
            $(".filter-tag.price li a").unbind('click').bind('click',function (e) {
                e.preventDefault()
                price = $(this).data("price")
                queryHtml()
                $(this).addClass('on')
                $(this).parent().siblings('li').find('a').removeClass('on')
            })
            $(".filter-tag.order li a").unbind('click').bind('click',function (e) {
                e.preventDefault()
                order = $(this).data("order")
                queryHtml()
                $(this).addClass('on')
                $(this).parent().siblings('li').find('a').removeClass('on')
            })
        }

        /* 初始化加载更多 */
        init_load_more() {
            if (window.JKConfig.DOCUMENT_LOAD_MORE !== 'ajax') return;
            let _this = this;
            let jloadmore_a = $('.j-loadmore a')
            jloadmore_a.attr('data-href', jloadmore_a.attr('href'));
            jloadmore_a.removeAttr('href');
            jloadmore_a.unbind('click').bind('click', function () {
                if ($(this).attr('disabled')) return;
                $(this).html('loading...');
                $(this).attr('disabled', true);
                let url = $(this).attr('data-href');
                if (!url) return;
                $.ajax({
                    url: url,
                    type: 'get',
                    success: data => {
                        $(this).removeAttr('disabled');
                        $(this).html('查看更多');
                        let list
                        if(window.JKConfig.ARCHIVE === "resources"){
                            list = $(data).find('.article .posts-wrapper>.post');
                            $('.article .posts-wrapper').append(list);
                        }else{
                            list = $(data).find('.article-list:not(.sticky)');
                            $('.j-index-article.article').append(list);
                        }
                        if (list.length > 0){
                            window.scroll({
                                top: $(list).first().offset().top - ($('.j-header').height() + 20),
                                behavior: 'smooth'
                            });
                        }

                        let newURL = $(data).find('.j-loadmore a').attr('href');
                        if (newURL) {
                            $(this).attr('data-href', newURL);
                        } else {
                            $('.j-loadmore').remove();
                        }
                        // _this.init_lazy_load();
                    }
                });
            });
        }

    }
    if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
        module.exports = JKHelper;
    } else {
        window.JKHelper = JKHelper;
    }
})()
window.JKHelperInstance = new JKHelper({});

