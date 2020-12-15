<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 主页 显示 图文 default
 */
$arr = getGirdPics($this);
?>
<div class="row">

    <div class="post-content-inner col-xl-12">
        <?php if ($this->fields->excerpt && $this->fields->excerpt != ''): ?>
            <?php echo $this->fields->excerpt; ?>
        <?php else: ?>
            <?php
            if ($arr['length'] > 0) {
                echo $this->excerpt(100);
            } else {
                echo $this->excerpt(180);
            }
            ?>
        <?php endif; ?>
    </div>
    <?php if ($this->fields->banner && $this->fields->banner != ''): ?>
        <div class="post-cover col-xl-12">
            <div class="post-cover-inner">
                <a data-fancybox='gallery' href='<?php echo $this->fields->banner; ?>'>
                    <img src="<?php echo $this->fields->banner; ?>" class="post-cover-img" alt="cover">
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="post-cover col-xl-12">
            <div class="post-cover-img-container" onclick="">
                <?php ehco9gridPics($arr['images'], $arr['length']); ?>
            </div>
        </div>
    <?php endif; ?>
</div>