<?php
define("THEME_URL", str_replace('//usr', '/usr', str_replace(Helper::options()->siteUrl, Helper::options()->rootUrl . '/', Helper::options()->themeUrl)));
$str1 = explode('/themes/', (THEME_URL . '/'));
$str2 = explode('/', $str1[1]);
define("THEME_NAME", $str2[0]);

/* 获取模板版本号 */
function OnecircleVersion()
{
    return "3.1";
}

/* 获取懒加载图片 */
function GetLazyLoad()
{
    if (Helper::options()->JLazyLoad) {
        return Helper::options()->JLazyLoad;
    } else {
        return "https://cdn.jsdelivr.net/npm/typecho_joe_theme@3.1.3/assets/img/lazyload.jpg";
    }
}


/* 生成目录树 */
function CreateCatalog($obj)
{
    global $catalog;
    global $catalog_count;
    $catalog = array();
    $catalog_count = 0;
    $obj = preg_replace_callback('/<h([1-6])(.*?)>(.*?)<\/h\1>/i', function ($obj) {
        global $catalog;
        global $catalog_count;
        $catalog_count++;
        $catalog[] = array('text' => trim(strip_tags($obj[3])), 'depth' => $obj[1], 'count' => $catalog_count);
        return '<h' . $obj[1] . $obj[2] . ' id="cl-' . $catalog_count . '"><span>' . $obj[3] . '</span></h' . $obj[1] . '>';
    }, $obj);
    return $obj;
}
function GetCatalog()
{
    global $catalog;
    $index = '';
    if ($catalog) {
        $index = '<ul>';
        $prev_depth = '';
        $to_depth = 0;
        foreach ($catalog as $catalog_item) {
            $catalog_depth = $catalog_item['depth'];
            if ($prev_depth) {
                if ($catalog_depth == $prev_depth) {
                    $index .= '</li>';
                } elseif ($catalog_depth > $prev_depth) {
                    $to_depth++;
                    $index .= '<ul>';
                } else {
                    $to_depth2 = ($to_depth > ($prev_depth - $catalog_depth)) ? ($prev_depth - $catalog_depth) : $to_depth;
                    if ($to_depth2) {
                        for ($i = 0; $i < $to_depth2; $i++) {
                            $index .= '</li></ul>';
                            $to_depth--;
                        }
                    }
                    $index .= '</li>';
                }
            }
            $index .= '<li><a href="javascript: void(0)" data-href="#cl-' . $catalog_item['count'] . '">' . $catalog_item['text'] . '</a>';
            $prev_depth = $catalog_item['depth'];
        }
        for ($i = 0; $i <= $to_depth; $i++) {

            $index .= '</li></ul>';
        }
        $index = '<div class="j-floor"><div class="contain" id="jFloor"><div class="title">文章目录</div>' . $index . '<svg class="toc-marker" xmlns="http://www.w3.org/2000/svg"><path stroke="var(--theme)" stroke-width="3" fill="transparent" stroke-dasharray="0, 0, 0, 1000" stroke-linecap="round" stroke-linejoin="round" transform="translate(-0.5, -0.5)" /></svg></div></div>';
    }
    echo $index;
}

