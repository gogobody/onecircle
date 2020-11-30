<?php if ($this->options->JIndexHotStatus === 'on') : ?>
    <?php $this->widget('Widget_Post_hot@gouzei@hot', 'pageSize=4')->to($hot); ?>
    <?php if ($hot->have()) : ?>
        <div class="index-hot">
            <div class="title">热门文章</div>
            <ul class="hot">
                <?php while ($hot->next()) : ?>
                    <li>
                        <a href="<?php $hot->permalink(); ?>" title="<?php $hot->title(); ?>">
                            <img class="lazyload" src="<?php echo GetLazyLoad() ?>" data-src="<?php GetRandomThumbnail($hot); ?>">
                            <p><?php $hot->title(); ?></p>
                            <span><?php getPostViews($hot); ?> ℃</span>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    <?php endif; ?>
<?php endif; ?>