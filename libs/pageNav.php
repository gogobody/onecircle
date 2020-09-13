<?php
class Typecho_Widget_Helper_PageNavigator_Box extends Typecho_Widget_Helper_PageNavigator
{
    /**
     * 输出盒装样式分页栏 - 增加对 itemClass linkClass 的支持
     *
     * @access public
     * @param string $prevWord 上一页文字
     * @param string $nextWord 下一页文字
     * @param int $splitPage 分割范围
     * @param string $splitWord 分割字符
     * @param array $template
     * @return void
     */
    public function render($prevWord = 'PREV', $nextWord = 'NEXT', $splitPage = 3, $splitWord = '...', array $template = array())
    {
        if ($this->_total < 1) {
            return;
        }

        $default = array(
            'itemTag'       =>  'li',
            'itemClass'     =>  '',
            'textTag'       =>  'span',
            'currentClass'  =>  'current',
            'prevClass'     =>  'prev',
            'nextClass'     =>  'next'
        );

        $template = array_merge($default, $template);
        extract($template);

        // 定义item
        $itemBegin = empty($itemTag) ? '' : ('<' . $itemTag . (empty($itemClass) ? '' : ' class="'.$itemClass.'"') . '>');
        $itemCurrentBegin = empty($itemTag) ? '' : ('<' . $itemTag
            . (empty($currentClass)&&empty($itemClass) ? '' : ' class="' . $currentClass . ' ' . $itemClass . '"') . '>');
        $itemPrevBegin = empty($itemTag) ? '' : ('<' . $itemTag
            . (empty($prevClass)&&empty($itemClass) ? '' : ' class="' . $prevClass . ' ' . $itemClass . '"') . '>');
        $itemNextBegin = empty($itemTag) ? '' : ('<' . $itemTag
            . (empty($nextClass)&&empty($itemClass) ? '' : ' class="' . $nextClass . ' ' . $itemClass . '"') . '>');
        $itemEnd = empty($itemTag) ? '' : ('</' . $itemTag . '>');
        $textBegin = empty($textTag) ? '' : ('<' . $textTag . (empty($textClass) ? '' : ' class="' . $textClass . '"') . '>');
        $textEnd = empty($textTag) ? '' : ('</' . $textTag . '>');
        $linkBegin = '<a ' . (empty($linkClass) ? '' : 'class="' . $linkClass . '"') . 'href="%s">';
        $linkCurrentBegin = empty($itemTag) ? ('<a ' . (empty($linkClass) ? '' : 'class="' . $linkClass . '"') . 'href="%s"'
            . (empty($currentClass) ? '' : ' class="' . $currentClass . '"') . '>')
            : $linkBegin;
        $linkPrevBegin = empty($itemTag) ? ('<a ' . (empty($linkClass) ? '' : 'class="' . $linkClass . '"') . 'href="%s"'
            . (empty($prevClass) ? '' : ' class="' . $prevClass . '"') . '>')
            : $linkBegin;
        $linkNextBegin = empty($itemTag) ? ('<a ' . (empty($linkClass) ? '' : 'class="' . $linkClass . '"') . 'href="%s"'
            . (empty($nextClass) ? '' : ' class="' . $nextClass . '"') . '>')
            : $linkBegin;
        $linkEnd = '</a>';

        $from = max(1, $this->_currentPage - $splitPage);
        $to = min($this->_totalPage, $this->_currentPage + $splitPage);

        //输出上一页
        if ($this->_currentPage > 1) {
            echo $itemPrevBegin . sprintf($linkPrevBegin,
                    str_replace($this->_pageHolder, $this->_currentPage - 1, $this->_pageTemplate) . $this->_anchor)
                . $prevWord . $linkEnd . $itemEnd;
        }

        //输出第一页
        if ($from > 1) {
            echo $itemBegin . sprintf($linkBegin, str_replace($this->_pageHolder, 1, $this->_pageTemplate) . $this->_anchor)
                . '1' . $linkEnd . $itemEnd;

            if ($from > 2) {
                //输出省略号
                echo $itemBegin . $textBegin . $splitWord . $textEnd . $itemEnd;
            }
        }

        //输出中间页
        for ($i = $from; $i <= $to; $i ++) {
            $current = ($i == $this->_currentPage);

            echo ($current ? $itemCurrentBegin : $itemBegin) . sprintf(($current ? $linkCurrentBegin : $linkBegin),
                    str_replace($this->_pageHolder, $i, $this->_pageTemplate) . $this->_anchor)
                . $i . $linkEnd . $itemEnd;
        }

        //输出最后页
        if ($to < $this->_totalPage) {
            if ($to < $this->_totalPage - 1) {
                echo $itemBegin . $textBegin . $splitWord . $textEnd . $itemEnd;
            }

            echo $itemBegin . sprintf($linkBegin, str_replace($this->_pageHolder, $this->_totalPage, $this->_pageTemplate) . $this->_anchor)
                . $this->_totalPage . $linkEnd . $itemEnd;
        }

        //输出下一页
        if ($this->_currentPage < $this->_totalPage) {
            echo $itemNextBegin . sprintf($linkNextBegin,
                    str_replace($this->_pageHolder, $this->_currentPage + 1, $this->_pageTemplate) . $this->_anchor)
                . $nextWord . $linkEnd . $itemEnd;
        }
    }
}
