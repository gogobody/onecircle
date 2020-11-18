<?php


class Widget_Pagination extends Typecho_Widget_Helper_PageNavigator
{
    public function getPageLink($type = 'next')
    {
        if ($type == 'next') {
            //输出下一页
            if ($this->_total > 0 && $this->_currentPage < $this->_totalPage) {
                return str_replace($this->_pageHolder, $this->_currentPage + 1, $this->_pageTemplate) . $this->_anchor;
            }
        } else {
            //输出上一页
            if ($this->_total > 0 && $this->_currentPage > 1) {
                return str_replace($this->_pageHolder, $this->_currentPage - 1, $this->_pageTemplate) . $this->_anchor;
            }
        }
        return "";
    }
}