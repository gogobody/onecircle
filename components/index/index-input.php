<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 主页的 发布 板块
 */
?>

<div class="post share-post"> <!--按个人CSS的更改-->
    <!--                    --><?php //$this->options->siteUrl(); ?><!--action/contents-post-edit-->
    <form id="input-form" class="post-form" action="<?php $this->options->loginAction(); ?>" method="post"
          name="write_post" target="nm_iframe"> <!--target="nm_iframe"-->
        <!--以发布时间作标题，把这里的hidden改成text就能自定义标题了-->
        <div class="textarea">
            <label for="text"></label>
            <textarea rows="4" id="text" autocomplete="off" placeholder="分享你的想法..."></textarea>
            <input type="hidden" name="text"  id="realtext" autocomplete="off" placeholder="分享你的想法...">
            <div class="show-panel fbjukw">

            </div>
            <a href="http://www.baidu.com" target="_blank" class="sc-AxjAm kgcKxQ">
                <div class="sc-AxjAm sc-AxirZ gITPLH bwqALa">
                    <div class="sc-AxjAm sc-AxirZ jLaetV">
                        <img src="<?php echo Helper::options()->themeUrl . '/assets/img/link.png' ?>" class="bLGCpY">
                        <div class="sc-AxjAm kKrDdN hHnMup"></div>
                    </div>
                    <div class="sc-AxjAm sc-AxirZ ezTcmd">
                        <div class="sc-AxjAm sc-AxirZ hyliOy">
                            <svg viewBox="0 0 17 17" fill="#ccc">
                                <path d="M9.565 8.595l5.829 5.829a.686.686 0 01-.97.97l-5.83-5.83-5.828 5.83a.686.686 0 01-.97-.97l5.829-5.83-5.83-5.828a.686.686 0 11.97-.97l5.83 5.829 5.829-5.83a.686.686 0 01.97.97l-5.83 5.83z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <div>
                <div role="combobox" aria-haspopup="listbox" aria-owns="topic-search-downshift-menu"
                     aria-expanded="true" class="sc-AxjAm sc-AxirZ kWzaA-d"
                     style="position: relative;">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg"
                         class="hoZbnH">
                        <circle cx="10" cy="10" r="10" fill="#03A9F5"></circle>
                        <circle cx="10" cy="10" r="5" fill="#A0E3FE"></circle>
                    </svg>
                    <input type="text" id="topic-search-downshift-input" aria-autocomplete="list"
                           aria-controls="topic-search-downshift-menu"
                           aria-labelledby="topic-search-downshift-label" autocomplete="on"
                           placeholder="查找更多圈子"
                           class="sc-AxjAm jgskPb cAmOCm"
                           value="">
                </div>
            </div>
        </div>
        <input type="hidden" id="allowComment" name="allowComment" value="1" checked="true"/>
        <!--允许评论-->
        <input type="hidden" name="do" value="publish"/><!--公开，可以无视-->
        <input type="hidden" id="articleType" name="fields[articleType]" value="default"/><!--文章类型-->
        <input type="hidden" name="markdown" value="1"/><!--markdown-->
        <input type="hidden" id="post-title" name="title" value=""/><!--title-->
        <input type="hidden" id="category" name="category[]" value="1"/><!---->

        <div class="ffdvlM">
            <div class="gDqTLX">
                <div id="addpic" data-type="default" class="sc-AxjAm sc-AxirZ csRQBH bvFLMj">
                    <div class="sc-AxjAm sc-AxirZ  dEkSi">
                        <svg viewBox="0 0 22 22" fill="currentColor">
                            <path d="M3 5.5a1 1 0 00-1 1v10a1 1 0 001 1h13a1 1 0 001-1v-10a1 1 0 00-1-1H3zm0-2h13a3 3 0 013 3v10a3 3 0 01-3 3H3a3 3 0 01-3-3v-10a3 3 0 013-3zm1.5 6a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm.488 6.155c.203-1.296.656-1.976 1.337-2.21.276-.094.609.009 1.55.495 1.57.811 2.416 1.025 3.567.457 1.115-.55 1.568-1.39 1.837-2.754l.064-.339c.13-.703.216-.954.35-1.083.341-.328.583-.359.989-.127a1 1 0 10.991-1.737 2.665 2.665 0 00-3.366.422c-.549.528-.723 1.039-.93 2.16l-.06.317c-.16.812-.336 1.138-.76 1.347-.368.182-.743.087-1.765-.44-1.446-.747-2.113-.953-3.117-.609-1.474.506-2.355 1.827-2.663 3.79a1 1 0 101.976.311zM6 2.5a1 1 0 110-2h12a4 4 0 014 4v9a1 1 0 01-2 0v-9a2 2 0 00-2-2H6z"></path>
                        </svg>
                    </div>
                    <div class="sc-AxjAm blMNOE bwQUKf">图片</div>
                </div>
                <div id="addlink" data-type="link" class="sc-AxjAm sc-AxirZ csRQBH">
                    <div class="sc-AxjAm sc-AxirZ Icon-nxu6ip-0 dEkSi">
                        <svg viewBox="0 0 22 22" fill="currentColor">
                            <path d="M11.707 4.919a1 1 0 01-1.414-1.414l.848-.849a5.8 5.8 0 018.203 8.203l-2.546 2.545a5.8 5.8 0 01-8.202 0 1 1 0 111.414-1.414 3.8 3.8 0 005.374 0l2.546-2.546a3.8 3.8 0 00-5.374-5.374l-.849.849zM10.293 17.08a1 1 0 011.414 1.414l-.848.849a5.8 5.8 0 11-8.203-8.203l2.546-2.545a5.8 5.8 0 018.202 0 1 1 0 01-1.414 1.414 3.8 3.8 0 00-5.374 0L4.07 12.556a3.8 3.8 0 105.374 5.374l.849-.849z"></path>
                        </svg>
                    </div>
                    <div class="sc-AxjAm blMNOE bwQUKf">链接</div>
                </div>
                <div id="addvideo" data-type="video" class="sc-AxjAm sc-AxirZ csRQBH">
                    <div class="sc-AxjAm sc-AxirZ Icon-nxu6ip-0 dEkSi">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-camera-video" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5zm11.5 5.175l3.5 1.556V4.269l-3.5 1.556v4.35zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H2z"/>
                        </svg>
                    </div>
                    <div class="sc-AxjAm blMNOE bwQUKf">视频</div>
                </div>
                <div id="addbilibili" data-type="bilibili" class="sc-AxjAm sc-AxirZ csRQBH">
                    <div class="sc-AxjAm sc-AxirZ Icon-nxu6ip-0 dEkSi">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-play" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 11.117V6.883a.5.5 0 0 1 .757-.429l3.528 2.117a.5.5 0 0 1 0 .858l-3.528 2.117a.5.5 0 0 1-.757-.43z"/>
                            <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                            <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                        </svg>
                    </div>
                    <div class="sc-AxjAm blMNOE bwQUKf">B站</div>
                </div>
            </div>
            <div class="ezTcmd">
                <input type="button" class="pub eynkqj" value="发送" id="postForm"
                       onclick="submitForm(this)"/>
            </div>
        </div>


    </form>
    <iframe id="id_iframe" name="nm_iframe" style="display:none;"></iframe>
