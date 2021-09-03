<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $all = Typecho_Plugin::export();?>
<?php if (!array_key_exists('SmmsForTypecho', $all['activated']) or !array_key_exists('OneCircle', $all['activated'])) : ?>
    <?php die("请下载并开启 SmmsPlugin 插件 和 onecircle 配套插件，查看：<a href='https://www.yuque.com/docs/share/05f40cac-980f-4e53-8b92-ed9728b8dc50?#%E3%80%8AOneCircle%20%E4%B8%BB%E9%A2%98%E8%AF%B4%E6%98%8E%E3%80%8B'>使用说明</a>"); ?>
<?php endif; ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link crossorigin="anonymous" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" href="https://lib.baomitu.com/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.bootcdn.net/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://cdn.bootcdn.net/ajax/libs/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">
    <!-- 文章 CSS -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/post.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/owo/owo.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/onecircle.min.css'); ?>">
    <link crossorigin="anonymous" integrity="sha384-Q8BgkilbsFGYNNiDqJm69hvDS7NCJWOodvfK/cwTyQD4VQA0qKzuPpvqNER1UC0F"
          href="https://lib.baomitu.com/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet">
    <?php if ($this->options->favicon): ?>
        <link rel="shortcut icon" href="<?php $this->options->favicon(); ?>"><?php endif; ?>
    <title><?php $this->archiveTitle(array(
            'category' => _t('分类 %s 下的文章'),
            'search' => _t('包含关键字 %s 的文章'),
            'tag' => _t('标签 %s 下的文章'),
            'author' => _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <!-- 通过自有函数输出HTML头部信息 -->
    <meta itemprop="image"
          content="<?php if ($this->fields->banner && $this->fields->banner != ''):$this->fields->banner();
          else: echo explode(PHP_EOL, $this->options->bannerUrl)[0]; endif; ?>"/>
    <meta name="description" itemprop="description" content="<?php if ($this->is('index')) {
        $this->options->description();
    } elseif ($this->is('category')) {
        echo $this->getDescription();
    } elseif ($this->is('single')) {
        $this->excerpt(200, '');
    } ?>">
    <?php $this->header('description=&generator=&template='); ?>
    <?php $this->options->cssEcho(); ?>
    <?php $this->options->headerEcho(); ?>
    <script>gconf={index:'<?_e(Helper::options()->index)?>',oneaction:'<?_e(Helper::options()->index)?>/oneaction'}</script>
    <script src="https://cdn.bootcdn.net/ajax/libs/lazysizes/5.2.2/lazysizes.min.js" async=""></script>

    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/responsive.min.css'); ?>" />
    <?php
        $rgb_pattern = '/rgb\((0|1\d{0,2}|2[0-5]{2}),(0|1\d{0,2}|2[0-5]{2}),(0|1\d{0,2}|2[0-5]{2})\)/';
        if (preg_match($rgb_pattern,$this->options->JMainColor,$arr)){
            if ($this->options->Jtransparent) $mainColor = sprintf('rgb(%d,%d,%d,%.2f)',$arr[1],$arr[2],$arr[3],$this->options->Jtransparent);
            else $mainColor = sprintf('rgb(%d,%d,%d)',$arr[1],$arr[2],$arr[3]);
        }else{
            $mainColor = $this->options->JMainColor;
        }
        $setTansparent = $this->options->Jtransparent and $this->options->Jtransparent !== 1;
    ?>
    <style>
        :root {
            --theme:#4e7cf2;
            --element: #409eff;
            cursor: <?php echo $this->options->JCursorType !== 'off' ? 'url(' . THEME_URL . '\/assets\/cur\/' . $this->options->JCursorType . '), auto' : 'auto' ?>;
            --classA: #dcdfe6;
            --classB: #e4e7ed;
            --classC: #ebeef5;
            --classD: #f2f6fc;
            --routine: #606266;
            --minor: #909399;
            --seat: #c0c4cc;
            --success: #67c23a;
            --warning: #e6a23c;
            --danger: #f56c6c;
            --main: <?php echo $mainColor ?>;
            --panelColor: <?php if ($setTansparent) _e('rgb(242,245,248,'.$this->options->Jtransparent.');'); else _e('rgb(242,245,248);');?>;
            --articleHover: <?php if ($setTansparent) _e('rgb(248,250,251,0.5);'); else _e('rgb(248,250,251);');?>;
            --focusUserColor: <?php if ($setTansparent) _e('rgb(242,245,258,0.5);'); else _e('rgb(242,245,258);');?>;
            --contentbg: <?php if ($setTansparent) _e('rgb(245,248,250,0.5);'); else _e('rgb(245,248,250);');?>;
            --info: <?php echo $this->options->JInfoColor ? $this->options->JInfoColor : '#909399' ?>;
            --radius-pc: <?php echo $this->options->JRadiusPC ? $this->options->JRadiusPC : '10px'?>;
            --radius-wap: <?php echo $this->options->JRadiusWap ?>;
            --text-shadow: <?php echo $this->options->JTextShadow ? $this->options->JTextShadow : '0 1px 2px rgba(0, 0, 0, 0.25)' ?>;
            --box-shadow: <?php echo $this->options->JBoxShadow ? $this->options->JBoxShadow : '0px 0px 20px -5px rgba(158, 158, 158, 0.22)' ?>;
            --background: <?php echo $this->options->JCardBackground ? $this->options->JCardBackground : '#fff' ?>;
            --swiper-theme-color: #fff !important;
            --indexcolor: <?php echo $this->options->bgColor ? $this->options->bgColor :'#eff3f6'?>;
        }
        body:before{
            background-image: url("<?php echo $this->options->bgImg ? $this->options->bgImg :''?>");
        }
    </style>

    <?php Typecho_Plugin::factory('SmmsForTypecho')->header($this);?>

</head>
<body class="bright" ontouchstart="">
<div id="allayout" class="app app-aside-fix app-header-fixed">
    <header class="app-header">
        <div class="container-xl">
            <div class="row navbar-expand-lg">
                <div class="col-6 col-md-9 col-lg-8 col-xl-9 mobile-nopading">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand mb-0 h1 p-2 mr-auto" href="<?php $this->options->siteUrl(); ?>">
                            <img class="site-logo" src="<?php $this->options->logoUrl(); ?>" loading="lazy"
                                 alt="<?php $this->options->title(); ?>"/>
                            <span class="nav-title"><?php $this->options->title(); ?></span>
                        </a>
                    </nav>
                </div>
                <div class="col-6 col-md-3 col-lg-4 col-xl-3 mobile-nopading">
                    <div class="max-height">
                        <ul class="navbar navbar-nav navbar-right ml-auto header__content header__content--end">

                            <li class="nav-item search-block-icon" aria-expanded="false"
                                aria-controls="search-block">
                                <a class="nav-link">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                        <path fill-rule="evenodd"
                                              d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                    </svg>
                                </a>
                            </li>

                            <?php if ($this->user->hasLogin()):?>
                                <li class="nav-item dropdown" id="easyLogin">
                                    <a class="nav-link" href="#" id="navbarDropdown" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        <span class="hidden-sm hidden-md hidden-lg"><?php _e($this->user->name);?></span>
                                        <b class="caret "></b><!--下三角符号-->
                                        <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm">
                                    <img class="img-circle img-40px" src="<?php _e(getUserV2exAvatar($this->user->mail,$this->user->userAvatar))?>">
                                    <i id="msg-tip" class="on md b-white bottom"></i>
                                </span>
                                    </a>
                                    <!-- dropdown(已经登录) -->
                                    <ul class="dropdown-menu animate__fadeInRight login-dropdown header__dropdown-menu " id="Logged-in">
                                        <li>
                                            <a target="_blank" href="<?php _e($this->options->index . '/usercenter/messages');?>">
                                                <span style="width: 30px;display: inline-block;text-align: center"><svg height="1em" aria-hidden="true" focusable="false" data-prefix="far" data-icon="comment-dots" class="svg-inline--fa fa-comment-dots fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M144 208c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm112 0c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm112 0c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zM256 32C114.6 32 0 125.1 0 240c0 47.6 19.9 91.2 52.9 126.3C38 405.7 7 439.1 6.5 439.5c-6.6 7-8.4 17.2-4.6 26S14.4 480 24 480c61.5 0 110-25.7 139.1-46.3C192 442.8 223.2 448 256 448c141.4 0 256-93.1 256-208S397.4 32 256 32zm0 368c-26.7 0-53.1-4.1-78.4-12.1l-22.7-7.2-19.5 13.8c-14.3 10.1-33.9 21.4-57.5 29 7.3-12.1 14.4-25.7 19.9-40.2l10.6-28.1-20.6-21.8C69.7 314.1 48 282.2 48 240c0-88.2 93.3-160 208-160s208 71.8 208 160-93.3 160-208 160z"></path></svg></span>
                                                <span id="my-message">我的私信</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="<?php _e($this->options->index . '/usercenter/notice');?>">
                                                <span style="width: 30px;display: inline-block;text-align: center"><svg height="1em" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope-square" class="svg-inline--fa fa-envelope-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM178.117 262.104C87.429 196.287 88.353 196.121 64 177.167V152c0-13.255 10.745-24 24-24h272c13.255 0 24 10.745 24 24v25.167c-24.371 18.969-23.434 19.124-114.117 84.938-10.5 7.655-31.392 26.12-45.883 25.894-14.503.218-35.367-18.227-45.883-25.895zM384 217.775V360c0 13.255-10.745 24-24 24H88c-13.255 0-24-10.745-24-24V217.775c13.958 10.794 33.329 25.236 95.303 70.214 14.162 10.341 37.975 32.145 64.694 32.01 26.887.134 51.037-22.041 64.72-32.025 61.958-44.965 81.325-59.406 95.283-70.199z"></path></svg></span>
                                                <span>系统消息</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="<?php $this->options->adminUrl('write-post.php')?>">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square login-svg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                                <span>新建文章</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="<?php $this->options->adminUrl('manage-comments.php')?>">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                     class="bi bi-credit-card-2-front login-svg" fill="currentColor"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M14 3H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/>
                                                    <path d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z"/>
                                                    <path fill-rule="evenodd"
                                                          d="M2 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
                                                </svg>
                                                <span>评论管理</span></a>
                                        </li>
                                        <!--后台管理(登录时候才会显示)-->
                                        <li>
                                            <a target="_blank" href="<?php $this->options->adminUrl()?>">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-tools login-svg"
                                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M0 1l1-1 3.081 2.2a1 1 0 0 1 .419.815v.07a1 1 0 0 0 .293.708L10.5 9.5l.914-.305a1 1 0 0 1 1.023.242l3.356 3.356a1 1 0 0 1 0 1.414l-1.586 1.586a1 1 0 0 1-1.414 0l-3.356-3.356a1 1 0 0 1-.242-1.023L9.5 10.5 3.793 4.793a1 1 0 0 0-.707-.293h-.071a1 1 0 0 1-.814-.419L0 1zm11.354 9.646a.5.5 0 0 0-.708.708l3 3a.5.5 0 0 0 .708-.708l-3-3z"/>
                                                    <path fill-rule="evenodd"
                                                          d="M15.898 2.223a3.003 3.003 0 0 1-3.679 3.674L5.878 12.15a3 3 0 1 1-2.027-2.027l6.252-6.341A3 3 0 0 1 13.778.1l-2.142 2.142L12 4l1.757.364 2.141-2.141zm-13.37 9.019L3.001 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z"/>
                                                </svg>
                                                <span>后台管理</span></a>
                                        </li>
                                        <!--个人设置(登录时候才会显示)-->
                                        <li>
                                            <a target="_blank" href="<?php _e($this->options->index . '/usercenter/setting'); ?>">
                                                <svg t="1604126473824" class="icon login-svg" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4129" width="1em" height="1em"><path d="M514.56 51.456a214.4 214.4 0 1 1 0 428.8 214.4 214.4 0 0 1 0-428.8z m0 42.88a171.52 171.52 0 1 0 0 343.04 171.52 171.52 0 0 0 0-343.04zM514.56 501.696a385.92 385.92 0 0 1 385.728 374.528l0.192 11.392c0 47.36-38.4 85.76-85.76 85.76H214.4c-47.36 0-85.76-38.4-85.76-85.76l0.192-11.392A385.92 385.92 0 0 1 514.56 501.76z m0 42.88a342.976 342.976 0 0 0-342.4 321.664l-0.448 10.624-0.192 10.752a42.88 42.88 0 0 0 37.888 42.56l4.992 0.32h600.32a42.88 42.88 0 0 0 42.624-37.376l0.256-4.864-0.128-10.752A343.04 343.04 0 0 0 514.56 544.576z" p-id="4130"></path></svg>
                                                <span>个人设置</span></a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a onclick="indexInput.canLogin = true" id="sign_out" no-pjax href="<?php $this->options->logoutUrl() ?>">退出</a>
                                        </li>
                                    </ul>
                                    <!-- / dropdown(已经登录) -->
                                </li>

                            <?php else:?>
                                <li class="nav-item dropdown" id="easyLogin">
                                    <a class="nav-link" href="#" id="navbarDropdown" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="feathericons">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-key">
                                        <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
                                    </svg>
                                </span>
                                        <b class="caret"></b><!--下三角符号-->
                                    </a>
                                    <!-- dropdown(登录) -->
                                    <div class="dropdown-menu w-lg wrapper bg-white animated fadeIn header__dropdown-menu "
                                         aria-labelledby="navbarDropdown">
                                        <form id="Login_form" name="login" action="<?php $this->options->loginAction() ?>" method="post">
                                            <div class="form-group">
                                                <label for="navbar-login-user">用户名</label>
                                                <input type="text" name="name" id="navbar-login-user" class="form-control"
                                                       placeholder="用户名或电子邮箱"></div>
                                            <div class="form-group">
                                                <label for="navbar-login-password">密码</label>
                                                <input autocomplete="" type="password" name="password" id="navbar-login-password"
                                                       class="form-control" placeholder="密码"></div>
                                            <button style="width: 100%;margin-bottom: 10px" type="submit" id="login-submit" name="submitLogin"
                                                    class="btn-rounded box-shadow-wrap-lg btn-gd-primary padder-lg">
                                                <span>登录</span>

                                                <span class="text-active">登录中...</span>
                                                <span class="banLogin_text">刷新页面后登录 </span>
                                                <span id="ban-login" class="hide">
                                            <svg  style="position: relative;top:-1px" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-clockwise animate-spin" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                              <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                              <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                            </svg>
                                        </span>
                                                <i class="animate-spin  fontello fontello-spinner hide" id="spin-login"></i>
                                            </button>
                                            <a no-pjax href="<?php $this->options->registerUrl(); ?>">
                                                <button style="width: 100%" type="button"
                                                        class="btn-rounded box-shadow-wrap-lg btn-gd-mix padder-lg">
                                                    <span>注册</span>
                                                </button>
                                            </a>
                                            <input type="hidden" name="referer" value="<?php $this->options->siteUrl(); ?>">
                                        </form>
                                    </div>

                                </li>
                            <?php endif;?>
                            <!-- aside -->
                            <li class="nav-item d-md-none">
                                <a class="nav-link d-block d-md-none aside-btn">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders" fill="currentColor"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M14 3.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0zM11.5 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM7 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0zM4.5 10a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm9.5 3.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0zM11.5 15a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                        <path fill-rule="evenodd"
                                              d="M9.5 4H0V3h9.5v1zM16 4h-2.5V3H16v1zM9.5 14H0v-1h9.5v1zm6.5 0h-2.5v-1H16v1zM6.5 9H16V8H6.5v1zM0 9h2.5V8H0v1z"/>
                                    </svg>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <!--search area-->
                <div class="search-block" style="display: none" id="search-block">
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4>搜索</h4>
                    <form name="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                        <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
                        <input type="text" id="s" name="s" class="text form-control"
                               placeholder="<?php _e('输入关键字搜索'); ?>"/>
                        <button type="submit" class="btn btn-primary float-right search-button"><?php _e('搜索'); ?></button>
                    </form>

                </div>
            </div>


        </div>
    </header>