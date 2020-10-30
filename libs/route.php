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

//@route.'/'
function rootRouteFunc($archive)
{
    header("HTTP/1.1 200 OK");
    // do somthn
    // process main route
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
//        header("HTTP/1.1 404 OK");
//        exit('error');
    }
}