/* 格式化标签 */
function ParseCode($text)
{
    $text = preg_replace_callback('/<img src=\"(.*?)\" (.*?)>/i', function ($text) {
        return '<img class="lazyload" src="' . GetLazyLoad()  . '" data-src="' . $text[1] . '">';
    }, $text);

    $text = preg_replace_callback('/\[tag type="(.*?)"\](.*?)\[\/tag\]/ism', function ($text) {
        return '<span class="j-tag ' . $text[1] . '">' . $text[2] . '</span>';
    }, $text);

    $text = preg_replace_callback('/\[btn href="(.*?)" type="(.*?)"\](.*?)\[\/btn\]/ism', function ($text) {
        return '<a href="' . $text[1] . '" class="j-btn ' . $text[2] . '">' . $text[3] . '</a>';
    }, $text);

    $text = preg_replace_callback('/\[alt type="(.*?)"\](.*?)\[\/alt\]/ism', function ($text) {
        return '<div class="j-alt ' . $text[1] . '">' . $text[2] . '</div>';
    }, $text);

    $text = preg_replace_callback('/\[line\](.*?)\[\/line\]/ism', function ($text) {
        return '<div class="j-line"><span>' . $text[1] . '</span></div>';
    }, $text);

    /* tab */
    $text = preg_replace_callback('/\[tabs\](.*?)\[\/tabs\]/ism', function ($text) {
        return preg_replace('~<br.*?>~', '', $text[0]);
    }, $text);

    $text = preg_replace_callback('/\[tabs\](.*?)\[\/tabs\]/ism', function ($text) {
        $tabname = '';
        preg_match_all('/label="(.*?)"\]/i', $text[1], $tabnamearr);
        for ($i = 0; $i < count($tabnamearr[1]); $i++) {
            if ($i === 0) {
                $tabname .= '<span class="active" data-panel="' . $i . '">' . $tabnamearr[1][$i] . '</span>';
            } else {
                $tabname .= '<span data-panel="' . $i . '">' . $tabnamearr[1][$i] . '</span>';
            }
        }
        $tabcon = '';
        preg_match_all('/"\](.*?)\[\//i', $text[1], $tabconarr);
        for ($i = 0; $i < count($tabconarr[1]); $i++) {
            if ($i === 0) {
                $tabcon .= '<div class="active" data-panel="' . $i . '">' . $tabconarr[1][$i] . '</div>';
            } else {
                $tabcon .= '<div data-panel="' . $i . '">' . $tabconarr[1][$i] . '</div>';
            }
        }
        return '<div class="j-tabs">
                    <div class="nav">' . $tabname . '</div>
                    <div class="content">' . $tabcon . '</div>
                </div>';
    }, $text);

    $text = preg_replace_callback('/\[card-default width="(.*?)" label="(.*?)"\](.*?)\[\/card-default\]/ism', function ($text) {
        return '<div class="j-card-default" style="width: ' . $text[1] . '">
                <div class="head">' . $text[2] . '</div>
                <div class="content">' . $text[3] . '</div>
            </div>';
    }, $text);

    $text = preg_replace_callback('/\[collapse\](.*?)\[\/collapse\]/ism', function ($text) {
        return '<div class="j-collapse">' . $text[1] . '</div>';
    }, $text);

    $text = preg_replace_callback('/\[collapse-item label="(.*?)"\](.*?)\[\/collapse-item\]/ism', function ($text) {
        return '<div class="collapse-head">
                    <span>' . $text[1] . '</span>
                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M21.6 772.8c28.8 28.8 74.4 28.8 103.2 0L512 385.6 899.2 772.8c28.8 28.8 74.4 28.8 103.2 0 28.8-28.8 28.8-74.4 0-103.2l-387.2-387.2-77.6-77.6c-14.4-14.4-37.6-14.4-51.2 0l-77.6 77.6-387.2 387.2c-28.8 28.8-28.8 75.2 0 103.2z"></path></svg>
                </div>
                <div class="collapse-body">' . $text[2] . '</div>';
    }, $text);


    $text = preg_replace_callback('/\[timeline\](.*?)\[\/timeline\]/ism', function ($text) {
        return preg_replace('~<br.*?>~', '', $text[0]);
    }, $text);

    $text = preg_replace_callback('/\[timeline\](.*?)\[\/timeline\]/ism', function ($text) {
        return '<div class="j-timeline">' . $text[1] . '</div>';
    }, $text);

    $text = preg_replace_callback('/\[timeline-item\](.*?)\[\/timeline-item\]/ism', function ($text) {
        return '<div class="item">' . $text[1] . '</div>';
    }, $text);

    $text = preg_replace_callback('/\[copy\](.*?)\[\/copy\]/ism', function ($text) {
        return '<span class="j-copy" data-copy="' . $text[1] . '">' . $text[1] . '</span>';
    }, $text);

    $text = preg_replace_callback('/\[typing\](.*?)\[\/typing\]/ism', function ($text) {
        return '<span class="j-typing">' . $text[1] . '</span>';
    }, $text);

    return $text;
}







//function themeInit($archive)
//{
//    /* 强制关闭反垃圾包含 */
//    Helper::options()->commentsAntiSpam = false;
//    /* 强制关闭检查来源URL */
//    Helper::options()->commentsCheckReferer = false;
//    if ($archive->is('single')) {
//        $archive->content = ParseReply($archive->content);
//        $archive->content = CreateCatalog($archive->content);
//        $archive->content = ParseCode($archive->content);
//    }
//}



