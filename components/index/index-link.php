<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 主页 显示 link
 */
?>
<div class="post-content-inner-link col-xl-12">
    <? echo parseMarkdownBeforeText($this->text)?>
    <a class="link-a" href="<?php echo parseFirstURL($this->content); ?>" target="_blank">
        <div class="link-container link-a">
            <div class="link-banner">
                <img src="<? echo Helper::options()->themeUrl . '/assets/img/link.png' ?>">
                <div class="link-text">
                    <?php echo parseMarkdownInText($this->text) ?>
                </div>
            </div>
        </div>
    </a>
</div>
