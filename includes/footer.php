<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer class="container footer">
    &copy; <?php echo date('Y'); ?>
    <a class="footer-item" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
    <?php if ($this->options->recordNo): ?>
        <a class="footer-item" target="_blank"
           href="http://beian.miit.gov.cn/"> <?php $this->options->recordNo(); ?></a>
    <?php endif ?>
    <?php $this->options->footerEcho(); ?>
    <span class="footer-item">| Designed by <b title="">gogobody</b></span>
</footer>

<script crossorigin="anonymous" integrity="sha384-LVoNJ6yst/aLxKvxwp6s2GAabqPczfWh6xzm38S/YtjUyZ+3aTKOnD/OJVGYLZDl" src="//lib.baomitu.com/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/popper.js/2.5.2/umd/popper.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery.form/3.09/jquery.form.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js"></script>

<?php $this->options->jsEcho(); ?>
<?php if (!$this->is('index')): ?>
    <script src="<?php $this->options->themeUrl('assets/js/prism.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('/assets/owo/owo_02.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('assets/js/page.js'); ?>"></script>
    <script crossorigin="anonymous" integrity="sha384-Zm+UU4tdcfAm29vg+MTbfu//q5B/lInMbMCr4T8c9rQFyOv6PlfQYpB5wItcXWe7" src="//lib.baomitu.com/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<?php else:?>
<?php endif; ?>

<?php
    $userId = -1; //save userid
    if ($this->user->hasLogin()){
        $userId = $this->user->uid;
    }
?>
<script>userId=<?echo $userId?></script>

<script src="<?php $this->options->themeUrl('assets/js/extend.js'); ?>"></script>
<?php if ($this->options->jsPushBaidu):?>
    <script src="<?php $this->options->themeUrl('assets/js/push.js'); ?>"></script>
<?php endif;?>
<script>
    //$(document).pjax('a[href^="<?php //Helper::options()->siteUrl()?>//"]:not(a[target="_blank"], a[no-pjax])', {
    //    container: '#pjax-container',
    //    fragment: '#pjax-container',
    //    timeout: 8000
    //})
    //$.pjax.reload('#pjax-container', {
    //    container: '#pjax-container',
    //    fragment: '#pjax-container',
    //    timeout: 8000
    //})
    //$(document).on('pjax:send',
    //    function() {
    //        $('#loader-wrapper').addClass("in");
    //    })
    //
    //$(document).on('pjax:complete',
    //    function() {
    //        $('#loader-wrapper').removeClass("in");
    //    })
</script>
<?php $this->footer(); ?>
    <div class="back-to-top"></div>
<?php if ($this->options->compressHtml): $html_source = ob_get_contents(); ob_clean(); print utils::compressHtml($html_source); ob_end_flush(); endif; ?>