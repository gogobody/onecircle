<?php
/**
 * usercenter page
 */
$this->need('includes/header.php');
$author_url = Typecho_Common::url('/author/' . $this->user->uid . '/', $this->options->index);
Typecho_Widget::widget('Widget_Security')->to($security);
?>

<?php $this->need('includes/body-layout.php'); ?>
<div class="hbox hbox-auto-xs hbox-auto-sm index">
    <div class="col center-part">
        <div class="main-content">
            <!-- 主体 -->
            <div class="page">
                <div class="usercenter-container">
                    <?php $this->need('components/usercenter/aside.php')?>

                    <div class="right-panel">
                        <header class="header bg-light lt">
                            <ul class="nav nav-tabs nav-white">
                                <li class="nav-item"><a class="nav-link active" href="#setting-info" data-toggle="tab"
                                                        aria-expanded="true">我的资料</a></li>
                                <li class="nav-item"><a class="nav-link" href="#setting-privacy" data-toggle="tab"
                                                        aria-expanded="false">隐私</a></li>
                                <li class="nav-item"><a class="nav-link" href="#setting-avatar" data-toggle="tab"
                                                        aria-expanded="false">个性化</a></li>
                                <li class="nav-item"><a class="nav-link" href="#setting-password" data-toggle="tab"
                                                        aria-expanded="false">密码</a></li>
                                <li class="nav-item"><a class="nav-link" href="#setting-bind" data-toggle="tab"
                                                        aria-expanded="false">帐号绑定</a></li>
                            </ul>
                        </header>
                        <section>
                            <div class="tab-content wrapper bg-white">
                                <div class="tab-pane active" id="setting-info">
                                    <form action="<?php $security->index('/action/users-profile'); ?>" method="post"
                                          enctype="application/x-www-form-urlencoded" class="form-horizontal"
                                          id="info-form" autocomplete="off" novalidate="novalidate">
                                        <div class="form-group row clearfix">
                                            <label for="L_id" class="col-lg-4 col-md-3 control-label">UID</label>
                                            <div class="col-lg-8 col-md-9">
                                                <input type="text" id="L_id" value="<?php _e($this->user->uid); ?>"
                                                       class="form-control" disabled="">
                                                <div class="help-block m-b-none">UID无法修改</div>
                                            </div>

                                        </div>
                                        <div class="form-group row clearfix">
                                            <label for="L_name" class="col-lg-4 col-md-3 control-label">用户名</label>
                                            <div class="col-lg-8 col-md-9">
                                                <input type="text" id="L_name" value="<?php _e($this->user->name); ?>"
                                                       class="form-control" disabled="">
                                                <div class="help-block m-b-none">用户名设置后将无法修改</div>
                                            </div>
                                        </div>
                                        <div class="form-group row clearfix">
                                            <label for="L_scname" class="col-lg-4 col-md-3 control-label">昵称</label>
                                            <div class="col-lg-8 col-md-9">
                                                <input name="screenName" type="text" id="L_scname"
                                                       value="<?php $this->user->screenName(); ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row clearfix">
                                            <label for="L_mail" class="col-lg-4 col-md-3 control-label">邮箱</label>
                                            <div class="col-lg-8 col-md-8">
                                                <input name="mail" type="text" id="L_mail"
                                                       value="<?php $this->user->mail(); ?>" class="form-control">
                                                <div class="help-block m-b-none">
                                                    <a>修改邮箱</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row clearfix">
                                            <label for="L_telephone" class="col-lg-4 col-md-3 control-label">手机号</label>
                                            <div class="col-lg-8 col-md-8">
                                                <input type="text" id="L_telephone" value="" class="form-control"
                                                       disabled="">
                                                <div class="help-block m-b-none"><a data-dev="">修改手机号</a></div>
                                            </div>
                                        </div>
                                        <div class="form-group row clearfix">
                                            <label for="L_url" class="col-lg-4 col-md-3 control-label">个人主页</label>
                                            <div class="col-lg-8 col-md-8">
                                                <input type="text" id="L_url" name="url"
                                                       value="<?php $this->user->url(); ?>" placeholder="http://"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row clearfix">
                                            <div class="col-lg-offset-2 col-md-offset-4 col-lg-8 col-md-8">
                                                <button class="btn btn-dark" data-submit="#info-form">确认修改</button>
                                            </div>
                                        </div>
                                        <input name="do" type="hidden" value="profile">
                                    </form>
                                </div>
                                <div class="tab-pane" id="setting-privacy">
