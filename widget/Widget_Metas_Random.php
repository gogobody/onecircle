<?php


class Widget_Metas_Random extends Widget_Metas_Category_List
{
    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);
        $this->parameter->setDefault('ignore=0&current=');
        $this->parameter->setDefault(array('order'=>'RAND()','limit'=>10));


    }
    public function execute()
    {
        $select = $this->select()->where('type = ?', 'category')->order($this->parameter->order)->limit($this->parameter->limit);
        $this->db->fetchAll($select, array($this, 'push'));
    }
}