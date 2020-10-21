<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?// $this->setDefault(array('order'=>'table.contents.views','desc'=>true));var_dump($this);?>
<?php
    $tArr = utils::parseUrlQuery(utils::GetCurUrl());
    if (count($tArr) == 0){
        $tabIndex = 0;
    }else{
        $tabIndex = $tArr['tabindex'];
    }
    if ($tabIndex == 3) {
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
//        $this->setTotal($this->length);

    }



?>
<?php $this->need('includes/header.php'); ?>

<div class="container-lg" id="pjax-container">
    <div class="row">
        <?php $this->need('includes/nav.php'); ?>
        <div class="col-xl-10 col-md-10 col-12 achieve-container">
            <?php if ($this->is('author')): ?>
                <div class="vxeHw">
                    <div class="kojXeB">
                        <div class="ivcfJN" style="background-image: url(<?php echo getV2exAvatar($this) ?>)">
                            <div class="iNTHKr"></div>
                        </div>
                    </div>
                    <div class="biCwrr">
                        <div class="sc-AxjAm sc-AxirZ fUlriR">
                            <div class="sc-AxjAm sc-AxirZ jnzuaU"><img src="<?php echo getV2exAvatar($this) ?>" class="sc-AxjAm irFFsx"></div>
                            <h2 class="sc-AxjAm dDtTVx"><?php echo $this->author() ?></h2>
                            <div class="sc-AxjAm sc-AxirZ dZfkqf">
                                <a href="" class="sc-AxjAm OAorY  ffrrSB"><span><? _e(UserFollow::getFollowNum($this->author->uid));?></span> 关注</a>
                                <a href="" class="sc-AxjAm OAorY  dDeaQZ"><span><? _e(UserFollow::getOtherFollowNum($this->author->uid));?></span> 被关注</a>
                            </div>
                            <div class="sc-AxjAm sc-AxirZ iiMLXg">
                                <div class="sc-AxjAm kkFELj"><?php _e($this->author->userSign);?>
                                </div>
                            </div>
                            <div class="sc-AxjAm sc-AxirZ  cXyaML">
                                <div class="sc-AxjAm bHdldX  fXkMMP">
                                    <img src="https://cdn.jellow.site/resources/userProfile/male@3x_6.0.png" class="sc-AxjAm hzfjJS">
                                </div>
                                <? foreach(utils::parseUserTag($this->author->userTag) as $val):?>
                                <div class="sc-AxjAm hXeItE  fXkMMP"><? _e($val);?></div>
                                <? endforeach;?>
                            </div>
                        </div>
                        <div class="sc-AxjAm sc-AxirZ kLKIKx">
                            <button data-authorid="<? echo $this->author->uid ?>"
                                <?php
                                if ($this->user->hasLogin()){
                                    if (UserFollow::statusFollow($this->user->uid,$this->author->uid)){
                                        echo 'class="fansed fan-event">已关注';
                                    }else{
                                        echo 'class="fans fan-event">关注';
                                    }
                                }else{
                                    echo 'class="fans fan-event">关注';
                                }
                                ?>
                            </button>
                        </div>
                    </div>
                </div>
            <?php elseif ($this->is('category')): ?>
                <div class="achieve-header">
                    <div class="achieve-header-top">
                        <div class="header-top-img"
                             style='background-image: url(<?php _e(parseDesc2img($this->options->defaultSlugUrl,$this->categories[0]['description'])); ?>)'>
                            <div class="header-top-img-inner"></div>
                        </div>
                    </div>

                    <div class="header-top-bottom">
                        <div class="header-top-bottom-avatar"><img src="<?php
                            $imgurl = parseDesc2img($this->options->defaultSlugUrl,$this->getDescription());
                            if ($imgurl) {
                                _e($imgurl);
                            } else {
                                _e($this->options->defaultSlugUrl());
                            } ?>" alt="">
                        </div>
                        <div class="header-top-bottom-text">
                            <div class="htbt-left">
                                <h2><?php _e($this->getArchiveTitle()) ?></h2>
                                <div class="htbt-intr">
                                    <div class="htbt-intr-text">
                                        <?php if ($this->getTotal() > 0) {
                                            echo '已经发布了' . $this->getTotal() . '条post，快来一起讨论吧';
                                        } else {
                                            echo '还没有人发布post，快来发布一条';
                                        } ?></div>
                                </div>
                            </div>
                            <div class="htbt-right">
                                <button data-categoryid="<? echo $this->getPageRow()['mid'] ?>"
                                <?php
                                if ($this->user->hasLogin()){
                                    if (CircleFollow::statusFollow($this->user->uid,$this->getPageRow()['mid'])){
                                        echo 'class="fansed circle-event">已加入';
                                    }else{
                                        echo 'class="fans circle-event">加入';
                                    }
                                }else{
                                    echo 'class="fans circle-event">加入';
                                }
                                ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="achieve-content">
                <div class="col-12 col-md-8 outer">

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
                            <div class="react-tabs__tab-panel react-tabs__tab-panel--selected">
                                <?php if ($this->have()&&$tabIndex==0): ?>
                                    <?php while ($this->next()): ?>
                                        <div class="item-inner">
                                            <? $this->need('components/index/article-content.php'); ?>
                                        </div>
                                    <?php endwhile; ?>
                                <?php elseif($tabIndex==1):?>
                                    <?php $fobj = UserFollow::getFollowObj($this->author->uid);?>
                                    <?php if (count($fobj)>0):?>
                                    <?php for($i=0;$i<count($fobj);$i++): ?>
                                        <div class="sc-AxjAm sc-AxirZ kQHfHM bITJVr">
                                            <a href="/author/<?php _e($fobj[$i]['uid'])?>"
                                               class="sc-AxjAm sc-AxirZ eGdPrb"><img
                                                        src="<?php _e(getUserV2exAvatar($fobj[$i]['mail']))?>"
                                                        alt="再多一点可爱" class="sc-AxjAm jZLHXc">
                                                <div  class="sc-AxjAm sc-AxirZ hkyonN">
                                                    <div class="sc-AxjAm oDrAC"><?php _e($fobj[$i]['name'])?></div>
                                                    <div class="sc-AxjAm hHqHSX ezzhLs"><?php _e($this->user->userSign);?></div>
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
                                    <?php $fobj = UserFollow::getOtherFollowObj($this->author->uid);?>
                                    <?php if (count($fobj)>0):?>

                                        <?php for ($i = 0; $i < count($fobj); $i++): ?>
                                        <div class="sc-AxjAm sc-AxirZ kQHfHM bITJVr">
                                            <a href="/author/<?php _e($fobj[$i]['uid'])?>"
                                               class="sc-AxjAm sc-AxirZ eGdPrb"><img
                                                        src="<?php _e(getUserV2exAvatar($fobj[$i]['mail']))?>"
                                                        alt="再多一点可爱" class="sc-AxjAm jZLHXc">
                                                <div  class="sc-AxjAm sc-AxirZ hkyonN">
                                                    <div class="sc-AxjAm oDrAC"><?php _e($fobj[$i]['name'])?></div>
                                                    <div class="sc-AxjAm hHqHSX ezzhLs"><?php _e($this->user->userSign);?></div>
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
                                <?php elseif($tabIndex==3):?>
                                    <?php while ($this->next()): ?>
                                        <div class="item-inner">
                                            <? $this->need('components/index/article-content.php'); ?>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <article class="post-article">
                                        <h6 class="post-title"><?php _e('还没有发布内容'); ?></h6>
                                    </article>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                    <?php if ($tabIndex==0 || $tabIndex == 3){$this->need('includes/pagination.php');} ?>

                </div>
                <?php $this->need('includes/achieve-right.php'); ?>
            </div>

        </div>
    </div>
</div>

<?php $this->need('includes/footer.php'); ?>
