<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer class="container">
    &copy; <?php echo date('Y'); ?> <a class="footer-item"
                                       href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
    <br>
    <?php if ($this->options->recordNo): ?>
        <a class="footer-item" target="_blank"
           href="http://beian.miit.gov.cn/"> <?php $this->options->recordNo(); ?></a>
    <?php endif ?>
    <br>
    <?php $this->options->footerEcho(); ?>
    <p class="footer-item">Designed by <b title="">gogobody</b></p>
</footer>
<script src="<?php $this->options->themeUrl('assets/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/popper.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/extend.js'); ?>"></script>
<?php $this->options->jsEcho(); ?>
<?php if (!$this->is('index')): ?>
    <script src="<?php $this->options->themeUrl('assets/js/prism.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('assets/owo/owo_02.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('assets/js/page.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('assets/js/jquery.fancybox.min.js'); ?>"></script>
<?php endif; ?>
<?php if ($this->options->jsPushBaidu):?>
    <script src="<?php $this->options->themeUrl('assets/js/push.js'); ?>"></script>
<?php endif;?>
<?php $this->footer(); ?>
