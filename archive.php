<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('includes/header.php'); ?>
<div class="container">
    <div class="row">
        <?php $this->need('includes/nav.php'); ?>
        <div class="col-xl-10 col-md-9 col-12 achieve-container">
            <?php if ($this->is('author')): ?>
                <div class="vxeHw">
                    <div class="kojXeB">
                        <div class="ivcfJN"
                             style="background-image: url(<?php echo getV2exAvatar($this) ?>)">
                            <div class="iNTHKr"></div>
                        </div>
                    </div>
                    <div class="biCwrr">
                        <div class="sc-AxjAm sc-AxirZ fUlriR">
                            <div class="sc-AxjAm sc-AxirZ jnzuaU"><img
                                        src="<?php echo getV2exAvatar($this) ?>"
                                        class="sc-AxjAm irFFsx"></div>
                            <h2 color="gray.0" font-size="24px" class="sc-AxjAm dDtTVx"><?php echo $this->author()?></h2>
                            <div class="sc-AxjAm sc-AxirZ dZfkqf"><a font-size="3" color="gray.0"
                                                                     href=""
                                                                     class="sc-AxjAm OAorY FollowInfo__StyledLink-qfw29x-0 ffrrSB"><span>62</span>关注</a><a
                                        font-size="3" color="gray.0" href=""
                                        class="sc-AxjAm OAorY FollowInfo__StyledLink-qfw29x-0 dDeaQZ"><span>12</span>被关注</a>
                            </div>
                            <div class="sc-AxjAm sc-AxirZ iiMLXg">
                                <div color="gray.0" font-size="14px" class="sc-AxjAm kkFELj"><?php _e($this->options->selfIntroduction);?>
                                </div>
                            </div>
                            <div class="sc-AxjAm sc-AxirZ UserProfile___StyledFlex2-sc-1ufzt9g-7 cXyaML">
                                <div class="sc-AxjAm bHdldX UserProfile__UserTag-sc-1ufzt9g-2 fXkMMP"><img
                                            src="https://cdn.jellow.site/resources/userProfile/male@3x_6.0.png"
                                            class="sc-AxjAm hzfjJS"></div>
                                <div class="sc-AxjAm hXeItE UserProfile__UserTag-sc-1ufzt9g-2 fXkMMP">重庆</div>
                                <div class="sc-AxjAm hXeItE UserProfile__UserTag-sc-1ufzt9g-2 fXkMMP">学生</div>
                                <div class="sc-AxjAm hXeItE UserProfile__UserTag-sc-1ufzt9g-2 fXkMMP">天秤座</div>
                            </div>
                        </div>
                        <div class="kLKIKx"></div>
                    </div>
                </div>
            <?php elseif ($this->is('category')): ?>
                <div class="achieve-header">
                    <div class="achieve-header-top">
                        <div class="header-top-img"
                             style='background-image: url(<?php _e(parseDesc2img($this->categories[0]['description'])); ?>)'>
                            <div class="header-top-img-inner"></div>
                        </div>
                    </div>

                    <div class="header-top-bottom">
                        <div class="header-top-bottom-avatar"><img
                                    src="<?php _e(parseDesc2img($this->categories[0]['description'])); ?>">
                        </div>
                        <div class="header-top-bottom-text">
                            <div class="htbt-left">
                                <h2><?php _e($this->categories[0]['name']) ?></h2>
                                <div class="htbt-intr">
                                    <div class="htbt-intr-text">
                                        <?php if ($this->categories[0]["count"] > 0) {
                                            echo '已经发布了' . $this->categories[0]["count"] . '条post，快来一起讨论吧';
                                        } else {
                                            echo '还没有人发布post，快来发布一条';
                                        } ?></div>
                                </div>
                            </div>
                            <div class="htbt-right">
                                <button>已加入</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="achieve-content">
                <div class="col-12 col-md-8 outer">
                    <div class="react-tabs" data-tabs="true">
                        <ul class="react-tabs__tab-list">
                            <li id="react-tabs-1" class="react-tabs__tab--selected react-tabs__tab">动态</li>
                            <li id="react-tabs-2" class="react-tabs__tab">热门</li>
                        </ul>
                        <div class="item-container">
                            <div class="react-tabs__tab-panel react-tabs__tab-panel--selected">
                                <?php if ($this->have()): ?>
                                    <?php while ($this->next()): ?>
                                        <div class="item-inner">
                                            <article class="post-article"
                                                     onclick="window.location = '<?php $this->permalink(); ?>';">
                                                <div class="post-article-left">
                                                    <a href="<?php $this->author->permalink(); ?>">
                                                        <!--<?php $this->author->gravatar(40); ?>-->
                                                        <img class="avatar"
                                                             src="//cdn.v2ex.com/gravatar/<?php echo $this->author->mail ? md5($this->author->mail) : ''; ?>?s=32&d=mp"
                                                             alt="<?php $this->author() ?>"/>
                                                    </a>
                                                </div>
                                                <div class="post-article-right">
                                                    <div class="post-author">
                                                        <?php if (!$this->options->singleAuthor): ?>
                                                            <div class="author-name"
                                                                 id="post-author-<?php $this->cid() ?>">
                                                                <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>
                                                            </div>
                                                            <div class="post-time">
                                                                <a href="<?php $this->permalink() ?>">
                                                                    <time><?php echo formatTime($this->created); ?></time>
                                                                </a>
                                                            </div>
                                                        <?php else: ?>
                                                            <a class="post-title" href="<?php $this->permalink() ?>"
                                                               target="_blank">
                                                                <h4><?php $this->title() ?></h4>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                    <!--content-->
                                                    <div class="post-content">
                                                        <div class="row">
                                                            <!--                                    link-->
                                                            <?php if ($this->fields->articleType == "link"): ?>
                                                                <div class="post-content-inner-link col-xl-12">
                                                                    <a href="<?php echo parseFirstURL($this->content); ?>"
                                                                       target="_blank" color="unset">
                                                                        <div class="link-container">
                                                                            <div class="link-banner">
                                                                                <img src="https://cdn.jellow.site/icons/link.png">
                                                                                <div class="link-text">
                                                                                    <?php echo $this->excerpt(70); ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <!--                                    default-->
                                                            <?php else: ?>
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
                                                                            <?php
                                                                            $images = getPostImg($this);
                                                                            $length = count($images);
                                                                            if ($length > 0) {
                                                                                if ($length == 1) {
                                                                                    echo "<div class='post-cover-inner'><img src='$images[0]' class='post-cover-img' alt='cover'></div>";
                                                                                } else {
                                                                                    echo "<div class='post-cover-inner-more post-cover-inner-auto-rows-$length'>";
                                                                                    for ($i = 0; $i < $length; $i++) {
                                                                                        echo "<div style='background-image:url($images[$i]);' class='post-cover-img-more' alt='cover'></div>";
                                                                                    }
                                                                                    echo "</div>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                <? endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <!--                                action-->
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
                                                                    <button class="button post-action btn-like"
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
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <article class="post-article">
                                        <h5 class="post-title"><?php _e('还没有发布内容'); ?></h5>
                                    </article>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php $this->need('includes/pagination.php'); ?>

                </div>
                <?php $this->need('includes/achieve-right.php'); ?>
            </div>

<!--            <h3 class="archive-title">--><?php //$this->archiveTitle(array(
//                    'category' => _t('分类 %s 下的文章'),
//                    'search' => _t('包含关键字 %s 的文章'),
//                    'tag' => _t('标签 %s 下的文章'),
//                    'author' => _t('%s 发布的文章')
//                ), '', ''); ?><!--</h3>-->



    </div>
</div>