/* 请求 */
function GetRequest($curl, $method = 'post', $data = null, $https = true)
{
    $ch = curl_init(); //初始化
    curl_setopt($ch, CURLOPT_URL, $curl); //设置访问的URL
    curl_setopt($ch, CURLOPT_HEADER, false); //设置不需要头信息
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //只获取页面内容，但不输出
    if ($https) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不做服务器认证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不做客户端认证
    }
    if ($method == 'post') {
        curl_setopt($ch, CURLOPT_POST, true); //设置请求是POST方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //设置POST请求的数据
    }
    $str = curl_exec($ch); //执行访问，返回结果
    curl_close($ch); //关闭curl，释放资源
    return $str;
}


/* 解析头像 */
function ParseAvatar($mail, $re = 0, $id = 0)
{
    $a = Typecho_Widget::widget('Widget_Options')->JGravatars;
    $b = 'https://' . $a . '/';
    $c = strtolower($mail);
    $d = md5($c);
    $f = str_replace('@qq.com', '', $c);
    if (strstr($c, "qq.com") && is_numeric($f) && strlen($f) < 11 && strlen($f) > 4) {
        $g = '//thirdqq.qlogo.cn/g?b=qq&nk=' . $f . '&s=100';
        if ($id > 0) {
            $g = Helper::options()->rootUrl . '?id=' . $id . '" data-type="qqtx';
        }
    } else {
        $g = $b . $d . '?d=mm';
    }
    if ($re == 1) {
        return $g;
    } else {
        echo $g;
    }
}

/* 获取父级评论 */
function GetParentReply($parent)
{
    if ($parent == 0) {
        return '';
    }
    $db = Typecho_Db::get();
    $commentInfo = $db->fetchRow($db->select('author,status,mail')->from('table.comments')->where('coid = ?', $parent));
    $link = '<div class="parent">@' . $commentInfo['author'] .  '</div>';
    return $link;
}


function ParsePaopaoBiaoqingCallback($match)
{
    return '<img class="owo" src="' . THEME_URL . '/assets/owo/paopao/' . str_replace('%', '', urlencode($match[1])) . '_2x.png">';
}

function ParseAruBiaoqingCallback($match)
{
    return '<img class="owo" src="' . THEME_URL . '/assets/owo/aru/' . str_replace('%', '', urlencode($match[1])) . '_2x.png">';
}

/* 格式化 */
function ParseReply($content)
{
    $content = preg_replace_callback(
        '/\:\:\(\s*(呵呵|哈哈|吐舌|太开心|笑眼|花心|小乖|乖|捂嘴笑|滑稽|你懂的|不高兴|怒|汗|黑线|泪|真棒|喷|惊哭|阴险|鄙视|酷|啊|狂汗|what|疑问|酸爽|呀咩爹|委屈|惊讶|睡觉|笑尿|挖鼻|吐|犀利|小红脸|懒得理|勉强|爱心|心碎|玫瑰|礼物|彩虹|太阳|星星月亮|钱币|茶杯|蛋糕|大拇指|胜利|haha|OK|沙发|手纸|香蕉|便便|药丸|红领巾|蜡烛|音乐|灯泡|开心|钱|咦|呼|冷|生气|弱|吐血)\s*\)/is',
        'ParsePaopaoBiaoqingCallback',
        $content
    );
    $content = preg_replace_callback(
        '/\:\@\(\s*(高兴|小怒|脸红|内伤|装大款|赞一个|害羞|汗|吐血倒地|深思|不高兴|无语|亲亲|口水|尴尬|中指|想一想|哭泣|便便|献花|皱眉|傻笑|狂汗|吐|喷水|看不见|鼓掌|阴暗|长草|献黄瓜|邪恶|期待|得意|吐舌|喷血|无所谓|观察|暗地观察|肿包|中枪|大囧|呲牙|抠鼻|不说话|咽气|欢呼|锁眉|蜡烛|坐等|击掌|惊喜|喜极而泣|抽烟|不出所料|愤怒|无奈|黑线|投降|看热闹|扇耳光|小眼睛|中刀)\s*\)/is',
        'ParseAruBiaoqingCallback',
        $content
    );
    return $content;
}




