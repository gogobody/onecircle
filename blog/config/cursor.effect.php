<?php if ($this->options->JCursorEffects !== 'off') : ?>
    <?php if ($this->options->JCDN === 'on') : ?>
        <script src="//unpkg.zhimg.com/typecho_joe_theme@<?php echo JoeVersion() ?>/assets/cursor/<?php $this->options->JCursorEffects() ?>"></script>
    <?php else : ?>
        <script src="<?php $this->options->themeUrl('assets/cursor/' . $this->options->JCursorEffects); ?>"></script>
    <?php endif; ?>
<?php endif; ?>
