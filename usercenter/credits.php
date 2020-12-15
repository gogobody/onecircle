<?php
/**
 * credits  page
 */
$this->need('includes/header.php');
$author_url = Typecho_Common::url('/author/' . $this->user->uid . '/', $this->options->index);
Typecho_Widget::widget('Widget_Security')->to($security);
$credits_arr = utils::creditsConvert($this->user->credits);

?>

<?php $this->need('includes/body-layout.php'); ?>
<div class="hbox hbox-auto-xs hbox-auto-sm index">
    <div class="col center-part">
        <div class="main-content">
            <!-- 主体 -->
            <div class="page">
                <div class="usercenter-container">
                    <?php $this->need('components/usercenter/aside.php')?>
                    <div class="right-panel">
                        <aside>
                            <header class="header bg-light lt">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#credits_" data-toggle="tab" aria-expanded="true">我的积分</a>
                                    </li>
                                </ul>
                            </header>
                            <section>
                                <div class="tab-content wrapper bg-white">
                                    <div class="tab-pane active" id="credits_">
                                        <div class="panel no-borders">
                                        <div class="row wrapper">
                                            <div class="col-sm-6">
                                                <label>当前积分</label>
                                                <div class="value">
                                                    <span class="coin">
                                                        <?php if ($this->user->credits == 0 ):?><span class="copper">0</span>
                                                        <?php else:?>
                                                            <?php if (!empty($credits_arr[0])):?><span class="gold"><?php _e($credits_arr[0]);?></span><?php endif;?>
                                                            <?php if (!empty($credits_arr[1])):?><span class="silver"><?php _e($credits_arr[1]);?></span><?php endif;?>
                                                            <?php if (!empty($credits_arr[2])):?><span class="copper"><?php _e($credits_arr[2]);?></span><?php endif;?>
                                                        <?php endif;?>
                                                    </span>
                                                    <a style="font-size: 12px" href="javascript:alert('开发中')" data-dev="" class="btn btn-xs btn-danger pull-right">兑换</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive bg-white">
                                            <table class="table table-striped b-t b-light">
                                                <thead>
                                                <tr><th>时间</th>
                                                    <th>类型</th>
                                                    <th>数额</th>
                                                    <th>余额</th>
                                                    <th>描述</th>
                                                </tr></thead>
                                                <tbody>
                                                <?php if($this->credits->have()):?>
                                                    <?php while ($this->credits->next()):?>
                                                        <tr>
                                                            <td><small class="gray"><?php $this->credits->date('Y-m-d H:i:s');?></small></td>
                                                            <td><?php $this->credits->name();?></td>
                                                            <td><span class="positive"><strong><?php $this->credits->amount();?></strong></span></td>
                                                            <td><?php $this->credits->balance();?></td>
                                                            <td class="d" style="border-right: none;"><span class="gray"><?php $this->credits->remark();?> <strong class="positive"><?php $this->credits->amount();?></span></strong></td>
                                                        </tr>
                                                    <?php endwhile;?>
                                                <?php endif;?>
                                                </tbody>
                                            </table>
                                        </div>
                                            <div class="inner pager">
                                                <?php $this->credits->pageLink('上一页','prev');?>
                                                <?php echo $this->credits->getCurrentPage();?>/<?php echo $this->credits->getTotalPage();?>
                                                <?php $this->credits->pageLink('下一页','next');?>
                                            </div>
                                        <div class="panel-footer"></div>

                                    </div>
                                    </div>
                                </div>
                            </section>

                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script crossorigin="anonymous" integrity="sha384-LVoNJ6yst/aLxKvxwp6s2GAabqPczfWh6xzm38S/YtjUyZ+3aTKOnD/OJVGYLZDl" src="//lib.baomitu.com/jquery/3.5.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#personal-OneCircle>h3").hide()
        $('form ul.typecho-option li').addClass("form-group d-flex d-flex-wrap")
        $('form ul.typecho-option li label').addClass("col-sm-2 col-form-label")
        var ty_form_input = $('form ul.typecho-option li>input')
        ty_form_input.addClass("form-control col-sm-10")
        $('form ul.typecho-option li span > label').addClass("radio-label")
        $(".typecho-option.typecho-option-submit > li > button").addClass("btn-dark")
        var errmsg = $(".message.error")
        if(errmsg.length > 0){
            var text = errmsg.text()
            var html = '<div class="alert alert-danger" role="alert">\n' +text +'</div>'
            $(".page").prepend(html)
        }
    })
</script>
<?php $this->need('includes/footer.php'); ?>