/* 判断是否是移动端 */
function isMobile()
{
    if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
        return true;
    if (isset($_SERVER['HTTP_VIA'])) {
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            return true;
    }
    if (isset($_SERVER['HTTP_ACCEPT'])) {
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}

/* 页面加载计时 */
timerStart();
function timerStart()
{
    global $timestart;
    $mtime     = explode(' ', microtime());
    $timestart = $mtime[1] + $mtime[0];
    return true;
}
function timerStop($display = 0, $precision = 3)
{
    global $timestart, $timeend;
    $mtime     = explode(' ', microtime());
    $timeend   = $mtime[1] + $mtime[0];
    $timetotal = number_format($timeend - $timestart, $precision);
    $r         = $timetotal < 1 ? $timetotal * 1000 . "ms" : $timetotal . "s";
    if ($display) {
        echo $r;
    }
    return $r;
}


/* 热门文章 */
class Widget_Post_hot extends Widget_Abstract_Contents
{
    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);
        $this->parameter->setDefault(array('pageSize' => $this->options->commentsListSize, 'parentId' => 0, 'ignoreAuthor' => false));
    }
    public function execute()
    {
        $db     = Typecho_Db::get();
        $prefix = $db->getPrefix();
        if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
            $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        };
        $select  = $this->select()->from('table.contents')
            ->where("table.contents.password IS NULL OR table.contents.password = ''")
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.created <= ?', time())
            ->where('table.contents.type = ?', 'post')
            ->limit($this->parameter->pageSize)
            ->order('table.contents.views', Typecho_Db::SORT_DESC);
        $this->db->fetchAll($select, array($this, 'push'));
    }
}

/* 随机图片 */
function GetRandomThumbnail($widget)
{
    $random = THEME_URL . '/assets/blog/img/random/' . rand(1, 25) . '.webp';
    if (Helper::options()->Jmos) {
        $moszu = explode("\r\n", Helper::options()->Jmos);
        $random = $moszu[array_rand($moszu, 1)] . "?jrandom=" . mt_rand(0, 1000000);
    }
    $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
    $patternlazy = '/\<img.*?data-src\=\"(.*?)\"[^>]*>/i';
    $patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
    $patternMDfoot = '/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
    $t = preg_match_all($pattern, $widget->content, $thumbUrl);
    $img = $random;
    if ($widget->fields->thumb) {
        $img = $widget->fields->thumb;
    } elseif ($t and $thumbUrl[1][0]) {
        $img = $thumbUrl[1][0];
    } elseif (preg_match_all($patternMD, $widget->content, $thumbUrl)) {
        $img = $thumbUrl[1][0];
    } elseif (preg_match_all($patternMDfoot, $widget->content, $thumbUrl)) {
        $img = $thumbUrl[1][0];
    } else{
        $t = preg_match_all($patternlazy, $widget->content, $thumbUrl);
        if ($t and $thumbUrl[1][0]) {
            $img = $thumbUrl[1][0];
        }
    }
    echo $img;
}


/* 获取浏览量 */
function GetPostViews($archive, $r = 0)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        if ($r == 0) {
            echo 1;
        }
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
        if (empty($views)) {
            $views = array();
        } else {
            $views = explode(',', $views);
        }
        if (!in_array($cid, $views)) {
            $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
            array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views);
        }
    }
    if ($r == 0) {
        echo number_format($row['views']);
    }
}

/* 随机一言 */
function GetRandomMotto()
{
    if (Helper::options()->JMotto) {
        $JMottoRandom = explode("\r\n", Helper::options()->JMotto);
        $random = $JMottoRandom[array_rand($JMottoRandom, 1)];
        echo $random;
    }
}




/* 点赞数 */
function agreeNum($cid)
{
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('agree', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `agree` INT(10) NOT NULL DEFAULT 0;');
    }
    $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));
    $AgreeRecording = Typecho_Cookie::get('typechoAgreeRecording');
    if (empty($AgreeRecording)) {
        Typecho_Cookie::set('typechoAgreeRecording', json_encode(array(0)));
    }
    return array(
        'agree' => $agree['agree'],
        'recording' => in_array($cid, json_decode(Typecho_Cookie::get('typechoAgreeRecording'))) ? true : false
    );
}
/* 点赞 */
function agree($cid)
{
    $db = Typecho_Db::get();
    $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));
    $agreeRecording = Typecho_Cookie::get('typechoAgreeRecording');
    if (empty($agreeRecording)) {
        Typecho_Cookie::set('typechoAgreeRecording', json_encode(array($cid)));
    } else {
        $agreeRecording = json_decode($agreeRecording);
        if (in_array($cid, $agreeRecording)) {
            return $agree['agree'];
        }
        array_push($agreeRecording, $cid);
        Typecho_Cookie::set('typechoAgreeRecording', json_encode($agreeRecording));
    }
    $db->query($db->update('table.contents')->rows(array('agree' => (int)$agree['agree'] + 1))->where('cid = ?', $cid));
    $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));
    return $agree['agree'];
}