</div>
<div class="add-area">
    <div class="sc-AxjAm sc-AxirZ XCHRv">
        <input data-addarea type="text" placeholder="请输入图片链接" class="sc-AxjAm bwpEWU gsmhQy" value="">
        <button disabled class="sc-AxjAm eVNRGW">添加</button>
    </div>
</div>
<div class="upload-pic">
    <div class="row XCHRv ">
        <div id="zz-img-show"></div><div class="zz-add-img "><input id="zz-img-file" type="file" accept="image/*" multiple="multiple"><button id="zz-img-add" type="button"><span class="chevereto-pup-button-icon"><svg class="chevereto-pup-button-icon" xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path d="M76.7 87.5c12.8 0 23.3-13.3 23.3-29.4 0-13.6-5.2-25.7-15.4-27.5 0 0-3.5-0.7-5.6 1.7 0 0 0.6 9.4-2.9 12.6 0 0 8.7-32.4-23.7-32.4 -29.3 0-22.5 34.5-22.5 34.5 -5-6.4-0.6-19.6-0.6-19.6 -2.5-2.6-6.1-2.5-6.1-2.5C10.9 25 0 39.1 0 54.6c0 15.5 9.3 32.7 29.3 32.7 2 0 6.4 0 11.7 0V68.5h-13l22-22 22 22H59v18.8C68.6 87.4 76.7 87.5 76.7 87.5z" style="fill: currentcolor;"></path></svg></span><span class="chevereto-pup-button-text">上传</span></button></div>
    </div>
</div>
<div class="newmsg"></div>

<?php
// get categories for index search
if ($this->is('index')){
    $obj = null;
    $this->widget('Widget_Metas_Category_List')->to($obj);
    $arr = array();
    if($obj->have()){
        while($obj->next()){
            $tmp = array();
            array_push($tmp,$obj->name,$obj->mid,parseDesc2img($this->options->defaultSlugUrl,$obj->description),parseDesc2text($obj->description));
            array_push($arr,$tmp);
        }
    }
    echo '<script type="text/javascript">allCategories = '.json_encode($arr).'</script>';
}
?>