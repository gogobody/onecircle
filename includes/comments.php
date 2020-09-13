<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function threadedComments($comments, $options)
{
  $commentClass = '';
  if ($comments->authorId) {
    if ($comments->authorId == $comments->ownerId) {
      $commentClass .= ' comment-by-author';
    } else {
      $commentClass .= ' comment-by-user';
    }
  }
  $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
  ?>
<li class="comment-list-item<?php
  if ($comments->levels > 0) {
    echo ' comment-child';
  } else {
    echo ' comment-parent';
  }
  echo $commentClass;
?>">

    <div id="<?php $comments->theId(); ?>" class="comment-body">
        <div class="comment-meta">
            <div class="comment-author">
              <?php if ($comments->authorId > 0): ?>
                <a href="/author/<?php echo $comments->authorId ?>" rel="external nofollow">
              <?php elseif ($comments->url): ?>
                <a href="<?php echo $comments->url ?>" target="_blank" rel="external nofollow">
              <?php endif; ?>
              <img class="avatar" src="//cdn.v2ex.com/gravatar/<?php echo $comments->mail?md5($comments->mail):''; ?>?s=64&d=mp" />
              <?php $comments->author(); ?>
              <?php if ($comments->authorId === $comments->ownerId): ?>
              <span class="comment-author-title">作者</span>
              <?php endif ?>
              <?php if ($comments->authorId > 0 || $comments->url): ?>
                </a>
              <?php endif; ?>
            </div>
            <div class="comment-time"><?php $comments->date('Y年m月d日'); ?></div>
            <?php 
              $pcomments = get_comment($comments->parent);
              if($pcomments) echo '<code style="float:left;margin:.1em .5em;padding:0;font-size:.9em;">@'.$pcomments['author'].'</code>';
            ?>
            <div class="comment-content">
                 <?php $comments->content();?>
            </div>
            <div class="comment-reply">
              <?php 
                if(in_array(get_user_group(), ['administrator', 'editor'])):
                  Typecho_Widget::widget('Widget_Security')->to($security);
              ?>
              <a href="<?php $security->index('/action/comments-edit?do=delete&coid='.$comments->coid); ?>" onclick="return p_del()"> 删除</a>
                    <script>
                        function p_del() {
                            let msg = "您真的确定要删除吗？";
                            return confirm(msg);
                        }
                    </script>
              <?php endif ?>
              <?php $comments->reply('回复') ?>
            </div>
        </div>
        <hr />
    </div>
    <?php if ($comments->children): ?>
    <div class="comment-children"><?php $comments->threadedComments($options); ?></div>
    <?php endif; ?>
</li>
<?php } ?>

<div class="article-comments">
    <?php 
      $this->comments()->to($comments);
    ?>
    <h1 id="comments">评论区</h1>
    <hr />

    <?php if ($comments->have()): ?>
    <h2 id="comment-num"><?php $this->commentsNum(_t('暂无评论'), _t('1 条评论'), _t('%d 条评论')); ?></h2>

    <?php $comments->listComments(); ?>
    <div class="page-pagination">
    <?php
        $comments->pageNav(
                '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-double-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                  <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                </svg>',
            '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-double-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
              <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg>',
                3, '...', array(
            'wrapTag' => 'ul',
            'wrapClass' => 'pagination justify-content-center',
            'itemTag' => 'li',
            'itemClass' => 'page-item',
            'linkClass' => 'page-link',
            'currentClass' => 'active'
        ));
    ?>
    </div>
    <?php endif; ?>

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="comment-respond">
        <form method="post" action="<?php $this->commentUrl() ?>" class="comment-form" role="form">
            <?php if($this->user->hasLogin()): ?>
            <div class="comment-respond-author">
              <a href="<?php $this->options->profileUrl(); ?>" target="_blank" rel="external nofollow">
                  <img class="user-head" src="//cdn.v2ex.com/gravatar/<?php echo md5($this->user->mail); ?>?s=80&d=mp" />
              </a>
            </div>
            <?php else: ?>
            <div class="comment-respond-author">
                <img class="user-head" src="//cdn.v2ex.com/gravatar/<?php echo ''; ?>?s=64&d=mp" />
              <div class="form-row">
                  <div class="col-6 col-md-4">
                    <input type="text" name="author" class="form-control form-control-sm" 
                        placeholder="昵称" required value="<?php $this->remember('author'); ?>" />
                  </div>
                  <div class="col-6 col-md-4">
                    <input type="text" name="url" class="form-control form-control-sm" 
                        placeholder="网站" value="<?php $this->remember('url'); ?>"
                        <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                  </div>
                  <div class="col">
                    <input type="text" name="mail" class="form-control form-control-sm" 
                        placeholder="邮箱" value="<?php $this->remember('mail'); ?>"
                        <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                  </div>
              </div>
            </div>
            <?php endif; ?>
            <div class="comment-action">
                <textarea type="text" class="textarea-container form-control owo-textarea" rows="4" name="text" id="textarea" placeholder="发条友善的评论" required></textarea>
                <span class="OwO"></span>
                <input type="checkbox" id="secret-button" name="secret">
                <label for="secret-button" class="secret-label" data-toggle="tooltip" data-placement="top" title="开启该功能，您的评论仅作者和评论双方可见">
                    <span class="circle"></span>
                </label>
                <button type="submit" class="submit btn comment-submit">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cursor" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103zM2.25 8.184l3.897 1.67a.5.5 0 0 1 .262.263l1.67 3.897L12.743 3.52 2.25 8.184z"/>
                    </svg>
                </button>
            </div>
            <div class="comment-reply-cancel">
                <?php $comments->cancelReply('取消'); ?>
            </div>
            <hr/>
        </form>
    </div>
    <?php else: ?>
    <h2 id="comment-closed"><?php _e('评论功能已关闭'); ?></h2>
    <?php endif; ?>
</div>