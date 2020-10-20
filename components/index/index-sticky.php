<?php
/**
 * login required
 * 文章置顶 + 只显示 关注的 category 的文章
 */
$sticky = $this->options->sticky; //置顶的文章cid，按照排序输入, 请以半角逗号或空格分隔
if($sticky && $this->is('index') || $this->is('front')){
    $sticky_cids = explode(',', strtr(trim($sticky), ' ', ','));//分割文本
    $sticky_html = "<span class='sticky-icon'>Sticky</span>"; //置顶标题的 html
    $db = Typecho_Db::get();
    $pageSize = $this->options->pageSize;
    // login required
    $usermids_arr =[];
    $usermids = $db->fetchAll($db->select('mid')->from('table.circle_follow')->where('uid = ?',$this->user->uid));
    foreach ($usermids as $usermid) array_push($usermids_arr,intval($usermid['mid']));
    if (!empty($usermids_arr)){
        $select1 = $this->select()->where('type = ?', 'post')
            ->join('table.relationships', 'table.contents.cid = table.relationships.cid',Typecho_Db::LEFT_JOIN)->where('table.relationships.mid in ?',$usermids_arr);
        $select2 = $this->select()->where('type = ? && status = ? && created < ?', 'post','publish',time())
            ->join('table.relationships', 'table.contents.cid = table.relationships.cid',Typecho_Db::LEFT_JOIN)->where('table.relationships.mid in ?',$usermids_arr);

    }else{
        $select1 = $this->select()->where('type = ?', 'post');
        $select2 = $this->select()->where('type = ? && status = ? && created < ?', 'post','publish',time());
    }
    //清空原有文章的列队
    $this->row = [];
    $this->stack = [];
    $this->length = 0;
    $order = '';

    // select 只显示 关注的 category里面的
    foreach($sticky_cids as $i => $cid) {
        if($i == 0) $select1->where('table.contents.cid = ?', $cid);
        else $select1->orWhere('table.contents.cid = ?', $cid);
        $order .= " when $cid then $i";
        $select2->where('table.contents.cid != ?', $cid); //避免重复
    }
    $contents_name = $db->getPrefix().'contents';
    if ($order) $select1->order(null,"(case $contents_name.cid$order end)"); //置顶文章的顺序 按 $sticky 中 文章ID顺序

    if ($this->_currentPage == 1) foreach($db->fetchAll($select1) as $sticky_post){ //首页第一页才显示
        $sticky_post['sticky'] = $sticky_html;
        $this->push($sticky_post); //压入列队
    }
    $uid = $this->user->uid; //登录时，显示用户各自的私密文章
    if($uid) $select2->orWhere('authorId = ? && status = ?',$uid,'private');
    $sticky_posts = $db->fetchAll($select2->order('table.contents.created', Typecho_Db::SORT_DESC)->page($this->_currentPage, $this->parameter->pageSize));
//    var_dump($sticky_posts);
//    echo $select2->order('table.contents.created', Typecho_Db::SORT_DESC)->page($this->_currentPage, $this->parameter->pageSize);
    foreach($sticky_posts as $sticky_post) $this->push($sticky_post); //压入列队
    $this->setTotal($this->getTotal()-count($sticky_cids)); //置顶文章不计算在所有文章内
//    $this->setTotal($this->length);
}
