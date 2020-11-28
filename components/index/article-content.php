<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 主页 显示 单个 content
 *  php $this->permalink(); ?>
 */
?>
<!-- focus user show -->
<?php if ($this->fields->articleType == "focususer"): ?>
    <article class="post-article" data-url="<?php $this->permalink(); ?>">
        <div class="post-article-left">
            <a onclick="event.stopPropagation();" href="<?php $this->author->permalink(); ?>">
                <!--<?php $this->author->gravatar(40); ?>-->
                <img class="avatar"
                     src="<?php echo getUserV2exAvatar($this->author->mail,$this->author->userAvatar); ?>"
                     alt="<?php $this->author() ?>"/>
            </a>
        </div>
        <div class="post-article-right">
            <div class="post-author">
                <?php if (!$this->options->singleAuthor): ?>
                    <div class="author-name" id="post-author-<?php $this->cid() ?>">
                        <a onclick="event.stopPropagation();"
                           href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>
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
                <!-- focususer -->
                <?php $this->need('components/index/index-focususer.php'); ?>
                <!-- action-->
                <div class="content-action">
                    <!--分类-->
                    <div class="topic-container">
                    <span class="topic-container-items" onclick="event.stopPropagation()">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="container-svg"><circle cx="10" cy="10" r="10" fill="#03A9F5"></circle><circle cx="10" cy="10" r="5" fill="#A0E3FE"></circle></svg>
                    <?php if (empty($this->category)) _e("未选择"); else $this->category(','); ?>

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
                            <button class="button post-action btn-like" data-link="<?php _e($this->permalink()) ?>"
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
        <?php $this->sticky(); ?>

    </article>

<!-- other show -->
<?php else: ?>
    <article do-pjax class="post-article" data-url="<?php $this->permalink(); ?>">
        <div class="post-article-left">
            <a onclick="event.stopPropagation();" href="<?php $this->author->permalink(); ?>">
                <!--<?php $this->author->gravatar(40); ?>-->
                <img class="avatar"
                     src="<?php echo getUserV2exAvatar($this->author->mail,$this->author->userAvatar); ?>"
                     alt="<?php $this->author() ?>"/>
            </a>
        </div>
        <div class="post-article-right">
            <div class="post-author">
                <?php if (!$this->options->singleAuthor): ?>
                    <div class="author-name" id="post-author-<?php $this->cid() ?>">
                        <a onclick="event.stopPropagation();"
                           href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>
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

                <?php if ($this->fields->articleType == "link"): ?>
                    <!-- link-->
                    <?php $this->need('components/index/index-link.php'); ?>

                <?php elseif ($this->fields->articleType == "default"): ?>
                    <!-- default-->
                    <?php $this->need('components/index/index-default.php'); ?>

                <?php elseif ($this->fields->articleType == "video" || $this->fields->articleType == "bilibili"): ?>
                    <!-- videos -->
                    <?php $this->need('components/index/index-videos.php'); ?>
                <?php elseif ($this->fields->articleType == "repost"): ?>
                    <!-- repost -->
                    <?php $this->need('components/index/index-repost.php'); ?>
                <?php endif; ?>

                <!-- actions container-->
                <div class="content-action">
                    <!--分类-->
                    <div class="topic-container">
                        <span class="topic-container-items" onclick="event.stopPropagation()">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                             xmlns="http://www.w3.org/2000/svg" class="container-svg"><circle
                                    cx="10"
                                    cy="10" r="10"
                                    fill="#03A9F5"></circle><circle cx="10" cy="10" r="5" fill="#A0E3FE"></circle></svg>
                    <?php if (empty($this->category)) _e("未选择"); else $this->category(','); ?>

                    </span>
                    </div>
                    <?php
                    $comments_arr = utils::getOneCommentIfMore($this->cid);
                    if (!empty($comments_arr)):
                        ?>
                        <div class="lucky-comment">
                            <div class="v-line ">&nbsp;</div>
                            <div class="lucky-comment-svg"><svg t="1605092004902" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2907" width="23px" height="23px"><path d="M201.142857 566.857143H146.285714a18.285714 18.285714 0 0 1-18.285714-18.285714V182.857143a18.285714 18.285714 0 0 1 18.285714-18.285714h585.142857a18.285714 18.285714 0 0 1 18.285715 18.285714v365.714286a18.285714 18.285714 0 0 1-18.285715 18.285714h-324.096l-178.468571 107.117714A18.285714 18.285714 0 0 1 201.142857 658.285714v-91.428571z m-36.571428-365.714286v329.142857H219.428571a18.285714 18.285714 0 0 1 18.285715 18.285715v77.421714l155.172571-93.110857A18.285714 18.285714 0 0 1 402.285714 530.285714h310.857143v-329.142857h-548.571428z m658.285714 548.571429H877.714286a18.285714 18.285714 0 0 0 18.285714-18.285715V365.714286a18.285714 18.285714 0 0 0-18.285714-18.285715h-73.142857a18.285714 18.285714 0 1 0 0 36.571429h54.857142v329.142857H804.571429a18.285714 18.285714 0 0 0-18.285715 18.285714v77.421715l-155.172571-93.110857A18.285714 18.285714 0 0 0 621.714286 713.142857H310.857143V694.857143a18.285714 18.285714 0 1 0-36.571429 0v36.571428a18.285714 18.285714 0 0 0 18.285715 18.285715h324.096l178.468571 107.117714A18.285714 18.285714 0 0 0 822.857143 841.142857v-91.428571zM329.142857 365.714286a36.571429 36.571429 0 1 1-73.142857 0 36.571429 36.571429 0 0 1 73.142857 0m146.285714 0a36.571429 36.571429 0 1 1-73.142857 0 36.571429 36.571429 0 0 1 73.142857 0m146.285715 0a36.571429 36.571429 0 1 1-73.142857 0 36.571429 36.571429 0 0 1 73.142857 0" p-id="2908" fill="#707070"></path></svg></div>
                            <div class="index-comment-user"><div class="user-name"><?php _e($comments_arr['author']);?>：</div></div>
                            <div class="index-comment-content"><div class="comment-content"><?php _e(comments::parseSecret($comments_arr['text']));?></div></div>
                        </div>
                    <?php endif;?>
                    <!-- action-->
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
                            <button class="button post-action btn-like" data-link="<?php _e($this->permalink()) ?>"
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
        <?php $this->sticky(); ?>

    </article>
<?php endif; ?>

