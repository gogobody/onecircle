<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
class contents{
    public static function parseContent($data, $widget, $last)
    {
        $text = empty($last) ? $data : $last;
        if ($widget instanceof Widget_Archive) {
            if($widget->fields->articleType == 'default' || $widget->is('page')){
                $text = contents::fancybox($text,$widget);
            }elseif ($widget->fields->articleType == 'focususer'){
                // 关注
                $text = contents::focusUsers($text);
            }elseif ($widget->fields->articleType == 'repost'){
                // 转发
                $text = contents::repostArticle($text,Helper::options()->defaultSlugUrl);
            }
            if ($widget->fields->articleType == 'link' || $widget->is('page')){
                $text = contents::parsePureLink($text);

            }

            //owo
            $text = contents::parseOwo($text);
            // 友链解析
            $text = contents::parseLink($text);
            $text = contents::parseHide($text);
            // 其它
            $text = contents::blankReplace($text);
            $text = contents::biliVideo($text);
            $text = contents::video($text);

            $text = contents::cidToContent($text);

            // 转发

        }
        return $text;
    }
    /**
     *  解析 owo 表情
     */
    public static function parseOwo($content) {
        $content = preg_replace_callback('/\:\:\(\s*(呵呵|哈哈|吐舌|太开心|笑眼|花心|小乖|乖|捂嘴笑|滑稽|你懂的|不高兴|怒|汗|黑线|泪|真棒|喷|惊哭|阴险|鄙视|酷|啊|狂汗|what|疑问|酸爽|呀咩爹|委屈|惊讶|睡觉|笑尿|挖鼻|吐|犀利|小红脸|懒得理|勉强|爱心|心碎|玫瑰|礼物|彩虹|太阳|星星月亮|钱币|茶杯|蛋糕|大拇指|胜利|haha|OK|沙发|手纸|香蕉|便便|药丸|红领巾|蜡烛|音乐|灯泡|开心|钱|咦|呼|冷|生气|弱|吐血)\s*\)/is',
            array('contents', 'parsePaopaoBiaoqingCallback'), $content);
        $content = preg_replace_callback('/\:\@\(\s*(高兴|小怒|脸红|内伤|装大款|赞一个|害羞|汗|吐血倒地|深思|不高兴|无语|亲亲|口水|尴尬|中指|想一想|哭泣|便便|献花|皱眉|傻笑|狂汗|吐|喷水|看不见|鼓掌|阴暗|长草|献黄瓜|邪恶|期待|得意|吐舌|喷血|无所谓|观察|暗地观察|肿包|中枪|大囧|呲牙|抠鼻|不说话|咽气|欢呼|锁眉|蜡烛|坐等|击掌|惊喜|喜极而泣|抽烟|不出所料|愤怒|无奈|黑线|投降|看热闹|扇耳光|小眼睛|中刀)\s*\)/is',
            array('contents', 'parseAruBiaoqingCallback'), $content);
        $content = preg_replace_callback('/\:\&\(\s*(.*?)\s*\)/is',
            array('contents', 'parseQuyinBiaoqingCallback'), $content);

        return $content;
    }
    /**
     * 泡泡表情回调函数
     *
     * @return string
     */
    public static function parsePaopaoBiaoqingCallback($match)
    {
        return '<img class="emoji" src="/usr/themes/onecircle/assets/owo/biaoqing/paopao/'. str_replace('%', '', urlencode($match[1])) . '_2x.png">';
    }

    /**
     * 阿鲁表情回调函数
     *
     * @return string
     */
    public static function parseAruBiaoqingCallback($match)
    {
        return '<img class="emoji" src="/usr/themes/onecircle/assets/owo/biaoqing/aru/'. str_replace('%', '', urlencode($match[1])) . '_2x.png">';
    }

    /**
     * 蛆音娘表情回调函数
     *
     * @return string
     */
    public static function parseQuyinBiaoqingCallback($match)
    {
        return '<img class="emoji" src="/usr/themes/onecircle/assets/owo/biaoqing/quyin/'. str_replace('%', '', urlencode($match[1])) . '.png">';
    }
    /**
     * 友链解析
     */
    public static function parseLink($text) {
        $reg = '/\[links\](.*?)\[\/links\]/s';
        if (preg_match($reg, $text)) {
            $rp = '${1}';
            $text = preg_replace($reg, $rp, $text);
            $pattern = '/\[(.*?)\]\((.*?)\)\+\((.*)\)/';
            $replacement = '<div class="col-lg-3 col-6 col-md-4 links-container">
		    <a href="${2}" title="${1}" target="_blank" class="links-link">
			  <div class="links-item">
			    <div class="links-img"><img src="${3}"></div>
				<div class="links-title">
				  <h4>${1}</h4>
				</div>
		      </div>
			  </a>
			</div>';
            return preg_replace($pattern, $replacement, $text);
        }else{
            return $text;
        }
    }

