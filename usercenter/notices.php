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
            <div class="page notice-page">
                <div class="usercenter-container">
                    <?php $this->need('components/usercenter/aside.php')?>
                    <div class="right-panel">
                        <aside>
                            <header class="header bg-light lt">
                                <p class="l-h font-bold">系统消息 </p>
                                <p class="pull-right i-sm">共收到了 <?php _e($this->notices->getTotal());?> 条消息</p>
                            </header>
                            <section class="scrollable">
                                <div class="panel no-borders">
                                    <ul class="list-group">
                                        <?php if($this->notices->have()):?>
                                        <?php while ($this->notices->next()):?>
                                        <li class="list-group-item">
                                            <span><?php _e($this->notices->text) ?></span>
                                            <time class="pull-right text-muted"><?php _e($this->notices->date->word()); ?></time>
                                        </li>
                                        <?php endwhile;?>
                                        <?php else:?>
                                            <li class="list-group-item">
                                                <span>目前尚无任何消息~</span>
                                            </li>
                                        <?php endif;?>
                                    </ul>
                                    <div class="panel-footer center"></div>
                                </div>
                            </section>
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
        if(errmsg.length > 0){
            var text = errmsg.text()
            var html = '<div class="alert alert-danger" role="alert">\n' +text +'</div>'
            $(".page").prepend(html)
        }
    })
</script>
<?php $this->need('includes/footer.php'); ?>