<!--                                    <form method="post" action="" class="form-horizontal"-->
<!--                                          id="privacy-form" autocomplete="off" novalidate="novalidate">-->
<!--                                        <div class="form-group row clearfix">-->
<!--                                            <label for="L_onlineStatus"-->
<!--                                                   class="col-lg-4 col-md-3 control-label">在线状态</label>-->
<!--                                            <div class="col-lg-8 col-md-8">-->
<!--                                                <select name="onlineStatus" id="L_onlineStatus" class="form-control">-->
<!--                                                    <option value="all">所有人</option>-->
<!--                                                    <option value="login">已登录用户</option>-->
<!--                                                    <option value="self">自己</option>-->
<!--                                                </select>-->
<!--                                                <div class="help-block m-b-none">当你在登录状态下访问了任何页面，即算作是在线状态，会在你的 <a-->
<!--                                                            href="https://www.sisome.com/user/13/"-->
<!--                                                            target="_blank">个人主页</a> 上显示 <i-->
<!--                                                            class="layui-badge user-online"></i> 。如果你 15-->
<!--                                                    分钟内没有访问任何其他页面，那么就会算作是离线。离线状态在个人主页上不会有任何标识。默认情况下，所有人都可以看到你的在线状态-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group row clearfix">-->
<!--                                            <label for="L_showFollow"-->
<!--                                                   class="col-lg-4 col-md-3 control-label">关注列表</label>-->
<!--                                            <div class="col-lg-8 col-md-8">-->
<!--                                                <select name="showFollow" id="L_showFollow" class="form-control">-->
<!--                                                    <option value="all">所有人</option>-->
<!--                                                    <option value="login">已登录用户</option>-->
<!--                                                    <option value="self">自己</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group row clearfix">-->
<!--                                            <label for="L_showFans" class="col-lg-4 col-md-3 control-label">粉丝列表</label>-->
<!--                                            <div class="col-lg-8 col-md-8">-->
<!--                                                <select name="showFans" id="L_showFans" class="form-control">-->
<!--                                                    <option value="all">所有人</option>-->
<!--                                                    <option value="login">已登录用户</option>-->
<!--                                                    <option value="self">自己</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group row clearfix">-->
<!--                                            <label for="L_home_activity"-->
<!--                                                   class="col-lg-4 col-md-3 control-label">首页动态列表</label>-->
<!--                                            <div class="col-lg-8 col-md-8">-->
<!--                                                <select name="home[activity]" id="L_home_activity" class="form-control">-->
<!--                                                    <option value="all" selected="">所有人</option>-->
<!--                                                    <option value="login">已登录用户</option>-->
<!--                                                    <option value="self">自己</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group row clearfix">-->
<!--                                            <label for="L_home_topics"-->
<!--                                                   class="col-lg-4 col-md-3 control-label">首页主题列表</label>-->
<!--                                            <div class="col-lg-8 col-md-8">-->
<!--                                                <select name="home[topics]" id="L_home_topics" class="form-control">-->
<!--                                                    <option value="all" selected="">所有人</option>-->
<!--                                                    <option value="login">已登录用户</option>-->
<!--                                                    <option value="self">自己</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group row clearfix">-->
<!--                                            <label for="L_home_replies"-->
<!--                                                   class="col-lg-4 col-md-3 control-label">首页回复列表</label>-->
<!--                                            <div class="col-lg-8 col-md-8">-->
<!--                                                <select name="home[replies]" id="L_home_replies" class="form-control">-->
<!--                                                    <option value="all" selected="">所有人</option>-->
<!--                                                    <option value="login">已登录用户</option>-->
<!--                                                    <option value="self">自己</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group row clearfix">-->
<!--                                            <label for="L_home_comments"-->
<!--                                                   class="col-lg-4 col-md-3 control-label">首页评论列表</label>-->
<!--                                            <div class="col-lg-8 col-md-8">-->
<!--                                                <select name="home[comments]" id="L_home_comments" class="form-control">-->
<!--                                                    <option value="all" selected="">所有人</option>-->
<!--                                                    <option value="login">已登录用户</option>-->
<!--                                                    <option value="self">自己</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group row clearfix">-->
<!--                                            <label for="L_home_posts"-->
<!--                                                   class="col-lg-4 col-md-3 control-label">首页文章列表</label>-->
<!--                                            <div class="col-lg-8 col-md-8">-->
<!--                                                <select name="home[posts]" id="L_home_posts" class="form-control">-->
<!--                                                    <option value="all" selected="">所有人</option>-->
<!--                                                    <option value="login">已登录用户</option>-->
<!--                                                    <option value="self">自己</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group row clearfix">-->
<!--                                            <label for="L_favorite_node"-->
<!--                                                   class="col-lg-4 col-md-3 control-label">节点收藏列表</label>-->
<!--                                            <div class="col-lg-8 col-md-8">-->
<!--                                                <select name="favorite[node]" id="L_favorite_node" class="form-control">-->
<!--                                                    <option value="all" selected="">所有人</option>-->
<!--                                                    <option value="login">已登录用户</option>-->
<!--                                                    <option value="self">自己</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group row clearfix">-->
<!--                                            <label for="L_favorite_topic"-->
<!--                                                   class="col-lg-4 col-md-3 control-label">主题收藏列表</label>-->
<!--                                            <div class="col-lg-8 col-md-8">-->
<!--                                                <select name="favorite[topic]" id="L_favorite_topic"-->
<!--                                                        class="form-control">-->
<!--                                                    <option value="all" selected="">所有人</option>-->
<!--                                                    <option value="login">已登录用户</option>-->
<!--                                                    <option value="self">自己</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group row clearfix">-->
<!--                                            <label for="L_favorite_post"-->
<!--                                                   class="col-lg-4 col-md-3 control-label">文章收藏列表</label>-->
<!--                                            <div class="col-lg-8 col-md-8">-->
<!--                                                <select name="favorite[post]" id="L_favorite_post" class="form-control">-->
<!--                                                    <option value="all" selected="">所有人</option>-->
<!--                                                    <option value="login">已登录用户</option>-->
<!--                                                    <option value="self">自己</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group row clearfix">-->
<!--                                            <label for="L_follow_fans"-->
<!--                                                   class="col-lg-4 col-md-3 control-label">粉丝列表</label>-->
<!--                                            <div class="col-lg-8 col-md-8">-->
<!--                                                <select name="follow[fans]" id="L_follow_fans" class="form-control">-->
<!--                                                    <option value="all" selected="">所有人</option>-->
<!--                                                    <option value="login">已登录用户</option>-->
<!--                                                    <option value="self">自己</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group row clearfix">-->
<!--                                            <label for="L_follow_follow"-->
<!--                                                   class="col-lg-4 col-md-3 control-label">关注列表</label>-->
<!--                                            <div class="col-lg-8 col-md-8">-->
<!--                                                <select name="follow[follow]" id="L_follow_follow" class="form-control">-->
<!--                                                    <option value="all" selected="">所有人</option>-->
<!--                                                    <option value="login">已登录用户</option>-->
<!--                                                    <option value="self">自己</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group row clearfix">-->
<!--                                            <div class="col-lg-offset-2 col-md-offset-4 col-lg-8 col-md-8">-->
<!--                                                <button class="btn btn-dark" data-submit="#privacy-form">保存</button>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </form>-->
                                    <div class="media pa-2">
                                        <div class="media-left"><i class="icon icon-qq"></i></div>
                                        <div class="media-body">
                                            还没开发
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="setting-avatar">
                                    <div class="form-group">
                                        <div class="avatar-add text-center">
                                            <?php Typecho_Widget::widget('Widget_Users_Profile')->personalFormList(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="setting-password">
                                    <?php Typecho_Widget::widget('Widget_Users_Profile')->passwordForm()->render(); ?>
                                </div>
                                <div class="tab-pane" id="setting-bind">
                                    <div class="media pa-2">
                                        <div class="media-left"><i class="icon icon-qq"></i></div>
                                        <div class="media-body">
                                            还没开发
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script crossorigin="anonymous" integrity="sha384-LVoNJ6yst/aLxKvxwp6s2GAabqPczfWh6xzm38S/YtjUyZ+3aTKOnD/OJVGYLZDl" src="//lib.baomitu.com/jquery/3.5.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#personal-OneCircle>h3").hide()
        $('form ul.typecho-option li').addClass("form-group d-flex d-flex-wrap")
        $('form ul.typecho-option li label').addClass("col-sm-2 col-form-label")
        var ty_form_input = $('form ul.typecho-option li>input')
        ty_form_input.addClass("form-control col-sm-10")
        $('form ul.typecho-option li span > label').addClass("radio-label")
        $(".typecho-option.typecho-option-submit > li > button").addClass("btn-dark")
        var errmsg = $(".message.error")
        if(errmsg.length > 0){
            var text = errmsg.text()
            var html = '<div class="alert alert-danger" role="alert">\n' +text +'</div>'
            $(".page").prepend(html)
        }
    })
</script>
<?php $this->need('includes/footer.php'); ?>