    public static function parseHide($text)
    {
        $reg = '/\[hide\](.*?)\[endhide\]/sm';
        if (preg_match($reg, $text)) {
            if(!Typecho_Widget::widget('Widget_Archive')->is('single')){
                $text = preg_replace($reg,'',$text);
            }
            $db = Typecho_Db::get();
            $sql = $db->select()->from('table.comments')
                ->where('cid = ?',Typecho_Widget::widget('Widget_Archive')->cid)
                ->where('mail = ?', Typecho_Widget::widget('Widget_Archive')->remember('mail',true))
                ->limit(1);
            $result = $db->fetchAll($sql);
            if(Typecho_Widget::widget('Widget_User')->hasLogin() || $result) {
                $text = preg_replace("/\[hide\](.*?)\[endhide\]/sm",'<div class="reply2view">$1</div>',$text);
            }
            else{
                $text = preg_replace("/\[hide\](.*?)\[endhide\]/sm",'<div class="reply2view text-center">此处内容需要评论回复后方可阅读。</div>',$text);
            }
        }
        return $text;
    }

    /**
     * 新标签打开
     * @param $content
     * @return string|string[]|null
     */
    public static function blankReplace($content){
        $reg = '#<a(.*?) href="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#sm';
        if (preg_match($reg, $content)) {
            $content = preg_replace($reg, '<a$1 href="$2$3"$5 target="_blank">', $content);
            return $content;
        }
        return $content;
    }

    public static function lazyload($text){
        $pattern_img =  '/<img[\s\S]*?src\s*=\s*[\"|\'](.*?)[\"|\'][\s\S]*?>/gim';
        $pregEchoBackImg = 'data-echo-background[ ]?=[ ]?[&quot;]*[\'"]?(.*?\.(?:png|jpg|jpeg|gif|bmp|webp))'; // 针对echo.js 匹配

    }

    public static function fancybox($text,$widget)
    {
        $loading = Helper::options()->themeUrl('assets/img/loading.svg', 'onecircle');
        // old format
        /*        $pattern =  '/<p>(\s|[\r\n])*(<img[\s\S]*?src\s*=\s*[\"|\'](.*?)[\"|\'][\s\S]*?>)(\s|[\r\n])*<\/p>/i';*/
        $pattern='/\[gallery\]([\s\S]*?)\[endgallery\]/sm';
        $pattern_img =  '/<img[\s\S]*?src\s*=\s*[\"|\'](.*?)[\"|\'][\s\S]*?>/i';
        $filter_plink = '/<img((?!plink).)*.src=[\"|\']?(.*?)[\"|\'][\s\S]*?>/i';  // 匹配不含 plink 的

        preg_match_all($pattern, $text, $match);
        if (!empty($match[1][0])){ // so its a gallery and $0 is <p> $1 = \t\r $2=<img>...</img> $3 ...
            $gallerynum = count($match[1]);
            for ($i = 0; $i < $gallerynum; $i++) {
                $imgs_str_ = $match[1][$i];
                preg_match($filter_plink,$match[0][$i],$plinkarr);
                if (empty($plinkarr)) continue; //含有 plink
                preg_match_all($pattern_img, $imgs_str_, $imgs);
                $img_count = count($imgs[0]) > 9 ? 9:count($imgs[0]) ;
                $imgs_str = preg_replace($pattern_img, '<a class="post-cover-img-more" data-fancybox="gallery" href="$1"><img src="'.$loading.'" class="post-cover-img-more" data-echo="$1" alt="no morepic"></a>', $imgs_str_); //style="background-image: url('."$1".')"
                $text = preg_replace($pattern, '<div class="post-cover-img-container"><div class="post-cover-inner-more post-cover-inner-auto-rows-'.$img_count.'">'.$imgs_str.'</div></div>', $text,1);
            }
            return $text;
        }else { // no gallery
            if (preg_match($pattern_img, $text)) {
                return preg_replace($pattern_img, '<a class="fancybox-single-img" data-fancybox="gallery" href="$1"><img src="'.$loading.'" class="post-cover-img-more" data-echo="$1" alt="no pic now"></a>', $text);
            }
        }

        return $text;
    }
    public static function biliVideo($text)
    {
        $reg = '/\[bilibili bv="(.+?)" p="(.+?)"]/sm';
        if (preg_match($reg, $text)) {
            $replacement = '<div class="embed-responsive embed-responsive-4by3"><iframe class="video embed-responsive-item" src="//player.bilibili.com/player.html?bvid=$1&page=$2&auto=0&autoplay=0" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe></div>';
            return preg_replace($reg, $replacement, $text);
        }
        return $text;
    }
    public static function video($text)
    {
        $reg = '/\[video src="(.+?)"]/sm';
        if (preg_match($reg, $text)) {
            $replacement = '<div class="embed-responsive embed-responsive-4by3"><iframe class="video" src="$1&auto=0&autoplay=0" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe></div>';
            return preg_replace($reg, $replacement, $text);
        }
        return $text;
    }
    public static function cidToContent($text)
    {
        $reg = '/\[cid="(.+?)"]/';
        if (preg_match_all($reg, $text, $matches)) {
            $db = Typecho_Db::get();
            foreach ($matches[1] as $match) {
                $result = $db->fetchAll($db->select()->from('table.fields')
                    ->where('cid = ?',$match)
                );
                $articleArr = $db->fetchAll($db->select()->from('table.contents')
                    ->where('status = ?','publish')
                    ->where('type = ?', 'post')
                    ->where('cid = ?',$match)
                );
                if (count($articleArr) == 0){
                    $text =  preg_replace($reg, '<br>文章cid错误<br>', $text, 1);
                    return $text;
                }
                $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($articleArr[0]);
                if ($result[0]['name'] =="banner"){
                    $banner = empty($result[0]['str_value'])?'/usr/themes/onecircle/assets/img/default.png':$result[0]['str_value'];

                }else{
                    $banner = '/usr/themes/onecircle/assets/img/default.png';
                }

                $replacement = '<div class="card cid-card text-white">
                              <img src="'.$banner.'" class="card-img" alt="文章卡片">
                              <div class="card-img-overlay">
                                <span class="card-title"><a href="'.$val['permalink'].'">'.$val['title'].'</a></span>
                                <p class="card-text">'.$result[1]['excerpt'].'</p>
                                <p class="card-text">'.date('Y-m-d H:i:s', $val['modified']).'</p>
                              </div>
                            </div>';
                $text =  preg_replace($reg, $replacement, $text, 1);
            }
        }
        return $text;
    }

