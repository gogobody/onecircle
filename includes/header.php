<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="d-flex">
            <div class="p-2">
                <img class="site-logo" src="<?php $this->options->logoUrl(); ?>"
                     alt="<?php $this->options->title(); ?>"/>
                <a class="site-name" href="<?php $this->options->siteUrl(); ?>"
                   title="<?php $this->options->description(); ?>"><?php $this->options->title(); ?></a>
            </div>
            <button class="p-2 search-area" type="button" data-toggle="collapse" data-target="#search-block" aria-expanded="false" aria-controls="search-block">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                    <path fill-rule="evenodd"
                          d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                </svg>
            </button>
            <div class="p-2 d-block d-md-none mobile-nav">
                <button class="btn" type="button" data-toggle="collapse" data-target="#mobile-nav"
                        aria-expanded="false" aria-controls="mobile-nav">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M14 3.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0zM11.5 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM7 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0zM4.5 10a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm9.5 3.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0zM11.5 15a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                        <path fill-rule="evenodd"
                              d="M9.5 4H0V3h9.5v1zM16 4h-2.5V3H16v1zM9.5 14H0v-1h9.5v1zm6.5 0h-2.5v-1H16v1zM6.5 9H16V8H6.5v1zM0 9h2.5V8H0v1z"/>
                    </svg>
                </button>
            </div>
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
    </div>
</header>