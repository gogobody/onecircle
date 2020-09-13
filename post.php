<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('includes/header.php'); ?>
<div class="container">
    <div class="row">
        <?php $this->need('includes/nav.php');?>
        <div class="col-xl-7 col-md-6 col-12 article-container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php $this->options->siteUrl();?>">首页</a></li>
                    <?php if ($this->is('post')): ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php $this->title()?></li>
                    <?php else: ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php $this->archiveTitle('&raquo;','',''); ?></li>
                    <?php endif; ?>
                </ol>
            </nav>
<!--            头图-->
            <?php if ($this->fields->banner && $this->fields->banner !=''):?>
                <div class="article-cover">
                    <div class="archive-cover-inner">
                        <img class="post-cover-img" src="<?php echo $this->fields->banner;?>" alt="cover">
                    </div>
                </div>
            <? endif; ?>
<!--            内容-->
            <article class="post">
                <h1 class="article-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
                <div class="article-auth">
                    <img class="avatar" src="//cdn.v2ex.com/gravatar/<?php echo $this->author->mail?md5($this->author->mail):''; ?>?s=32&d=mp" alt="<?php $this->author()?>"/>
                    <a href="<?php $this->author->permalink(); ?>"><span><?php $this->author(); ?></span></a>
                    <?php if($this->user->hasLogin()):?>
                        <a href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>">编辑</a>
                    <?php endif;?>
                </div>
<!--                元数据-->
                <div class="article-meta">
                    <span class="article-category">
                        <?php $this->category(' ');?>
                    </span>
                    <time class="create-time" daetime="<?php $this->date('c'); ?>"><?php $this->date(); ?></time>
                    <?php $agree = $this->hidden?array('agree' => 0, 'recording' => true):utils::agreeNum($this->cid); ?>
                    <div class="article-data"><span><?php utils::getPostView($this);?>阅读 <?php echo $agree['agree']; ?>点赞</span></div>
                </div>
<!--                content-->
                <div class="article-content">
                    <?php if($this->hidden||$this->titleshow): ?>
                        <form action="<?php echo Typecho_Widget::widget('Widget_Security')->getTokenUrl($this->permalink); ?>" class="protected">
                            <div class="form-group mb-3 col-md-6 text-center required-password">
                                <label for="passwd">请输入密码访问</label>
                                <div class="input-group">
                                    <input type="password" id="passwd" name="protectPassword" class="form-control text" placeholder="请输入密码" aria-label="请输入密码">
                                    <input type="hidden" name="protectCid" value="<?php $this->cid(); ?>" />
                                    <div class="input-group-append">
                                        <button class="btn btn-primary protected-btn" type="button">提交</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php else: ?>
                        <?php $this->content();?>
                    <?php endif;?>
                </div>
                <!--tag-->
                <p class="tags"><?php $this->tags(' ', true, ''); ?></p>
                <!--点赞-->

                <div class="row">
                    <button type="button" id="agree-btn" class="button post-like" data-cid="<?php $this->cid();?>">
                        <svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-heart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>
                        <span class="agree-num"><?php echo $agree['agree']; ?></span>
                    </button>
                </div>

                <div class="article-list-plane row">
                    <div class="col-4">
                        <?php thePrev($this); ?>
                    </div>
                    <div class="col-4">
                        <div class="button" id="article-list-btn">
                            <div class="label">查看目录</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <?php theNext($this); ?>
                    </div>
                </div>
            </article>
<!--            目录树-->
            <section class="col-12 col-md-4 col-xl-3 article-catalog" id="tocTree">
                <h3 class="article-catalog-title">
                    <?php _e('目录'); ?>
                    <button type="button" class="close" aria-label="Close" id="catalog-close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>
                <div class="article-list-title">来自  《<?php $this->title() ?>》</div>
                <ul class="article-catalog-list">
                </ul>
            </section>
            <?php $this->need('includes/comments.php'); ?>

        </div>
        <?php $this->need('includes/right.php');?>
    </div>
</div>
