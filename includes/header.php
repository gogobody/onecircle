<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.5.2/scss/_navbar.scss" rel="stylesheet">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/main.css'); ?>">
    <?php if ($this->is('single')): ?>
        <!-- 文章 CSS -->
        <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/post.css'); ?>">
        <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/owo/owo.min.css'); ?>">

    <?php endif; ?>
    <link crossorigin="anonymous" integrity="sha384-Q8BgkilbsFGYNNiDqJm69hvDS7NCJWOodvfK/cwTyQD4VQA0qKzuPpvqNER1UC0F" href="//lib.baomitu.com/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet">
    <?php if ($this->is('index')):?>
    <?php endif; ?>
    <title><?php $this->archiveTitle(array(
            'category' => _t('分类 %s 下的文章'),
            'search' => _t('包含关键字 %s 的文章'),
            'tag' => _t('标签 %s 下的文章'),
            'author' => _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <!-- 通过自有函数输出HTML头部信息 -->
    <meta itemprop="image" content="<?php if ($this->fields->banner && $this->fields->banner !=''):$this->fields->banner();
    else: echo explode(PHP_EOL, $this->options->bannerUrl)[0]; endif;?>" />
    <meta name="description" itemprop="description" content="<?php if($this->is('index')) { $this->options->description();}elseif($this->is('category')){ echo $this->getDescription();}elseif($this->is('single')){$this->excerpt(200, '');} ?>">
    <?php $this->header('description=&generator=&template='); ?>
    <?php $this->options->cssEcho(); ?>
    <?php $this->options->headerEcho(); ?>
</head>
<body>
<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand mb-0 h1 p-2 mr-auto" href="<?php $this->options->siteUrl(); ?>">
                <img class="site-logo" src="<?php $this->options->logoUrl(); ?>"
                     alt="<?php $this->options->title(); ?>"/>
                <?php $this->options->title(); ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
<!--            <div class="p-2 mr-auto">-->
<!--                <img class="site-logo" src="--><?php //$this->options->logoUrl(); ?><!--"-->
<!--                     alt="--><?php //$this->options->title(); ?><!--"/>-->
<!--                <a class="site-name" href="--><?php //$this->options->siteUrl(); ?><!--"-->
<!--                   title="--><?php //$this->options->description(); ?><!--">--><?php //$this->options->title(); ?><!--</a>-->
<!--            </div>-->


            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar navbar-nav navbar-right ml-auto">
                    <li class="nav-item" data-toggle="collapse" data-target="#search-block" aria-expanded="false"
                        aria-controls="search-block">
                        <a class="nav-link" href="#">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                <path fill-rule="evenodd"
                                      d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item dropdown" id="easyLogin">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="feathericons">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-key">
                                    <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
                                </svg>
                            </span>
                            <b class="caret"></b><!--下三角符号-->
                        </a>
                        <!-- dropdown(已经登录) -->
                        <div class="dropdown-menu w-lg wrapper bg-white animated fadeIn" aria-labelledby="navbarDropdown">
                            <form id="Login_form"
                                  action="https://www.ihewro.com/index.php/action/login?_=f1086b406997944ac9d4e4b72c20fb53"
                                  method="post">
                                <div class="form-group">
                                    <label for="navbar-login-user">用户名</label>
                                    <input type="text" name="name" id="navbar-login-user" class="form-control"
                                           placeholder="用户名或电子邮箱"></div>
                                <div class="form-group">
                                    <label for="navbar-login-password">密码</label>
                                    <input autocomplete="" type="password" name="password" id="navbar-login-password"
                                           class="form-control" placeholder="密码"></div>
                                <button style="width: 100%" type="submit" id="login-submit" name="submitLogin"
                                        class="btn-rounded box-shadow-wrap-lg btn-gd-primary padder-lg">
                                    <span>登录</span>
                                    <span class="text-active">登录中...</span>
                                    <span class="banLogin_text">刷新页面后登录</span>
                                    <i class="animate-spin  fontello fontello-spinner hide" id="spin-login"></i>
                                    <i class="animate-spin fontello fontello-refresh hide" id="ban-login"></i>
                                </button>


                                <!--                            -->
                                <input type="hidden" name="referer" value="https://www.ihewro.com/"></form>
                        </div>

                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link" href="#" type="button" data-toggle="collapse" data-target="#mobile-nav"
                           aria-expanded="false" aria-controls="mobile-nav">
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


        </nav>
        <!--search area-->
        <div class="search-block collapse" id="search-block">
            <button type="button" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4>搜索</h4>
            <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
                <input type="text" id="s" name="s" class="text form-control"
                       placeholder="<?php _e('输入关键字搜索'); ?>"/>
                <button type="submit" class="btn btn-primary float-right search-button"><?php _e('搜索'); ?></button>
            </form>
        </div>

    </div>
</header>