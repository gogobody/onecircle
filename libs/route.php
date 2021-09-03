<?php


function parseRout($archive)
{
    rootRouteFunc($archive);

//    if ($archive->is('archive', 404)) {
//        $path_info = trim($archive->request->getPathinfo(), '/');
//        if (strpos($path_info, '/') !== false) {
//        }
//
//
//    }


}

function loginReq($archive){
    if(!$archive->user){
        $archive->user = Typecho_Widget::widget('Widget_User');
    }
    if (!$archive->user->hasLogin()){
        if($archive->request->isPost()){
            exit(json_encode([
               'code'=>0,
               'msg'=>'login need!'
            ]));
        }else{
            $archive->response->redirect($archive->options->loginUrl);
        }
    }
}
//@route.'/'
function rootRouteFunc($archive)
{
    header("HTTP/1.1 200 OK");
    // do somthn
    // process main route
    /** 初始化request */
    $request = $archive->request;
    if (!empty($request)) {
        $requestObject = new Typecho_Request();
    } else {
        $requestObject = Typecho_Request::getInstance();
    }
    $archive->request=$requestObject;
    if ($archive->request->isPost()) {
        //  点赞
        if ($archive->request->agree) {
            if ($archive->request->agree == $archive->cid) {
                exit(utils::agree($archive->cid));
            } elseif ($archive->is('index')) {
                exit(utils::agree($archive->request->agree));
            }
            exit('error agree');
        } // follow user
        else if ($archive->request->followuser) {
            loginReq($archive);
            if ($archive->request->follow == 'follow') {
                exit(UserFollow::addFollow($archive->request->uid, $archive->request->fid));
            } elseif ($archive->request->follow == 'unfollow') {
                exit(UserFollow::cancleFollow($archive->request->uid, $archive->request->fid));
            } elseif ($archive->request->follow == 'status') {
                exit(UserFollow::statusFollow($archive->request->uid, $archive->request->fid));
            }
            exit('error follow');
        } // follow circle
        else if ($archive->request->followcircle) {
            loginReq($archive);
            if ($archive->request->follow == 'follow') {
                exit(CircleFollow::addFollow($archive->request->uid, $archive->request->mid));
            } elseif ($archive->request->follow == 'unfollow') {
                exit(CircleFollow::cancleFollow($archive->request->uid, $archive->request->mid));
            } elseif ($archive->request->follow == 'status') {
                exit(CircleFollow::statusFollow($archive->request->uid, $archive->request->mid));
            }
            exit('error follow');
        }
        else if ($archive->request->changeCircleCat){
            CircleFollow::changeCircleCat($archive->request->mid,$archive->request->changetomid);
            exit('success');
        }
        else if($archive->request->getallfollowers){ // 获取所有的 follower
            loginReq($archive);
            if($archive->request->type=='getallfollowers'){
                exit(json_encode(UserFollow::getFollowObjLike($archive->request->uid,$archive->request->keyword)));
            }
            exit('error follow');
        }
        else if($archive->request->handleMsg){ // 消息类 api
            loginReq($archive);
            if($archive->request->type=='getUserMsg'){
                exit(UserMessage::getMsg($archive->user->uid,$archive->request->fid));
            }elseif ($archive->request->type=='sendMsg'){
                // param : to , text
                $data = [
                    'fid'=>$archive->user->uid,
                    'uid'=>$archive->request->to,
                    'text'=>$archive->request->text,
                ];
                exit(UserMessage::createMsg($data));

            }elseif ($archive->request->type=='getUnRead'){

                exit(UserMessage::getUnReadMsg($archive->user->uid));
            }
            exit('error handle msg');
        }
//        header("HTTP/1.1 404 OK");
//        exit('error');
    }
}
