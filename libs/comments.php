<?php

class comments
{
    public static function parseContent($text, $widget, $lastResult)
    {
        $text = empty($lastResult) ? $text : $lastResult;
        // 强制开启评论markdown
        Helper::options()->commentsMarkdown = '1';
        Helper::options()->commentsHTMLTagAllowed .= '<img class src alt><div class>';
        if ($widget instanceof Widget_Abstract_Comments) {
            //owo
            $text = contents::parseOwo($text);
            $text = self::parseSecret($text);
        }
        return $text;
    }

    public static function parseText($text)
    {
        $text = contents::parseOwo($text);
        $text = self::parseSecret($text);
        return $text;
    }

    public static function parseSecret($text)
    {
        $reg = '/\[secret\](.*?)\[secret\]/sm';
        if (preg_match($reg, $text, $arr)) {
            $user = Typecho_Widget::widget('Widget_User');
            $db = Typecho_Db::get();
            $sql = $db->select()->from('table.comments')
                ->where('coid = ?', Typecho_Widget::widget('Widget_Comments_Archive')->coid)
                ->where('mail = ?', Typecho_Widget::widget('Widget_Archive')->remember('mail', true))
                ->limit(1);
            $result = $db->fetchAll($sql);
            if ($user->hasLogin() || $result) {
                $text = preg_replace($reg, '<div class="secret">${1}</div>', $text);
            } else {
                $text = preg_replace($reg, '<div class="secret text-center">私密消息</div>', $text);
            }
        }
        return $text;
    }

    public static function insertSecret($comment)
    {
        if ($_POST['secret']) {
            $comment['text'] = '[secret]' . $comment['text'] . '[secret]';
        }
        /* 加强评论拦截功能 */
        $opt = "none";
        $err= "";
        /* 用户输入内容画图模式 */
        if (preg_match('/\{!\{(.*)\}!\}/', $comment['text'], $matches)) {
            /* 如果判断是否有双引号，如果有双引号，则禁止评论 */
            if (strpos($matches[1], '"') !== false || _checkXSS($matches[1])) {
                $comment['status'] = 'waiting';
                $opt = "abandon";
                $err = "禁止评论";
            }
            /* 普通评论 */
        } else {
            /* 判断用户输入是否大于字符 */
            if (Helper::options()->JTextLimit && strlen($comment['text']) > Helper::options()->JTextLimit) {
                $comment['status'] = 'waiting';
                $opt = "abandon";
                $err = "字符数不够";
            } else {
                /* 判断评论内容是否包含敏感词 */
                if (Helper::options()->JSensitiveWords) {
                    if (_checkSensitiveWords(Helper::options()->JSensitiveWords, $comment['text'])) {
                        $comment['status'] = 'waiting';
                        $opt = "abandon";
                        $err = "包含敏感词";
                    }
                }
                /* 判断评论是否至少包含一个中文 */
                if (Helper::options()->JLimitOneChinese === "on") {
                    if (preg_match("/[\x{4e00}-\x{9fa5}]/u", $comment['text']) == 0) {
                        $comment['status'] = 'waiting';
                        $opt = "abandon";
                        $err = "至少要有中文";
                    }
                }
            }
        }
        if ($opt == "abandon") {

            Typecho_Cookie::set('__typecho_remember_text',$comment['text']);
            throw new Typecho_Widget_Exception(_t($err));
        }
        Typecho_Cookie::delete('__typecho_remember_text');
        return $comment;
    }
}