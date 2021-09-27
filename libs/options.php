<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
//require_once('admin/core.php');
include_once 'admin/core.php';
/**
 * @throws Typecho_Plugin_Exception
 */
function themeConfig($form)
{   $options = Helper::options();
    if (version_compare( phpversion(), '7.0.0', '<' ) ) {
        throw new Typecho_Plugin_Exception('请升级到 php 7 以上');
    }
    ?>
    <div class="j-setting-contain">
        <link href="<?php $options->themeUrl('/assets/admin/css/one.setting.min.css') ?>" rel="stylesheet" type="text/css" />
        <div>
            <div class="j-aside">
                <div class="logo">ONE <?php echo OnecircleVersion() ?><br><small style="font-size: 10px">设置模板来自Joe的typecho主题</small><br>
                    <a href="/admin/options-plugin.php?config=OneCircle" target="_self">点我去插件设置</a></div>
                <ul class="j-setting-tab">
                    <li data-current="j-setting-notice">最新公告</li>
                    <li data-current="j-setting-global">公共设置</li>
                    <li data-current="j-setting-image">图片设置</li>
                    <li data-current="j-setting-post">文章设置</li>
                    <li data-current="j-setting-jifen">积分设置</li>
                    <li data-current="j-setting-color">色彩背景</li>
                    <li data-current="j-setting-index">博客设置</li>
                    <li data-current="j-setting-ads">广告设置</li>
                    <li data-current="j-setting-aside">侧栏设置</li>
                    <li data-current="j-setting-other">其他设置</li>
                </ul>
                <?php require_once("admin/backup.php"); ?>
            </div>
        </div>
        <span id="j-version" style="display: none;"><?php echo OnecircleVersion() ?></span>
        <div class="j-setting-notice"><iframe src="https://www.yuque.com/docs/share/05f40cac-980f-4e53-8b92-ed9728b8dc50?# 《OneCircle 主题说明》" frameborder="no" scrolling="yes" height="100%" width="100%"></iframe></div>
        <script src="<?php $options->themeUrl('/assets/admin/js/one.setting.min.js')?>"></script>
    <?php
    $enableTravel = new Typecho_Widget_Helper_Form_Element_Radio('enableTravel',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        1, _t('是否启用十年之约'), _t('开启后会在动态显示十年之约的内容，了解十年之约：https://www.foreverblog.cn/'));
    $enableTravel->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($enableTravel);

    $enableMessage = new Typecho_Widget_Helper_Form_Element_Radio('enableMessage',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        1, _t('是否启用全局私聊'), _t('开启私聊可以用，关了就不能用'));
    $enableMessage->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($enableMessage);

    $announcement = new Typecho_Widget_Helper_Form_Element_Textarea('announcement', NULL, NULL, _t('公告'), _t('首页公告内容（默认左下角），不填不显示,可以填写 html'));
    $announcement->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($announcement);


    // 公共设置
    $recordNo = new Typecho_Widget_Helper_Form_Element_Text('recordNo', NULL, NULL, _t('网站备案号'), _t('根据要求，每个备案网站必须填写备案号'));
    $recordNo->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($recordNo);

    $sticky = new Typecho_Widget_Helper_Form_Element_Text('sticky', NULL, NULL, _t('圈子文章置顶'), _t('输入圈子文章的文章cid，按照排序输入, 请以空格分隔'));
    $sticky->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($sticky);

    $useInfiniteScroll = new Typecho_Widget_Helper_Form_Element_Radio('useInfiniteScroll',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('无限滚动'), _t('开启后将会隐藏分页器，显示无限滚动'));
    $useInfiniteScroll->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($useInfiniteScroll);
    // 图片设置
    $avatarSource = new Typecho_Widget_Helper_Form_Element_Text('avatarSource',
        null,"https://cravatar.cn/avatar/","头像源设置","例如：https://gravatar.helingqi.com/wavatar/ <br>
         其他：非必填，默认头像源为https://cravatar.cn/avatar/ <br>
         注意：填写时，务必保证最后有一个/字符，否则不起作用！"
    );
    $avatarSource->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($avatarSource);

    $JShare_QQ_Image = new Typecho_Widget_Helper_Form_Element_Text('JShare_QQ_Image', NULL, NULL, _t('qq分享图'), _t('qq分享图 图片'));
    $JShare_QQ_Image->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($JShare_QQ_Image);

    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('favicon'), _t('favicon 图片,浏览器显示的小logo'));
    $favicon->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($favicon);

    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, "https://dss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2592033302,3451533765&fm=26&gp=0.jpg", _t('<h2>普通设置</h2>站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $logoUrl->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($logoUrl);

    $defaultSlugUrl = new Typecho_Widget_Helper_Form_Element_Text('defaultSlugUrl', NULL, "https://img.icons8.com/dusk/2x/categorize.png", _t('默认的分类图片'), _t('在这里填入一个图片 URL， 地址为分类图片的默认图标'));
    $defaultSlugUrl->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($defaultSlugUrl);

    $NavDynamic = new Typecho_Widget_Helper_Form_Element_Textarea('NavDynamic', NULL, '<svg t="1605599903214" class="nav-icon icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3902" width="1em" height="1em"><path d="M957.9 391.5c-1.1-7.5-5.5-14.2-12-18.5L527.4 98.9c-4.6-3.1-10.1-4.7-15.7-4.7-5.7 0-11.1 1.6-15.7 4.7L77.4 373.1c-6.2 4.1-10.4 10.3-11.6 17.4-1.2 7 0.5 14 4.8 19.7 5.2 6.9 13.7 11.1 22.6 11.1 5.6 0 11.1-1.6 15.7-4.7l40.2-26.3v435.4c0 57.8 45.8 104.7 102.2 104.7h520.8c56.3 0 102.2-47 102.2-104.7V390.2l40.4 26.5c5.7 3.5 11.1 5.2 16.4 5.2 7.9 0 15.2-3.8 21.5-11.4 4.4-5.4 6.3-12.1 5.3-19zM616.3 884.4H407V631.7c0-54 46.9-97.9 104.6-97.9 57.7 0 104.6 43.9 104.6 97.9v252.7z m202.4-58.8c0 28.6-20.9 51.9-46.6 51.9H665V631.7c0-79.4-68.8-143.9-153.3-143.9-84.5 0-153.3 64.6-153.3 143.9v245.9H251.3c-25.7 0-46.7-23.3-46.7-51.9V353.9l307.1-201.2 307.1 201.2v471.7z" fill="#6B400D" p-id="3903"></path><path d="M511.7 533.8c-57.7 0-104.6 43.9-104.6 97.9v252.7h209.3V631.7c-0.1-54-47-97.9-104.7-97.9z" fill="#FFD524" p-id="3904"></path><path d="M270.3 504.3c-17.5 0-31.7 14.7-31.7 32.8 0 18.1 14.2 32.8 31.7 32.8s31.7-14.7 31.7-32.8c-0.1-18.1-14.3-32.8-31.7-32.8zM270.3 592.9h-1.4c-13.1 0-23.8 10.7-23.8 23.8v212.5c0 13.1 10.7 23.8 23.8 23.8h1.4c13.1 0 23.8-10.7 23.8-23.8V616.7c0-13.1-10.7-23.8-23.8-23.8z" fill="#6B400D" p-id="3905"></path></svg>', _t('自定义导航动态图标'), _t('请前往阿里巴巴 iconfront，找到你最喜欢的图标跑，点击复制svg <br>每行粘贴一个，自定义内导航栏左侧的小图标，留空则展示默认的图标按钮<hr>'));
    $NavDynamic->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($NavDynamic);

    $NavDiscover = new Typecho_Widget_Helper_Form_Element_Textarea('NavDiscover', NULL, '<svg t="1605600499130" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="8799" width="200" height="200"><path d="M287 962h530.35714248c45 0 80.35714248-35.35714248 80.35714336-80.35714248V576.28571416H158.42857168v257.14285752c0 70.71428584 57.85714248 128.57142832 128.57142832 128.57142832z" fill="#BAE7FF" p-id="8800"></path><path d="M647 962H238.78571416C193.78571416 962 158.42857168 926.64285752 158.42857168 881.64285752v-739.28571504C158.42857168 97.35714248 193.78571416 62 238.78571416 62h575.35714336C862.35714248 62 897.71428584 97.35714248 897.71428584 142.35714248v572.14285752L647 962z" fill="#69C0FF" p-id="8801"></path><path d="M650.21428584 962v-186.42857168c0-32.14285752 25.71428584-61.07142832 61.07142832-61.07142832H897.71428584L650.21428584 962z" fill="#1890FF" p-id="8802"></path><path d="M319.14285752 640.57142832h417.85714248c19.28571416 0 32.14285752-12.85714248 32.14285752-32.14285664s-12.85714248-32.14285752-32.14285752-32.14285752H319.14285752c-19.28571416 0-32.14285752 12.85714248-32.14285752 32.14285752s12.85714248 32.14285752 32.14285752 32.14285664zM576.28571416 479.85714248h160.71428584c19.28571416 0 32.14285752-12.85714248 32.14285752-32.14285664s-12.85714248-32.14285752-32.14285752-32.14285752h-160.71428584c-19.28571416 0-32.14285752 12.85714248-32.14285664 32.14285752s12.85714248 32.14285752 32.14285664 32.14285664z" fill="#BAE7FF" p-id="8803"></path><path d="M319.14285752 479.85714248h128.57142832c19.28571416 0 32.14285752-12.85714248 32.14285664-32.14285664V287c0-19.28571416-12.85714248-32.14285752-32.14285664-32.14285752H319.14285752c-19.28571416 0-32.14285752 12.85714248-32.14285752 32.14285752v160.71428584c0 19.28571416 12.85714248 32.14285752 32.14285752 32.14285664z" fill="#BAE7FF" p-id="8804"></path><path d="M576.28571416 319.14285752h160.71428584c19.28571416 0 32.14285752-12.85714248 32.14285752-32.14285752s-12.85714248-32.14285752-32.14285752-32.14285752h-160.71428584c-19.28571416 0-32.14285752 12.85714248-32.14285664 32.14285752s12.85714248 32.14285752 32.14285664 32.14285752z" fill="#BAE7FF" p-id="8805"></path></svg>', _t('自定义导航发现图标'), _t('请前往阿里巴巴 iconfront，找到你最喜欢的图标跑，点击复制svg <br>每行粘贴一个，自定义内导航栏左侧的小图标，留空则展示默认的图标按钮<hr>'));
    $NavDiscover->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($NavDiscover);

    $NavBlog = new Typecho_Widget_Helper_Form_Element_Textarea('NavBlog', NULL, '<svg t="1606702800546" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2980" width="200" height="200"><path d="M512 1024C229.2224 1024 0 794.7776 0 512S229.2224 0 512 0s512 229.2224 512 512-229.2224 512-512 512z m-229.12-443.6224c18.176-15.6416 27.264-36.1472 27.264-61.44 0-20.352-6.016-36.864-17.9456-49.6128-11.9808-12.7232-27.9296-20.224-47.872-22.5792v-0.8192c15.9744-5.2224 28.4672-14.0032 37.5552-26.3936 9.0624-12.3648 13.5936-26.9312 13.5936-43.7248 0-20.0704-7.4752-36.352-22.4768-48.896-15.0016-12.544-35.2512-18.7648-60.8256-18.7648H128.0256V603.904h86.1952c27.648 0 50.5344-7.8336 68.6848-23.5264z m-120.2176-240.896H202.496c37.8112 0 56.704 14.3872 56.704 43.1104 0 16.64-5.4272 29.5168-16.2816 38.656-10.8544 9.1648-25.7792 13.7216-44.7488 13.7216H162.6624v-95.488z m0 126.6432H202.496c47.5648 0 71.3472 17.4848 71.3472 52.3776 0 16.7936-5.6064 29.9776-16.7936 39.6032-11.2384 9.6256-26.9824 14.4384-47.36 14.4384H162.688v-106.4192z m202.9568-158.592V603.904h33.792V307.5328h-33.792z m267.1872 266.368c19.0208-20.2752 28.5696-47.2576 28.5696-80.9216 0-34.4064-8.8576-61.2864-26.496-80.64-17.6896-19.4048-42.24-29.0816-73.728-29.0816-33.024 0-59.2128 9.984-78.592 29.9008-19.3792 19.968-29.0816 47.6416-29.0816 83.1232 0 32.5632 9.3184 58.752 27.9552 78.464 18.6112 19.712 43.5456 29.5936 74.752 29.5936 32.0256 0 57.5744-10.1632 76.6208-30.4384z m-144.6912-78.8992c0-25.984 6.3232-46.3616 18.9696-61.1328 12.6464-14.7968 29.824-22.1952 51.5584-22.1952 21.8624 0 38.6816 7.168 50.432 21.4528 11.776 14.3104 17.6384 34.6624 17.6384 61.056 0 26.112-5.888 46.2592-17.664 60.416-11.7248 14.1568-28.544 21.248-50.4064 21.248-21.4528 0-38.5792-7.1936-51.3536-21.632-12.8-14.464-19.1744-34.176-19.1744-59.2128z m407.5264 87.4496v-194.2528h-33.8176v29.2608h-0.8192c-13.7728-22.8096-34.8672-34.2272-63.3344-34.2272-29.952 0-53.5808 10.5984-70.8352 31.744-17.2544 21.1968-25.856 49.7152-25.856 85.6064 0 31.616 7.9872 56.832 24.0128 75.5968 16.0256 18.7648 37.1712 28.16 63.4112 28.16 32.3328 0 56.5248-13.4912 72.6272-40.448h0.8192v23.1168c0 21.6576-3.9936 39.0656-12.0064 52.224l-17.0752 18.0736-0.7424 0.512c-5.3504 3.3024-43.1872 24.4992-97.3824-0.4096-58.5728-26.9568-141.8752-29.184-162.4064 41.3952l24.1664 18.5856s0-33.2032 37.4272-46.4896c27.8016-9.856 58.0608 2.6112 81.9968 12.8768v0.128c6.912 3.5072 14.1824 6.3744 21.8624 8.6272l0.384 0.1024a168.448 168.448 0 0 0 46.2336 6.144c74.2144 0 111.3344-38.784 111.3344-116.3264z m-51.6608-26.8032c-11.904 13.4656-27.3408 20.224-46.3104 20.224-18.688 0-33.7152-7.0656-45.056-21.1712-11.3408-14.08-17.024-32.8704-17.024-56.3968 0-27.3664 5.888-48.64 17.7408-63.8208 11.8272-15.1808 28.16-22.784 49.0752-22.784 16.9216 0 31.0272 5.9648 42.3936 17.92a60.416 60.416 0 0 1 17.024 43.1104v31.1552c0 21.0176-5.9648 38.272-17.8432 51.7632z" fill="#62AFFE" p-id="2981"></path></svg>', _t('自定义导航博客图标'), _t('请前往阿里巴巴 iconfront，找到你最喜欢的图标跑，点击复制svg <br>每行粘贴一个，自定义内导航栏左侧的小图标，留空则展示默认的图标按钮<hr>'));
    $NavBlog->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($NavBlog);

    $NavResource = new Typecho_Widget_Helper_Form_Element_Textarea('NavResource', NULL, '<svg t="1631609453100" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3933" width="18" height="18"><path d="M512 1024A512 512 0 1 1 512 0a512 512 0 0 1 0 1024z m307.2-716.8H563.2v102.4h33.938286C568.539429 479.378286 539.867429 548.132571 512 613.522286c-27.794286-65.389714-56.539429-134.144-85.138286-203.922286H460.8V307.2H204.8v102.4h111.616C421.302857 666.550857 512 870.4 512 870.4s90.624-203.849143 195.584-460.8H819.2V307.2z" fill="#FFBF00" p-id="3934"></path></svg>', _t('自定义导航资源图标'), _t('请前往阿里巴巴 iconfront，找到你最喜欢的图标跑，点击复制svg <br>每行粘贴一个，自定义内导航栏左侧的小图标，留空则展示默认的图标按钮<hr>'));
    $NavResource->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($NavResource);

    $customNavIcon = new Typecho_Widget_Helper_Form_Element_Textarea('customNavIcon', NULL, NULL, _t('自定义导航小图标'), _t('请前往阿里巴巴 iconfront，找到你最喜欢的图标跑，点击复制svg <br>每行粘贴一个，自定义内导航栏左侧的小图标，留空则展示默认的图标按钮<hr>'));
    $customNavIcon->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($customNavIcon);


    /**
     * 色彩背景设置
     */
    $bgColor = new Typecho_Widget_Helper_Form_Element_Text('bgColor', NULL, "#eff3f6", _t('背景色'),_t('默认背景色 #eff3f6'));
    $bgColor->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($bgColor);

    $bgImg = new Typecho_Widget_Helper_Form_Element_Text('bgImg', NULL, "https://pic.downk.cc/item/5fd996003ffa7d37b3f9a64c.jpg", _t('背景图'),_t('设置主页背景图:<br>https://ae01.alicdn.com/kf/HTB18ehESIfpK1RjSZFOq6y6nFXaf.jpg'));
    $bgImg->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($bgImg);

    $JMainColor = new Typecho_Widget_Helper_Form_Element_Text('JMainColor', NULL, "rgb(255,255,255)", _t('主色调(透明色)'),_t('设置主色调：<br>默认白色: rgb(255,255,255)'));
    $JMainColor->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JMainColor);

    $Jtransparent = new Typecho_Widget_Helper_Form_Element_Text('Jtransparent', NULL, "0.9", _t('透明度'),_t('<br>设置全局透明度，0是透明，1是不透明，默认 0.9 '));
    $Jtransparent->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($Jtransparent);

    $JnavMenuColor = new Typecho_Widget_Helper_Form_Element_Text('JnavMenuColor', NULL, "#000", _t('左侧导航栏字体颜色'),_t('<br>左侧导航栏字体颜色，默认 #000 '));
    $JnavMenuColor->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JnavMenuColor);

    // 文章设置
    $JOverdue = new Typecho_Widget_Helper_Form_Element_Select(
        'JOverdue',
        array(
            'off' => '关闭（默认）',
            '3' => '大于3天',
            '7' => '大于7天',
            '15' => '大于15天',
            '30' => '大于30天',
            '60' => '大于60天',
            '90' => '大于90天',
            '120' => '大于120天',
            '180' => '大于180天'
        ),
        'off',
        '是否开启文章更新时间大于多少天提示（仅针对文章有效）',
        '介绍：开启后如果文章在多少天内无任何修改，则进行提示'
    );
    $JOverdue->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($JOverdue->multiMode());

    $JEditor = new Typecho_Widget_Helper_Form_Element_Select(
        'JEditor',
        array(
            'on' => '开启（默认）',
            'off' => '关闭',
        ),
        'on',
        '是否启用Joe自定义编辑器',
        '介绍：开启后，文章编辑器将替换成Joe编辑器 <br>
         其他：目前编辑器处于拓展阶段，如果想继续使用原生编辑器，关闭此项即可'
    );
    $JEditor->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($JEditor->multiMode());

    $JPrismTheme = new Typecho_Widget_Helper_Form_Element_Select(
        'JPrismTheme',
        array(
            '//cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.min.css' => 'prism（默认）',
            '//cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism-dark.min.css' => 'prism-dark',
            '//cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism-okaidia.min.css' => 'prism-okaidia',
            '//cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism-solarizedlight.min.css' => 'prism-solarizedlight',
            '//cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism-tomorrow.min.css' => 'prism-tomorrow',
            '//cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism-twilight.min.css' => 'prism-twilight',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-a11y-dark.min.css' => 'prism-a11y-dark',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-atom-dark.min.css' => 'prism-atom-dark',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-base16-ateliersulphurpool.light.min.css' => 'prism-base16-ateliersulphurpool.light',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-cb.min.css' => 'prism-cb',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-coldark-cold.min.css' => 'prism-coldark-cold',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-coldark-dark.min.css' => 'prism-coldark-dark',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-darcula.min.css' => 'prism-darcula',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-dracula.min.css' => 'prism-dracula',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-duotone-dark.min.css' => 'prism-duotone-dark',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-duotone-earth.min.css' => 'prism-duotone-earth',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-duotone-forest.min.css' => 'prism-duotone-forest',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-duotone-light.min.css' => 'prism-duotone-light',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-duotone-sea.min.css' => 'prism-duotone-sea',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-duotone-space.min.css' => 'prism-duotone-space',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-ghcolors.min.css' => 'prism-ghcolors',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-gruvbox-dark.min.css' => 'prism-gruvbox-dark',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-hopscotch.min.css' => 'prism-hopscotch',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-lucario.min.css' => 'prism-lucario',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-material-dark.min.css' => 'prism-material-dark',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-material-light.min.css' => 'prism-material-light',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-material-oceanic.min.css' => 'prism-material-oceanic',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-night-owl.min.css' => 'prism-night-owl',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-nord.min.css' => 'prism-nord',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-pojoaque.min.css' => 'prism-pojoaque',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-shades-of-purple.min.css' => 'prism-shades-of-purple',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-synthwave84.min.css' => 'prism-synthwave84',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-vs.min.css' => 'prism-vs',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-vsc-dark-plus.min.css' => 'prism-vsc-dark-plus',
            '//cdn.jsdelivr.net/npm/prism-themes@1.7.0/themes/prism-xonokai.min.css' => 'prism-xonokai',
            '//cdn.jsdelivr.net/npm/prism-theme-one-light-dark@1.0.4/prism-onelight.min.css' => 'prism-onelight',
            '//cdn.jsdelivr.net/npm/prism-theme-one-light-dark@1.0.4/prism-onedark.min.css' => 'prism-onedark',
            '//cdn.jsdelivr.net/npm/prism-theme-one-dark@1.0.0/prism-onedark.min.css' => 'prism-onedark2',
        ),
        '//cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.min.css',
        '选择一款您喜欢的代码高亮样式',
        '介绍：用于修改代码块的高亮风格 <br>
         其他：如果您有其他样式，可通过源代码修改此项，引入您的自定义样式链接'
    );
    $JPrismTheme->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($JPrismTheme->multiMode());

    $jsPushBaidu = new Typecho_Widget_Helper_Form_Element_Select('jsPushBaidu', array('0' => '关闭', '1' => '开启'), '0', _t('自动推送'), _t('使用通用js自动推荐给百度引擎，增快收录'));
    $jsPushBaidu->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($jsPushBaidu);

    $LicenseInfo = new Typecho_Widget_Helper_Form_Element_Text('LicenseInfo', NULL, NULL, _t('文章许可信息'), _t('填入后将在文章底部显示你填入的许可信息（支持HTML标签）<br>eg: 本作品采用 <a rel="license nofollow" href="https://creativecommons.org/licenses/by-sa/4.0/" target="_blank">知识共享署名-相同方式共享 4.0 国际许可协议</a> 进行许可。'));
    $LicenseInfo->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($LicenseInfo);
    //
    $JCursorType = new Typecho_Widget_Helper_Form_Element_Select(
        'JCursorType',
        array(
            'off' => '默认样式（默认）',
            'cursor1.cur' => '风格1',
            'cursor2.cur' => '风格2',
            'cursor3.cur' => '风格3',
            'cursor4.cur' => '风格4',
            'cursor5.cur' => '风格5',
            'cursor6.cur' => '风格6',
        ),
        'off',
        '是否开启自定义鼠标风格（仅限PC）',
        '介绍：选择一款您所喜欢的鼠标默认样式。'
    );
    $JCursorType->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCursorType->multiMode());

    $JCursorEffects = new Typecho_Widget_Helper_Form_Element_Select(
        'JCursorEffects',
        array(
            'off' => '关闭（默认）',
            'cursor1.min.js' => '烟花效果',
            'cursor2.min.js' => '气泡效果',
            'cursor3.min.js' => '富强、民主、和谐（消耗性能）',
            'cursor4.min.js' => '彩色爱心（消耗性能）'
        ),
        'off',
        '选择鼠标点击特效',
        '介绍：用于切换鼠标点击特效 '
    );
    $JCursorEffects->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCursorEffects->multiMode());

    // 博客设置
    //以下为博客设置
    $blogMid = new Typecho_Widget_Helper_Form_Element_Text('blogMid', NULL, NULL, _t('展示的博客分类mid'), _t('输入需要展示的博客分类的mid，中间用||分隔, 1 || 2'));
    $blogMid->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($blogMid);

    $JSummaryMeta = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'JSummaryMeta',
        array(
            'author' => '显示作者',
            'cate' => '显示分类',
            'time' => '显示时间',
            'read' => '显示阅读量',
            'comment' => '显示评论量',
        ),
        null,
        '选择博客显示的选项',
        '该处的设置是用于设置首页及搜索页列表里的文章信息，根据您的爱好自行选择'
    );
    $JSummaryMeta->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JSummaryMeta->multiMode());

    $JPageStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JPageStatus',
        array('default' => '按钮切换形式（默认）', 'ajax' => '点击加载形式'),
        'default',
        '选择博客页的分页形式',
        '介绍：选择一款您所喜欢的分页形式'
    );
    $JPageStatus->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JPageStatus->multiMode());

    $JIndexSticky = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexSticky',
        NULL,
        NULL,
        '博客置顶文章（非必填）',
        '介绍：请务必填写正确的格式 <br />
         格式：文章的ID || 文章的ID || 文章的ID （中间使用两个竖杠分隔）<br />
         例如：1 || 2 || 3'
    );
    $JIndexSticky->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexSticky);

    $JIndexNotice = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexNotice',
        NULL,
        NULL,
        '博客通知文字（非必填）',
        '介绍：请务必填写正确的格式 <br />
         格式：通知文字 || 跳转链接（中间使用两个竖杠分隔，限制一个）<br />
         例如：我是通知哈哈哈||http://baidu.com'
    );
    $JIndexNotice->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexNotice);

    $JIndexAD = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexAD',
        NULL,
        NULL,
        '博客大屏广告（非必填）',
        '介绍：请务必填写正确的格式 <br />
         格式：广告图片 || 广告链接 （中间使用两个竖杠分隔，限制一个）<br />
         例如：https://puui.qpic.cn/media_img/lena/PICykqaoi_580_1680/0||http://baidu.com'
    );
    $JIndexAD->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexAD);

    $JIndexHotStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JIndexHotStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启热门文章',
        '介绍：开启后，网站博客页将会显示浏览量最多的4篇热门文章'
    );
    $JIndexHotStatus->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexHotStatus->multiMode());

    $JIndexCarousel = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexCarousel',
        NULL,
        NULL,
        '博客页轮播图（非必填）',
        '介绍：用于显示博客页轮播图，请务必填写正确的格式 <br />
         格式：图片地址 || 跳转链接 || 标题 （中间使用两个竖杠分隔）<br />
         其他：一行一个，一行代表一个轮播图 <br />
         例如：<br />
            https://puui.qpic.cn/media_img/lena/PICykqaoi_580_1680/0 || http://baidu.com || 百度一下 <br />
            https://puui.qpic.cn/tv/0/1223447268_1680580/0 || http://v.qq.com || 腾讯视频
         '
    );
    $JIndexCarousel->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexCarousel);

    $JIndexRecommend = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexRecommend',
        NULL,
        NULL,
        '博客页推荐文章（非必填，填写时请填写2个，否则不显示！）',
        '介绍：用于显示推荐文章，请务必填写正确的格式 <br/>
         格式：文章的id || 文章的id （中间使用两个竖杠分隔）<br />
         例如：1 || 2 <br />
         注意：如果填写的不是2个，将不会显示
         '
    );
    $JIndexRecommend->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexRecommend);

    // 侧栏设置
    $JAside_Mayintrest = new Typecho_Widget_Helper_Form_Element_Select(
        'JAside_Mayintrest',
        array(
            '0' => '关闭（默认）',
            '1' => '开启'
        ),
        '0',
        '是否右侧可能感兴趣推荐',
        '介绍：用于设置侧边栏是否显示可能感兴趣推荐'
    );
    $JAside_Mayintrest->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JAside_Mayintrest->multiMode());

    $JAside_Flatterer = new Typecho_Widget_Helper_Form_Element_Select(
        'JAside_Flatterer',
        array(
            '0' => '关闭（默认）',
            '1' => '开启'
        ),
        '0',
        '是否开启舔狗日记 - PC',
        '介绍：用于设置侧边栏是否显示舔狗日记'
    );
    $JAside_Flatterer->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JAside_Flatterer->multiMode());

    // 其他
    /* 评论发信 */
    $JCommentMail = new Typecho_Widget_Helper_Form_Element_Select(
        'JCommentMail',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启评论邮件通知',
        '介绍：开启后评论内容将会进行邮箱通知 <br />
         注意：此项需要您完整无错的填写下方的邮箱设置！！ <br />
         其他：下方例子以QQ邮箱为例，推荐使用QQ邮箱'
    );
    $JCommentMail->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JCommentMail->multiMode());

    $JCommentMailHost = new Typecho_Widget_Helper_Form_Element_Text(
        'JCommentMailHost',
        NULL,
        NULL,
        '邮箱服务器地址',
        '例如：smtp.qq.com'
    );
    $JCommentMailHost->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JCommentMailHost->multiMode());

    $JCommentSMTPSecure = new Typecho_Widget_Helper_Form_Element_Select(
        'JCommentSMTPSecure',
        array('ssl' => 'ssl（默认）', 'tls' => 'tls'),
        'ssl',
        '加密方式',
        '介绍：用于选择登录鉴权加密方式'
    );
    $JCommentSMTPSecure->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JCommentSMTPSecure->multiMode());

    $JCommentMailPort = new Typecho_Widget_Helper_Form_Element_Text(
        'JCommentMailPort',
        NULL,
        NULL,
        '邮箱服务器端口号',
        '例如：465'
    );
    $JCommentMailPort->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JCommentMailPort->multiMode());

    $JCommentMailFromName = new Typecho_Widget_Helper_Form_Element_Text(
        'JCommentMailFromName',
        NULL,
        NULL,
        '发件人昵称',
        '例如：帅气的象拔蚌'
    );
    $JCommentMailFromName->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JCommentMailFromName->multiMode());

    $JCommentMailAccount = new Typecho_Widget_Helper_Form_Element_Text(
        'JCommentMailAccount',
        NULL,
        NULL,
        '发件人邮箱',
        '例如：2323333339@qq.com'
    );
    $JCommentMailAccount->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JCommentMailAccount->multiMode());

    $JCommentMailPassword = new Typecho_Widget_Helper_Form_Element_Text(
        'JCommentMailPassword',
        NULL,
        NULL,
        '邮箱授权码',
        '介绍：这里填写的是邮箱生成的授权码 <br>
         获取方式（以QQ邮箱为例）：<br>
         QQ邮箱 > 设置 > 账户 > IMAP/SMTP服务 > 开启 <br>
         其他：这个可以百度一下开启教程，有图文教程'
    );
    $JCommentMailPassword->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JCommentMailPassword->multiMode());

    $JCustomPlayer = new Typecho_Widget_Helper_Form_Element_Text(
        'JCustomPlayer',
        NULL,
        NULL,
        '自定义视频播放器（非必填）',
        '介绍：用于修改主题自带的默认播放器 <br />
         例如：https://v.ini0.com/player/?url= <br />
         注意：主题自带的播放器只能解析M3U8的视频格式'
    );
    $JCustomPlayer->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JCustomPlayer);

    $JSensitiveWords = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JSensitiveWords',
        NULL,
        '你妈死了 || 傻逼 || 操你妈 || 射你妈一脸',
        '评论敏感词（非必填）',
        '介绍：用于设置评论敏感词汇，如果用户评论包含这些词汇，则将会把评论置为审核状态 <br />
         例如：你妈死了 || 你妈炸了 || 我是你爹 || 你妈坟头冒烟 （多个使用 || 分隔开）'
    );
    $JSensitiveWords->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JSensitiveWords);

    $JLimitOneChinese = new Typecho_Widget_Helper_Form_Element_Select(
        'JLimitOneChinese',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启评论至少包含一个中文',
        '介绍：开启后如果评论内容未包含一个中文，则将会把评论置为审核状态 <br />
         其他：用于屏蔽国外机器人刷的全英文垃圾广告信息'
    );
    $JLimitOneChinese->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JLimitOneChinese->multiMode());

    $JTextLimit = new Typecho_Widget_Helper_Form_Element_Text(
        'JTextLimit',
        NULL,
        NULL,
        '限制用户评论最大字符',
        '介绍：如果用户评论的内容超出字符限制，则将会把评论置为审核状态 <br />
         其他：请输入数字格式，不填写则不限制'
    );
    $JTextLimit->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JTextLimit->multiMode());

    $headerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('headerEcho', NULL, NULL, _t('<h2>开发者设置</h2>自定义头部信息'), _t('填写 html 代码，将输出在 &lt;head&gt; 标签中，可以在这里写上统计代码'));
    $headerEcho->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($headerEcho);

    $footerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('footerEcho', NULL, NULL, _t('自定义脚部信息'), _t('填写 html 代码，将输出在 &lt;footer&gt; 标签中，可以在这里写上统计代码'));
    $footerEcho->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($footerEcho);

    $cssEcho = new Typecho_Widget_Helper_Form_Element_Textarea('cssEcho', NULL, NULL, _t('自定义 CSS'), _t('填写 CSS 代码，输出在 head 标签结束之前的 style 标签内'));
    $cssEcho->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($cssEcho);

    $jsEcho = new Typecho_Widget_Helper_Form_Element_Textarea('jsEcho', NULL, NULL, _t('自定义 JavaScript'), _t('填写 JavaScript代码，输出在 body 标签结束之前'));
    $jsEcho->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($jsEcho);

    $compressHtml = new Typecho_Widget_Helper_Form_Element_Radio('compressHtml',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('HTML压缩'), _t('默认关闭，启用则会对HTML代码进行压缩，可能与部分插件存在兼容问题，请酌情选择开启或者关闭'));
    $compressHtml->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($compressHtml);

    $f12disable = new Typecho_Widget_Helper_Form_Element_Radio('f12disable',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('启用代码防偷'), _t('默认关闭'));
    $f12disable->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($f12disable);

    /**
     * 积分设置
     */
    //用户积分
    $credits_register = new Typecho_Widget_Helper_Form_Element_Text('creditsRegister', NULL, 2000, _t('注册积分'),_t('用户注册后默认的积分'));
    $credits_register->setAttribute('class', 'j-setting-content j-setting-jifen');
    $form->addInput($credits_register);

    $credits_login = new Typecho_Widget_Helper_Form_Element_Text('creditsLogin', NULL, 20, _t('登录积分'),_t('每日登录获取的积分'));
    $credits_login->setAttribute('class', 'j-setting-content j-setting-jifen');
    $form->addInput($credits_login);

    $credits_publish = new Typecho_Widget_Helper_Form_Element_Text('creditsPublish', NULL, -10, _t('发布主题'),_t('用户发布主题加上或减少的积分'));
    $credits_publish->setAttribute('class', 'j-setting-content j-setting-jifen');
    $form->addInput($credits_publish);

    $credits_reply = new Typecho_Widget_Helper_Form_Element_Text('creditsReply', NULL, -5, _t('发表回复'),_t('用户发表回复加上或减少的积分'));
    $credits_reply->setAttribute('class', 'j-setting-content j-setting-jifen');
    $form->addInput($credits_reply);

    $credits_invite = new Typecho_Widget_Helper_Form_Element_Text('creditsInvite', NULL, 200, _t('邀请注册'),_t('邀请者和被邀请者所奖励的积分'));
    $credits_invite->setAttribute('class', 'j-setting-content j-setting-jifen');
    $form->addInput($credits_invite);


    /**
     * 广告设置
     */
    $index_middle_ads = new Typecho_Widget_Helper_Form_Element_Text('index_middle_ads', NULL, '', _t('首页中部广告设置'),_t('默认长度 600x90'));
    $index_middle_ads->setAttribute('class', 'j-setting-content j-setting-ads');
    $form->addInput($index_middle_ads);

    $list_middle_ads = new Typecho_Widget_Helper_Form_Element_Text('list_middle_ads', NULL, '', _t('文章列表广告设置'),_t('每隔7篇输出一下，文章数不够的修改阅读设置文章数，默认长度 600x90'));
    $list_middle_ads->setAttribute('class', 'j-setting-content j-setting-ads');
    $form->addInput($list_middle_ads);

    $article_top_ads = new Typecho_Widget_Helper_Form_Element_Text('article_top_ads', NULL, '', _t('文章顶部广告设置'),_t('默认长度 600x90'));
    $article_top_ads->setAttribute('class', 'j-setting-content j-setting-ads');
    $form->addInput($article_top_ads);

    $article_bottom_ads = new Typecho_Widget_Helper_Form_Element_Text('article_bottom_ads', NULL, '', _t('文章底部广告设置'),_t('默认长度 600x90'));
    $article_bottom_ads->setAttribute('class', 'j-setting-content j-setting-ads');
    $form->addInput($article_bottom_ads);
}