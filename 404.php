<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('includes/header.php'); ?>
<div class="container-lg">
    <div class="row">
        <?php $this->need('includes/nav.php');?>
        <div class="col-xl-7 col-md-6 col-12">
            <div class="error-page">
                <h2 class="post-title">404 - <?php _e('页面没找到'); ?></h2>
                <p><?php _e('你想查看的页面已被转移或删除了, 要不要搜索看看: '); ?></p>
                <form method="post">
                    <p><input type="text" name="s" class="text" autofocus /></p>
                    <p><button type="submit" class="submit"><?php _e('搜索'); ?></button></p>
                </form>
            </div>
        </div>
        <?php $this->need('includes/right.php');?>
    </div>
</div>
<?php $this->need('includes/footer.php'); ?>