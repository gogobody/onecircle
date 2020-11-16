<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

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
<div class="back-to-top animate__animated"></div>
<script crossorigin="anonymous" integrity="sha384-LVoNJ6yst/aLxKvxwp6s2GAabqPczfWh6xzm38S/YtjUyZ+3aTKOnD/OJVGYLZDl" src="//lib.baomitu.com/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery.form/3.09/jquery.form.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.js"></script>
<?php $this->options->jsEcho(); ?>

<script src="<?php $this->options->themeUrl('assets/js/prism.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/owo/owo_02.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/page.min.js'); ?>"></script>
<script crossorigin="anonymous" integrity="sha384-Zm+UU4tdcfAm29vg+MTbfu//q5B/lInMbMCr4T8c9rQFyOv6PlfQYpB5wItcXWe7" src="//lib.baomitu.com/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
<script src="https://cdn.bootcss.com/echo.js/1.7.3/echo.min.js"></script>
<?php
    $userId = -1; //save userid
    if ($this->user->hasLogin()){
        $userId = $this->user->uid;
    }
?>
<script>userId=<?echo $userId?></script>
<script src="<?php $this->options->themeUrl('assets/js/extend.min.js'); ?>"></script>
<?php if ($this->options->jsPushBaidu):?>
    <script src="<?php $this->options->themeUrl('assets/js/push.js'); ?>"></script>
<?php endif;?>
<script>
    var echoInit = function(){
        echo.init({
            offset: 100,
            callback: function (element, op) {
                if (element.style.backgroundImage){ // 如果设置了背景图就把前景 src清空
                    element.src=" "
                }
            }
        });
    }
    window.onload = function(){
        echoInit()
        // 加载不出时触发
        // $('img').on('error', function () {
        //     $(this).attr("src", "https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=3031618999,450259559&fm=11&gp=0.jpg");
        // })
    }
    $(document).pjax('a[href^="<?php Helper::options()->siteUrl()?>"]:not(a[target="_blank"], a[no-pjax],form,#id_iframe)', {
        container: '#pjax-container',//
        fragment: '#pjax-container',
        timeout: 8000
    })
    $(document).on('pjax:send',
        function() {
            NProgress.start();
            $.showloading({
                selector:'header',
                choice: 'after'
            })
        })
    var pjaxInit = function() {
        indexInput.pjax_complete()
        archiveInit.init()
        recommendInit.pjax_complete()
        owoInit();
        if (typeof smms_node!="undefined" && typeof smms!="undefined"){
            smms_node.init()
            smms.init()
        }
        if (typeof smms!="undefined"){
            smms.init()
        }
        //
        tagsManageInit.pjax_complete()
        NProgress.done();
        $.rmloading()
        // reinit echo
        echoInit()
    }
    // $(document).on('pjax:complete',function (){pjaxInit();})
    $(document).on('pjax:end',function (){})
    $(document).on('pjax:start', function() {});
    $(document).on('ready pjax:end', function(event) {pjaxInit();})
</script>
<?php $this->footer(); ?>

<?php if ($this->options->compressHtml): $html_source = ob_get_contents(); ob_clean(); print utils::compressHtml($html_source); ob_end_flush(); endif; ?>
</body>
</html>
