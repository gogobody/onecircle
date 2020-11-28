<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 主页 显示 图文 default
 */
?>
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
                <span class="post-icon" style="display: flex;align-items: center;">
                    <svg width="24" height="24" viewBox="0 0 16 16" class="post-icon bi bi-eye"
                         fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd"
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                          <path fill-rule="evenodd"
                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg>
                    <?php echo $GLOBALS['actionRow']['views'] ?>
                </span>
            </button>
        </div>
        <div class="p-2">
            <button class="button post-action">
                <span class="post-icon" style="display: flex;align-items: center;">
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
                <span class="post-icon" style="display: flex;align-items: center;">
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
        <div class="p-2 post-address-container">
            <button class="button post-address">
                <span class="post-icon" style="display: flex;align-items: center;">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/><path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/></svg>
                    <time><?php echo formatTime($this->created); ?></time>
                </span>
            </button>
        </div>
    </div>
</div>