<?php
/**
 * credits  page
 */
$this->need('includes/header.php');
$author_url = Typecho_Common::url('/author/' . $this->user->uid . '/', $this->options->index);
Typecho_Widget::widget('Widget_Security')->to($security);
$credits_arr = utils::creditsConvert($this->user->credits);

?>

<?php $this->need('includes/body-layout.php'); ?>
<div class="hbox hbox-auto-xs hbox-auto-sm index">
    <div class="col center-part">
        <div class="main-content">
            <!-- 主体 -->
            <div class="page message-page">
                <div class="usercenter-container">
                    <?php $this->need('components/usercenter/aside.php') ?>
                    <div class="right-panel">
                        <aside>
                            <aside id="user-messages">
                                <header class="header bg-light lt">
                                    <ul id="chat-tabs" class="nav nav-tabs nav-white">
                                        <li class="nav-item"><a class="nav-link active" href="#contact-list"
                                                                data-toggle="tab" aria-expanded="true">联系人</a></li>
                                        <li class="nav-item" id="chat-tab" style="display: none;"><a class="nav-link" href="#contact-chat" data-toggle="tab" aria-expanded="false"></a></li>
                                    </ul>
                                </header>
                                <div class="tab-content">
                                    <div id="contact-list" class="tab-pane fade show active">
                                        <div class="contact-search wrapper"><input id="contact-search" type="text"
                                                                                   placeholder="搜索关注者"
                                                                                   class="form-control">
                                        </div>
                                        <ul class="list-group contact-list">
                                            <?php
                                            // 解析 url 参数
                                            $urlParams = utils::parseUrlQuery($this->request->getRequestUrl());
                                            $talkUid = $urlParams['uid'];
                                            $contactUser=null;
                                            if(!empty($talkUid) && UserFollow::statusFollow($this->user->uid,$talkUid)){
                                                $contactUser=UserFollow::getUserWidget($talkUid);
                                                $showName = empty($contactUser->screenName)?$contactUser->name:$contactUser->screenName;
                                                $showName= $showName.' [新聊天]';
                                            }
                                            // 主要是从参数获取
                                            if ($contactUser):
                                            ?>
                                            <li data-uid="<?php _e($contactUser->uid);?>" class="list-group-item media">
                                                <div class="media-left">
                                                    <figure class="image is-circle is-48"><img
                                                                src="<?php echo getUserV2exAvatar($contactUser->mail,$contactUser->userAvatar)?>"
                                                                title="<?php _e($contactUser->screenName) ?>"></figure>
                                                </div>
                                                <div class="media-body"><p class="font-bold"><?php _e($showName) ?></p>
                                                    <p class="text-muted m-b-none">新聊天<span class="pull-right i-sm">刚刚</span></p>
                                                </div>
                                            </li>
                                            <?php endif;?>

                                            <?php /*遍历已有消息*/if ($this->messages->have()): ?>
                                            <?php while ($this->messages->next()):?>
                                                <?php
                                                    if($this->user->uid == $this->messages->uid){ // 自己是接收方
                                                        $contactUser=UserFollow::getUserWidget($this->messages->fid);
                                                        $showName = empty($contactUser->screenName)?$contactUser->name:$contactUser->screenName;
                                                        if($this->messages->status==0){
                                                            $showName=$showName.' [未读]';
                                                        }
                                                    }else{ // 自己是发送方
                                                        $contactUser=UserFollow::getUserWidget($this->messages->uid);
                                                        $showName = empty($contactUser->screenName)?$contactUser->name:$contactUser->screenName;
                                                    }

                                                    ?>
                                            <li data-uid="<?php _e($contactUser->uid);?>" class="list-group-item media">
                                                <div class="media-left">
                                                    <figure class="image is-circle is-48"><img
                                                                src="<?php echo getUserV2exAvatar($contactUser->mail,$contactUser->userAvatar)?>"
                                                                title="<?php _e($contactUser->screenName) ?>"></figure>
                                                </div>
                                                <div class="media-body"><p class="font-bold"><?php _e($showName) ?></p>
                                                    <p class="text-muted m-b-none"><?php _e(utils::substr($this->messages->text,30)) ?>
                                                        <span class="pull-right i-sm"><?php _e((new Typecho_Date($this->messages->created))->word()) ?></span>
                                                    </p>
                                                </div>
                                            </li>
                                            <?php endwhile; ?>
                                            <?php else:?>

                                            <li class="list-group-item wrapper-lg" style="">
                                                <div class="text-muted">联系人列表为空</div>
                                            </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div id="contact-chat" class="tab-pane fade panel">
                                        <div id="contact-messages" class="contact-messages scrollable">
                                            <div id="contact-message-list">
                                            </div>
                                            <p class="text-center text-muted" style="display: none;">没有更多消息了～</p></div>
                                        <div class="panel-footer">
                                            <div class="form-group"><textarea id="usermsg-input" class="form-control"></textarea></div>
                                            <div class="layui-form-item text-right">
                                                <button id="sendUserMsg" type="button" class="btn btn-secondary btn-sm">发送</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script crossorigin="anonymous" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" src="https://lib.baomitu.com/jquery/3.6.0/jquery.min.js"></script>
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
        if (errmsg.length > 0) {
            var text = errmsg.text()
            var html = '<div class="alert alert-danger" role="alert">\n' + text + '</div>'
            $(".page").prepend(html)
        }
    })
</script>
<?php $this->need('includes/footer.php'); ?>
