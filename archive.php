<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
    $tArr = utils::parseUrlQuery(utils::GetCurUrl());
    if (count($tArr) == 0){
        $tabIndex = 0;
    }else{
        $tabIndex = $tArr['tabindex'];
    }
    if ($tabIndex == 3) { // 热门标签，根据点赞量排序
        //清空原有文章的列队
        $this->row = [];
        $this->stack = [];
        $this->length = 0;

        $db = Typecho_Db::get();

        $sqlt = $this->getCountSql();
        $sqlt->order('views',Typecho_Db::SORT_DESC);
//    var_dump($sqlt->__toString());

        $this->setCountSql($sqlt);
//    var_dump($this->getCountSql()->__toString());
        $sqlt_clone = clone $sqlt;
        $cnt = $this->size($sqlt_clone); // 获取 sql 结果数量
        $sqlt->page($this->_currentPage, $this->parameter->pageSize);
        $achives_ = $db->fetchAll($sqlt);
        foreach($achives_ as $_post) $this->push($_post); //压入列队
        $this->setTotal($cnt);
//        $this->setTotal($this->length)
    }
?>
<?php $this->need('includes/header.php'); ?>

<?php $this->need('includes/body-layout.php');?>
    <div class="hbox hbox-auto-xs hbox-auto-sm archive">
        <div class="archive-container">
            <?php if ($this->is('author')): ?>
                <?php $this->need('components/archive/archive-author.php') ?>
            <?php elseif ($this->is('category')): ?>
                <?php $this->need('components/archive/archive-category.php') ?>
            <?php endif; ?>
            <div class="archive-content tabindex-<?_e($tabIndex);?>">
                <div class="outer">
                    <div class="react-tabs" data-tabs="true">
                        <div class="line"></div>
                        <ul class="react-tabs__tab-list">
                            <li id="react-tabs-1" data-tabindex="0" class="react-tabs__tab <?if($tabIndex==0){_e("react-tabs__tab--selected");}?>">动态</li>
                            <?php if ($this->is('author')):?>
                            <li id="react-tabs-2" data-tabindex="1" class="react-tabs__tab <?if($tabIndex==1){_e("react-tabs__tab--selected");}?>">关注</li>
                            <li id="react-tabs-3" data-tabindex="2" class="react-tabs__tab <?if($tabIndex==2){_e("react-tabs__tab--selected");}?>">被关注</li>

                            <?php else:?>
                            <li id="react-tabs-4" data-tabindex="3" class="react-tabs__tab <?if($tabIndex==3){_e("react-tabs__tab--selected");}?>">热门</li>
                            <?php endif;?>
                        </ul>
                        <div class="item-container">
                            <div class="list react-tabs__tab-panel react-tabs__tab-panel--selected">
                                <?php if ($this->have()&&$tabIndex==0): ?>
                                    <?php while ($this->next()): ?>
                                        <?php $this->need('components/index/article-content.php'); ?>
                                    <?php endwhile; ?>
                                <?php elseif($tabIndex==1):?>
                                    <?php $fobj = UserFollow::getFollowObj($this->getPageRow()['uid']);?>
                                    <?php if (count($fobj)>0):?>
                                    <?php for($i=0;$i<count($fobj);$i++): ?>
                                        <div class="sc-AxjAm sc-AxirZ kQHfHM bITJVr">
                                            <a href="<?php $author_url = Typecho_Common::url('/author/'.$fobj[$i]['uid'].'/',$this->options->index);_e($author_url)?>"
                                               class="sc-AxjAm sc-AxirZ eGdPrb"><img
                                                        src="<?php _e(getUserV2exAvatar($fobj[$i]['mail'],$fobj[$i]['userAvatar']))?>"
                                                        alt="再多一点可爱" class="sc-AxjAm jZLHXc">
                                                <div  class="sc-AxjAm sc-AxirZ hkyonN">
                                                    <div class="sc-AxjAm oDrAC"><?php _e($fobj[$i]['name'])?></div>
                                                    <div class="sc-AxjAm hHqHSX ezzhLs"><?php _e($fobj[$i]['userSign']);?></div>
                                                </div>
                                            </a>

                                            <div class="sc-AxjAm sc-AxirZ hsyNhw">
                                                <button data-authorid="<?php _e($fobj[$i]['uid'])?>" <?php
                                                if ($this->user->hasLogin()){
                                                    if (UserFollow::statusFollow($this->user->uid,$fobj[$i]['uid'])){
                                                        echo 'class="fansed-little fan-event">已关注';
                                                    }else{
                                                        echo 'class="fans-little fan-event">关注';
                                                    }
                                                }else{
                                                    echo 'class="fans-little fan-event">关注';
                                                }
                                                ?>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endfor;?>
                                    <?php else:?>
                                        <article class="post-article">
                                            <h6 class="post-title"><?php _e('还没关注别人'); ?></h6>
                                        </article>
                                    <?php endif ?>
                                <?php elseif($tabIndex==2):?>
                                    <?php $fobj = UserFollow::getOtherFollowObj($this->getPageRow()['uid']);?>
                                    <?php if (count($fobj)>0):?>

                                        <?php for ($i = 0; $i < count($fobj); $i++): ?>
                                        <div class="sc-AxjAm sc-AxirZ kQHfHM bITJVr">
                                            <a href="<?php $author_url = Typecho_Common::url('/author/'.$fobj[$i]['uid'].'/',$this->options->index);_e($author_url)?>"
                                               class="sc-AxjAm sc-AxirZ eGdPrb"><img
                                                        src="<?php _e(getUserV2exAvatar($fobj[$i]['mail'],$fobj[$i]['userAvatar']))?>"
                                                        alt="再多一点可爱" class="sc-AxjAm jZLHXc">
                                                <div  class="sc-AxjAm sc-AxirZ hkyonN">
                                                    <div class="sc-AxjAm oDrAC"><?php _e($fobj[$i]['name'])?></div>
                                                    <div class="sc-AxjAm hHqHSX ezzhLs"><?php _e($fobj[$i]['userSign']);?></div>
                                                </div>
                                            </a>
                                            <div class="sc-AxjAm sc-AxirZ hsyNhw">
                                                <button data-authorid="<?php _e($fobj[$i]['uid'])?>" <?php
                                                if ($this->user->hasLogin()){
                                                    if (UserFollow::statusFollow($this->user->uid,$fobj[$i]['uid'])){
                                                        echo 'class="fansed-little fan-event">已关注';
                                                    }else{
                                                        echo 'class="fans-little fan-event">关注';
                                                    }
                                                }else{
                                                    echo 'class="fans-little fan-event">关注';
                                                }
                                                ?>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endfor;?>
                                    <?php else:?>
                                    <article class="post-article">
                                        <h6 class="post-title"><?php _e('还没有人关注你哦'); ?></h6>
                                    </article>
                                    <?php endif ?>
                                <?php elseif($tabIndex==3 && $this->have()):?>
                                    <?php while ($this->next()): ?>
                                        <?php $this->need('components/index/article-content.php'); ?>
                                    <?php endwhile; ?>

                                <?php else: ?>
                                    <article class="post-article">
                                        <h6 class="post-title"><?php _e('还没有发布内容'); ?></h6>
                                    </article>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                    <?php if ($tabIndex==0 || $tabIndex == 3){$this->need('includes/post-pagination.php');} ?>

                </div>
                <?php $this->need('includes/archive-right.php'); ?>
            </div>

        </div>
    </div>
<?php $this->need('includes/body-layout-end.php');?>
<?php $this->need('includes/footer.php'); ?>
