<?php $banner = getLayout("banner") ?>
<div id="banner">
	<div class="container">
		<div class="row">
			<a href="<?= getBaseURL().(is_file("./home.php") ? "index.php" : "") ?>"><img class="logo-left" src="<?= $design['banner-left']['thumbnail'] ?>"></a>
			<a href="<?= getBaseURL().(is_file("./home.php") ? "index.php" : "") ?>"><img class="logo-right" src="<?= $design['banner-right']['thumbnail'] ?>"></a>
		</div>
	</div>
</div>