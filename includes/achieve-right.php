<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="col-12 col-md-4 text-center text-md-left">

    <div class="card user-container">
        <div class="mycicle-title"><h2><?php _e($this->getArchiveTitle()) ?></h2></div>
        <div class="iwNods">
            <div class="daMYau">
                <span><?php _e($this->user->userSign);?>
                </span>
            </div>
        </div>
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
</div>

