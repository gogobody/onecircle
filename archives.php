<?php
/**
 * 归档页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/header.php');
?>
<div class="container">
    <div class="row">
        <?php $this->need('includes/nav.php'); ?>
        <div class="col-xl-7 col-md-6 col-12 archives">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php $this->options->siteUrl(); ?>">首页</a></li>
                    <?php if ($this->is('post')): ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php $this->title(); ?></li>
                    <?php else: ?>
                        <li class="breadcrumb-item active"
                            aria-current="page"><?php $this->archiveTitle('&raquo;', '', ''); ?></li>
                    <?php endif; ?>
                </ol>
            </nav>
            <article class="post" id="post-<?php $this->cid(); ?>">
                <h1 class="article-title"><a href="<?php $this->permalink(); ?>"><?php $this->title(); ?></a></h1>
                <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
                $year = 0;
                $mon = 0;
                $i = 0;
                $j = 0;
                $output = '<div class="post-content">';
                while ($archives->next()):
                    $year_tmp = date('Y', $archives->created);
                    $mon_tmp = date('m', $archives->created);
                    $y = $year;
                    $m = $mon;
                    if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
                    if ($year != $year_tmp && $year > 0) $output .= '</ul>';
                    if ($year != $year_tmp) {
                        $year = $year_tmp;
                        $output .= '<h3>' . $year . ' 年</h3><ul>';
                    }
                    if ($mon != $mon_tmp) {
                        $mon = $mon_tmp;
                        $output .= '<li><span>' . $year . ' 年' . $mon . ' 月</span><ul>';
                    }
                    $output .= '<li>' . date('d日: ', $archives->created) . '<a href="' . $archives->permalink . '">' . $archives->title . '</a> (' . $archives->commentsNum . ')</li>';
                endwhile;
                $output .= '</ul></li></ul></div>';
                echo $output;
                ?>
            </article>
        </div>
        <?php $this->need('includes/right.php'); ?>
    </div>
</div>