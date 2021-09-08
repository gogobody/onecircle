<?php
/**
 * github
 * @package custom
 * @author gogobody 即刻学术
 **/

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/header.php');

?>

<?php $this->need('includes/body-layout.php'); ?>
<div class="hbox hbox-auto-xs hbox-auto-sm index">
    <div class="col center-part">
        <div class="page">
            <section id="joe">
                <!-- 头部 -->
                <style>
                    .j-index {
                        display: flex;
                    }

                    .j-adaption {
                        position: relative;
                        width: 0;
                        min-width: 0;
                        flex: 1;
                    }

                    .j-index .one-git .search-title {
                        display: flex;
                        align-items: center;
                        height: 45px;
                        line-height: 45px;
                        color: rgba(0, 0, 0, .9);
                        user-select: none;
                        border-bottom: 1px solid var(--classC);
                        font-size: 19px;
                        text-transform: uppercase;
                        padding-bottom: 15px;
                    }

                    .j-index .one-git .search-title svg {
                        width: 20px;
                        height: 20px;
                        min-width: 20px;
                        min-height: 20px;
                        margin-right: 8px;
                    }

                    .j-index .one-git .search-title section {
                        display: flex;
                        align-items: center;
                        width: 100%;
                    }

                    @media (max-width: 768px)
                        .j-index .one-git {
                            background: none;
                            padding: 0;
                            box-shadow: none;
                            border-radius: 0;
                        }

                        .j-index .one-git .search-title {
                            background: var(--backgroundA);
                            padding: 0 15px;
                            border-radius: var(--radius-wap);
                            margin-bottom: 15px;
                            box-shadow: var(--box-shadow);
                        }

                        .j-index .one-git .search-title .ellipsis {
                            max-width: 85%;
                            overflow: hidden;
                            white-space: nowrap;
                            text-overflow: ellipsis;
                        }
                </style>
                <style type="text/css">.hide {
                        display: none
                    }
                    .text-center {
                        text-align: center
                    }
                    .row-sm > div {
                        padding-right: 10px;
                        padding-left: 10px
                    }
                    .panel {
                        margin-bottom: 20px;
                        background-color: #fff;
                        border: 1px solid transparent;
                        border-radius: 4px;
                        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
                        box-shadow: 0 1px 1px rgba(0, 0, 0, .05)
                    }

                    .panel-body:after, .panel-body:before, .row:after, .row:before {
                        display: table;
                        content: " "
                    }

                    .panel-body:after, .row:after {
                        clear: both
                    }

                    .panel-body a {
                        color: #58666e;
                        word-wrap: break-word;
                        word-break: break-all
                    }

                    .b-light {
                        border-color: rgba(237, 241, 242, .6)
                    }

                    .bg-success .text-muted {
                        color: #9ee4af !important
                    }

                    .font-thin {
                        font-weight: 300
                    }

                    .panel-body {
                        padding: 15px;
                        position: relative
                    }

                    .github_language {
                        position: absolute;
                        font-size: 20px;
                        color: rgba(255, 255, 255, .5);
                        bottom: 6px;
                        right: 14px
                    }

                    .clear {
                        display: block;
                        overflow: hidden
                    }

                    .text-ellipsis {
                        display: block;
                        overflow: hidden;
                        text-overflow: ellipsis;
                        white-space: nowrap
                    }

                    .m-sm {
                        margin: 10px
                    }

                    .text-muted {
                        color: #a0a0a0
                    }

                    .btn {
                        display: inline-block;
                        padding: 6px 12px;
                        margin-bottom: 0;
                        font-size: 14px;
                        line-height: 1.42857143;
                        text-align: center;
                        white-space: nowrap;
                        vertical-align: middle;
                        -ms-touch-action: manipulation;
                        touch-action: manipulation;
                        cursor: pointer;
                        -webkit-user-select: none;
                        -moz-user-select: none;
                        -ms-user-select: none;
                        user-select: none;
                        background-image: none;
                        border: 1px solid transparent;
                        font-weight: 500;
                        border-radius: 2px;
                        outline: 0 !important
                    }

                    .btn-rounded {
                        padding-right: 15px;
                        padding-left: 15px;
                        border-radius: 50px
                    }

                    .panel-body a:hover {
                        color: #222
                    }

                    .bg-dark a {
                        color: #c1c3c9
                    }

                    .bg-dark a:hover {
                        color: #fff
                    }

                    .bg-dark .text-muted {
                        color: #8b8e99 !important
                    }

                    .bg-black a {
                        color: #96abbb
                    }

                    .bg-black a:hover {
                        color: #fff
                    }

                    .bg-black .text-muted {
                        color: #5c798f !important
                    }

                    .bg-primary a {
                        color: #fff
                    }

                    .bg-primary a:hover {
                        color: #fff
                    }

                    .bg-primary .text-muted {
                        color: #d6d3e6 !important
                    }

                    .bg-success a {
                        color: #eefaf1
                    }

                    .bg-success a:hover {
                        color: #fff
                    }

                    .bg-success .text-muted {
                        color: #9ee4af !important
                    }

                    .bg-info a {
                        color: #fff
                    }

                    .bg-info a:hover {
                        color: #fff
                    }

                    .bg-info .text-muted {
                        color: #b0e1f1 !important
                    }

                    .bg-warning a {
                        color: #fff
                    }

                    .bg-warning a:hover {
                        color: #fff
                    }

                    .bg-warning .text-muted {
                        color: #fbf2cb !important
                    }

                    .bg-danger a {
                        color: #fff
                    }

                    .bg-danger a:hover {
                        color: #fff
                    }

                    .bg-danger .text-muted {
                        color: #e6e6e6 !important
                    }

                    .bg-info a:hover {
                        color: #fff
                    }

                    .btn {
                        font-weight: 500;
                        border-radius: 2px;
                        outline: 0 !important
                    }

                    .block {
                        display: block
                    }

                    .banner {
                        margin-bottom: 10px
                    }</style>
                <!-- 主体 -->
                <section class="container j-index">
                    <section class="j-adaption">
                        <section class="one-git">
                            <?php
                            $githubUser = $this->fields->github;
                            if ($githubUser == "" || $githubUser == null) {
                                $githubUser = 'gogobody';
                            }
                            ?>
                            <section class="search-title">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                                    <line x1="16" y1="8" x2="2" y2="22"></line>
                                    <line x1="17.5" y1="15" x2="9" y2="15"></line>
                                </svg>
                                <section>
                                    <span class="ellipsis"><?php echo $githubUser; ?> 的 Repo</span>
                                </section>
                            </section>
                            <section class="j-index-article article">
                                <div class="banner">
                                    <div style="position: relative;padding-top: 20%;display: block;transition: opacity 0.35s;border-radius: calc(var(--radius-pc) / 2) calc(var(--radius-pc) / 2) 0 0;background-position: center;background-repeat: no-repeat;background-size: cover;background-color: transparent;overflow: hidden;height: 100%;background-image: url('https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=2309007985,3468552525&fm=26&gp=0.jpg')"></div>
                                </div>
                                <small class="text-muted letterspacing github_tips"></small>

                                <div class="github_page">
                                    <div class="loading-nav text-center">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </div>
                                    <nav class="alert alert-warning hide text-center" role="alert">
                                        <p class="infinite-scroll-request">加载失败！尝试重新加载</p>
                                    </nav>
                                </div>
                            </section>
                            <script type="text/javascript">
                                const githubItemTemple = '<div class="col-xs-12 col-sm-6 col-md-4">' +
                                    '<div class="panel b-light {BG_COLOR}">\n' +
                                    '        <div class="panel-body"><div class="github_language">{PROJECT_LANGUAGE}</div>' +
                                    '          \n' +
                                    '          <div class="clear">\n' +
                                    '            <h3 class="text-ellipsis font-thin h3">{REPO_NAME}</h3>\n' +
                                    '            <small class="block m-sm"><i class="iconfont icon-star m-r-xs"></i>{REPO_STARS} stars / <i class="iconfont icon-fork"></i> {REPO_FORKS} forks</small>\n' +
                                    '<small class="text-ellipsis block text-muted">{REPO_DESC}</small>' +
                                    '<a target="_blank" href="{REPO_URL}" class="m-sm btn btn-rounded btn-sm lter btn-{BUTTON_COLOR}"><i class="glyphicon glyphicon-hand-up"></i>访问</a>' +
                                    '          </div>\n' +
                                    '        </div>\n' +
                                    '      </div>' +
                                    '</div>';

                                function appendHtml(elem, value) {
                                    let node = document.createElement("div"),
                                        fragment = document.createDocumentFragment(),
                                        childs = null,
                                        i = 0;
                                    node.innerHTML = value;
                                    childs = node.childNodes;
                                    for (; i < childs.length; i++) {
                                        fragment.appendChild(childs[i]);
                                    }
                                    elem.appendChild(fragment);
                                    childs = null;
                                    fragment = null;
                                    node = null;
                                }

                                const open = function () {
                                    const handleGithub = function () {
                                        var repoContainer = document.querySelector('.github_page')//$('.github_page');
                                        var loadingContainer = document.querySelector(".github_page .loading-nav");
                                        var errorContainer = document.querySelector(".github_page .error-nav");
                                        var countContainer = document.querySelector(".github_tips");
                                        var colors = ["light", "info", "dark", "success", "black", "warning", "primary", "danger"];
                                        let httpRequest = new XMLHttpRequest();
                                        httpRequest.open('GET', "https://api.github.com/users/<?php echo $githubUser; ?>/repos?accept=application/vnd.github.v3+json&sort=updated&direction=desc&per_page=100", true);
                                        httpRequest.send();
                                        httpRequest.onreadystatechange = function () {
                                            if (httpRequest.readyState === 4 && httpRequest.status === 200) {
                                                let json = JSON.parse(httpRequest.responseText);
                                                if (json) {
                                                    loadingContainer.classList.add("hide")
                                                    let ul = "<div class='raw'><div class='col-md-12'><div class=\"row row-sm text-center " +
                                                        "github_contain" +
                                                        "\"></div></div></div>";
                                                    appendHtml(repoContainer, ul)
                                                    let contentContainer = document.querySelector(".github_contain");
                                                    json.sort(function (a, b) {
                                                        return b.stargazers_count - a.stargazers_count
                                                    })
                                                    let show_len = json.length > 33 ? 33 : json.length
                                                    for (let i = 0; i < show_len; i++) {
                                                        let repo = json[i]
                                                        repo.updated_at = repo.updated_at.substring(0, repo.updated_at.lastIndexOf("T"));
                                                        if (repo.language == null) {
                                                            repo.language = "未知";
                                                        }
                                                        //匹配替换
                                                        let item = githubItemTemple.replace("{REPO_NAME}", repo.name)
                                                            .replace("{REPO_URL}", repo.html_url)
                                                            .replace("{REPO_STARS}", repo.stargazers_count)
                                                            .replace("{REPO_FORKS}", repo.forks_count)
                                                            .replace("{REPO_DESC}", repo.description)
                                                            .replace("{BG_COLOR}", "bg-" + colors[i % 8])
                                                            .replace("{BUTTON_COLOR}", colors[(i) % 8])
                                                            .replace("{PROJECT_LANGUAGE}", repo.language);
                                                        appendHtml(contentContainer, item)
                                                    }
                                                } else {
                                                    errorContainer.classList.remove("hide");
                                                }
                                            }
                                        };
                                    };

                                    return {
                                        init: function () {
                                            handleGithub();
                                        }
                                    }
                                };
                                open().init();
                            </script>
                        </section>
                    </section>

                </section>
                <!-- 尾部 -->
            </section>
        </div>
    </div>

</div>
<?php $this->need('includes/footer.php'); ?>
