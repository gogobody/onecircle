'use strict';
(function () {
    document.addEventListener('DOMContentLoaded', function () {
        var TabItems = document.querySelectorAll('.j-setting-tab li');
        var Notice = document.querySelector('.j-setting-notice');
        var Version = document.querySelector('#j-version');
        var Form = document.querySelector('.j-setting-contain > form');
        var Content = document.querySelectorAll('.j-setting-content');
        TabItems.forEach(function (item) {
            item.addEventListener('click', function () {
                sessionStorage.setItem('j-setting-current', item.getAttribute('data-current'));
                TabItems.forEach(function (_item) {
                    return _item.classList.remove('active');
                });
                item.classList.add('active');

                if (item.getAttribute('data-current') === 'j-setting-notice') {
                    Notice.style.display = 'block';
                    Form.style.display = 'none';
                } else {
                    Form.style.display = 'block';
                    Notice.style.display = 'none';
                }

                Content.forEach(function (_item) {
                    _item.style.display = 'none';
                    if (_item.classList.contains(item.getAttribute('data-current'))) _item.style.display = 'block';
                });
            });
        });
        /* 页面第一次进来 */
        if (sessionStorage.getItem('j-setting-current')) {
            if (sessionStorage.getItem('j-setting-current') === 'j-setting-notice') {
                Notice.style.display = 'block';
                Form.style.display = 'none';
            } else {
                Form.style.display = 'block';
                Notice.style.display = 'none';
            }

            TabItems.forEach(function (item) {
                if (item.getAttribute('data-current') === sessionStorage.getItem('j-setting-current')) {
                    item.classList.add('active');
                    Content.forEach(function (_item) {
                        if (_item.classList.contains(sessionStorage.getItem('j-setting-current'))) _item.style.display = 'block';
                    });
                }
            });
        } else {
            TabItems[0].classList.add('active');
            Notice.style.display = 'block';
            Form.style.display = 'none';
        }
        // var xhr = new XMLHttpRequest();
        // xhr.onreadystatechange = function () {
        //     if (xhr.readyState === 4) {
        //         if ((xhr.status >= 200 && xhr.status < 300) || xhr.status === 304) {
        //             var res = JSON.parse(xhr.responseText);
        //             if (res.success) {
        //                 if (res.title !== Version.innerHTML) {
        //                     var str = '<h2 class="update">检测到版本更新！</h2><p>当前版本号：' + Version.innerHTML + '</p><p>最新版本号：' + res.title + '</p>' + res.content;
        //                     Notice.innerHTML = str;
        //                 } else {
        //                     var str = '<h2 class="no-update">当前已是最新版本！</h2><p>当前版本号：' + Version.innerHTML + '</p><p>最新版本号：' + res.title + '</p>' + res.content;
        //                     Notice.innerHTML = str;
        //                 }
        //             } else {
        //                 Notice.innerHTML = '请求失败！';
        //             }
        //         } else {
        //             Notice.innerHTML = '请求失败！';
        //         }
        //     }
        // };
        // xhr.open('get', 'https://ae.js.cn/qqshoucang.php?key=1668901a8a41e2e9deaaaa3100ebd4ae', true);
        // xhr.send(null);
    });
})();
