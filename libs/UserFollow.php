<?php

class UserFollow
{

    public static function init()
    {
// create circle follow table
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        $type = explode('_', $db->getAdapterName());
        $type = array_pop($type);
        if($type == "SQLite"){
            $sql ="SELECT count(*) FROM sqlite_master WHERE type='table' AND name='".$prefix."user_follow';";
            $checkTabel = $db->query($sql);
            $row = $checkTabel->fetchAll();
            if ($row[0]["count(*)"] == '0'){
                $db->query('CREATE TABLE `' . $prefix . 'user_follow` (
                                  `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                                  `uid` bigint(20) NOT NULL DEFAULT 0 ,
                                  `fid` bigint(20) NOT NULL DEFAULT 0 ,
                                  `createtime` int(10) DEFAULT 0 
                                )');
            }
        }else{
            $sql = 'SHOW TABLES LIKE "' . $prefix . 'user_follow' . '"';
            $checkTabel = $db->query($sql);
            $row = $checkTabel->fetchAll();
            if ('1' == count($row)) {
            } else {
                $db->query('CREATE TABLE `' . $prefix . 'user_follow` (
                                  `id` bigint(20) NOT NULL AUTO_INCREMENT,
                                  `uid` bigint(20) NOT NULL DEFAULT 0 COMMENT \'用户ID\',
                                  `fid` bigint(20) NOT NULL DEFAULT 0 COMMENT \'关注用户ID\',
                                  `createtime` int(10) DEFAULT 0 COMMENT \'关注时间\',
                                  PRIMARY KEY (`id`)
                                )');
            }
        }
    }

    /**
     * 添加关注
     * @param $uid
     * @param $fid
     * @return bool
     * @throws Typecho_Db_Exception
     */
    public static function addFollow($uid, $fid)
    {
        if ($uid == $fid) {
            return false;
        }
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        if (is_numeric($uid) && is_numeric($fid)) {
            $row = $db->fetchRow($db->select('fid')->from('table.user_follow')->where('uid = ?', $uid)->where('fid = ?', $fid));
            if (count($row) > 0) {
                return false;
            }
            $insert = $db->insert('table.user_follow')->rows(array('uid' => $uid, 'fid' => $fid));
            $db->query($insert);
            return true;
        }
        return false;
    }

    /**
     * 取消关注
     * @param $uid
     * @param $fid
     * @return bool
     * @throws Typecho_Db_Exception
     */
    public static function cancleFollow($uid, $fid)
    {
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        if (is_numeric($uid) && is_numeric($fid)) {
//            $insert = $db->delete('table.user_follow')->rows(array('uid' => $uid, 'fid' => $fid));
            $insert = $db->delete('table.user_follow')->where('uid = ? and fid = ?',$uid,$fid);
            $db->query($insert);
            return true;
        }
        return false;
    }

    /**
     * 检查 follow 状态
     * @param $uid
     * @param $fid
     * @return bool
     * @throws Typecho_Db_Exception
     */
    public static function statusFollow($uid, $fid)
    {
        $db = Typecho_Db::get();
        $row = $db->fetchRow($db->select('fid')->from('table.user_follow')->where('uid = ?', $uid)->where('fid = ?', $fid));
        if (count($row) > 0) {
            return true;
        }
        return false;
    }

    /** 查询自己关注别人数量
     * @param $uid
     * @param $fid
     * @return false|int
     * @throws Typecho_Db_Exception
     */
    public static function getFollowNum($uid)
    {
        $db = Typecho_Db::get();
        $row = $db->fetchAll($db->select()->from('table.user_follow')->where('uid = ?', $uid));
        return count($row);
    }

    /** 查询被关注数
     * @param $uid
     * @return int
     * @throws Typecho_Db_Exception
     */
    public static function getOtherFollowNum($uid)
    {
        $db = Typecho_Db::get();
        $row = $db->fetchAll($db->select()->from('table.user_follow')->where('fid = ?', $uid));
        return count($row);
    }

    public static function getFollowObj($uid, $num = 20)
    {
        $db = Typecho_Db::get();
        $arr = $db->fetchAll($db->select('fid')->from('table.user_follow')->where('uid = ?', $uid));
        $newArr = [];
        for ($i = 0; $i < count($arr) && $i < $num; $i++) {
            $obj = $db->fetchRow($db->select('uid', 'name', 'mail','screenName','userSign','userAvatar','userBackImg')->from('table.users')->where('uid = ?', $arr[$i]));
            array_push($newArr, $obj);
        }
        return $newArr;
    }

    public static function getOtherFollowObj($uid, $num = 20)
    {
        $db = Typecho_Db::get();
        $arr = $db->fetchAll($db->select('uid')->from('table.user_follow')->where('fid = ?', $uid));
        $newArr = [];
        for ($i = 0; $i < count($arr) && $i < $num; $i++) {
            $obj = $db->fetchRow($db->select('uid', 'name', 'mail','screenName','userSign','userAvatar','userBackImg')->from('table.users')->where('uid = ?', $arr[$i]));
            array_push($newArr, $obj);
        }
        return $newArr;
    }

    /**
     * @param $uid
     * @return array|mixed
     * @throws Typecho_Db_Exception
     */
    public static function getUserObj($uid)
    {
        $db = Typecho_Db::get();
        return $db->fetchRow($db->select('uid','name','mail','userSign','userAvatar','userBackImg')->from('table.users')->where('uid = ?', $uid));

    }

    public static function getUserObjFromMail($mail)
    {
        $db = Typecho_Db::get();
        return $db->fetchRow($db->select('uid','name','mail','userSign','userAvatar','userBackImg')->from('table.users')->where('mail = ?', $mail));
    }
}