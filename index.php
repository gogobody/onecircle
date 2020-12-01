<?php
/**
 * 一个圈子主题
 * OneCircle theme，也许是 typecho 第一个社交圈子主题
 * @package OneCircle
 * @author gogobody
 * @version 3.0
 * @link check https://github.com/
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$loading = Helper::options()->defaultLoadingUrl();
// recommend page
$tArr = utils::parseUrlQuery(utils::GetCurUrl());
if (count($tArr) == 0) {
    $recommend = NULL;
} else {
    $recommend = $tArr['recommend'];
}
// if login show index
if ($this->user->hasLogin()){
    if (!$recommend) {
        // login page index show sticky
        $this->need('components/index/index-sticky.php');
    } else {
        // login recommend page show random post
        $this->need('components/recommend/recommend-randompost.php');
    }
}else{ // no login show recommend page, but still show sticky
    $recommend = 'default';
    $this->need('components/recommend/recommend-rand-sticky.php');
}
//Typecho_Widget::widget('Widget_Users_Admin')->to($users);
$this->need('includes/header.php');
// below is body content
?>

<?php $this->need('includes/body-layout.php');?>
    <div class="hbox hbox-auto-xs hbox-auto-sm index">
        <div class="col center-part">
            <div class="main-content">
                <?php if ($this->user->hasLogin() && !$recommend && checkIndexInputPermission($this->user->group)): //判断是否登录 ?>
                    <?php $this->need('components/index/index-input.php'); ?>
                <?php endif; ?>

                <?php if($recommend):?>
                <!-- 圈友日记 -->
                <div class="diary-content">
                    <a href="<?php $meta_url = Typecho_Common::url('/metas',$this->options->index);_e($meta_url);?>">
                    <div class="mycicle-title">
                        <h2>圈友日记</h2>
                        <a href="<?php _e($meta_url);?>"><h2>更多</h2></a>
                    </div>
                    <div class="circle-diary">
                        <?php $imgs = getRandRecommendImgs(8); foreach ($imgs as $rimg):?>
                            <?php $archive_ = null;
                            $this->widget('Widget_Archive@_'.$rimg['cid'], 'pageSize=1&type=post', 'cid='.$rimg['cid'])->to($archive_);?>
                            <a href="<?php _e($archive_->permalink()); ?>" class="diary-item">
                                <div class="circle-diary-bg">
                                    <div class="diary-img">
                                        <img src="<?php _t($loading)?>" data-src="<? _e($rimg['img']); ?>" class="lazyload">
                                    </div>
                                    <div class="circle-diary-bottom">
                                        <div class="circle-diary-avatar"><img class="img-circle img-thumbnail"
                                                                              src="<? _e(getUserV2exAvatar($rimg['email'], $rimg['userAvatar'])); ?>">
                                        </div>
                                        <div class="circle-diary-name"><? _e($rimg['screenName']); ?></div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach;?>
                        <?php if(count($imgs) == 0): ?>
                            <span class="text-center"> 这里空空如也~ </span>
                        <?php endif;?>
                    </div>
                    </a>
                </div>
                <?php endif; ?>
                <div class="list">
                    <?php while ($this->next()): ?>
                        <?php $this->need('components/index/article-content.php'); ?>
                    <?php endwhile; ?>
                </div>
                <!--分页-->
                <?php $this->need('includes/post-pagination.php');?>
            </div>
        </div>
        <?php
            if (!$recommend) {
                $this->need('includes/right.php');
            } else {
                $this->need('components/recommend/recommend-right.php');
            }
        ?>
    </div>
<?php $this->need('includes/body-layout-end.php');?>


<?php $this->need('includes/footer.php'); ?>


