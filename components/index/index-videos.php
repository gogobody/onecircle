<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 主页 显示 video
 */
?>
<div class="row">
    <div class="post-content-inner col-xl-12">
        <?php if ($this->fields->excerpt && $this->fields->excerpt != ''): ?>
            <?php echo $this->fields->excerpt; ?>
        <?php else: ?>
            <?php echo $this->excerpt(70); ?>
        <?php endif; ?>
    </div>
    <div class="post-cover col-xl-12">
        <a onclick="videoToggle('#collapse<?php _e($this->cid) ?>',this,event)" href="#collapse<?php _e($this->cid) ?>"
           data-toggle="collapse" class="toggle-player collapsed" rel="button" aria-expanded="false"
           aria-controls="collapse<?php _e($this->cid) ?>" data-controls="collapse<?php _e($this->cid) ?>">
            <div class="">
                <span class="expand">
                    <svg class="bi bi-arrows-angle-contract" width=".7em"
                         height=".7em" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                            d="M9.5 2.036a.5.5 0 0 1 .5.5v3.5h3.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5z"/>
                      <path fill-rule="evenodd"
                            d="M14.354 1.646a.5.5 0 0 1 0 .708l-4.5 4.5a.5.5 0 1 1-.708-.708l4.5-4.5a.5.5 0 0 1 .708 0zm-7.5 7.5a.5.5 0 0 1 0 .708l-4.5 4.5a.5.5 0 0 1-.708-.708l4.5-4.5a.5.5 0 0 1 .708 0z"/>
                      <path fill-rule="evenodd"
                            d="M2.036 9.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V10h-3.5a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </span>
                <span>收缩</span>
            </div>
        </a>

        <div class="collapse show" id="collapse<?php _e($this->cid) ?>">
            <?php echo parseFirstVideo($this->content); ?>
        </div>
    </div>
</div>