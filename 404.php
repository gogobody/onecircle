<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('includes/header.php'); ?>
<?php $this->need('includes/body-layout.php');?>
    <div class="hbox hbox-auto-xs hbox-auto-sm  index">
        <div class="col center-part">
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
<?php $this->need('includes/body-layout-end.php');?>
<?php $this->need('includes/footer.php'); ?>