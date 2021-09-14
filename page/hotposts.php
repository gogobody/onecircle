<?php

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('common/common.header.php'); ?>
    <!-- 主体 -->
    <section class="container j-index">
        <section class="j-adaption">
            <section class="main">
                <?php $this->need('component/search.title.php'); ?>
                <section class="j-index-article article">
                    <!-- 列表 -->
                    <?php $this->need('component/index.list.php'); ?>
                </section>

            </section>
            <?php $this->need('public/pagination.php'); ?>
        </section>
    </section>

<?php $this->need('common/common.footer.php'); ?>