    // [focususer href="user href" avatar="user avatar" username="user name" sign="wojiushiwo" ]
    public static function focusUsers($text){
        $pattern = '/\[focususer.*?href="(.*?)" avatar="(.*?)" username="(.*?)" sign="(.*?)".*?]/i';
        if(preg_match($pattern, $text, $match)){
            $replacement = '<div class="sc-AxjAm sc-AxirZ kQHfHM bITJVr"><a href="$1" class="sc-AxjAm sc-AxirZ eGdPrb"><img src="$2" alt="再多一点可爱" class="sc-AxjAm jZLHXc"><div class="sc-AxjAm sc-AxirZ hkyonN"><div class="sc-AxjAm oDrAC">$3</div><div class="sc-AxjAm hHqHSX ezzhLs">$4</div></div></a></div>';
            return preg_replace($pattern, $replacement, $text);
        }
        return $text;
    }
    // [repost.*?href="(.*?)" bannerimg="(.*?) repousername="(.*?)" repostext="(.*?)" categoryname="(.*?)" categoryhref="(.*?)".*?]

    /**
     * @param $text
     * @param $url_ //imgurl
     * @return string|string[]|null
     */
    public static function repostArticle($text,$url_){
        $pattern = '/\[repost.*?href="(.*?)" bannerimg="(.*?)" repousername="(.*?)" repostext="(.*?)" category=["\'](.*?)["\']\]/i';
        if(preg_match($pattern, $text, $match)){
            if ($match[2]){ // if has img
                $replacement = '<div class="repost-container"><a class="repost-content" href="$1"><img src="$2" class="repost-banner"><div class="repost-text">$3:$4</div></a><div class="repost-category">$5</div></div>';
            }else{
                $replacement = '<div class="repost-container"><a class="repost-content" href="$1"><img src="'.$url_.'" class="repost-banner"><div class="repost-text">$3:$4</div></a><div class="repost-category">$5</div></div>';
            }
            return preg_replace($pattern, $replacement, $text);
        }
        return $text;
    }

    // parse pureLink
    // [pureLink comment="" text="" link=""]
    public static function parsePureLink($text){
        $reg = '/\[pureLink comment="(.*?)" text="(.*?)" link="(.*?)"\]/sm';
        if (preg_match($reg, $text, $arr)) {
            if ($arr[1])
                $replacement = '<div class=""><p>$1</p><a class="link-a" href="$3" target="_blank"><div class="link-container link-a"><div class="link-banner"><img plink src="'.Helper::options()->themeUrl .'/assets/img/link.png'.'"><div class="link-text">$2</div></div></div></a></div>';
            else
                $replacement = '<div class=""><a class="link-a" href="$3" target="_blank"><div class="link-container link-a"><div class="link-banner"><img plink src="'.Helper::options()->themeUrl .'/assets/img/link.png'.'"><div class="link-text">$2</div></div></div></a></div>';
            return preg_replace($reg, $replacement, $text);
        }
        return $text;
    }
}
