<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * archive 显示 author
 *
 */
?>
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
                <div class="sc-AxjAm kkFELj"><?php _e($this->getPageRow()['userSign']);?></div>
            </div>
            <div class="sc-AxjAm sc-AxirZ  cXyaML">
                <div class="sc-AxjAm bHdldX  fXkMMP">
                    <img src="https://cdn.jellow.site/resources/userProfile/male@3x_6.0.png" class="sc-AxjAm hzfjJS">
                </div>
                <? foreach(utils::parseUserTag($this->getPageRow()['userTag']) as $val):?>
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
