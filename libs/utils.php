<?php
class utils
{
    /**
     * 首页幻灯片的处理
     * @param $content
     * @return string
     */
    public static function bannerHandle($content)
    {
        $bannerArr = explode(PHP_EOL, $content);
        $text = '';
        if (count($bannerArr) > 3) {
            //打乱数组
            shuffle($bannerArr);
            $bannerArr = array_slice($bannerArr,0,3);
        }
        foreach ($bannerArr as $key => $banner) {
            if ($key) {
                $text .= '<div class="carousel-item">
                    <img src="'.$banner.'" class="d-block w-100" alt="banner">
                </div>';
            } else {
                $text .= '<div class="carousel-item active">
                    <img src="'.$banner.'" class="d-block w-100" alt="banner">
                </div>';
            }
        }
        return $text;
    }

    /**
     * 判断插件是否可用（存在且已激活）
     * @param $name
     * @return bool
     */
    public static function hasPlugin($name)
    {
        $plugins = Typecho_Plugin::export();
        $plugins = $plugins['activated'];
        return is_array($plugins) && array_key_exists($name, $plugins);
    }

    /**
     * 给导航添加图标
     * @param $nav
     * @param $text
     */
    public static function customNavHandle($nav, $pages, $that)
    {
        $navArr = explode(PHP_EOL, $nav);
        foreach ($navArr as $key => $val){
            if (empty($val) or $val == ""){
                unset($navArr[$key]);
            }
        }
        $navArr = array_values($navArr);
        $content = '';
        $count = count($navArr);
        $start = count($navArr);
        while ($pages->next()) {
            if ($that->is('page', $pages->slug)):
                $class="nav-link active";
            else:
                $class="nav-link";
            endif;
            if ($count) {
//                $url = Helper::options()->themeUrl .'/assets/img/bootstrap-icons.svg' . '#'. $navArr[$start-$count];
                $content .= '
                <a class="'.$class.'" href="'.$pages->permalink.'" title="'.$pages->title.'">
                        <div class="nav-item nav-icon">
                            '.$navArr[$start-$count].'
                        <span class="nav-item-text">'.$pages->title.'</span>
                    </div>
                </a>';
                $count--;
            } else { // 默认图标
//                $url = Helper::options()->themeUrl.'/assets/img/bootstrap-icons.svg#cursor';
                $content .= '
                    <a class="'.$class.'" href="'.$pages->permalink.'" title="'.$pages->title.'">
                            <div class="nav-item nav-icon">
                                <svg t="1605600901768" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="17655" width="200" height="200"><path d="M34.816 36.864h944.128v229.376H34.816zM47.104 275.0464V970.752h933.888V275.0464H47.104z m309.248 588.5952c-47.9232 0-86.6304-38.912-86.6304-86.6304 0-47.9232 38.912-86.6304 86.6304-86.6304s86.6304 38.912 86.6304 86.6304c0 47.7184-38.7072 86.6304-86.6304 86.6304z m4.096-282.624c-47.9232 0-86.6304-38.912-86.6304-86.6304 0-47.9232 38.912-86.6304 86.6304-86.6304s86.6304 38.912 86.6304 86.6304c0 47.7184-38.7072 86.6304-86.6304 86.6304zM660.8896 407.552c47.9232 0 86.6304 38.912 86.6304 86.6304 0 47.9232-38.912 86.6304-86.6304 86.6304-47.9232 0-86.6304-38.912-86.6304-86.6304-0.2048-47.7184 38.7072-86.6304 86.6304-86.6304z m1.2288 457.3184c-47.9232 0-86.6304-38.912-86.6304-86.6304s38.912-86.6304 86.6304-86.6304c47.9232 0 86.6304 38.912 86.6304 86.6304s-38.7072 86.6304-86.6304 86.6304z" fill="#EFB4BF" p-id="17656"></path><path d="M901.12 0H122.88C55.0912 0 0 55.0912 0 122.88v778.24c0 67.7888 55.0912 122.88 122.88 122.88h778.24c67.7888 0 122.88-55.0912 122.88-122.88V122.88c0-67.7888-55.0912-122.88-122.88-122.88zM122.88 61.44h778.24c33.792 0 61.44 27.648 61.44 61.44v120.832H61.44V122.88c0-33.792 27.648-61.44 61.44-61.44z m778.24 901.12H122.88c-33.792 0-61.44-27.648-61.44-61.44V305.152h901.12v595.968c0 33.792-27.648 61.44-61.44 61.44z" fill="#C9062C" p-id="17657"></path><path d="M152.576 152.576m-30.72 0a30.72 30.72 0 1 0 61.44 0 30.72 30.72 0 1 0-61.44 0Z" fill="#C9062C" p-id="17658"></path><path d="M275.456 152.576m-30.72 0a30.72 30.72 0 1 0 61.44 0 30.72 30.72 0 1 0-61.44 0Z" fill="#C9062C" p-id="17659"></path><path d="M398.336 152.576m-30.72 0a30.72 30.72 0 1 0 61.44 0 30.72 30.72 0 1 0-61.44 0Z" fill="#C9062C" p-id="17660"></path><path d="M358.4 365.1584c-67.7888 0-122.88 55.0912-122.88 122.88s55.0912 122.88 122.88 122.88 122.88-55.0912 122.88-122.88-55.0912-122.88-122.88-122.88z m0 184.32c-33.792 0-61.44-27.648-61.44-61.44s27.648-61.44 61.44-61.44 61.44 27.648 61.44 61.44c0 33.9968-27.648 61.44-61.44 61.44zM358.4 651.8784c-67.7888 0-122.88 55.0912-122.88 122.88s55.0912 122.88 122.88 122.88 122.88-55.0912 122.88-122.88-55.0912-122.88-122.88-122.88z m0 184.32c-33.792 0-61.44-27.648-61.44-61.44s27.648-61.44 61.44-61.44 61.44 27.648 61.44 61.44-27.648 61.44-61.44 61.44zM665.6 365.1584c-67.7888 0-122.88 55.0912-122.88 122.88s55.0912 122.88 122.88 122.88 122.88-55.0912 122.88-122.88-55.0912-122.88-122.88-122.88z m0 184.32c-33.792 0-61.44-27.648-61.44-61.44s27.648-61.44 61.44-61.44 61.44 27.648 61.44 61.44c0 33.9968-27.648 61.44-61.44 61.44zM665.6 651.8784c-67.7888 0-122.88 55.0912-122.88 122.88s55.0912 122.88 122.88 122.88 122.88-55.0912 122.88-122.88-55.0912-122.88-122.88-122.88z m0 184.32c-33.792 0-61.44-27.648-61.44-61.44s27.648-61.44 61.44-61.44 61.44 27.648 61.44 61.44-27.648 61.44-61.44 61.44z" fill="#C9062C" p-id="17661"></path></svg>
                            <span class="nav-item-text">'.$pages->title.'</span>
                        </div>
                    </a>';
            }
        }
        echo $content;
    }
    /**
     * 文章中文字数统计
     * @param $cid
     */
    public static function artCount ($cid){
        $db=Typecho_Db::get ();
        $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
        $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
        echo mb_strlen($text,'UTF-8');
    }

