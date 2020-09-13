<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="col-12 col-md-3 text-center text-md-left">
    <div class="card user-container">
        <?php if ($this->is('index')): ?>
            <?php if ($this->user->hasLogin()): ?>
                <div class="card-header user-info" style="background-image: url(<?php echo getV2exAvatar($this) ?>);"></div>
                <div class="user-detail">
                    <a>
                        <div class="info">
                            <img class="avatar" src="<?php echo getV2exAvatar($this)?>" alt="<?php $this->author() ?>"/>
                        </div>
                    </a>
                    <div class="user-info-name">
                        <a href=""><?php echo $this->author()?></a>
                    </div>
                    <div class="user-info-fans">
                        <a href=""><span style="color: rgb(64, 64, 64);">62</span>关注</a>
                        <a href=""><span style="color: rgb(64, 64, 64);">12</span>被关注</a>
                    </div>
                    <div class="user-info-introduction">
                        <span><?php _e($this->options->selfIntroduction);?></span>
                    </div>
                </div>
            <?php else: ?>
                <div class="card-header user-info" style="background-image: url(<?php echo getV2exAvatar($this) ?>);"></div>
                <div class="user-detail user-detail-padding">
                    <a>
                        <div class="info">
                            <img class="avatar" src="<?php echo getV2exAvatar($this)?>" alt="<?php $this->author() ?>"/>
                        </div>
                    </a>
                    <div class="user-info-name">
                        <a href=""><?php echo $this->author()?></a>
                    </div>
                    <div class="user-info-fans">
                        <a href=""><span style="color: rgb(64, 64, 64);">62</span>关注</a>
                        <a href=""><span style="color: rgb(64, 64, 64);">12</span>被关注</a>
                    </div>
                    <div class="user-info-introduction">
                        <span>个人简介</span>
                        <?php
                        print_r(getCategories($this,10));
                        ?>
                    </div>
                </div>

                <div class="card-footer user-detail">
                    <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
                    <ul class="list-group list-group-horizontal">
                        <li>
                            <div class="detail-title" title="文章">📝</div>
                            <div class="detail-num">
                                <?php $stat->publishedPostsNum() ?>
                            </div>
                        </li>
                        <li>
                            <div class="detail-title" title="评论">💬</div>
                            <div class="detail-num">
                                <?php $stat->publishedCommentsNum() ?>
                            </div>
                        </li>
                        <li>
                            <div class="detail-title" title="分类">🏷</div>
                            <div class="detail-num">
                                <?php $stat->categoriesNum() ?>
                            </div>
                        </li>
                    </ul>
                    <hr>

                </div>
            <?php endif ?>
        <?php else: ?>
        <?php endif ?>

    </div>
    <div class="card d-none d-md-block mycicle">
        <div class="mycicle-title"><h2>我的圈子</h2></div>
        <div class="mycicle-content">
            <?php
            $arr = getCategories($this,10);
//            print_r($arr);
            $length = count($arr);
            for ($i=0;$i<$length;$i++){
                echo '<div class="circle-item">
                <a href="'.$arr[$i][2].'" class="circle-item-link">
                    <img src="'.$arr[$i][3].'">
                    <div class="circle-item-link-right">
                        <div class="circle-item-link-title">'.$arr[$i][1].'</div>
                        <div class="circle-item-link-info">[图片] #once more周六宜🚴‍♀️</div>
                    </div>
                </a>
            </div>';
            }
            ?>

        </div>
    </div>

    <div class="card recent-box d-none d-md-block">
        <h2 class="title">最近回复</h2>
        <ul class="list-unstyled">
            <?php $this->widget('Widget_Comments_Recent', 'pageSize=3')->to($comments); ?>
            <?php while ($comments->next()): ?>
                <li class="media my-4">
                    <img class="recent-avatar mr-3"
                         src="//cdn.v2ex.com/gravatar/<?php echo md5($comments->mail); ?>?s=40&d=mp"/>
                    <div class="media-body">
                        <h6 class="mt-0 mb-1"><?php $comments->author(false); ?></h6>
                        <a class="content" href="<?php $comments->permalink(); ?>"
                           target="<?php $this->options->sidebarLinkOpen(); ?>">
                            <?php $comments->excerpt(35, '...'); ?>
                        </a>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <div class="card random-post d-none d-md-block">
        <h4 class="title">可能感兴趣</h4>
        <?php theme_random_posts(); ?>
    </div>
    <?php $this->need('includes/footer.php'); ?>
</div>

