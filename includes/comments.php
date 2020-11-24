<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function threadedComments($comments, $options)
{
    $options = Helper::options();
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
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
                    <a href="<?php $author_url = Typecho_Common::url('/author/'.$comments->authorId.'/',$options->index);_e($author_url)?>" rel="external nofollow">
                        <?php elseif ($comments->url): ?>
                        <a href="<?php echo $comments->url ?>" target="_blank" rel="external nofollow">
                            <?php endif; ?>
                            <img class="avatar" src="<?php echo getUserV2exAvatar($comments->mail,UserFollow::getUserObjFromMail($comments->mail)['userAvatar']); ?>" />
                            <?php $comments->author(); ?>
                            <?php if ($comments->authorId === $comments->ownerId): ?>
                                <span class="comment-author-title">作者</span>
                            <?php endif; ?>
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
                        <a href="<?php $security->index('/action/comments-edit?do=delete&coid='.$comments->coid); ?>" onclick="return p_del()"> <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                            </svg>删除</a>
                        <script>
                            function p_del() {
                                let msg = "您真的确定要删除吗？";
                                return confirm(msg);
                            }
                        </script>
                    <?php endif; ?>
                    <?php $comments->reply('<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-reply" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9.502 5.013a.144.144 0 0 0-.202.134V6.3a.5.5 0 0 1-.5.5c-.667 0-2.013.005-3.3.822-.984.624-1.99 1.76-2.595 3.876C3.925 10.515 5.09 9.982 6.11 9.7a8.741 8.741 0 0 1 1.921-.306 7.403 7.403 0 0 1 .798.008h.013l.005.001h.001L8.8 9.9l.05-.498a.5.5 0 0 1 .45.498v1.153c0 .108.11.176.202.134l3.984-2.933a.494.494 0 0 1 .042-.028.147.147 0 0 0 0-.252.494.494 0 0 1-.042-.028L9.502 5.013zM8.3 10.386a7.745 7.745 0 0 0-1.923.277c-1.326.368-2.896 1.201-3.94 3.08a.5.5 0 0 1-.933-.305c.464-3.71 1.886-5.662 3.46-6.66 1.245-.79 2.527-.942 3.336-.971v-.66a1.144 1.144 0 0 1 1.767-.96l3.994 2.94a1.147 1.147 0 0 1 0 1.946l-3.994 2.94a1.144 1.144 0 0 1-1.767-.96v-.667z"/></svg>回复'); ?>
                </div>
            </div>
            <hr/>
        </div>
        <?php if ($comments->children): ?>
            <div class="comment-children"><?php $comments->threadedComments($options); ?></div>
        <?php endif; ?>
    </li>
<?php } ?>

<div class="article-comments">
    <?php $this->comments()->to($comments);?>
    <h6 id="comments"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
        </svg> 评论区</h6>
    <hr />
    <div class="comment-detail">
        <?php if ($comments->have()): ?>
            <h6 id="comment-num"><?php $this->commentsNum(_t('暂无评论'), _t('1 条评论'), _t('%d 条评论')); ?></h6>

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
    </div>

    <?php if($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="comment-respond">
            <form method="post" action="<?php $this->commentUrl(); ?>" id="comment-form" class="comment-form" role="form">
                <?php if($this->user->hasLogin()): ?>
                    <div class="comment-respond-author">
                        <a href="<?php $this->options->profileUrl(); ?>" target="_blank" rel="external nofollow">
                            <img class="user-head" src="<?php echo getUserV2exAvatar($comments->mail,$this->user->userAvatar,40); ?>" />
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
                    <span class="OwO" data-owo="<?php $this->options->themeUrl('/assets/owo/OwO_02.json')?>"></span>
                    <input type="checkbox" id="secret-button" name="secret">
                    <label for="secret-button" class="secret-label" data-toggle="tooltip" data-placement="top" title="开启该功能，您的评论仅作者和评论双方可见">
                        <span class="circle"></span>
                    </label>
                    <button type="submit" class="submit btn comment-submit">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-square-text-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                        </svg>
                    </button>
                </div>
                <div class="comment-reply-cancel">
                    <?php $comments->cancelReply('<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg>取消'); ?>
                </div>
                <hr/>
            </form>
        </div>
    <?php if ($this->options->commentsThreaded): ?>
        <script>(function(){window.TypechoComment={dom:function(id){return document.getElementById(id)},create:function(tag,attr){var el=document.createElement(tag);for(var key in attr){el.setAttribute(key,attr[key])}return el},reply:function(cid,coid){var comment=this.dom(cid),parent=comment.parentNode,response=this.dom('<?php $this->respondId(); ?>'),input=this.dom('comment-parent'),form='form'==response.tagName?response:response.getElementsByTagName('form')[0],textarea=response.getElementsByTagName('textarea')[0];if(null==input){input=this.create('input',{'type':'hidden','name':'parent','id':'comment-parent'});form.appendChild(input)}input.setAttribute('value',coid);if(null==this.dom('comment-form-place-holder')){var holder=this.create('div',{'id':'comment-form-place-holder'});response.parentNode.insertBefore(holder,response)}comment.appendChild(response);this.dom('cancel-comment-reply-link').style.display='';if(null!=textarea&&'text'==textarea.name){textarea.focus()}return false},cancelReply:function(){var response=this.dom('<?php $this->respondId(); ?>'),holder=this.dom('comment-form-place-holder'),input=this.dom('comment-parent');if(null!=input){input.parentNode.removeChild(input)}if(null==holder){return true}this.dom('cancel-comment-reply-link').style.display='none';holder.parentNode.insertBefore(response,holder);return false}}})();</script>
    <?php endif; ?>
    <?php else: ?>
        <h2 id="comment-closed"><?php _e('评论功能已关闭'); ?></h2>
    <?php endif; ?>
</div>