<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 主页 显示 focususer
 */
?>
<div class="row">
    <div class="post-content-inner col-xl-12 focususer-excerpt">
        <?php if ($this->fields->excerpt && $this->fields->excerpt != ''): ?>
            <?php echo $this->fields->excerpt; ?>
        <?php else: ?>
            <?php echo $this->excerpt(70, ''); ?>
        <?php endif; ?>
    </div>
    <?php if ($this->fields->banner && $this->fields->banner != ''): ?>
        <div class="post-cover col-xl-12">
            <div class="post-cover-inner">
                <img src="<?php echo $this->fields->banner; ?>"
                     class="post-cover-img"
                     alt="cover">
            </div>
        </div>
    <?php else: ?>
        <div class="post-cover post-cover-focususer col-xl-12">
            <div class="post-cover-focususer-container">
                <?php $this->content(); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
