<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 主页 显示 all
 */
?>
<div class="row">

    <div class="post-content-inner col-xl-12">
        <?php
           _parseContent($this, $this->user->hasLogin())
        ?>

    </div>
    <!-- 占位 -->
    <div class="post-cover col-xl-12">
        <div class="post-cover-img-container" onclick="">
        </div>
    </div>
</div>