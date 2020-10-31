<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php
// get categories for index search
if ($this->is('index')){
    $this->widget('Widget_Metas_Category_List')->to($obj);
    $arr = array();
    if($obj->have()){
        while($obj->next()){
            $tmp = array();
            array_push($tmp,$obj->name,$obj->mid,parseDesc2img($this->options->defaultSlugUrl,$obj->description),parseDesc2text($obj->description));
            array_push($arr,$tmp);
        }
    }
    echo '<script type="text/javascript">allCategories = '.json_encode($arr).'</script>';
}
?>

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

<script crossorigin="anonymous" integrity="sha384-LVoNJ6yst/aLxKvxwp6s2GAabqPczfWh6xzm38S/YtjUyZ+3aTKOnD/OJVGYLZDl" src="//lib.baomitu.com/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery.form/3.09/jquery.form.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.js"></script>
<?php $this->options->jsEcho(); ?>
<?php //if (!$this->is('index')): ?>

<?php //else:?>
<?php //endif; ?>
<script src="<?php $this->options->themeUrl('assets/js/prism.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/owo/owo_02.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/page.min.js'); ?>"></script>
<script crossorigin="anonymous" integrity="sha384-Zm+UU4tdcfAm29vg+MTbfu//q5B/lInMbMCr4T8c9rQFyOv6PlfQYpB5wItcXWe7" src="//lib.baomitu.com/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
<?php
    $userId = -1; //save userid
    if ($this->user->hasLogin()){
        $userId = $this->user->uid;
    }
?>
<script>
    userId=<?echo $userId?>
</script>

<script src="<?php $this->options->themeUrl('assets/js/extend.min.js'); ?>"></script>
<?php if ($this->options->jsPushBaidu):?>
    <script src="<?php $this->options->themeUrl('assets/js/push.js'); ?>"></script>
<?php endif;?>
<script>

    $(document).pjax('a[href^="<?php Helper::options()->siteUrl()?>"]:not(a[target="_blank"], a[no-pjax],form,#id_iframe)', {
        container: '#pjax-container',//
        fragment: '#pjax-container',
        timeout: 8000
    })

    $(document).on('pjax:send',
        function() {
            $("#pjax-container").fadeOut();
            NProgress.start();
            $.showloading({
                selector:'header',
                choice: 'after'
            })

        })

    $(document).on('pjax:complete',
        function() {
            $("#pjax-container").fadeIn();
            indexInput.pjax_complete()
            archiveInit.init()
            recommendInit.pjax_complete()
            owoInit();
            NProgress.done();
            $.rmloading()
            if (typeof smms_node!="undefined" && typeof smms!="undefined"){
                smms_node.init()
                smms.init()
            }
            if (typeof smms!="undefined"){
                smms.init()
            }
            //
            tagsManageInit.pjax_complete()
        })
</script>
<?php $this->footer(); ?>
    <div class="back-to-top"></div>
<?php if ($this->options->compressHtml): $html_source = ob_get_contents(); ob_clean(); print utils::compressHtml($html_source); ob_end_flush(); endif; ?>
</body>
</html>
