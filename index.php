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
                <?$this->need('includes/index-input.php');?>
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
                        <article class="post-article" onclick="window.location='<?php $this->permalink(); ?>'">
                            <div class="post-article-left">
                                <a onclick="event.stopPropagation();" href="<?php $this->author->permalink(); ?>">
                                    <!--<?php $this->author->gravatar(40); ?>-->
                                    <img class="avatar"
                                         src="<?php echo getUserV2exAvatar($this->author->mail); ?>"
                                         alt="<?php $this->author() ?>"/>
                                </a>
                            </div>
                            <div class="post-article-right">
                                <div class="post-author">
                                    <?php if (!$this->options->singleAuthor): ?>
                                        <div class="author-name" id="post-author-<?php $this->cid() ?>">
                                            <a onclick="event.stopPropagation();" href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>
                                        </div>
                                        <div class="post-time">
                                            <a href="<?php $this->permalink() ?>">
                                                <time><?php echo formatTime($this->created); ?></time>
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <a class="post-title" href="<?php $this->permalink() ?>" target="_blank">
                                            <h4><?php $this->title() ?></h4>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <!--content-->
                                <div class="post-content">
                                    <div class="row">
                                        <!-- link-->
                                        <?php if ($this->fields->articleType == "link"): ?>
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
                                        <!-- default-->
                                        <?php elseif ($this->fields->articleType == "default"): ?>
                                            <div class="post-content-inner col-xl-12">
                                                <?php if ($this->fields->excerpt && $this->fields->excerpt != ''): ?>
                                                    <?php echo $this->fields->excerpt; ?>
                                                <?php else: ?>
                                                    <?php echo $this->excerpt(70); ?>
                                                <? endif; ?>
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
                                            <div class="post-cover col-xl-12">
                                                <div class="post-cover-img-container">
                                                   <?php ehco9gridPics($this);?>
                                                </div>
                                            </div>
                                            <? endif; ?>
                                            <!-- videos -->
                                        <?php elseif ($this->fields->articleType == "video" || $this->fields->articleType == "bilibili"): ?>
                                            <div class="post-content-inner col-xl-12">
                                                <?php if ($this->fields->excerpt && $this->fields->excerpt != ''): ?>
                                                    <?php echo $this->fields->excerpt; ?>
                                                <?php else: ?>
                                                    <?php echo $this->excerpt(70); ?>
                                                <? endif; ?>
                                            </div>
                                            <div class="post-cover col-xl-12" onclick="event.stopPropagation();return false">
                                                <a onclick="videoToggle('#collapse<?_e($this->cid)?>',this)" href="#collapse<?_e($this->cid)?>" data-toggle="collapse" class="toggle-player collapsed" rel="button" aria-expanded="false"
                                                   aria-controls="collapse<?_e($this->cid)?>" data-controls="collapse<?_e($this->cid)?>">
                                                    <div class="">
                                                        <span class="expand">
                                                            <svg class="bi bi-arrows-angle-contract" width=".7em" height=".7em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                              <path fill-rule="evenodd" d="M9.5 2.036a.5.5 0 0 1 .5.5v3.5h3.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5z"/>
                                                              <path fill-rule="evenodd" d="M14.354 1.646a.5.5 0 0 1 0 .708l-4.5 4.5a.5.5 0 1 1-.708-.708l4.5-4.5a.5.5 0 0 1 .708 0zm-7.5 7.5a.5.5 0 0 1 0 .708l-4.5 4.5a.5.5 0 0 1-.708-.708l4.5-4.5a.5.5 0 0 1 .708 0z"/>
                                                              <path fill-rule="evenodd" d="M2.036 9.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V10h-3.5a.5.5 0 0 1-.5-.5z"/>
                                                            </svg>
                                                        </span>
                                                        <span>收缩</span>
                                                    </div>
                                                </a>

                                                <div class="collapse show" id="collapse<?_e($this->cid)?>">
                                                    <?php echo parseFirstVideo($this->content);?>
                                                </div>
                                            </div>
                                        <?php else:?>

                                        <?php endif; ?>
                                    </div>
                                    <!-- action-->
                                    <div class="content-action">
                                        <!--分类-->
                                        <div class="topic-container">
                                        <span style="display: flex;align-items: center;">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg" class="container-svg"><circle
                                                        cx="10"
                                                        cy="10" r="10"
                                                        fill="#03A9F5"></circle><circle
                                                        cx="10" cy="10" r="5" fill="#A0E3FE"></circle></svg>
                                        <?php $this->category(','); ?>

                                        </span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="p-2">
                                                <button class="button post-action">
                                        <span style="display: flex;align-items: center;">
                                            <svg width="24" height="24" viewBox="0 0 16 16" class="post-icon bi bi-eye"
                                                 fill="currentColor"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                  <path fill-rule="evenodd"
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                                                  <path fill-rule="evenodd"
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                            </svg>
                                            <?php utils::getPostView($this); ?>
                                        </span>
                                                </button>
                                            </div>
                                            <div class="p-2">
                                                <button class="button post-action">
                                        <span style="display: flex;align-items: center;">
                                            <svg width="20" height="20" viewBox="0 0 16 16"
                                                 class="post-icon bi bi-chat-dots" fill="currentColor"
                                                 xmlns="http://www.w3.org/2000/svg">
                                              <path fill-rule="evenodd"
                                                    d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                                              <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                            </svg>
                                        <?php $this->commentsNum('0', '1', '%d'); ?>
                                        </span>
                                                </button>
                                            </div>
                                            <div class="p-2">
                                                <button class="button post-action btn-like" data-link="<?php _e($this->permalink())?>"
                                                        data-cid="<?php $this->cid(); ?>">
                                        <span style="display: flex;align-items: center;">
                                            <svg width="20" height="20" viewBox="0 0 16 16"
                                                 class="post-icon bi bi-heart" fill="currentColor"
                                                 xmlns="http://www.w3.org/2000/svg">
                                              <path fill-rule="evenodd"
                                                    d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                            </svg>
                                        <?php $agree = $this->hidden ? array('agree' => 0, 'recording' => true) : utils::agreeNum($this->cid); ?>
                                        <span class="agree-num"><?php echo $agree['agree']; ?></span>
                                        </span>
                                                </button>
                                            </div>
                                            <div class="p-2">
                                                <button class="button post-datetime">
                                        <span style="display: flex;align-items: center;">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                 class="post-icon bi bi-clock-fill" fill="currentColor"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                            </svg>
                                        <?php echo formatTime($this->created); ?>
                                        </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </article>
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


