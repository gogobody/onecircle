<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
/**
 * Lens风格照片集
 *
 * @package custom
 */
?>
<!-- 
作者：ZhangDi
https://github.com/zzd/photo-page-for-typecho
时间:2021-05-20 版权所有，请勿删除 
-->
<!-- jsdelivr公共CDN -->
<?php
function usePublicCdn()
{
	echo "https://cdn.jsdelivr.net/gh/zzd/photo-page-for-typecho@2.0";
}
?>
<!-- 公共CDN结束 -->
<!-- 相册图片对象存储供应商，用以加载缩略图 -->
<!-- 由于Lens模板的缩略图没有固定比例，故将裁剪工作交给云 -->
<?php
function storage($storage)
{
	if ($storage == "UPYUN") {
		echo "!/fw/640/quality/85/clip/640x400a0a0/gravity/center";
	} elseif ($storage == "OSS") {
		echo "?x-oss-process=image/crop,x_0,y_0,w_640,h_400,g_center";
	} elseif ($storage == "KODO") {
		echo "?imageMogr2/gravity/center/crop/!640x400";
	} elseif ($storage == "COS") {
		echo "?imageMogr2/gravity/center/crop/!640x400";
	} else
		echo "";
}
?>
<!-- 自动缩略图结束 -->
<!DOCTYPE HTML>
<html>

<head>
	<title><?php $this->title() ?> - <?php $this->options->title() ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="<?php usePublicCdn(); ?>/Lens/css/main.css" />
	<link rel="shortcut icon" href="<?php $this->options->siteUrl(); ?>/favicon.ico">
	<noscript>
		<link rel="stylesheet" href="<?php usePublicCdn(); ?>/Lens/css/noscript.css" /></noscript>
	<!-- 百度统计 -->
	<script>
		var _hmt = _hmt || [];
		(function() {
			var hm = document.createElement("script");
			hm.src = "https://hm.baidu.com/hm.js?e804e37f8afa68b911afdd756b4314c7";
			var s = document.getElementsByTagName("script")[0];
			s.parentNode.insertBefore(hm, s);
		})();
	</script>
</head>

<body class="is-preload-0 is-preload-1 is-preload-2">
	<!-- Main -->
	<div id="main">
		<!-- Header -->
		<header id="header">
			<h1><?php $this->title() ?></h1>
			<?php if ($this->fields->about) : ?>
				<p><?php echo $this->fields->about; ?></p>
			<?php else : ?>
				<p>在自定义字段内添加about字段，即可编辑此内容，现有内容将自动替换。</p>
			<?php endif ?>
			<ul class="icons">
				<?php if ($this->fields->Twitter) : ?>
					<li><a href="<?php echo $this->fields->Twitter; ?>" class="icon brands fa-twitter" target="_blank"><span class="label">Twitter</span></a></li>
				<?php endif ?>
				<?php if ($this->fields->Facebook) : ?>
					<li><a href="<?php echo $this->fields->Facebook; ?>" class="icon brands fa-facebook-f" target="_blank"><span class="label">Facebook</span></a></li>
				<?php endif ?>
				<?php if ($this->fields->Instagram) : ?>
					<li><a href="<?php echo $this->fields->Instagram; ?>" class="icon brands fa-instagram" target="_blank"><span class="label">Instagram</span></a></li>
				<?php endif ?>
				<?php if ($this->fields->GitHub) : ?>
					<li><a href="<?php echo $this->fields->GitHub; ?>" class="icon brands fa-github" target="_blank"><span class="label">GitHub</span></a></li>
				<?php endif ?>
			</ul>
		</header>

		<!-- Thumbnail -->
		<section id="thumbnails">
		</section>
		<!-- Footer -->
		<footer id="footer">
			<!-- 虽说本页面制作容易，但也需要一点点时间编辑，请保留版权信息。 -->
			<ul class="copyright">
				<li>&copy; 2020 <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a></li>
				<li>Powered by <a href="https://github.com/616620131/photo-page-for-typecho">ZDSR</a> Based HTML5UP</a>.</li>
			</ul>
		</footer>
	</div>
	<!--
		动态读取数据 by ZhangDi
		https://github.com/616620131/photo-page-for-typecho
	-->
	<script type="text/javascript">
		var datas =
			`<?php
				$html = $this->row['text'];
				echo $html;
				?>`;
		datas = datas.split("\n");
		for (var i = 0; i < datas.length; i++) {
			datas[i] = datas[i].split(",");
		}

		function creatArticle(datas) {
			var parent = document.getElementById("thumbnails");
			for (var i = 0; i < datas.length; i++) {
				var article = document.createElement("article");
				article.className = "thumb";
				parent.appendChild(article);
				var a = document.createElement("a");
				a.className = "thumbnail";
				a.href = datas[i][2];
				article.appendChild(a);
				var img = document.createElement("img");
				img.src = datas[i][2] + "<?php storage($this->fields->CDN); ?>";
				a.appendChild(img);
				var h2 = document.createElement("h2");
				h2.innerHTML = datas[i][0];
				article.appendChild(h2);
				var p = document.createElement("p");
				p.innerHTML = datas[i][1];
				article.appendChild(p);
			}
		}
		creatArticle(datas);
	</script>
	<!-- Scripts -->
	<script src="<?php usePublicCdn(); ?>/Lens/js/jquery.min.js"></script>
	<script src="<?php usePublicCdn(); ?>/Lens/js/browser.min.js"></script>
	<script src="<?php usePublicCdn(); ?>/Lens/js/breakpoints.min.js"></script>
	<script src="<?php usePublicCdn(); ?>/Lens/js/main.js"></script>
</body>

</html>