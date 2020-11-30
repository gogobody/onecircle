<?php
/**
 * neighbor page
 */
$this->need('includes/header.php');
$district = $this->getKeywords();
?>

<?php $this->need('includes/body-layout.php');?>
<div class="hbox hbox-auto-xs hbox-auto-sm index">
    <div class="col center-part">
        <div class="main-content">
            <div id="amap-container" class="embed-responsive"></div>
            <div class="list">
                <?php while ($this->next()): ?>
                    <?php $this->need('components/index/article-content.php'); ?>
                <?php endwhile; ?>
            </div>
            <!--分页-->
            <?php $this->need('includes/post-pagination.php');?>
        </div>
    </div>
</div>
<script>district='<?php _e($district);?>';window.onload = function(){oneMap.pjax_complete()}</script>

<?php $this->need('includes/body-layout-end.php');?>

<?php  $this->need('includes/footer.php');?>
