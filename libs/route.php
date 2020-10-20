<?php


function parseRout($archive){
    if ($archive->request->isPost()){
        //  点赞
        if ($archive->request->agree) {
            if ($archive->request->agree == $archive->cid) {
                exit(utils::agree($archive->cid));
            } elseif ($archive->is('index')) {
                exit(utils::agree($archive->request->agree));
            }
            exit('error');
        }
        // follow user
        else if ($archive->request->followuser){
            if ($archive->request->follow == 'follow'){
                exit(UserFollow::addFollow($archive->request->uid,$archive->request->fid));
            }elseif ($archive->request->follow == 'unfollow'){
                exit(UserFollow::cancleFollow($archive->request->uid,$archive->request->fid));
            }elseif ($archive->request->follow == 'status'){
                exit(UserFollow::statusFollow($archive->request->uid,$archive->request->fid));
            }
            exit('error');
        }
        // follow circle
        else if ($archive->request->followcircle){
            if ($archive->request->follow == 'follow'){
                exit(CircleFollow::addFollow($archive->request->uid,$archive->request->mid));
            }elseif ($archive->request->follow == 'unfollow'){
                exit(CircleFollow::cancleFollow($archive->request->uid,$archive->request->mid));
            }elseif ($archive->request->follow == 'status'){
                exit(CircleFollow::statusFollow($archive->request->uid,$archive->request->mid));
            }
            exit('error');
        }

    }


}