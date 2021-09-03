<?php

class UserMessage
{

    public static function getUserObj($uid)
    {
        $db = Typecho_Db::get();
        $obj = $db->fetchObject($db->select('uid', 'name', 'mail', 'screenName', 'userSign', 'userAvatar', 'userBackImg')
            ->from('table.users')->where('uid = ?', $uid));
        if (empty($obj->userAvatar)) {
            $obj->userAvatar = getUserV2exAvatar($obj->mail, $obj->userAvatar);
        }
        return $obj;
    }

    public static function getUnReadMsg($uid)
    {
        $db = Typecho_Db::get();
        $select = $db->select('count(id) num')->from('table.onemessages')->where('uid = ? and status = 0', $uid);
        $num = $db->fetchObject($select)->num;

        $ret = [
            'data' => [
                'num' => $num,
            ],
            'code' => 1,
            'msg' => ''
        ];
        return json_encode($ret);
    }

    public static function getAllContact($uid, $num = 20)
    {
        $db = Typecho_Db::get();

    }

    // 从登陆用户 获取 聊天对象消息
    public static function getMsg($uid, $fid, $num = 30)
    {
        $db = Typecho_Db::get();

        $select = $db->select()->from('table.onemessages')->where('uid = ? and fid = ?', $uid, $fid)
            ->orWhere('uid = ? and fid = ?', $fid, $uid)->order('created');
        $rows = $db->fetchAll($select->limit($num));

        // 更新消息为已读
        $db->query($select->update('table.onemessages')->rows(array('status'=>1)));

        $data = [];
        foreach ($rows as $value) {
            $tmp = [
                'datetime' => (new Typecho_Date($value['created']))->word(),
                'from' => $uid == $value['fid'] ? 'sender' : 'receiver',
                'id' => $value['id'],
                'text' => $value['text']

            ];
            array_push($data, $tmp);
        }
        // sender
        $sender = UserMessage::getUserObj($uid);
        $sdata = [
            'uid' => $sender->uid,
            'name' => empty($sender->screenName) ? $sender->name : $sender->screenName,
            'intro' => $sender->userSign,
            'avatar' => $sender->userAvatar
        ];
        // receiver
        $receiver = UserMessage::getUserObj($fid);
        $rdata = [
            'uid' => $receiver->uid,
            'name' => empty($receiver->screenName) ? $receiver->name : $receiver->screenName,
            'intro' => $receiver->userSign,
            'avatar' => $receiver->userAvatar
        ];

        $ret = [
            'data' => [
                'message' => $data,
                'sender' => $sdata,
                'receiver' => $rdata
            ],
            'code' => 1,
            'msg' => ''
        ];
        return json_encode($ret);

    }

    public static function createMsg($data)
    {
        $options = Helper::options();
        if(!$options->enableMessage){
            return json_encode([
                'msg' => '管理员禁用了私聊',
                'code' => 0
            ]);
        }
        $uid = $data['uid'];
        $fid = $data['fid'];
        $type = 'message';
        $text = $data['text'];
        // xss 过滤
        $text = utils::filterWords($text);
        if(strlen($text)<2){
            return json_encode([
                'msg' => '消息错误',
                'code' => 0
            ]);
        }
        $date = new Typecho_Date();
        $widget = Typecho_Widget::widget('Widget_Abstract_Messages');
        $ret = $widget->insert([
            'uid' => $uid,
            'fid' => $fid,
            'type' => $type,
            'text' => $text,
            'created' => $date->time(),
            'status' => 0 // unread
        ]);
        // sender 主动发
        $sender = UserMessage::getUserObj($fid);
        $sdata = [
            'uid' => $sender->uid,
            'name' => empty($sender->screenName) ? $sender->name : $sender->screenName,
            'intro' => $sender->userSign,
            'avatar' => $sender->userAvatar
        ];
        // receiver
        $receiver = UserMessage::getUserObj($uid);
        $rdata = [
            'uid' => $receiver->uid,
            'name' => empty($receiver->screenName) ? $receiver->name : $receiver->screenName,
            'intro' => $receiver->userSign,
            'avatar' => $receiver->userAvatar
        ];

        return json_encode([
            'data' => [
                'sender' => $sdata,
                'receiver' => $rdata
            ],
            'msg' => '',
            'code' => 1
        ]);
    }
}