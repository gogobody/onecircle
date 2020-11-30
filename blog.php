<?php
/**
 * neighbor page
 */
$this->need('includes/header.php');
?>

<?php $this->need('includes/body-layout.php');?>
<div class="hbox hbox-auto-xs hbox-auto-sm index">
    <div class="col center-part">
        <div class="main-content">
            <!-- 主体 -->
            <section class="container-xl j-index">
                <section class="j-adaption">
                    <section class="main">

                        <?php if ($this->is('blog')) : ?>
                            <?php $this->need('blog/component/index.banner.php'); ?>
                            <?php $this->need('blog/component/index.hot.php'); ?>
                            <?php $this->need('blog/component/index.ad.php'); ?>
                            <?php $this->need('blog/component/index.title.php'); ?>
                        <?php else : ?>
                            <?php $this->need('blog/component/search.title.php'); ?>
                        <?php endif; ?>

                        <section class="j-index-article article">
                            <!-- 置顶文章 -->
                            <?php if ($this->is('blog')) : ?>
                                <?php $this->need('blog/component/index.sticky.php'); ?>
                            <?php endif; ?>
                            <!-- 列表 -->
                            <?php $this->need('blog/component/index.list.php'); ?>
                        </section>

                    </section>
                    <?php $this->need('blog/public/blog-pagination.php'); ?>
                </section>


            </section>
            <!--分页-->
<!--            --><?php //$this->need('includes/post-pagination.php');?>

        </div>
    </div>
</div>
<?php  $this->need('includes/footer.php');?>
