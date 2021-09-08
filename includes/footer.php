<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php /*公告*/ if ($this->options->announcement):?>
<div class="position-fixed bottom-0 left-0 p-3" style="z-index: 5; left: 0; bottom: 0;">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
        <div class="toast-header">
            <img src="<?php $this->options->favicon(); ?>" class="rounded mr-2" style="height: 26px;" alt="icon">
            <strong class="mr-auto">站长公告</strong>
            <small class="text-muted">just now~</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            <?php $this->options->announcement() ?>
        </div>
    </div>
</div>
<?php endif; ?>
</div> <!--close header app layout-->


<footer class="container footer">
    &copy; <?php echo date('Y'); ?>
    <a class="footer-item" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
    <?php if ($this->options->recordNo): ?>
        <a class="footer-item" target="_blank"
           href="http://beian.miit.gov.cn/"> <?php $this->options->recordNo(); ?></a>
    <?php endif ?>
    <?php $this->options->footerEcho(); ?>
    <!--可以去除主题版权信息，最好保留版权信息或者添加主题信息到友链，谢谢你的理解-->
    <span class="footer-item">&nbsp;|&nbsp;Powered by <a target="_blank" href="http://www.typecho.org">Typecho</a>&nbsp;|&nbsp;Designed by <b title="author info"><a target="_blank" href="https://github.com/gogobody/onecircle">gogobody</a></b></span>
</footer>

<script crossorigin="anonymous" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" src="https://lib.baomitu.com/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery.form/3.09/jquery.form.min.js"></script>
<script crossorigin="anonymous" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" src="https://lib.baomitu.com/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.js"></script>
<?php $this->options->jsEcho(); ?>

<script src="<?php $this->options->themeUrl('assets/owo/owo_02.js'); ?>?version=<?php themeVersion() ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/page.min.js'); ?>?version=<?php themeVersion() ?>"></script>
<script crossorigin="anonymous" integrity="sha384-Zm+UU4tdcfAm29vg+MTbfu//q5B/lInMbMCr4T8c9rQFyOv6PlfQYpB5wItcXWe7" src="//lib.baomitu.com/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
<script src="<?php $this->options->themeUrl('assets/js/prism.min.js'); ?>?version=<?php themeVersion() ?>"></script>

<!-- 鼠标点击特效 -->
<?php $this->need('blog/config/cursor.effect.php'); ?>

<?php Typecho_Plugin::factory('SmmsForTypecho')->footer($this); ?>
<?php
    $userId = -1; //save userid
    if ($this->user->hasLogin()){
        $userId = $this->user->uid;
    }
?>
<script>userId=<?echo $userId?></script>
<script src="<?php $this->options->themeUrl('assets/js/onecircle.min.js'); ?>?version=<?php themeVersion() ?>"></script>
<?php if ($this->options->jsPushBaidu):?>
    <script src="<?php $this->options->themeUrl('assets/js/push.js'); ?>"></script>
<!--    // 加载不出时触发-->
<!--    // $('img').on('error', function () {-->
<!--    //     $(this).attr("src", "https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=3031618999,450259559&fm=11&gp=0.jpg");-->
<!--    // })-->
<?php endif;?>
<script>
$(document).pjax('a[href^="<?php Helper::options()->siteUrl()?>"]:not(a[target="_blank"], a[no-pjax],form,#id_iframe)', {
    container: '#pjax-container',//
    fragment: '#pjax-container',
    timeout: 8000
});
$(document).on('pjax:send',
    function() {
        NProgress.start();
    });

$(document).on('pjax:complete',function (){});
$(document).on('pjax:end',function (){ NProgress.done();});
$(document).on('pjax:start', function() {});
$(document).on('ready pjax:end', function(event) {
    pjaxInit();
    if (typeof smms_node!="undefined" && typeof smms!="undefined"){
        smms_node.init();
        smms.init();
    }
    if (typeof smms!="undefined"){
        smms.init();
    }
});
</script>
<?php if ($this->options->f12disable): ?>
<script>// 禁止f12
    ((function() {
        var callbacks = [],
            timeLimit = 50,
            open = false;
        setInterval(loop, 1);
        return {
            addListener: function(fn) {
                callbacks.push(fn);
            },
            cancleListenr: function(fn) {
                callbacks = callbacks.filter(function(v) {
                    return v !== fn;
                });
            }
        }
        function loop() {
            var startTime = new Date();
            debugger;
            if (new Date() - startTime > timeLimit) {
                if (!open) {
                    callbacks.forEach(function(fn) {
                        fn.call(null);
                    });
                }
                open = true;
                window.stop();
                alert('不要扒我了');
                window.location.reload();
            } else {
                open = false;
            }
        }
    })()).addListener(function() {
        window.location.reload();
    });
</script>
<?php endif; ?>
<?php $this->footer(); ?>

<?php if ($this->options->compressHtml): $html_source = ob_get_contents(); ob_clean(); print utils::compressHtml($html_source); ob_end_flush(); endif; ?>
</body>
</html>
