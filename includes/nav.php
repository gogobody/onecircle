<?php
/**
 * author:gogobody
 * time：2020-10-11 19：39
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="col-md-3 col-xl-2 collapse" id="mobile-nav">
        <div class="nav-menu">
            <nav class="nav flex-column">
                <a<?php if ($this->is('index')): ?> class="nav-link active"<?php else:?> class="nav-link"<?php endif; ?>
                        href="<?php $this->options->siteUrl(); ?>">
                    <div class="nav-item">
                        <svg viewBox="0 0 24 24" class="nav-icon bi bi-home" fill="currentColor"><g><path fill-rule="evenodd" d="M22.58 7.35L12.475 1.897c-.297-.16-.654-.16-.95 0L1.425 7.35c-.486.264-.667.87-.405 1.356.18.335.525.525.88.525.16 0 .324-.038.475-.12l.734-.396 1.59 11.25c.216 1.214 1.31 2.062 2.66 2.062h9.282c1.35 0 2.444-.848 2.662-2.088l1.588-11.225.737.398c.485.263 1.092.082 1.354-.404.263-.486.08-1.093-.404-1.355zM12 15.435c-1.795 0-3.25-1.455-3.25-3.25s1.455-3.25 3.25-3.25 3.25 1.455 3.25 3.25-1.455 3.25-3.25 3.25z"></path></g></svg>
                        <span class="nav-item-text"><?php _e('动态'); ?></span>
                    </div>
                </a>
                <a<?php if ($this->is('index')): ?> class="nav-link active"<?php else:?> class="nav-link"<?php endif; ?>
                        href="<?php $this->options->siteUrl(); ?>?recommend=default">
                    <div class="nav-item">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="nav-icon bi bi-app-indicator" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z"/>
                            <path d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        </svg>
                        <span class="nav-item-text"><?php _e('发现'); ?></span>
                    </div>
                </a>
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>

                <?php utils::customNavHandle($this->options->customNavIcon, $pages, $this);?>
            </nav>
        </div>
        <?php if ($this->user->hasLogin()): ?>
            <a class="nav-link" href="<?php $this->options->adminUrl(); ?>" title="进入后台">
                <div class="last-nav-item">
                    <svg width="2em" height="2em" viewBox="0 0 16 16" class="nav-icon bi bi-gear" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                        <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                    </svg>
                    <span class="nav-item-text">后台</span>
                </div>
            </a>
        <?php endif; ?>
    </div>
