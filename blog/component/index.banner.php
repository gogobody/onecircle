<?php if (count((explode("||", ($this->options->JIndexRecommend)))) == 2 || $this->options->JIndexCarousel) : ?>
    <div class="index-banner">
        <?php if ($this->options->JIndexCarousel) : ?>
            <?php
            $txt = $this->options->JIndexCarousel;
            $string_arr = explode("\r\n", $txt);
            $long = count($string_arr);
            ?>
            <div id="carouselSwiperCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php for ($j = 0; $j < $long; $j++):?>
                    <li data-target="#carouselSwiperCaptions" data-slide-to="<?php _e($j);?>"  class="<?php if ($j == 0) _e('active');?>"></li>
                    <?php endfor;?>
                </ol>
                <div class="carousel-inner">
                    <?php for ($i = 0; $i < $long; $i++) {
                        $img = explode("||", $string_arr[$i])[0];
                        $url = explode("||", $string_arr[$i])[1];
                        $title = explode("||", $string_arr[$i])[2];
                    ?>
                    <div class="carousel-item <?php if ($i == 0) _e('active');?>">
                        <a target="_blank" title="<?php echo $title ?>" href="<?php echo $url ?>" class="swiper-slide">
                            <img src="<?php echo GetLazyLoad() ?>" data-src="<?php echo $img ?>" class="d-block w-100 lazyload" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo $title ?></h5>
                            </div>
                            <svg width="15px" height="15px" class="icon" viewBox="0 0 1026 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <path d="M784.299475 1007.961156a33.200407 33.200407 0 0 1-27.105646-9.061947l-216.524395-144.349597-108.903751 108.262198c-9.061947 9.061947-36.167593 18.0437-45.229541 9.061947a49.720417 49.720417 0 0 1-27.105646-45.229541v-198.881666A33.200407 33.200407 0 0 1 368.893414 700.656903l343.070875-370.577492a44.748375 44.748375 0 0 1 63.273239 63.27324L441.068212 754.868196v72.174799l63.27324-54.211293a42.583131 42.583131 0 0 1 54.211293-9.061947L757.193829 890.155846l153.652126-749.81596-759.198684 370.497298 171.695826 108.50278c18.0437 9.061947 27.105646 45.22954 9.061946 63.27324-9.061947 18.0437-45.22954 27.105646-63.273239 18.043699L34.082544 547.004777C25.100791 538.023025 16.038844 529.281854 16.038844 510.837184s9.061947-27.105646 27.105647-36.167594l903.788863-451.814237c18.0437-9.061947 36.167593-9.061947 45.229541 0C1010.447177 32.077688 1010.447177 49.960999 1010.447177 68.004699l-180.757773 903.788864c0 18.0437-9.061947 27.105646-27.105646 36.167593z"></path>
                            </svg>
                        </a>
                    </div>
                    <?php } ?>
                </div>
                <a class="carousel-control-prev" href="#carouselSwiperCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselSwiperCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        <?php endif; ?>

        <?php
        $recommend = $this->options->JIndexRecommend;
        $recommendCounts = explode("||", $recommend);
        $number = count($recommendCounts);
        if ($number === 2) {
        ?>
            <div class="recommend <?php if (!$this->options->JIndexCarousel) : ?>noCarousel<?php endif; ?>" id="recommend">
                <?php for ($i = 0; $i < $number; $i++) {
                ?>
                    <?php $this->widget('Widget_Archive@recommend' . $i, 'pageSize=1&type=post', 'cid=' . $recommendCounts[$i])->to($item); ?>
                    <a title="<?php $item->title(); ?>" href="<?php $item->permalink() ?>">
                        <img class="lazyload" src="<?php echo GetLazyLoad() ?>" data-src="<?php GetRandomThumbnail($item) ?>">
                        <div class="desc">
                            <span class="type">推荐</span>
                            <p><?php $item->title(); ?></p>
                        </div>
                    </a>

                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php endif; ?>