<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<div class="col-12 col-md-3 text-center text-md-left right-panel">
    <?php if ($this->is('index')): ?>
        <div class="card user-container">
            <?php if ($this->user->hasLogin()): ?>
                <div class="card-header user-info" style="background-image: url(<?php echo getUserV2exAvatar($this->user->mail) ?>);"></div>
                <div class="user-detail">
                    <a href="/author/<?php echo $this->user->uid?>">
                        <div class="info">
                            <img class="avatar" src="<?php echo getUserV2exAvatar($this->user->mail)?>" alt="<?php echo $this->user->name ?>"/>
                        </div>
                    </a>
                    <div class="user-info-name">
                        <a href="/author/<?php echo $this->user->uid?>"><?php echo $this->user->name;?></a>
                    </div>
                    <div class="user-info-fans">
                        <a href=""><span style="color: rgb(64, 64, 64);"><? _e(UserFollow::getFollowNum($this->user->uid));?></span>关注</a>
                        <a href=""><span style="color: rgb(64, 64, 64);"><? _e(UserFollow::getOtherFollowNum($this->user->uid));?></span>被关注</a>
                    </div>
                    <div class="user-info-introduction">
                        <span><?php
                            if($this->user->userSign){
                                echo $this->user->userSign;
                            }else{
                                echo "太懒了，还没有个人签名!";
                            }
                            ?></span>
                    </div>
                </div>
            <?php else: ?>
                <div class="card-header user-info" style="background-image: url(<?php echo getUserV2exAvatar(getBlogAdminInfo()['mail']) ?>);"></div>
                <div class="user-detail user-detail-padding">
                    <a>
                        <div class="info">
                            <img class="avatar" src="<?php echo getUserV2exAvatar(getBlogAdminInfo()['mail'])?>" alt="<?php echo getV2exAvatar(getBlogAdminInfo()['name']) ?>"/>
                        </div>
                    </a>
                    <div class="user-info-name">
                        <a href=""><?php echo getBlogAdminInfo()['name'] ?></a>
                    </div>
                    <div class="user-info-fans">
                        <a href=""><span style="color: rgb(64, 64, 64);"><? _e(UserFollow::getFollowNum(1));?></span>关注</a>
                        <a href=""><span style="color: rgb(64, 64, 64);"><? _e(UserFollow::getOtherFollowNum(1));?></span>被关注</a>
                    </div>
                    <div class="user-info-introduction">
                        <span><?php echo getBlogAdminInfo()['userSign'] ?></span>

                    </div>
                </div>

                <div class="card-footer user-detail" >
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

                </div>
            <?php endif ?>
        </div>
        <?php elseif($this->is('page')): ?>
        <?php elseif($this->is('search')): ?>
        <?php else:?>
        <div class="card user-container">

            <div class="mycicle-title"><h2><?php _e($this->categories[0]['name']) ?></h2></div>
            <div class="iwNods">
                <div class="daMYau">
                <span><?php _e(parseDesc2text($this->categories[0]['description']));?>
                </span>
                </div>
            </div>
        </div>
    <?php endif ?>
    <div class="card d-none d-md-block mycicle">
        <div class="mycicle-title"><h2>我的圈子</h2></div>
        <div class="mycicle-content">
            <?php
            $arr = CircleFollow::getFollowObj($this->user->uid,10,$this->options->defaultSlugUrl);
            $length = count($arr);
            if ($length > 0):
            ?>
            <?for ($i = 0; $i < $length; $i++): ?>
                <div class="circle-item">
                    <a href="<? echo $arr[$i][2] ?>" class="circle-item-link">
                        <img src="<? echo $arr[$i][3] ?>">
                        <div class="circle-item-link-right">
                            <div class="circle-item-link-title"><? echo $arr[$i][1] ?></div>
                            <div class="circle-item-link-info"><? echo $arr[$i][4] ?></div>
                        </div>
                    </a>
                </div>
            <? endfor;?>
            <? else:?>
            <div class="circle-item">
                <?php if ($this->user->hasLogin()): ?>
                <small>还没有关注圈子~</small>
                <? else:?>
                <small>登录后可见</small>
                <? endif;?>
            </div>
            <? endif;?>
        </div>
    </div>

    <div class="card recent-box d-none d-md-block">
        <h2 class="title">最近回复</h2>
        <ul class="list-unstyled">
            <?php $this->widget('Widget_Comments_Recent', 'ignoreAuthor=true&pageSize=5')->to($comments); ?>
            <?php while ($comments->next()): ?>
                <li class="media my-4">
                    <img class="recent-avatar mr-3"
                         src="<?php echo getUserV2exAvatar($comments->mail,40); ?>"/>
                    <div class="media-body">
                        <h6 class="mt-0 mb-1"><?php $comments->author(false); ?></h6>
                        <a class="content" href="<?php $comments->permalink(); ?>"
                           target="<?php $this->options->sidebarLinkOpen(); ?>">
                            <?php echo contents::parseHide($comments->excerpt(35, '...'));?>
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

</div>

