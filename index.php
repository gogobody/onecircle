<?php
/**
 * 一个圈子主题，改自@Lanstar https://dyedd.cn
 *
 * @package OneCircle
 * @author gogobody
 * @version 1.0
 * @link https://blog.gogobody.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/header.php');
?>
    <div class="container" id="pjax-container">
        <div class="row">
            <?php $this->need('includes/nav.php'); ?>
            <div class="col-xl-7 col-md-6 col-12 main-content">
                <?php if ($this->user->hasLogin()): //判断是否登录 ?>
                <?$this->need('components/index/index-input.php');?>
                <?php endif; ?>

<!--暂时取消首页幻灯片-->
<!--                --><?php //if ($this->options->bannerUrl): ?>
<!--                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">-->
<!--                        <ol class="carousel-indicators">-->
<!--                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>-->
<!--                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>-->
<!--                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>-->
<!--                        </ol>-->
<!--                        <div class="carousel-inner">-->
<!--                            --><?php //echo utils::bannerHandle($this->options->bannerUrl); ?>
<!--                        </div>-->
<!--                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"-->
<!--                           data-slide="prev">-->
<!--                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--                            <span class="sr-only">Previous</span>-->
<!--                        </a>-->
<!--                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"-->
<!--                           data-slide="next">-->
<!--                            <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--                            <span class="sr-only">Next</span>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                --><?php //endif; ?>
                <div class="list">
                    <?php while ($this->next()): ?>
                        <? $this->need('components/index/article-content.php'); ?>
                    <?php endwhile; ?>
                    <!--            分页-->
                    <div class="page-pagination">
                        <?php
                        $this->pageNav(
                            '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-double-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                          <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                        </svg>',
                            '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-double-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                      <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>',
                            1, '...', array(
                            'wrapTag' => 'ul',
                            'wrapClass' => 'pagination justify-content-center',
                            'itemTag' => 'li',
                            'itemClass' => 'page-item',
                            'linkClass' => 'page-link',
                            'currentClass' => 'active'
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <?php $this->need('includes/right.php'); ?>
        </div>
    </div>


<?php $this->need('includes/footer.php'); ?>


