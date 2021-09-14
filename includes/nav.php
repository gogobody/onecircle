<?php
/**
 * author:gogobody
 * time：2020-10-11 19：39
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<aside id="aside" class="app-aside hidden-xs">
    <div class="aside-wrap" layout="column">
        <div class="navi-wrap scroll-y scroll-hide" flex>
            <div class="nav-menu">
            <nav class="nav flex-column">
                <a<?php if ($this->is('index')): ?> class="nav-link active"<?php else:?> class="nav-link"<?php endif; ?>
                        href="<?php $this->options->siteUrl(); ?>">
                    <div class="nav-item nav-icon">
                        <?php $this->options->NavDynamic(); ?>
                        <span class="nav-item-text"><?php _e('动态'); ?></span>
                    </div>
                </a>
                <a<?php if ($this->is('index')): ?> class="nav-link active"<?php else:?> class="nav-link"<?php endif; ?>
                        href="<?php $this->options->siteUrl(); ?>?recommend=default">
                    <div class="nav-item nav-icon">
                        <?php $this->options->NavDiscover(); ?>
                        <span class="nav-item-text"><?php _e('发现'); ?></span>
                    </div>
                </a>
                <a class="nav-link" href="<?php _e($this->options->index); ?>/myblog">
                    <div class="nav-item nav-icon">
                        <?php $this->options->NavBlog(); ?>
                        <span class="nav-item-text"><?php _e('博客'); ?></span>
                    </div>
                </a>
                <?php $poptions = Helper::options()->plugin('OneCircle');if ($poptions->enableResource):?>
                <a class="nav-link" href="<?php _e($this->options->index); ?>/resources">
                    <div class="nav-item nav-icon">
                        <?php $this->options->NavResource(); ?>
                        <span class="nav-item-text"><?php _e('资源'); ?></span>
                    </div>
                </a>
                <?php endif;?>
                <?php $pages = null;
                $this->widget('Widget_Contents_Page_List')->to($pages); ?>

                <?php utils::customNavHandle($this->options->customNavIcon, $pages, $this);?>
            </nav>
        </div>
        </div>
        <?php echo Typecho_Plugin::factory('OneCircle.Donate')->Donate(); ?>

    </div><!--.aside-wrap-->

</aside>


