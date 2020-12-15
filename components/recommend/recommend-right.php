<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

?>

<aside class="asideBar col w-md w-lg bg-white-only bg-auto no-border-xs" role="complementary">
    <div id="sidebar">
        <div class="card d-md-block mycicle">
            <div class="mycicle-title"><h2>发现圈友</h2></div>
            <div class="mycicle-content">

                <?php
                $this->widget('Widget_Users_Random@users', 'pageSize=6')->to($users);
                while ($users->next()):
                    ?>
                    <div class="sc-AxjAm sc-AxirZ kQHfHM bITJVr">
                        <a href="<?php _e($users->permalink); ?>" class="sc-AxjAm sc-AxirZ eGdPrb"><img
                                    src="<?php _e(getUserV2exAvatar($users->mail, $users->userAvatar)) ?>" alt="再多一点可爱"
                                    class="sc-AxjAm jZLHXc">
                            <div class="sc-AxjAm sc-AxirZ hkyonN">
                                <div class="sc-AxjAm oDrAC"><?php $users->screenName() ?><span class="badge bg-info m-l-xs text-xs">LV<?php _e($users->level); ?></span></div>
                                <div class="sc-AxjAm hHqHSX ezzhLs"><?php if ($users->userSign) _e($users->userSign); else _e('太懒了还没有签名'); ?></div>
                            </div>
                        </a>

                        <div class="sc-AxjAm sc-AxirZ hsyNhw">
                            <button data-authorid="<?php _e($users->uid); ?>" <?php
                            if ($this->user->hasLogin()) {
                                if (UserFollow::statusFollow($this->user->uid, $users->uid)) {
                                    echo 'class="fansed-little fan-event">已关注';
                                } else {
                                    echo 'class="fans-little fan-event">关注';
                                }
                            } else {
                                echo 'class="fans-little fan-event">关注';
                            }
                            ?>
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="card d-md-block mycicle">
            <div class="mycicle-title">
                <h2>推荐圈子</h2>
                <a href="<?php _e(Typecho_Common::url('/metas', $this->options->index)); ?>">
                    <svg t="1603601049059" class="icon" viewBox="0 0 1024 1024" version="1.1"
                         xmlns="http://www.w3.org/2000/svg" p-id="3178" width="24" height="24">
                        <path d="M391.88 600.132c17.667 0 31.988 14.321 31.988 31.987v271.894c0 17.666-14.321 31.987-31.987 31.987H119.987C102.321 936 88 921.679 88 904.013V632.119c0-17.666 14.321-31.987 31.987-31.987h271.894z m463.818 0c17.667 0 31.988 14.321 31.988 31.987v271.894c0 17.666-14.321 31.987-31.988 31.987H583.805c-17.666 0-31.987-14.321-31.987-31.987V632.119c0-17.666 14.321-31.987 31.987-31.987h271.893zM734.374 97.369L926.63 289.626c12.492 12.492 12.492 32.746 0 45.238L734.374 527.12c-12.492 12.492-32.746 12.492-45.238 0L496.88 334.864c-12.492-12.492-12.492-32.746 0-45.238L689.136 97.37c12.492-12.492 32.746-12.492 45.238 0zM391.88 136.314c17.666 0 31.987 14.321 31.987 31.988v271.893c0 17.666-14.321 31.987-31.987 31.987H119.987c-17.666 0-31.987-14.321-31.987-31.987V168.302c0-17.667 14.321-31.988 31.987-31.988h271.894z m319.874 40.22L576.044 312.245l135.711 135.711 135.711-135.711-135.711-135.711z"
                              p-id="3179" fill="#707070"></path>
                    </svg>
                </a>
            </div>
            <div class="mycicle-content">
                <?php
                $arr = getCategories($this, 10, $this->options->defaultSlugUrl, true);
                $length = count($arr);
                for ($i = 0; $i < $length; $i++) {
                    echo '<div class="circle-item">
                <a href="' . $arr[$i][2] . '" class="circle-item-link">
                    <img src="' . $arr[$i][3] . '">
                    <div class="circle-item-link-right">
                        <div class="circle-item-link-title">' . $arr[$i][1] . '</div>
                        <div class="circle-item-link-info">' . $arr[$i][4] . '️</div>
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
</aside>

