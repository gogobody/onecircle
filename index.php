<?php
/**
 * 一个圈子主题，改自@Lanstar https://dyedd.cn
 *
 * @package OneCircle
 * @author gogobody
 * @version 1.9
 * @link https://blog.gogobody.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

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
?>

<div class="container-lg animate__animated animate__fadeIn" id="pjax-container">
    <div class="row">
        <?php $this->need('includes/nav.php'); ?>
        <div class="col-xl-7 col-md-7 col-12 main-content">
            <?php if ($this->user->hasLogin() && !$recommend && checkIndexInputPermission($this->user->group)): //判断是否登录 ?>
                <? $this->need('components/index/index-input.php'); ?>
            <?php endif; ?>

            <? if($recommend):?>
            <!-- 圈友日记 -->
            <div class="diary-content">
                <a href="<? _e(Typecho_Common::url('/metas',$this->options->rootUrl));?>">
                <div class="mycicle-title">
                    <h2>圈友日记</h2>
                    <a href="<? _e(Typecho_Common::url('/metas',$this->options->rootUrl));?>"><h2>更多</h2></a>
                </div>
                <div class="circle-diary">
                    <?php $imgs = getRandRecommendImgs(8); foreach ($imgs as $rimg):?>
                        <?php $this->widget('Widget_Archive@_'.$rimg['cid'], 'pageSize=1&type=post', 'cid='.$rimg['cid'])->to($archive_);?>
                        <a href="<? _e($archive_->permalink()); ?>" class="circle-diary-bg" style="background-image: url('<?_e($rimg['img']);?>')">
                            <div class="circle-diary-bottom">
                                <div class="circle-diary-avatar"><img class="img-circle img-thumbnail" src="<?_e(getUserV2exAvatar($rimg['email'],$rimg['userAvatar']));?>"></div>
                                <div class="circle-diary-name"><?_e($rimg['screenName']);?></div>
                            </div>
                        </a>
                    <? endforeach;?>
                </div>
                </a>
            </div>
            <? endif; ?>
            <div class="list">
                <?php while ($this->next()): ?>
                    <? $this->need('components/index/article-content.php'); ?>
                <?php endwhile; ?>
                <!--分页-->
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
        <?php
        if (!$recommend) {
            $this->need('includes/right.php');
        } else {
            $this->need('components/recommend/recommend-right.php');
        }
        ?>
    </div>
</div>


<?php $this->need('includes/footer.php'); ?>


