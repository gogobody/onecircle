<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
//require_once('admin/core.php');
include_once 'admin/core.php';
function themeConfig($form)
{  $options = Helper::options();
    ?>
    <div class="j-setting-contain">
    <link href="<?php $options->themeUrl('/assets/admin/css/one.setting.min.css') ?>" rel="stylesheet" type="text/css" />
    <div>
        <div class="j-aside">
            <div class="logo">ONE <?php echo OnecircleVersion() ?><br><small style="font-size: 10px">设置模板来自Joe的typecho主题</small></div>
            <ul class="j-setting-tab">
                <li data-current="j-setting-notice">最新公告</li>
                <li data-current="j-setting-global">公共设置</li>
                <li data-current="j-setting-image">图片设置</li>
                <li data-current="j-setting-post">文章设置</li>
                <!--                    <li data-current="j-setting-aside">侧栏设置</li>-->
                <!--                    <li data-current="j-setting-color">色彩圆角</li>-->
                <li data-current="j-setting-index">首页设置</li>
                <li data-current="j-setting-other">其他设置</li>
            </ul>
            <?php require_once("admin/backup.php"); ?>
        </div>
    </div>
    <span id="j-version" style="display: none;"><?php echo OnecircleVersion() ?></span>
    <div class="j-setting-notice"><iframe src="https://www.yuque.com/docs/share/05f40cac-980f-4e53-8b92-ed9728b8dc50?# 《OneCircle 主题说明》" frameborder="no" scrolling="yes" height="100%" width="100%"></iframe></div>
    <script src="<?php $options->themeUrl('/assets/admin/js/one.setting.min.js')?>"></script>
    <?php

    $recordNo = new Typecho_Widget_Helper_Form_Element_Text('recordNo', NULL, NULL, _t('网站备案号'), _t('根据要求，每个备案网站必须填写备案号'));
    $recordNo->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($recordNo);

    $sticky = new Typecho_Widget_Helper_Form_Element_Text('sticky', NULL, NULL, _t('文章置顶'), _t('置顶的文章cid，按照排序输入, 请以空格分隔'));
    $sticky->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($sticky);

    $useInfiniteScroll = new Typecho_Widget_Helper_Form_Element_Radio('useInfiniteScroll',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('无限滚动'), _t('开启后将会隐藏分页器，显示无限滚动'));
    $useInfiniteScroll->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($useInfiniteScroll);

    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, "https://dss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2592033302,3451533765&fm=26&gp=0.jpg", _t('<h2>普通设置</h2>站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $logoUrl->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($logoUrl);

    $defaultSlugUrl = new Typecho_Widget_Helper_Form_Element_Text('defaultSlugUrl', NULL, "https://img.icons8.com/dusk/2x/categorize.png", _t('默认的分类图片'), _t('在这里填入一个图片 URL， 地址为分类图片的默认图标'));
    $defaultSlugUrl->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($defaultSlugUrl);

    $customNavIcon = new Typecho_Widget_Helper_Form_Element_Textarea('customNavIcon', NULL, NULL, _t('自定义导航小图标'), _t('请前往阿里巴巴 iconfront，找到你最喜欢的图标跑，点击复制svg <br>每行粘贴一个，自定义内导航栏左侧的小图标，留空则展示默认的图标按钮<hr>'));
    $customNavIcon->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($customNavIcon);

    $jsPushBaidu = new Typecho_Widget_Helper_Form_Element_Select('jsPushBaidu', array('0' => '关闭', '1' => '开启'), '0', _t('自动推送'), _t('使用通用js自动推荐给百度引擎，增快收录'));
    $jsPushBaidu->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($jsPushBaidu);

    $LicenseInfo = new Typecho_Widget_Helper_Form_Element_Text('LicenseInfo', NULL, NULL, _t('文章许可信息'), _t('填入后将在文章底部显示你填入的许可信息（支持HTML标签）<br>eg: 本作品采用 <a rel="license nofollow" href="https://creativecommons.org/licenses/by-sa/4.0/" target="_blank">知识共享署名-相同方式共享 4.0 国际许可协议</a> 进行许可。'));
    $LicenseInfo->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($LicenseInfo);


    //developer
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
}