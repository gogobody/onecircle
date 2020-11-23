<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$next_page_link = "";
if ($this->have()) {
    if (empty($this->_pageNav)) {
        $query = Typecho_Router::url($this->parameter->type .
            (false === strpos($this->parameter->type, '_page') ? '_page' : NULL),
            $this->_pageRow, $this->options->index);

        $this->need('/widget/Widget_Pagination.php');
        $this->_widget_pageNav = new Widget_Pagination($this->getTotal(),
            $this->_currentPage, $this->parameter->pageSize, $query);
        $next_page_link = $this->_widget_pageNav->getPageLink('next');
    }
}
?>
<?php if (!$this->options->useInfiniteScroll):?>
    <div class="page-pagination">
        <?php
        $this->pageNav(
            '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-double-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                              <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                            </svg>',
            '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-double-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                          <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>',
            1, '...', array(
            'wrapTag' => 'ul',
            'wrapClass' => 'pagination justify-content-center',
            'itemTag' => 'li',
            'itemClass' => 'page-item',
            'linkClass' => 'page-link',
            'currentClass' => 'active'
        ));
        ?>
    </div>
<?php else:?>
    <div class="pagination a-pageLink align-content-center">
        <?php if (!empty($next_page_link)):?>
            <a no-pjax class="next" href="<?php _e($next_page_link);?>">
                <div class="pagelink-svg"><svg t="1605616761471" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="8698" width="18" height="18"><path d="M 951.844 772.835 L 858.965 635.466 c -3.65568 -5.24493 -11.2835 -9.21702 -20.5783 -10.6465 c -9.21805 -1.35066 -19.0689 0 -26.3772 3.8144 L 622.757 725.722 c -8.58214 4.36941 -12.3146 11.1217 -9.85293 17.7971 c 2.62246 6.59251 11.1237 11.8385 21.929 13.4257 l 49.9753 7.46906 c -49.6579 58.3168 -115.442 93.7513 -179.639 93.7513 c -125.056 0 -264.573 -137.211 -264.573 -333.853 c 0 -23.1997 -31.145 -42.1888 -69.5992 -42.1888 s -69.5992 18.9891 -69.5992 42.1888 c 0 234.381 177.334 418.072 403.77 418.072 c 127.916 0 242.803 -57.7597 317.724 -157.154 l 95.8187 14.4589 c 2.4617 0.319488 4.84557 0.477184 7.23046 0.477184 c 0.157696 0 0.157696 0 0.397312 0 c 16.4465 0 29.7943 -8.02406 29.7943 -17.9548 C 956.132 778.714 954.543 775.617 951.844 772.835 L 951.844 772.835 Z M 185.934 392.106 c -9.29587 -1.4295 -17.0025 -5.2439 -20.5783 -10.6455 L 70.7297 241.705 c -4.28954 -6.27712 -2.22413 -13.6663 5.08416 -18.6716 c 7.31034 -5.2439 18.9102 -7.38816 29.7155 -5.79994 l 95.8976 14.4599 c 74.923 -99.2338 189.809 -157.233 317.726 -157.233 c 226.435 0 403.769 183.77 403.769 418.151 c 0 23.3585 -31.1439 42.1888 -69.6003 42.1888 c -38.4532 0 -69.5982 -18.8303 -69.5982 -42.1888 c 0 -196.642 -139.437 -333.854 -264.571 -333.854 c -64.1966 0 -129.983 35.4345 -179.64 93.7523 l 49.9753 7.46906 c 10.8841 1.82682 19.3065 6.83213 21.9279 13.4267 c 2.54259 6.67443 -1.27181 13.6653 -9.85088 18.0347 l -189.332 97.0107 c -5.40262 2.78016 -12.2358 4.13184 -19.1478 4.13184 C 190.622 392.583 188.238 392.423 185.934 392.106 Z" fill="#ffffff" p-id="8699"></path></svg></div> 加载更多
            </a>
            <div class="donut"></div>
        <?endif;?>
    </div>
<?php endif;?>