/* 获取浏览器信息 */
function GetBrowser($agent)
{
    if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs)) {
        $outputer = 'Internet Explore';
    } else if (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Firefox/', $regs[0]);
        $FireFox_vern = explode('.', $str1[1]);
        $outputer = 'FireFox';
    } else if (preg_match('/Maxthon([\d]*)\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Maxthon/', $agent);
        $Maxthon_vern = explode('.', $str1[1]);
        $outputer = 'MicroSoft Edge';
    } else if (preg_match('#360([a-zA-Z0-9.]+)#i', $agent, $regs)) {
        $outputer = '360 Fast Browser';
    } else if (preg_match('/Edge([\d]*)\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Edge/', $regs[0]);
        $Edge_vern = explode('.', $str1[1]);
        $outputer = 'MicroSoft Edge';
    } else if (preg_match('/UC/i', $agent)) {
        $str1 = explode('rowser/',  $agent);
        $UCBrowser_vern = explode('.', $str1[1]);
        $outputer = 'UC Browser';
    } else if (preg_match('/QQ/i', $agent, $regs) || preg_match('/QQ Browser\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('rowser/',  $agent);
        $QQ_vern = explode('.', $str1[1]);
        $outputer = 'QQ Browser';
    } else if (preg_match('/UBrowser/i', $agent, $regs)) {
        $str1 = explode('rowser/',  $agent);
        $UCBrowser_vern = explode('.', $str1[1]);
        $outputer = 'UC Browser';
    } else if (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs)) {
        $outputer = 'Opera';
    } else if (preg_match('/Chrome([\d]*)\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Chrome/', $agent);
        $chrome_vern = explode('.', $str1[1]);
        $outputer = 'Google Chrome';
    } else if (preg_match('/safari\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Version/',  $agent);
        $safari_vern = explode('.', $str1[1]);
        $outputer = 'Safari';
    } else {
        $outputer = 'Google Chrome';
    }
    echo $outputer;
}

// 获取操作系统信息
function GetOs($agent)
{
    $os = false;
    if (preg_match('/win/i', $agent)) {
        if (preg_match('/nt 6.0/i', $agent)) {
            $os = 'Windows Vista';
        } else if (preg_match('/nt 6.1/i', $agent)) {
            $os = 'Windows 7';
        } else if (preg_match('/nt 6.2/i', $agent)) {
            $os = 'Windows 8';
        } else if (preg_match('/nt 6.3/i', $agent)) {
            $os = 'Windows 8.1';
        } else if (preg_match('/nt 5.1/i', $agent)) {
            $os = 'Windows XP';
        } else if (preg_match('/nt 10.0/i', $agent)) {
            $os = 'Windows 10';
        } else {
            $os = 'Windows X64';
        }
    } else if (preg_match('/android/i', $agent)) {
        if (preg_match('/android 9/i', $agent)) {
            $os = 'Android Pie';
        } else if (preg_match('/android 8/i', $agent)) {
            $os = 'Android Oreo';
        } else {
            $os = 'Android';
        }
    } else if (preg_match('/ubuntu/i', $agent)) {
        $os = 'Ubuntu';
    } else if (preg_match('/linux/i', $agent)) {
        $os = 'Linux';
    } else if (preg_match('/iPhone/i', $agent)) {
        $os = 'iPhone';
    } else if (preg_match('/mac/i', $agent)) {
        $os = 'MacOS';
    } else if (preg_match('/fusion/i', $agent)) {
        $os = 'Android';
    } else {
        $os = 'Linux';
    }
    echo $os;
}


