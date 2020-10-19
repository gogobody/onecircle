document.getElementById('update-button').addEventListener('click',
    function (){
        let container = document.getElementById('check-update');
        let ajax = new XMLHttpRequest();
        container.style.display = 'block';
        ajax.open('get', 'https://api.github.com/gogobody/onecircle/releases/latest');
        ajax.send();
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4 && ajax.status === 200) {
                let obj = JSON.parse(ajax.responseText);
                let newest = parseFloat(obj.tag_name);
                if (newest.toString() > version.toString()) {
                    container.innerHTML =
                        '发现新主题版本：' + obj.name +
                        '。下载地址：<a href="' + obj.zipball_url + '">点击下载</a>' +
                        '<br>您目前的版本:' + String(version) + '。' +
                        '<a target="_blank" href="' + obj.html_url + '">👉查看新版亮点</a>';
                } else {
                    container.innerHTML = '您目前使用的是最新版主题。';
                }
            }
        };
})