    /**
     * 文章阅读次数统计
     * @param $archive
     */
    public static function getPostView($archive)
    {
        $cid    = $archive->cid;
        $db     = Typecho_Db::get();
        $prefix = $db->getPrefix();
        if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
            $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
            echo 0;
            return;
        }
        $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
        if ($archive->is('single')) {
            $views = Typecho_Cookie::get('extend_contents_views');
            if(empty($views)){
                $views = array();
            }else{
                $views = explode(',', $views);
            }
            if(!in_array($cid,$views)){
                $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
                array_push($views, $cid);
                $views = implode(',', $views);
                Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
            }
        }
        echo $row['views'];
    }

    /**
     * 获取文章actions 信息
     * @param $archive
     * @throws Typecho_Db_Exception
     */
    public static function getPostActions($archive){
        $cid    = $archive->cid;
        $db     = Typecho_Db::get();
        $prefix = $db->getPrefix();
        if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
            $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
            echo 0;
        }
        $row = $db->fetchRow($db->select('views','name','address','district')->from('table.contents')->where('cid = ?', $cid));
        if ($archive->is('single')) {
            $views = Typecho_Cookie::get('extend_contents_views');
            if(empty($views)){
                $views = array();
            }else{
                $views = explode(',', $views);
            }
            if(!in_array($cid,$views)){
                $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
                array_push($views, $cid);
                $views = implode(',', $views);
                Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
            }
        }
        return $row;
    }

    /**
     * 编辑界面添加Button
     *
     * @return void
     */
    public static function addButton()
    {
        echo '<div class="pop_main" style="display:none;position:fixed;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-moz-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);-o-transform:translate(-50%,-50%);transform:translate(-50%,-50%);padding:10px;background-color:wheat;border-radius:10px">
        <div class="pop_con">
            <div class="pop_title">
                <h3>插入图册</h3>
                <a href="#" style="position:absolute;top:0;right:6px;padding:5px;font-size:22px;font-weight:bold;">×</a>
            </div>
            <div class="pop_detail">
                <label>每行输入一个网址</label><textarea id="input-num" type="text" rows="3" cols="70" style="outline:0;border:1px solid #ccc;border-radius:3px;"></textarea>
            </div>
            <div class="pop_footer" style="margin: 12px 0">
                <input type="button" value="取 消" class="cancel" style="float: left;margin-left: 10px;">
                <input type="button" value="确 定" class="confirm" style="float:right;margin-right: 10px;">                 
            </div>
        </div>
        <div class="mask"></div>
    </div>';

        echo '<script src="';
        Helper::options()->themeUrl('/assets/js/all.min.js');
        echo '"></script>';

        echo '<script src="';
        Helper::options()->themeUrl('/assets/js/editor.min.js');
        echo '"></script>';

        echo '<script src="';
        Helper::options()->themeUrl('/assets/js/page.min.js');
        echo '"></script>';

        echo '<script src="';
        Helper::options()->themeUrl('/assets/owo/owo_02.js');
        echo '"></script>';

        echo '<link rel="stylesheet" href="';
        Helper::options()->themeUrl('/assets/owo/owo.min.css');
        echo '" />';

        echo '<style>#custom-field textarea,#custom-field input{width:100%}
        .OwO span{background:none!important;width:unset!important;height:unset!important}
        .OwO .OwO-body .OwO-items{
            -webkit-overflow-scrolling: touch;
            overflow-x: hidden;
        }
        .OwO .OwO-body .OwO-items-image .OwO-item{
            max-width:-moz-calc(20% - 10px);
            max-width:-webkit-calc(20% - 10px);
            max-width:calc(20% - 10px)
        }
        @media screen and (max-width:767px){	
            .comment-info-input{flex-direction:column;}
            .comment-info-input input{max-width:100%;margin-top:5px}
            #comments .comment-author .avatar{
                width: 2.5rem;
                height: 2.5rem;
            }
        }
        @media screen and (max-width:760px){
            .OwO .OwO-body .OwO-items-image .OwO-item{
                max-width:-moz-calc(25% - 10px);
                max-width:-webkit-calc(25% - 10px);
                max-width:calc(25% - 10px)
            }
        }
        .wmd-button-row{height:unset}</style>';
    }
    public static function agreeNum($cid) {
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();

        //  判断点赞数量字段是否存在
        if (!array_key_exists('agree', $db->fetchRow($db->select()->from('table.contents')))) {
            //  在文章表中创建一个字段用来存储点赞数量
            $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `agree` INT(10) NOT NULL DEFAULT 0;');
        }

        //  查询出点赞数量
        $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));
        //  获取记录点赞的 Cookie
        $AgreeRecording = Typecho_Cookie::get('typechoAgreeRecording');
        //  判断记录点赞的 Cookie 是否存在
        if (empty($AgreeRecording)) {
            //  如果不存在就写入 Cookie
            Typecho_Cookie::set('typechoAgreeRecording', json_encode(array(0)));
        }

        //  返回
        return array(
            //  点赞数量
            'agree' => $agree['agree'],
            //  文章是否点赞过
            'recording' => in_array($cid, json_decode(Typecho_Cookie::get('typechoAgreeRecording')))?true:false
        );
    }
    public static function agree($cid) {
        $db = Typecho_Db::get();
        //  根据文章的 `cid` 查询出点赞数量
        $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));

        //  获取点赞记录的 Cookie
        $agreeRecording = Typecho_Cookie::get('typechoAgreeRecording');
        //  判断 Cookie 是否存在
        if (empty($agreeRecording)) {
            //  如果 cookie 不存在就创建 cookie
            Typecho_Cookie::set('typechoAgreeRecording', json_encode(array($cid)));
        }else {
            //  把 Cookie 的 JSON 字符串转换为 PHP 对象
            $agreeRecording = json_decode($agreeRecording);
            //  判断文章是否点赞过
            if (in_array($cid, $agreeRecording)) {
                //  如果当前文章的 cid 在 cookie 中就返回文章的赞数，不再往下执行
                return $agree['agree'];
            }
            //  添加点赞文章的 cid
            array_push($agreeRecording, $cid);
            //  保存 Cookie
            Typecho_Cookie::set('typechoAgreeRecording', json_encode($agreeRecording));
        }

        //  更新点赞字段，让点赞字段 +1
        $db->query($db->update('table.contents')->rows(array('agree' => (int)$agree['agree'] + 1))->where('cid = ?', $cid));
        //  查询出点赞数量
        $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));
        //  返回点赞数量
        return $agree['agree'];
    }

    public static function compressHtml($html_source) {
        $chunks = preg_split('/(<!--<nocompress>-->.*?<!--<\/nocompress>-->|<nocompress>.*?<\/nocompress>|<pre.*?\/pre>|<textarea.*?\/textarea>|<script.*?\/script>)/msi', $html_source, -1, PREG_SPLIT_DELIM_CAPTURE);
        $compress = '';
        foreach ($chunks as $c) {
            if (strtolower(substr($c, 0, 19)) == '<!--<nocompress>-->') {
                $c = substr($c, 19, strlen($c) - 19 - 20);
                $compress .= $c;
                continue;
            } else if (strtolower(substr($c, 0, 12)) == '<nocompress>') {
                $c = substr($c, 12, strlen($c) - 12 - 13);
                $compress .= $c;
                continue;
            } else if (strtolower(substr($c, 0, 4)) == '<pre' || strtolower(substr($c, 0, 9)) == '<textarea') {
                $compress .= $c;
                continue;
            } else if (strtolower(substr($c, 0, 7)) == '<script' && strpos($c, '//') != false && (strpos($c, PHP_EOL) !== false || strpos($c, PHP_EOL) !== false)) {
                $tmps = preg_split('/(\r|\n)/ms', $c, -1, PREG_SPLIT_NO_EMPTY);
                $c = '';
                foreach ($tmps as $tmp) {
                    if (strpos($tmp, '//') !== false) {
                        if (substr(trim($tmp), 0, 2) == '//') {
                            continue;
                        }
                        $chars = preg_split('//', $tmp, -1, PREG_SPLIT_NO_EMPTY);
                        $is_quot = $is_apos = false;
                        foreach ($chars as $key => $char) {
                            if ($char == '"' && $chars[$key - 1] != '\\' && !$is_apos) {
                                $is_quot = !$is_quot;
                            } else if ($char == '\'' && $chars[$key - 1] != '\\' && !$is_quot) {
                                $is_apos = !$is_apos;
                            } else if ($char == '/' && $chars[$key + 1] == '/' && !$is_quot && !$is_apos) {
                                $tmp = substr($tmp, 0, $key);
                                break;
                            }
                        }
                    }
                    $c .= $tmp;
                }
            }
            $c = preg_replace('/[\\n\\r\\t]+/', ' ', $c);
            $c = preg_replace('/\\s{2,}/', ' ', $c);
            $c = preg_replace('/>\\s</', '> <', $c);
            $c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c);
            $c = preg_replace('/<!--[^!]*-->/', '', $c);
            $compress .= $c;
        }
        return $compress;
    }

    /**
     * parse url query
     * @param $url
     * @return mixed
     */
    public static function parseUrlQuery($url){
        $query = parse_url($url,PHP_URL_QUERY);
        parse_str($query,$arr);
        return $arr;
    }

    /**
     * get now url
     * @return mixed|string
     */
    public static function GetCurUrl()
    {
        if(!empty($_SERVER["REQUEST_URI"]))
        {
            $scriptName = $_SERVER["REQUEST_URI"];
            $nowurl = $scriptName;
        }
        else
        {
            $scriptName = $_SERVER["PHP_SELF"];
            if(empty($_SERVER["QUERY_STRING"]))
            {
                $nowurl = $scriptName;
            }
            else
            {
                $nowurl = $scriptName."?".$_SERVER["QUERY_STRING"];
            }
        }
        return $nowurl;
    }

    /**
     * 解析 userTag 字段
     * @param $userTag
     * @param int $num
     * @return false|string[]
     */
    public static function parseUserTag($userTag,$num = 5){
        $tags = explode(',',$userTag);
        return array_slice($tags,0,$num);
    }
    /**
     * 输出归档页时间轴
     *
     * @param $post
     * @return void
     */
    public static function pageArchives($post)
    {
        static $lastY = null,
        $lastM = null;
        $t = $post->created;
        $href = $post->permalink;
        $title = $post->title;
        $y = date('Y', $t) . ' 年';
        $m = date('m', $t) . ' 月';
        $d = date('d', $t) . ' 日';
        $t_href = Helper::options()->siteUrl . date('Y/m', $t);
        $html = '';
        if ($lastY == date('Y', $t) || $lastY == null) {
            if ($lastM != date('m', $t)) {
                $lastM = date('m', $t);
                $html .= "<div class=\"timeline-ym timeline-item\"><a href=\"$t_href\" target=\"_blank\">$y $m</a></div>";
            }
        } else {
            $lastY = date('Y', $t);
        }
        $html .= '<div class="timeline-box"><div class="timeline-post timeline-item">' . '<a href="' . $href . '" target="_blank">' . $title . '</a><span class="timeline-post-time">' . $d . '</span></div></div>';
        echo $html;
    }

    /**
     * 获取一条评论
     * @param $cid
     * @return array|mixed
     * @throws Typecho_Db_Exception
     */
    public static function getOneCommentIfMore($cid){
        $options = Helper::options();
        $db = Typecho_Db::get();
        $limit = 5;  //调用数量
        $length = 30;  //截取长度
        $ispage = true;  //true 输出slug页面评论，false输出其它所有评论
        $isGuestbook = $ispage ? " = " : " <> ";
        $comments = $db->fetchAll($db->select()->from('table.comments')
            ->where('table.comments.status = ?', 'approved')
            ->where('table.comments.type = ?', 'comment')
            ->where('table.comments.cid '.$isGuestbook.' ?', $cid)
            ->order('table.comments.created', Typecho_Db::SORT_DESC)
            ->limit($limit)  );
        if (count($comments) >= 5){ // 超过5条显示1条
            $comment = $comments[0];
            return $comment;
        }
        return array();
    }

    /**
     * @param $str
     * @param int $length
     * @param string $trim
     * @return string
     */
    public static function substr($str,$length = 100, $trim = '...'){
        return Typecho_Common::subStr(strip_tags($str), 0, $length, $trim);
    }

    /**
     *
     */
    public static function creditsConvert($credits){
        if ($credits <= 0) return array(0,0,0);
        $gold = intval($credits/10000);
        $res = $credits%10000;
        $sliver = intval($res/100);
        $copper = intval($res%100);
        return array($gold,$sliver,$copper);
    }
}

