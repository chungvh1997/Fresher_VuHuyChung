<?php
//error_reporting(0);
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
@define('_template', './templates/');
@define('_source', './sources/');
@define('_lib', './lib/');
include_once _lib."config.php";
include_once _lib."functions.php";
include_once _lib."class.database.php";
include_once _lib."pagination.php";
include_once _lib."file_requick.php";
$alt = $information['title'];
if (@$_SESSION['member']['username']!="") {
	$r_member = getItem("account", null, "where username like '{$_SESSION['member']['username']}'");
}
?>
<!doctype html>
<html lang="vi">
<head>
	<meta charset="utf-8" />
	<base href="http://<?=$config_url?>/" />
	<title>
		<?=$title?>
	</title>
	<meta name="keywords" content="<?=$seo['keyword']?>" />
	<meta name="description" content="<?=$seo['desc']?>" />
	<meta property="og:title" content="<?=$title?>" />
	<meta property="og:description" content="<?=$seo['desc']?>" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="<?=$information['title']?>" />
	<meta property="og:url" content="<?=getCurrentPageURL()?>" />
	<meta property="og:image" content="<?=count(explode(" ://
	", $seo['thumbnail']))>1?$seo['thumbnail']:(getHostURL().str_replace("// ", "/ ", $seo['thumbnail']))?>" />
	<meta name="twitter:card" content="<?=$information['title']?>" />
	<meta name="twitter:site" content="<?=getHostURL().getBaseURL(true)?>" />
	<meta name="twitter:title" content="<?=$title?>" />
	<meta name="twitter:description" content="<?=$seo['desc']?>" />
	<meta name="twitter:image" content="<?=count(explode(" ://
	", $seo['thumbnail']))>1?$seo['thumbnail']:(getHostURL().str_replace("// ", "/ ", $seo['thumbnail']))?>" />
	<meta property="article:published_time" content="5/19/2017 0:00:00 AM" />
	<meta property="article:modified_time" content="5/19/2017 23:59:59 PM" />
	<link rel="canonical" href="<?=getHostURL().getBaseURL(true)?>" />
	<meta name="copyright" content="<?=$information['title']?>" />
	<meta name="author" content="<?=$information['title']?>" />
	<meta name="GENERATOR" content="<?=$information['title']?>" />
	<link rel="publisher" href="" />
	<link rel="author" href="" />
	<meta http-equiv="audience" content="General" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="resource-type" content="Document" />
	<meta name="distribution" content="Global" />
	<meta name="revisit-after" content="1 days" />
	<meta name="robots" content="INDEX,FOLLOW" />
	<meta name="geo.position" content="<?=$information['map_location']?>">
	<meta name="geo.placename" content="Hồ Chí Minh - Việt Nam">
	<meta name="geo.region" content="<?=$information['title']?>">
	<link rel="schema.DC" href="http://<?=$config_url?>/" />
	<meta name="DC.title" content="<?=$information['ten']?>" />
	<meta name="DC.identifier" content="<?=getHostURL().getBaseURL(true)?>" />
	<meta name="DC.description" content="<?=$information['description']?>" />
	<meta name="DC.subject" content="<?=$information['keyword']?>" />
	<meta name="DC.language" scheme="ISO639-1" content="vi" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="rss" />
	<meta name="viewport" content="width=device-width">
	<link rel="shortcut icon" href="<?=count(explode(" ://
	", $information['favicon']))>1?$information['favicon']:(getHostURL().str_replace("// ", "/ ", $information['favicon']))?>">

	<link rel="stylesheet" href="./assets/fontawesome/css/fontawesome-all.min.css" />
	<link rel="stylesheet" type="text/css" href="./assets/fancybox-2.1.7/source/jquery.fancybox.css?v=2.1.5" media="screen"
	/>
	<link rel="stylesheet" href="./assets/fancybox-2.1.7/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
	<link href='./assets/css/bootstrap.min.css' rel='stylesheet' type='text/css' media='all' />
	<link href='./assets/css/bootstrap-theme.min.css' rel='stylesheet' type='text/css' media='all' />
	<link href='./assets/css/swiper.min.css' rel='stylesheet' type='text/css' media='all' />

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

	<script src="./assets/js/jquery.min.js"></script>
	<script src="./assets/js/smoothScroll.js"></script>
	<script src="./assets/fancybox-2.1.7/lib/jquery.mousewheel.pack.js?v=3.1.3"></script>
	<script src="./assets/fancybox-2.1.7/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<script src="./assets/fancybox-2.1.7/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script src='./assets/js/jquery.mmenu.all.js' type='text/javascript'></script>
	<script src="./assets/js/swiper.min.js"></script>
	<script src='./assets/js/bootstrap.min.js' type='text/javascript'></script>
	<script src='./assets/js/script.js' type='text/javascript'></script>
	<script src="./assets/js/superplaceholder.js"></script>


	<link rel="stylesheet" href="./assets/fontawesome/css/fontawesome-all.min.css" />
	<link href='./assets/css/jquery.mmenu.all.css' rel='stylesheet' type='text/css' media='all' />
	<link href='./assets/css/style.css' rel='stylesheet' type='text/css' media='all' />
	<link rel="stylesheet" href="./css/style.css">

	<?php include _template."layout/style.php"; ?>

	<?=$information['script_head']?>

	<!-- schema.org starts -->
	<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "Organization",
			"url": "http://<?=$config_url?>",
			"contactPoint": [{
			"@type": "ContactPoint",
			"telephone": "<?='+84'.preg_replace('/^0/', "", preg_replace('/(\D)/i', "", $information['hotline']))?>",
			"contactType": "customer service"
		}]
	}
</script>
<?= $breadcrumb_string ?>
<!-- schema.org ends -->
</head>
<body>
	<?=$information['script_body']?>
	<?php include _template."layout/menu-mobile.php" ?>
	<div id="body">
		<?php include _template."layout/header.php" ?>
		<?php if ($source == "index"):
			include _template."layout/slider.php";
		endif ?>
		<?php include _template.$template."_tpl.php" ?>
		<?php include _template."layout/footer.php" ?>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$("img").each(function() {
				var target = $(this);
				if(target.attr("alt") == '' || target.attr("alt") == undefined)
					target.attr("alt", "<?= $title ?>");
			});
			$.smoothScroll();
			var func = function (res) {
				res = res.split("&"); 
				$("#current_view").html(res[0]);
				$("#today").html(res[1]);
				$("#toweek").html(res[2]);
				$("#total_view").html(res[3]);
			}
			getOnline(func);
			setInterval(function() { getOnline(func); }, 1000*60*10);
			$("img").on("error", function () {
				$(this).attr("src", "./assets/img/no-image.png");
			});
		});
		function getOnline(func) {
			$.ajax({
				url: "<?= getAjaxURL() ?>ajax.php",
				method: "post",
				data: { table: "online", id: "<?= session_id() ?>" },
				success: function (res) {
					func(res);
				}
			});
		}
	</script>
	<?php include _template."layout/hotline.php" ?>
	<?php include _template."layout/backtotop.php" ?>
	<?= $information['livechat'] ?>
	<style>
		.fancybox-overlay,
		#fancybox-thumbs {
			z-index: 99999 !important;
		}
	</style>
</body>
</html>