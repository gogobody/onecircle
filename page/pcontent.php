<?php
/**
 * 资源页
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$db = Typecho_Db::get();
$resource_category = $this->request->get("category", "");
$resource_tag = $this->request->get("tag", "");

// plugins options
$poptions = Helper::options()->plugin('OneCircle');
$Jcatags = $poptions->JResourceCatags; // 1||22,23 category||tsg1,tag2
$category_tags_arr = [];
if (isset($Jcatags) && $Jcatags!="") {
    $cts_arr = explode("\r\n", trim($Jcatags));
    if(!empty($cts_arr)){
        foreach ($cts_arr as $cts_a) {
            $ctx_explode = explode("||", $cts_a);
            if(count($ctx_explode)==0) continue;
            if(count($ctx_explode)==1) $ctx_explode[1]='';
            $category_tags_arr[] = array(
                "category" => $ctx_explode[0],
                "tags" => explode(",", trim($ctx_explode[1]))
            );
        }
    }

}
$category_mids = array_column($category_tags_arr, "category");
$categorys = null;
$this->widget('Widget_Metas_Category_List')->to($categorys);
$showCategory = $categorys->getCategories($category_mids);
$showTags = null;
if ($resource_category) {
    $showTagsMids = null;
    foreach ($category_tags_arr as $c) {
        if ($c['category'] == $resource_category) {
            $showTagsMids = $c['tags'];
        }
    }
    if ($showTagsMids) {
        $showTags = $db->fetchAll($db->select()->from('table.metas')->where('type = ?', 'tag')->where('mid IN ?', $showTagsMids));
    }
} else {
    if (!empty($category_tags_arr)) {
        $showTags = $db->fetchAll($db->select()->from('table.metas')->where('type = ?', 'tag')->where('mid IN ?', $category_tags_arr[0]['tags']));
    }
}

$payPlugin = $this->getPageRow()['payPlugin'];
?>
<div>
    <section id="pjax-container">

        <section class="container j-index j-index-r j-resource">
            <section class="j-adaption">
                <?php
                if (empty($category_tags_arr)): ?>
                    <section class="main"><center>请在插件中填写分类标签!</center></section>
                <?php else:?>
                <section class="main">
                    <!-- 主体 -->
                    <div class="term-bar visible lazyload" data-bg="https://api.btstu.cn/sjbz/api.php"
                         style="background-image: url(https://api.btstu.cn/sjbz/api.php);">
                        <h1 class="term-title"><?php echo $resource_category ? $resource_category : "发现" ?></h1>
                    </div>
                    <div class="lang">
                        <div class="lang__3"></div>
                        <div class="lang__4"></div>
                    </div>
                    <div class="filter--content">
                        <form class="mb-0" method="get" action="">
                            <input type="hidden" name="s">
                            <div class="form-box search-properties mb-0">
                                <!-- 一级分类 -->
                                <div class="filter-item">
                                    <ul class="filter-tag category"><span><i class="icon iconfont icon-folder-open"></i> 分类</span>
                                        <li><a no-pjax href="<?php echo $this->options->index . '/resources' ?>"
                                               class="on"> 发现</a></li>
                                        <?php foreach ($showCategory as $showc): ?>
                                            <li><a no-pjax href="<?php echo $showc['permalink'] ?>"
                                                   data-mid="<?php echo $showc['mid'] ?>"><?php echo $showc['name'] ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <!-- 相关标签 -->
                                <div class="filter-item">
                                    <ul class="filter-tag tag"><span><i class="icon iconfont icon-tags"></i> 标签</span>
                                        <?php foreach ($showTags as $showt): ?>
                                            <li><a no-pjax
                                                   href="<?php echo genPermalink('tag', ['type' => 'tag', 'slug' => $showt['slug']]) ?>"
                                                   data-mid="<?php echo $showt ['mid'] ?>"><?php _oc_e($showt['name']); ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <!-- 自定义筛选 -->
                                <div class="filter-tab">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <ul class="filter-tag price"><span><i class="icon iconfont icon-filter"></i>价格</span>
                                                <?php
                                                if ($payPlugin == 'TePass'){
                                                ?>
                                                <li><a no-pjax href="/resources?price=-1" class="tab on"
                                                       data-price="-1"><i></i><em>全部</em></a></li>
                                                <li><a no-pjax href="/resources?price=1" class="tab"
                                                       data-price="0"><i></i><em>免费</em></a></li>
                                                <li><a no-pjax href="/resources?price=2" class="tab"
                                                       data-price="3"><i></i><em>付费</em></a></li>
                                                <li><a no-pjax href="/resources?price=3" class="tab"
                                                       data-price="1"><i></i><em>登录可见</em></a></li>
                                                <li><a no-pjax href="/resources?price=4" class="tab"
                                                       data-price="2"><i></i><em>会员可见</em></a></li>
                                                    <?
                                                }else{
                                                    ?>
                                                    <li><a no-pjax href="/resources?price=-1" class="tab on"
                                                           data-price="-1"><i></i><em>全部</em></a></li>
                                                    <li><a no-pjax href="/resources?price=1" class="tab"
                                                           data-price="0"><i></i><em>免费</em></a></li>
                                                    <?
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <!-- 排序 -->
                                            <ul class="filter-tag order" style="width: 100%;">
                                                <div class="right">
                                                    <li class="rightss"><i class="icon iconfont icon-show_more"></i><a
                                                                no-pjax href="/resources?order=created" class="on"
                                                                data-order="created">发布日期</a></li>
                                                    <li class="rightss"><i class="icon iconfont icon-show_more"></i><a
                                                                no-pjax href="/resources?order=modified"
                                                                data-order="modified">修改时间</a></li>
                                                    <li class="rightss"><i class="icon iconfont icon-show_more"></i><a
                                                                no-pjax href="/resources?order=commentsNum"
                                                                data-order="commentsNum">评论数量</a></li>
                                                    <li class="rightss"><i class="icon iconfont icon-show_more"></i><a
                                                                no-pjax href="/resources?order=likes"
                                                                data-order="likes">点赞</a></li>
                                                    <li class="rightss"><i class="icon iconfont icon-show_more"></i><a
                                                                no-pjax href="/resources?order=views"
                                                                data-order="views">热度</a></li>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- .row end -->
                            </div>
                            <!-- .form-box end -->
                        </form>
                    </div>
                    <div class="main-content article">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="content-area">
                                    <main class="row posts-wrapper">
                                        <?php if ($this->have()): ?>
                                            <?php while ($this->next()): ?>
                                                <div class="post col-lg-1-5 col-6 col-sm-6 col-md-4 col-lg-3">
                                                    <article class="post post-grid">
                                                        <div class="entry-media">
                                                            <div class="placeholder">
                                                                <a class="lazyload"
                                                                   href="<?php echo $this->permalink ?>" target="_blank"
                                                                   rel="noopener"
                                                                   style="background-image: url('<?php echo GetLazyLoad_(); ?>')"
                                                                   data-bg="<?php GetRandomThumbnail($this); ?>"></a>
                                                                <div class="cao-cover"><img
                                                                        src="<?php PluginUrl('assets/img/resources/rings.svg'); ?>"
                                                                        width="50" height="50px" alt=""></div>
                                                            </div>
                                                            <div class="entry-format"><i
                                                                    class="icon iconfont icon-huiyuan2"></i></div>
                                                            <div class="post-list-meta-box">
                                                                <ul class="post-list-meta">
                                                                    <li class="post-list-meta-views">
                                                                        <i class="icon iconfont icon-Views"></i>
                                                                        <?php echo $this->views; ?>
                                                                    </li>
                                                                    <li class="post-list-meta-comment">
                                                                        <i class="icon iconfont icon-pinglun3x"></i>
                                                                        <?php echo $this->commentsNum ?>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="entry-wrapper">
                                                            <a class="grid_author_avt"
                                                               href="<?php echo $this->permalink ?>" target="_blank"
                                                               rel="noopener">
                                                                <div class="grid_author_bggo avatar bg-cover"
                                                                     style="background-image: url(<?php PluginUrl('assets/img/resources/huiyuan.svg') ?>);"></div>
                                                            </a>
                                                            <header class="entry-header">
                                                                <div class="entry-meta">
                                                            <span class="meta-category">
                                                            <?php foreach ($this->categories as $category): ?>
                                                                <a href="<?php echo $category['permalink'] ?>"
                                                                   rel="category" target="_blank" rel="noopener"><i
                                                                        class="dot"></i><?php echo $category['name'] ?></a>
                                                            <?php endforeach; ?>
                                                            </span>
                                                                </div>

                                                                <h2 class="entry-title">
                                                                    <a href="<?php echo $this->permalink ?>"
                                                                       title="<?php $this->title(); ?>" rel="bookmark"
                                                                       target="_blank"
                                                                       rel="noopener"><?php $this->title(); ?></a>
                                                                </h2>
                                                            </header>
                                                            <div class="entry-footer">
                                                                <ul class="post-meta-box">
                                                                    <li class="meta-date">
                                                                        <time>
                                                                            <i class="fa fa-clock-o"></i><?php echo formatTime_($this->created); ?>
                                                                        </time>
                                                                    </li>
                                                                    <?php if ($this->fields->resourceField): ?>
                                                                        <div class="jing-theme-tag"><?php _oc_e($this->fields->resourceField); ?></div>
                                                                    <?php endif; ?>
                                                                    <li class="meta-price">
                                                                <span>
                                                                    <i class="icon iconfont icon-dianchi"></i>
                                                                    <?php
                                                                    if ($payPlugin == 'TePass'){
                                                                        echo $this->post_price;
                                                                    }else {
                                                                        _oc_e($this->price);
                                                                    }
                                                                    ?>
                                                                </span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <section class="empty-result">
                                                <svg viewBox="0 0 1024 1024" version="1.1"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M456.597204 887.400836V886.000845v1.399991z m56.199656-57.499648c-30.899811 0-56.199656 24.799848-56.199656 56.099657v0.699996c0 6.399961 4.89997 11.39993 11.199932 11.39993 6.299961 0 11.199931-4.999969 11.199931-11.39993v-0.699996c0-18.499887 14.69991-34.099791 33.699794-34.099791 18.999884 0 33.699794 15.599904 33.699793 34.099791v0.699996c0 6.399961 4.89997 11.39993 11.199932 11.39993 6.299961 0 11.199931-4.999969 11.199931-11.39993v-0.699996c0.199999-30.599813-25.099846-56.099656-55.999657-56.099657zM382.19766 709.501926c-15.499905-3.599978-38.599764-2.799983-43.499734 13.499917-2.799983 9.899939 13.299919 11.39993 28.099828 14.899909 11.899927 2.799983 18.299888 9.199944 16.899897 11.39993-2.799983 3.599978-20.399875-3.499979-36.499777 2.099987-15.499905 5.699965-12.599923 19.899878-3.499978 23.399857 9.099944 3.599978 23.899854-0.699996 58.299643 4.999969 17.599892 2.799983 28.099828-2.799983 30.199815-13.499917 3.999976-24.099852-28.299827-51.799683-49.999694-56.799652zM591.496378 767.001574c2.099987 10.599935 11.899927 16.2999 30.199815 13.499917 34.399789-5.699965 49.199699-1.399991 58.299643-4.999969 9.099944-3.499979 11.899927-18.499887-3.499978-23.399857-15.499905-5.699965-32.999798 1.399991-36.499777-2.099987-2.099987-2.799983 4.89997-9.199944 16.899897-12.099926 14.69991-3.599978 30.899811-4.999969 28.099828-14.899909-4.89997-16.2999-27.399832-16.999896-43.499734-13.499917-21.899866 4.999969-54.299668 32.6998-49.999694 57.499648z m420.697424-296.698184L816.894998 288.604503c-6.299961-6.399961-15.499905-9.199944-24.599849-9.199944H232.598576c-9.099944 0-17.599892 3.499979-23.899854 9.199944L11.999927 470.30339C4.299974 477.403347 0.099999 486.603291 0.099999 497.303225v445.097275c0 44.699726 35.799781 81.5995 80.799506 81.5995h862.494719c44.199729 0 80.799505-36.899774 80.799505-81.5995V497.303225c-0.099999-9.999939-4.999969-19.899878-11.999927-26.999835z m-352.597841-2.799983c-12.599923 0-23.199858 10.599935-23.199858 24.099853 0 66.699592-56.199656 122.799248-122.899247 122.799248s-122.899247-56.099656-122.899248-122.799248c0-12.799922-10.499936-24.099852-23.199858-24.099853H93.499427l146.099106-134.899174H785.995187l144.699114 134.899174H659.595961zM969.994061 515.703112v426.597388c0 15.599904-11.899927 26.999835-26.699837 26.999835H80.899505c-15.499905 0-28.099828-12.099926-28.099828-26.999835V515.703112H344.997888c5.599966 36.899774 23.199858 71.699561 51.299685 97.9994 32.299802 31.199809 73.699549 47.599709 117.299282 47.599709 43.499734 0 84.99948-16.999896 117.299282-47.599709 27.399832-26.999835 45.69972-60.999626 51.299686-97.9994H969.994061zM246.298492 203.505024L157.199037 118.005547c-9.499942-9.199944-9.899939-24.399851-0.799995-34.099791 9.099944-9.599941 24.199852-9.999939 33.699794-0.799995l88.999455 85.499477c9.599941 9.199944 9.899939 24.399851 0.899995 34.099791-9.099944 9.599941-24.099852 9.999939-33.699794 0.799995m245.498497-37.799769c-4.599972-4.399973-7.199956-10.499936-7.399955-16.799897l-3.19998-124.09924C480.897055 11.4062 491.296992 0.406268 504.396912 0.00627c13.199919-0.299998 24.099852 10.199938 24.49985 23.499856l3.099981 124.09924c0.199999 9.699941-5.299968 18.699885-14.099914 22.599862-8.699947 3.999976-18.999884 2.199987-26.09984-4.499973m231.098585 33.399796c-4.599972-4.399973-7.299955-10.499936-7.399955-16.899897-0.199999-6.399961 2.199987-12.599923 6.49996-17.199894l84.599482-90.099449c9.099944-9.599941 24.199852-9.999939 33.699794-0.799995 9.499942 9.199944 9.899939 24.399851 0.799995 34.099791l-84.599482 90.099449c-4.399973 4.599972-10.399936 7.299955-16.699898 7.499954-6.199962 0-12.299925-2.299986-16.899896-6.699959"></path>
                                                </svg>
                                                <span>这里空空如也，啥也没有~</span>
                                            </section>
                                        <?php endif; ?>

                                    </main>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <?php $this->need('page/pagination.php'); ?>
                <?php endif; ?>

            </section>
        </section>
    </section>
</div>
