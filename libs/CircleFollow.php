<?php
/**
 * circle follow by gogobody
 * Class UserFollow
 */
class CircleFollow
{

    public static function init()
    {
        // create circle follow table
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        $type = explode('_', $db->getAdapterName());
        $type = array_pop($type);
        if($type == "SQLite"){
            $sql ="SELECT count(*) FROM sqlite_master WHERE type='table' AND name='".$prefix."circle_follow';";
            $checkTabel = $db->query($sql);
            $row = $checkTabel->fetchAll();
            if ($row[0]["count(*)"] == '0'){
                $res = $db->query('CREATE TABLE `' . $prefix . 'circle_follow` (
                                  `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                                  `uid` bigint(20) NOT NULL DEFAULT 0 ,
                                  `mid` bigint(20) NOT NULL DEFAULT 0 ,
                                  `createtime` int(10) DEFAULT 0 
                                )');
            }
        }else{
            $sql = 'SHOW TABLES LIKE "' . $prefix . 'circle_follow' . '"';
            $checkTabel = $db->query($sql);
            $row = $checkTabel->fetchAll();
            if ('1' == count($row)) {
            } else {
                $db->query('CREATE TABLE `' . $prefix . 'circle_follow` (
                              `id` bigint(20) NOT NULL AUTO_INCREMENT,
                              `uid` bigint(20) NOT NULL DEFAULT 0 COMMENT \'用户ID\',
                              `mid` bigint(20) NOT NULL DEFAULT 0 COMMENT \'关注meta/circle\',
                              `createtime` int(10) DEFAULT 0 COMMENT \'关注时间\',
                              PRIMARY KEY (`id`)
                            )');
            }
        }

    }

    /**
     * 添加关注
     * @param $uid
     * @param $mid
     * @return bool
     * @throws Typecho_Db_Exception
     */
    public static function addFollow($uid, $mid)
    {
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        if (is_numeric($uid) && is_numeric($mid)) {
            $row = $db->fetchRow($db->select('mid')->from('table.circle_follow')->where('uid = ?', $uid)->where('mid = ?', $mid));
            if (count($row) > 0) {
                return false;
            }
            $insert = $db->insert('table.circle_follow')->rows(array('uid' => $uid, 'mid' => $mid));
            $db->query($insert);
            return true;
        }
        return false;
    }

    /**
     * 取消关注
     * @param $uid
     * @param $mid
     * @return bool
     * @throws Typecho_Db_Exception
     */
    public static function cancleFollow($uid, $mid)
    {
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        if (is_numeric($uid) && is_numeric($mid)) {
//            $insert = $db->delete('table.circle_follow')->rows(array('uid' => $uid, 'mid' => $mid)); // delete all
            $insert = $db->delete('table.circle_follow')->where('uid = ? and mid = ?',$uid,$mid);
            $db->query($insert);
            return true;
        }
        return false;
    }

    /**
     * 检查 follow 状态
     * @param $uid
     * @param $mid
     * @return bool
     * @throws Typecho_Db_Exception
     */
    public static function statusFollow($uid, $mid)
    {
        $db = Typecho_Db::get();
        $row = $db->fetchRow($db->select('mid')->from('table.circle_follow')->where('uid = ?', $uid)->where('mid = ?', $mid));
        if (count($row) > 0) {
            return true;
        }
        return false;
    }

    /** 查询自己关注圈子数量
     * @param $uid
     * @return false|int
     * @throws Typecho_Db_Exception
     */
    public static function getFollowNum($uid)
    {
        $db = Typecho_Db::get();
        $row = $db->fetchAll($db->select()->from('table.circle_follow')->where('uid = ?', $uid));
        return count($row);
    }

    /** 查询圈子被关注数
     * @param $mid
     * @return int
     * @throws Typecho_Db_Exception
     */
    public static function getOtherFollowNum($mid)
    {
        $db = Typecho_Db::get();
        $row = $db->fetchAll($db->select()->from('table.circle_follow')->where('mid = ?', $mid));
        return count($row);
    }

    /**
     * get user follow
     * @param $uid
     * @param int $num
     * @param string $url default slug img
     * @return array
     * @throws Typecho_Db_Exception
     * @throws Typecho_Exception
     */
    public static function getFollowObj($uid, $num = 20,$url='')
    {
        $db = Typecho_Db::get();
        $arr = $db->fetchAll($db->select('mid')->from('table.circle_follow')->where('uid = ?', $uid)->limit($num));
        $newArr = [];
        $preg = '/^<(.*)>([\s\S]*)/';
        for ($i = 0; $i < count($arr) && $i < $num; $i++) {
            $categories = Typecho_Widget::widget('Widget_Metas_Category_List')->getCategory(intval($arr[$i]['mid']));
            $tmp = array();
            preg_match($preg, $categories["description"], $res); // res[0][0] 是匹配的整个串 [1] 是网址 [2]是内容
            if (isset($res[1])) { // has img
                $imgurl = $res[1];
                $desc = $res[2];
            } else {
                $imgurl = $url;
                $desc = $categories["description"];
            }
            array_push($tmp, $categories["mid"], $categories["name"], $categories["permalink"], $imgurl, $desc, $categories["count"]);
            array_push($newArr, $tmp);
        }
        return $newArr;
    }

    public static function getCircleFollowUsers($mid, $num = 20)
    {
        $db = Typecho_Db::get();
        $arr = $db->fetchAll($db->select('uid')->from('table.circle_follow')->where('mid = ?', $mid));
        $newArr = [];
        for ($i = 0; $i < count($arr) && $i < $num; $i++) {
            $obj = $db->fetchRow($db->select('uid', 'name', 'mail','screenName')->from('table.users')->where('uid = ?', $arr[$i]));
            array_push($newArr, $obj);
        }
        return $newArr;
    }

    public static function getMetaObj($mid)
    {
        $db = Typecho_Db::get();
        return $db->fetchRow($db->select('mid', 'name', 'slug','description')->from('table.metas')->where('mid = ?', $mid));

    }

    /**
     * 改变圈子的分类
     * @param $mid
     * @param $changetomid
     */
    public static function changeCircleCat($mid,$changetomid){
        $db = Typecho_Db::get();
        $update = $db->update('table.metas')->rows(array('tagid'=>$changetomid))->where('mid = ?',$mid);
        return $db->query($update);
    }
}