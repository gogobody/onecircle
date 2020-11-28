<?php $name=THEME_NAME;$db=Typecho_Db::get();$sjdq=$db->fetchRow($db->select()->from('table.options')->where('name = ?','theme:'.$name));$ysj=$sjdq['value'];if(isset($_POST['type'])){if($_POST["type"]=="备份模板"){if($db->fetchRow($db->select()->from('table.options')->where('name = ?','theme:'.$name.'bf'))){$update=$db->update('table.options')->rows(array('value'=>$ysj))->where('name = ?','theme:'.$name.'bf');$updateRows=$db->query($update);?>
            <script>
                let flag = confirm("备份更新成功!");
                if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
            </script>
            <?php } else{if($ysj){$insert=$db->insert('table.options')->rows(array('name'=>'theme:'.$name.'bf','user'=>'0','value'=>$ysj));$insertId=$db->query($insert);?>
                <script>
                    let flag = confirm("备份成功!");
                    if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
                </script>
            <?php }}}if($_POST["type"]=="还原备份"){if($db->fetchRow($db->select()->from('table.options')->where('name = ?','theme:'.$name.'bf'))){$sjdub=$db->fetchRow($db->select()->from('table.options')->where('name = ?','theme:'.$name.'bf'));$bsj=$sjdub['value'];$update=$db->update('table.options')->rows(array('value'=>$bsj))->where('name = ?','theme:'.$name);$updateRows=$db->query($update);?>
            <script>
                let flag = confirm("恢复成功！");
                if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
            </script>
        <?php }else{?>
            <script>
                let flag = confirm("未备份过数据，无法恢复！");
                if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
            </script>
        <?php }?>
    <?php }?>
    <?php  if($_POST["type"]=="删除备份"){if($db->fetchRow($db->select()->from('table.options')->where('name = ?','theme:'.$name.'bf'))){$delete=$db->delete('table.options')->where('name = ?','theme:'.$name.'bf');$deletedRows=$db->query($delete);?>
            <script>
                let flag = confirm("删除成功！");
                if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
            </script>
        <?php }else{?>
            <script>
                let flag = confirm("没有备份内容，无法删除！");
                if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
            </script>
        <?php }?>
    <?php }?>
<?php }?>
<?php echo'<form class="j-backup" action="?'.$name.'bf" method="post"><input type="submit" name="type" value="备份模板" /><input type="submit" name="type" value="还原备份" /><input type="submit" name="type" value="删除备份" /></form>';?>