<?php
/**
 * random post generators by gogobody
 * Class Widget_Post_hot
 */

class Widget_Users_Random extends Widget_Abstract_Users
{
    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);
    }

    public function execute()
    {
        $this->parameter->setDefault('pageSize=10');

        $type = explode('_', $this->db->getAdapterName());
        $type = array_pop($type);
        if($type == "SQLite"){
            $select  = $this->select()->from('table.users')
                ->limit($this->parameter->pageSize)
                ->order('RANDOM()');
        }else{
            $select  = $this->select()->from('table.users')
                ->limit($this->parameter->pageSize)
                ->order('RAND()');
        }
        $this->db->fetchAll($select, array($this, 'push'));
    }
}