<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 主页 显示 单个 content
 *  php $this->permalink(); ?>
 */
$this->need('libs/language.php');
global $language;
$row = utils::getPostActions($this);
if ($row['name']){
    $addr = $row['name'];
    $district = $row['district'];
}else{
    $addr = $language['defaultAddr'];
    $district = $language['defaultAddr'];
}
$GLOBALS['actionRow'] = $row;
/** 这里 neighbor 默认按照 区 来找*/
$neighbor_addr = Typecho_Common::url('/neighbor/'.$district.'?name='.$addr,$this->options->index);
?>
<!-- focus user show -->
<?php if ($this->fields->articleType == "focususer"): ?>
    <article class="post-article" data-url="<?php $this->permalink(); ?>">
        <div class="post-article-left">
            <a onclick="event.stopPropagation();" href="<?php $this->author->permalink(); ?>">
                <!--<?php $this->author->gravatar(40); ?>-->
                <img class="avatar"
                     src="<?php echo getUserV2exAvatar($this->author->mail,$this->author->userAvatar); ?>"
                     alt="<?php $this->author() ?>"/>
            </a>
        </div>
        <div class="post-article-right">
            <div class="post-author">
                <?php if (!$this->options->singleAuthor): ?>
                    <div class="author-name" id="post-author-<?php $this->cid() ?>">
                        <a onclick="event.stopPropagation();"
                           href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>
                    </div>
                    <div class="post-addr">
                        <a href="<?php _e($neighbor_addr); ?>">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-geo-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.166 8.94C12.696 7.867 13 6.862 13 6A5 5 0 0 0 3 6c0 .862.305 1.867.834 2.94.524 1.062 1.234 2.12 1.96 3.07A31.481 31.481 0 0 0 8 14.58l.208-.22a31.493 31.493 0 0 0 1.998-2.35c.726-.95 1.436-2.008 1.96-3.07zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/><path fill-rule="evenodd" d="M8 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
                            <time><?php echo $addr ?></time>
                        </a>
                    </div>
                <?php else: ?>
                    <a class="post-title" href="<?php $this->permalink() ?>" target="_blank">
                        <h4><?php $this->title() ?></h4>
                    </a>
                <?php endif; ?>
            </div>
            <!--content-->
            <div class="post-content">
                <!-- focususer -->
                <?php $this->need('components/index/index-focususer.php'); ?>
                <?php $this->need('components/index/index-article-action.php'); ?>
            </div>
        </div>
        <?php $this->sticky(); ?>

    </article>

<!-- other show -->
<?php else: ?>
    <article do-pjax class="post-article" data-url="<?php $this->permalink(); ?>">
        <div class="post-article-left">
            <a onclick="event.stopPropagation();" href="<?php $this->author->permalink(); ?>">
                <!--<?php $this->author->gravatar(40); ?>-->
                <img class="avatar"
                     src="<?php echo getUserV2exAvatar($this->author->mail,$this->author->userAvatar); ?>"
                     alt="<?php $this->author() ?>"/>
            </a>
        </div>
        <div class="post-article-right">
            <div class="post-author">
                <?php if (!$this->options->singleAuthor): ?>
                    <div class="author-name" id="post-author-<?php $this->cid() ?>">
                        <a onclick="event.stopPropagation();"
                           href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>
                    </div>
                    <div class="post-addr">
                        <a href="<?php _e($neighbor_addr); ?>">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-geo-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.166 8.94C12.696 7.867 13 6.862 13 6A5 5 0 0 0 3 6c0 .862.305 1.867.834 2.94.524 1.062 1.234 2.12 1.96 3.07A31.481 31.481 0 0 0 8 14.58l.208-.22a31.493 31.493 0 0 0 1.998-2.35c.726-.95 1.436-2.008 1.96-3.07zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/><path fill-rule="evenodd" d="M8 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
                            <time><?php echo $addr ?></time>
                        </a>
                    </div>
                <?php else: ?>
                    <a class="post-title" href="<?php $this->permalink() ?>" target="_blank">
                        <h4><?php $this->title() ?></h4>
                    </a>
                <?php endif; ?>
            </div>
            <!--content-->
            <div class="post-content">

                <?php if ($this->fields->articleType == "link"): ?>
                    <!-- link-->
                    <?php $this->need('components/index/index-link.php'); ?>

                <?php elseif ($this->fields->articleType == "default"): ?>
                    <!-- default-->
                    <?php $this->need('components/index/index-default.php'); ?>

                <?php elseif ($this->fields->articleType == "video" || $this->fields->articleType == "bilibili"): ?>
                    <!-- videos -->
                    <?php $this->need('components/index/index-videos.php'); ?>
                <?php elseif ($this->fields->articleType == "repost"): ?>
                    <!-- repost -->
                    <?php $this->need('components/index/index-repost.php'); ?>
                <?php endif; ?>

                <?php $this->need('components/index/index-article-action.php'); ?>
            </div>
        </div>
        <?php $this->sticky(); ?>

    </article>
<?php endif; ?>

