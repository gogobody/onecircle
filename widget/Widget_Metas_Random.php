<?php


class Widget_Metas_Random extends Widget_Metas_Category_List
{
    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);
        $this->parameter->setDefault('ignore=0&current=');
        $type = explode('_', $this->db->getAdapterName());
        $type = array_pop($type);
        if($type == "SQLite"){
            $this->parameter->setDefault(array('order'=>'RANDOM()','limit'=>10));
        }else{
            $this->parameter->setDefault(array('order'=>'RAND()','limit'=>10));
        }

    }
    public function execute()
    {
        $select = $this->select()->where('type = ?', 'category')->order($this->parameter->order)->limit($this->parameter->limit);
        $this->db->fetchAll($select, array($this, 'push'));
    }
}