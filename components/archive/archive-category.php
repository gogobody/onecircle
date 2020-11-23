<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * archive 显示 category
 *
 */
?>
<div class="archive-header">
    <div class="archive-header-top">
        <div class="header-top-img"
             style='background-image: url(<?php _e(parseDesc2img($this->options->defaultSlugUrl,$this->categories[0]['description'])); ?>)'>
            <div class="header-top-img-inner"></div>
        </div>
    </div>

    <div class="header-top-bottom">
        <div class="header-top-bottom-avatar"><img src="<?php
            $imgurl = parseDesc2img($this->options->defaultSlugUrl,$this->getDescription());
            if ($imgurl) {
                _e($imgurl);
            } else {
                _e($this->options->defaultSlugUrl());
            } ?>" alt="">
        </div>
        <div class="header-top-bottom-text">
            <div class="htbt-left">
                <h2><?php _e($this->getArchiveTitle()) ?></h2>
                <div class="htbt-intr">
                    <div class="htbt-intr-text">
                        <?php if ($this->getTotal() > 0) {
                            echo '已经发布了' . $this->getTotal() . '条post，快来一起讨论吧';
                        } else {
                            echo '还没有人发布post，快来发布一条';
                        } ?></div>
                </div>
            </div>
            <div class="htbt-right">
                <button data-categoryid="<?php echo $this->getPageRow()['mid'] ?>"
                <?php
                if ($this->user->hasLogin()){
                    if (CircleFollow::statusFollow($this->user->uid,$this->getPageRow()['mid'])){
                        echo 'class="fansed circle-event">已加入';
                    }else{
                        echo 'class="fans circle-event">加入';
                    }
                }else{
                    echo 'class="fans circle-event">加入';
                }
                ?>
                </button>
            </div>
        </div>
    </div>
</div>
