<?php
/**
 * author:gogobody
 * time：2020-10-11 19：39
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
// float_action_buttons 来自 https://github.com/solstice23/argon-theme/
?>

<div class="container-xl app-container">
    <div id="float_action_buttons" class="float-action-buttons fabtns-unloaded">
        <button id="fabtn_toggle_sides" class="btn btn-icon btn-neutral fabtn shadow-sm" type="button" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="<?php _e('移至另侧', 'argon'); ?>">
            <span class="btn-inner--icon fabtn-show-on-right"><svg width="5.36px" height="14px" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-left" class="svg-inline--fa fa-caret-left fa-w-6" role="img" viewBox="0 0 192 512"><path fill="currentColor" d="M192 127.338v257.324c0 17.818-21.543 26.741-34.142 14.142L29.196 270.142c-7.81-7.81-7.81-20.474 0-28.284l128.662-128.662c12.599-12.6 34.142-3.676 34.142 14.142z"/></svg></span>
            <span class="btn-inner--icon fabtn-show-on-left"><svg width="5.36px" height="14px" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" viewBox="0 0 192 512"><path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"/></svg></span>
        </button>
        <button id="fabtn_back_to_top" class="btn btn-icon btn-neutral fabtn shadow-sm" type="button" aria-label="Back To Top" data-toggle="tooltip" data-placement="left" title="<?php _e('回到顶部', 'argon'); ?>">
            <span class="btn-inner--icon"><svg width="9.34px" height="14px" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-up" class="svg-inline--fa fa-angle-up fa-w-10" role="img" viewBox="0 0 320 512"><path fill="currentColor" d="M177 159.7l136 136c9.4 9.4 9.4 24.6 0 33.9l-22.6 22.6c-9.4 9.4-24.6 9.4-33.9 0L160 255.9l-96.4 96.4c-9.4 9.4-24.6 9.4-33.9 0L7 329.7c-9.4-9.4-9.4-24.6 0-33.9l136-136c9.4-9.5 24.6-9.5 34-.1z"/></svg></span>
        </button>
        <button id="fabtn_go_to_comment" class="btn btn-icon btn-neutral fabtn shadow-sm d-none" type="button" aria-label="Comment" data-toggle="tooltip" data-placement="left" title="<?php _e('评论', 'argon'); ?>">
            <span class="btn-inner--icon"><svg width="14.34px" height="14px" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="far" data-icon="comment" class="svg-inline--fa fa-comment fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M256 32C114.6 32 0 125.1 0 240c0 47.6 19.9 91.2 52.9 126.3C38 405.7 7 439.1 6.5 439.5c-6.6 7-8.4 17.2-4.6 26S14.4 480 24 480c61.5 0 110-25.7 139.1-46.3C192 442.8 223.2 448 256 448c141.4 0 256-93.1 256-208S397.4 32 256 32zm0 368c-26.7 0-53.1-4.1-78.4-12.1l-22.7-7.2-19.5 13.8c-14.3 10.1-33.9 21.4-57.5 29 7.3-12.1 14.4-25.7 19.9-40.2l10.6-28.1-20.6-21.8C69.7 314.1 48 282.2 48 240c0-88.2 93.3-160 208-160s208 71.8 208 160-93.3 160-208 160z"/></svg></span>
        </button>
        <button id="fabtn_reading_progress" class="btn btn-icon btn-neutral fabtn shadow-sm" type="button" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="<?php _e('阅读进度', 'argon'); ?>">
            <div id="fabtn_reading_progress_bar" style="width: 0;"></div>
            <span id="fabtn_reading_progress_details">0%</span>
        </button>
    </div>
    <?php $this->need('includes/nav.php'); ?>
    <div id="pjax-container" class="app-content animate__animated animate__fadeIn">
        <a class="off-screen-toggle hide"></a>
        <main class="app-content-body">
