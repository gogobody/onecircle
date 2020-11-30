<?php
/**
 * random post generators by gogobody
 * Class Widget_Post_hot
 */
class Widget_Post_Random extends Widget_Abstract_Contents
{
    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);
        $this->parameter->setDefault(array('pageSize' => 5, 'parentId' => 0, 'ignoreAuthor' => false));
    }
    public function execute()
    {
        $type = explode('_', $this->db->getAdapterName());
        $type = array_pop($type);
        if($type == "SQLite"){
            $select  = $this->select()->from('table.contents')
                ->where("table.contents.password IS NULL OR table.contents.password = ''")
                ->where('table.contents.status = ?','publish')
                ->where('table.contents.created <= ?', time())
                ->where('table.contents.type = ?', 'post')
                ->limit($this->parameter->pageSize)
                ->order('RANDOM()');
        }else{
            $select  = $this->select()->from('table.contents')
                ->where("table.contents.password IS NULL OR table.contents.password = ''")
                ->where('table.contents.status = ?','publish')
                ->where('table.contents.created <= ?', time())
                ->where('table.contents.type = ?', 'post')
                ->limit($this->parameter->pageSize)
                ->order('RAND()');
        }
        $this->db->fetchAll($select, array($this, 'push'));
    }
}