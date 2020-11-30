<?php
/**
 * meta manage page
 */
$this->need('includes/header.php');
//var_dump($this->getPageRow());
$total_category_data = $this->getPageRow()["type_categories_all"];
$tags_num = count($total_category_data);
$total_tags = $this->getPageRow()["tags_all"];
define("MANAGEURL","/extending.php?panel=OneCircle%2Fmanage%2Fmanage-cat-tags.php");

?>

<?php $this->need('includes/body-layout.php');?>
<div class="hbox hbox-auto-xs hbox-auto-sm index">
    <div class="circle-management">
        <?php if ($this->user->hasLogin() and $this->user->pass('administrator', true)):?>
            <div class="alert alert-warning" role="alert">
                <button type="button" class="btn btn-light"><a target="_blank" href="<?php echo Typecho_Common::url(MANAGEURL, $this->options->adminUrl) ?>">创建圈子分类</a></button>
            </div>
        <?endif;?>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <?php if ($this->user->hasLogin()):?>
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-my-tab" data-toggle="pill" href="#pills-my" role="tab" aria-controls="pills-my" aria-selected="true">我的圈子</a>
                </li>
            <?endif;?>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?if (!$this->user->hasLogin()) _e('active');?>" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="false">所有圈子</a>
            </li>

        </ul>
        <div class="tab-content" id="pills-tabContent">
            <!--登录显示我的-->
            <?php if ($this->user->hasLogin()):?>
                <div class="tab-pane fade show active" id="pills-my" role="tabpanel" aria-labelledby="pills-my-tab">
                    <div class="row">
                        <div class="col-md-4 col-lg-3" style="border-bottom: 1px solid rgba(0,0,0,.05);">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-allmy-tab" data-toggle="pill" href="#v-pills-allmy" role="tab" aria-controls="v-pills-allmy" aria-selected="true">默认</a>

                            </div>
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <!--输出对应分类圈子-->
                                <div class="tab-pane fade show active mycicle-content" id="v-pills-allmy" role="tabpanel" aria-labelledby="v-pills-allmy-tab">
                                    <div class="mycicle-content">
                                        <?php // 顶多显示100个，多了放弃吧，看不完也没有意义
                                        $arr = CircleFollow::getFollowObj($this->user->uid,100,$this->options->defaultSlugUrl);
                                        $length = count($arr);
                                        if ($length > 0):
                                            ?>
                                            <?for ($i = 0; $i < $length; $i++): ?>
                                            <div class="circle-item">
                                                <a href="<?php echo $arr[$i][2] ?>" class="circle-item-link">
                                                    <img src="<?php echo $arr[$i][3] ?>">
                                                    <div class="circle-item-link-right">
                                                        <div class="circle-item-link-title"><?php echo $arr[$i][1] ?></div>
                                                        <div class="circle-item-link-info"><?php echo $arr[$i][4] ?></div>
                                                    </div>
                                                </a>
                                                <div class="htbt-right">
                                                    <button data-categoryid="<?php _e($arr[$i][0]) ?>"
                                                    <?php
                                                    if ($this->user->hasLogin()){
                                                        if (CircleFollow::statusFollow($this->user->uid,$arr[$i][0])){
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
                                        <?php endfor;?>
                                        <?php else:?>
                                            <div class="circle-item">
                                                <?php if ($this->user->hasLogin()): ?>
                                                    <small>还没有关注圈子~</small>
                                                <?php else:?>
                                                    <small>登录后可见</small>
                                                <?php endif;?>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--管理员显示编辑-->
                <?php if (checkCircleEditPermission($this->user->uid)):?>
                    <div class="tab-pane fade" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                        <div class="row">
                            <div class="col-md-4 col-lg-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <?php foreach($total_category_data as $k => $data):?>
                                        <?php if ($k == 'all_'):?> <!-- 所有 ，默认active-->
                                            <a class="nav-link active" id="v-pills-<?php _e($data['id']);?>-tab" data-toggle="pill" href="#v-pills-<?php _e($data['id']);?>" role="tab" aria-controls="v-pills-<?php _e($data['id']);?>" aria-selected="true"><?php _e($data['name']);?></a>
                                        <?php else:?>
                                            <a class="nav-link" id="v-pills-<?php _e($data['id']);?>-tab" data-toggle="pill" href="#v-pills-<?php _e($data['id']);?>" role="tab" aria-controls="v-pills-<?php _e($data['id']);?>" aria-selected="false"><?php _e($data['name']);?></a>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <!--输出对应分类圈子-->
                                    <?php foreach($total_category_data as $k => $data):?>
                                        <div class="tab-pane fade <?php if ($k == 'all_') _e('show active');?> mycicle-content" id="v-pills-<?php _e($data['id']);?>" role="tabpanel" aria-labelledby="v-pills-<?php _e($data['id']);?>-tab">
                                            <?php foreach ($data['categories'] as $val):?>
                                                <?php $entry = Typecho_Widget::widget('Widget_Abstract_Metas')->filter(array(
                                                    'type'=>"category",
                                                    'slug'=>$val['slug']
                                                ));
                                                $url_ = Typecho_Router::url("category", array("slug"=>$val['slug']), $this->options->index);
                                                ?>
                                                <div class="circle-item">
                                                    <a href="<?php _e($url_) ?>" class="circle-item-link">
                                                        <img src="<?php echo parseDesc2img($this->options->defaultSlugUrl,$val['description']) ?>">
                                                        <div class="circle-item-link-right">
                                                            <div class="circle-item-link-title"><?php _e($val['name']); ?></div>
                                                            <div class="circle-item-link-info"><?php echo parseDesc2text($val['description']) ?></div>
                                                        </div>
                                                    </a>

                                                    <div class="htbt-right edit-btn">
                                                        <button data-categoryid="<?php _e($val['mid']) ?>" data-name="<?php _e($val['name']); ?>" type="button">编辑</button>
                                                    </div>
                                                    <div class="htbt-right">
                                                        <button data-categoryid="<?php _e($val['mid']) ?>"
                                                        <?php
                                                        if ($this->user->hasLogin()){
                                                            if (CircleFollow::statusFollow($this->user->uid,$val['mid'])){
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
                                            <?endforeach;?>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php else:?>
                    <div class="tab-pane fade" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                        <div class="row">
                            <div class="col-md-4 col-lg-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <?php foreach($total_category_data as $k => $data):?>
                                        <?php if ($k == 'all_'):?> <!-- 所有 ，默认active-->
                                            <a class="nav-link active" id="v-pills-<?php _e($data['id']);?>-tab" data-toggle="pill" href="#v-pills-<?php _e($data['id']);?>" role="tab" aria-controls="v-pills-<?php _e($data['id']);?>" aria-selected="true"><?php _e($data['name']);?></a>
                                        <?php else:?>
                                            <a class="nav-link" id="v-pills-<?php _e($data['id']);?>-tab" data-toggle="pill" href="#v-pills-<?php _e($data['id']);?>" role="tab" aria-controls="v-pills-<?php _e($data['id']);?>" aria-selected="false"><?php _e($data['name']);?></a>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <!--输出对应分类圈子-->
                                    <?php foreach($total_category_data as $k => $data):?>
                                        <div class="tab-pane fade <?php if ($k == 'all_') _e('show active');?> mycicle-content" id="v-pills-<?php _e($data['id']);?>" role="tabpanel" aria-labelledby="v-pills-<?php _e($data['id']);?>-tab">
                                            <?php foreach ($data['categories'] as $val):?>
                                                <?php $entry = Typecho_Widget::widget('Widget_Abstract_Metas')->filter(array(
                                                    'type'=>"category",
                                                    'slug'=>$val['slug']
                                                ));
                                                $url_ = Typecho_Router::url("category", array("slug"=>$val['slug']), $this->options->index);
                                                ?>
                                                <div class="circle-item">
                                                    <a href="<?php _e($url_) ?>" class="circle-item-link">
                                                        <img src="<?php echo parseDesc2img($this->options->defaultSlugUrl,$val['description']) ?>">
                                                        <div class="circle-item-link-right">
                                                            <div class="circle-item-link-title"><?php _e($val['name']); ?></div>
                                                            <div class="circle-item-link-info"><?php echo parseDesc2text($val['description']) ?></div>
                                                        </div>
                                                    </a>

                                                    <div class="htbt-right">
                                                        <button data-categoryid="<?php _e($val['mid']) ?>"
                                                        <?php
                                                        if ($this->user->hasLogin()){
                                                            if (CircleFollow::statusFollow($this->user->uid,$val['mid'])){
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
                                            <?endforeach;?>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php endif;?>
            <?php else:?>
                <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <?php foreach($total_category_data as $k => $data):?>
                                    <?php if ($k == 'all_'):?> <!-- 所有 ，默认active-->
                                        <a class="nav-link active" id="v-pills-<?php _e($data['id']);?>-tab" data-toggle="pill" href="#v-pills-<?php _e($data['id']);?>" role="tab" aria-controls="v-pills-<?php _e($data['id']);?>" aria-selected="true"><?php _e($data['name']);?></a>
                                    <?php else:?>
                                        <a class="nav-link" id="v-pills-<?php _e($data['id']);?>-tab" data-toggle="pill" href="#v-pills-<?php _e($data['id']);?>" role="tab" aria-controls="v-pills-<?php _e($data['id']);?>" aria-selected="false"><?php _e($data['name']);?></a>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <!--输出对应分类圈子-->
                                <?php foreach($total_category_data as $k => $data):?>
                                    <div class="tab-pane fade <?php if ($k == 'all_') _e('show active');?> mycicle-content" id="v-pills-<?php _e($data['id']);?>" role="tabpanel" aria-labelledby="v-pills-<?php _e($data['id']);?>-tab">
                                        <?php foreach ($data['categories'] as $val):?>
                                            <?php $entry = Typecho_Widget::widget('Widget_Abstract_Metas')->filter(array(
                                                'type'=>"category",
                                                'slug'=>$val['slug']
                                            ));
                                            $url_ = Typecho_Router::url("category", array("slug"=>$val['slug']), $this->options->index);
                                            ?>
                                            <div class="circle-item">
                                                <a href="<?php _e($url_) ?>" class="circle-item-link">
                                                    <img src="<?php echo parseDesc2img($this->options->defaultSlugUrl,$val['description']) ?>">
                                                    <div class="circle-item-link-right">
                                                        <div class="circle-item-link-title"><?php _e($val['name']); ?></div>
                                                        <div class="circle-item-link-info"><?php echo parseDesc2text($val['description']) ?></div>
                                                    </div>
                                                </a>
                                                <div class="htbt-right">
                                                    <button data-categoryid="<?php _e($val['mid']) ?>"
                                                    <?php
                                                    if ($this->user->hasLogin()){
                                                        if (CircleFollow::statusFollow($this->user->uid,$val['mid'])){
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
                                        <?endforeach;?>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>

                </div>
            <?endif;?>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="changeCatagModal" tabindex="-1" data-backdrop="false" aria-labelledby="changeCatagModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeCatagModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="selectCircle">当前圈子</label>
                            <input type="text" class="form-control" id="selectCircle" placeholder="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="changeCircle">更改分类</label>
                            <select class="form-control" id="changeCircle">
                                <?php foreach($total_tags as $k => $data):?>
                                    <option value="<?_e($data['id'])?>"><?_e($data['name'])?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="circle-edit-save">保存</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->need('includes/body-layout-end.php');?>


<?php
$this->need('includes/footer.php');
?>

