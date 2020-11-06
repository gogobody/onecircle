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

    public static function parseSecret($text)
    {
        $reg = '/\[secret\](.*?)\[secret\]/sm';
        if (preg_match($reg, $text,$arr)) {
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
                $text = preg_replace($reg, '<div class="secret text-center">该评论仅登录用户及评论双方可见</div>', $text);
            }
        }
        return $text;
    }

    public static function insertSecret($comment)
    {
        if ($_POST['secret']) {
            $comment['text'] = '[secret]' . $comment['text'] . '[secret]';
        }
        return $comment;
    }
}