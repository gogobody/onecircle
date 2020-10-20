<?php
/** random post */

//清空原有文章的列队
$this->row = [];
$this->stack = [];
$this->length = 0;

$select  = $this->select()->from('table.contents')
    ->where("table.contents.password IS NULL OR table.contents.password = ''")
    ->where('table.contents.status = ?','publish')
    ->where('table.contents.created <= ?', time())
    ->where('table.contents.type = ?', 'post')
    ->limit($this->parameter->pageSize)
    ->order('RAND()')
    ->page($this->_currentPage, $this->parameter->pageSize);
$this->db->fetchAll($select, array($this, 'push'));