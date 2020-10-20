<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

?>

<div class="col-12 col-md-3 text-center text-md-left right-panel">
    <div class="card d-md-block mycicle">
        <div class="mycicle-title"><h2>发现圈友</h2></div>
        <div class="mycicle-content">

            <?php
            $this->widget('Widget_Users_Random@users', 'pageSize=6')->to($users);
            while ($users->next()):
            ?>
            <div class="sc-AxjAm sc-AxirZ kQHfHM bITJVr">
                <a href="/author/4" class="sc-AxjAm sc-AxirZ eGdPrb"><img src="<?php _e(getUserV2exAvatar($users->mail))?>" alt="再多一点可爱" class="sc-AxjAm jZLHXc">
                    <div class="sc-AxjAm sc-AxirZ hkyonN">
                        <div class="sc-AxjAm oDrAC"><? $users->screenName()?></div>
                        <div class="sc-AxjAm hHqHSX ezzhLs"><?if($users->userSign)_e($users->userSign);else _e('太懒了还没有签名');?></div>
                    </div>
                </a>

                <div class="sc-AxjAm sc-AxirZ hsyNhw">
                    <button data-authorid="<?php _e($users->uid);?>" <?php
                    if ($this->user->hasLogin()){
                        if (UserFollow::statusFollow($this->user->uid,$users->uid)){
                            echo 'class="fansed-little fan-event">已关注';
                        }else{
                            echo 'class="fans-little fan-event">关注';
                        }
                    }else{
                        echo 'class="fans-little fan-event">关注';
                    }
                    ?>
                    </button>
                </div>
            </div>
            <? endwhile;?>
        </div>
    </div>

    <div class="card d-md-block mycicle">
        <div class="mycicle-title"><h2>推荐圈子</h2></div>
        <div class="mycicle-content">
            <?php
            $arr = getCategories($this, 10, $this->options->defaultSlugUrl,true);
            $length = count($arr);
            for ($i = 0; $i < $length; $i++) {
                echo '<div class="circle-item">
                <a href="' . $arr[$i][2] . '" class="circle-item-link">
                    <img src="' . $arr[$i][3] . '">
                    <div class="circle-item-link-right">
                        <div class="circle-item-link-title">' . $arr[$i][1] . '</div>
                        <div class="circle-item-link-info">'.$arr[$i][4].'️</div>
                    </div>
                </a>
            </div>';
            }
            ?>

        </div>
    </div>

    <div class="card random-post d-md-block">
        <h4 class="title">可能感兴趣</h4>
        <?php theme_random_posts(); ?>
    </div>

</div>