/* 自定义字段 */
//function themeFields($layout)
//{
//    $thumb = new Typecho_Widget_Helper_Form_Element_Text(
//        'thumb',
//        NULL,
//        NULL,
//        '自定义文章缩略图',
//        '填写时：将会显示填写的文章缩略图 <br>
//         不填写时：如果文章内有图片则取文章图片，否则取模板自带的随机缩略图'
//    );
//    $layout->addItem($thumb);
//
//    $desc = new Typecho_Widget_Helper_Form_Element_Text(
//        'desc',
//        NULL,
//        NULL,
//        'SEO描述',
//        '用于填写文章或独立页面的SEO描述，如果不填写则显示默认描述'
//    );
//    $layout->addItem($desc);
//
//    $keywords = new Typecho_Widget_Helper_Form_Element_Text(
//        'keywords',
//        NULL,
//        NULL,
//        'SEO关键词',
//        '用于填写文章或独立页面的SEO关键词，如果不填写则显示默认关键词'
//    );
//    $layout->addItem($keywords);
//
//    $keywords = new Typecho_Widget_Helper_Form_Element_Text(
//        'keywords',
//        NULL,
//        NULL,
//        'SEO关键词',
//        '用于填写文章或独立页面的SEO关键词，如果不填写则显示默认关键词'
//    );
//    $layout->addItem($keywords);
//
//    $video = new Typecho_Widget_Helper_Form_Element_Textarea(
//        'video',
//        NULL,
//        NULL,
//        'M3U8或MP4地址（仅限文章和自定义页面使用）',
//        '填写则会显示视频模板，不填写则显示默认文章模板 <br>
//         格式：视频名称&视频地址。如果有多个，换行写即可 <br>
//         例如：<br>
//            第01集$https://iqiyi.cdn9-okzy.com/20201104/17638_8f3022ce/index.m3u8 <br>
//            第02集$https://iqiyi.cdn9-okzy.com/20201104/17639_5dcb8a3b/index.m3u8
//        '
//    );
//    $layout->addItem($video);
//
//    $sharePic = new Typecho_Widget_Helper_Form_Element_Textarea(
//        'sharePic',
//        NULL,
//        NULL,
//        'QQ里分享链接时的缩略图',
//        '填写则会优先使用此缩略图，不填写则随机取网站中图片 <br>
//         格式：图片URL 或 BASE64地址'
//    );
//    $layout->addItem($sharePic);
//}

function GetQQSharePic($widget)
{
    if ($widget->fields->sharePic) {
        return $widget->fields->sharePic;
    } else {
        return Helper::options()->JQQSharePic;
    }
}

/* 评论回复 */
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('myyodux', 'one');
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('myyodux', 'one');
class myyodux
{
    public static function one($con, $obj, $text)
    {
        $text = empty($text) ? $con : $text;
        if (!$obj->is('single')) {
            $text = preg_replace("/\[hide\](.*?)\[\/hide\]/sm", '', $text);
        }
        return $text;
    }
}


function check_in($words_str, $str)
{
    $words = explode("||", $words_str);
    if (empty($words)) {
        return false;
    }
    foreach ($words as $word) {
        if (false !== strpos($str, trim($word))) {
            return true;
        }
    }
    return false;
}

Typecho_Plugin::factory('Widget_Feedback')->comment = array('plgl', 'one');
class plgl
{
    public static function one($comment, $post)
    {
        $options = Helper::options();
        $action = "";
        $msg = "";

        /* 脚本回复 */
        if ($options->JProhibitScript === "on") {
            if (preg_match("/<a(.*?)href=\"javascript:(.*?)>(.*?)<\/a>/u", $comment['text']) == 1) {
                $msg = "检测到脚本回复，已禁止！";
                $action = 'abandon';
            }
        }

        /* 空格回复 */
        if ($options->JProhibitEmsp === "on") {
            if (ctype_space($comment['text'])) {
                $msg = "请不要使用空格评论！";
                $action = 'abandon';
            }
        }

        /* 非中文评论 */
        if ($options->JProhibitChinese === "on") {
            if (preg_match("/[\x{4e00}-\x{9fa5}]/u", $comment['text']) == 0) {
                $msg = "评论至少包含一个中文！";
                $action = 'abandon';
            }
        }


        /* 敏感词 */
        if (!empty($options->JProhibitWords)) {
            if (check_in($options->JProhibitWords, $comment['text'])) {
                $msg = "评论内容中包含敏感词汇";
                $action = "abandon";
            }
        }

        if ($action == "abandon") {
            Typecho_Cookie::set('__typecho_remember_text', $comment['text']);
            throw new Typecho_Widget_Exception(_t($msg), 403);
        }

        Typecho_Cookie::delete('__typecho_remember_text');
        return $comment;
    }
}
