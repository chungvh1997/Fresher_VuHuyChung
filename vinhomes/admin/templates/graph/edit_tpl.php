<link rel="stylesheet" href="../assets/css/swiper.min.css">
<script src="../assets/js/jquery-ui.min.js"></script>
<script src="../assets/js/swiper.min.js"></script>
<script>$(document).ready(function() { newSwiper(); });</script>
<div class="layout-left">
	<form action="" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="layout-container">
			<center class="col-xs-12">
				<button class="btn btn-primary" type="submit" name="layout_submit" value="true">Lưu</button>
			</center>
			<div class="clearfix"></div>
			<?php include _template.$com."/{$_GET['type']}.php" ?>
			<div class="clearfix"></div>
			<center>
				<button class="btn btn-primary" type="submit" name="layout_submit" value="true">Lưu</button>
			</center>
		</div>
	</form>
</div>
<div class="layout-right">
	<div class="panel panel-primary panel-scroll">
		<div class="panel-heading">Danh mục</div>
		<div class="panel-body sortable">
			<?php foreach ($row_category as $r_category): ?>
				<div data-id="<?= $r_category['id'] ?>" class="category draggable text-primary">
					<?= $r_category['title'] ?>
					<button class="close hidden" type="button" title="Gỡ bỏ" onclick="$(this).parent().remove()">x</button>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		setTimeout(function () {
			var hmax = 0;
			$(".layout-part").each(function () {
				if(hmax < $(this).outerHeight())
					hmax = $(this).outerHeight();
			});
			if(hmax > 0)
				$(".layout-part").css("min-height", hmax + "px");
			hmax = $(window).outerHeight();
			$(".layout-right .panel-scroll").css("width", $(".layout-right").outerWidth() + "px");
			$(".layout-right .panel-scroll .panel-body").css("height", (hmax - 50 - 43 - $("#footer").outerHeight()) + "px");
			$(".layout-right").css("min-height", Math.max(hmax, $(".layout-left").outerHeight()) + "px");
			$(".layout-right .panel-scroll").addClass("loaded");
		}, 500);
		$(".sortable").sortable({ revert: true });
		$(".draggable").draggable({
			connectToSortable: ".layout-left .sortable",
			helper: "clone",
      revert: true
		});
		$(".category").attr("title", "Kéo thả để chọn vị trí hiển thị");
		$(".layout-left form").submit(function() {
			$(".position-container").each(function () {
				var input_arr = [];
				$(this).find(".category").each(function () {
					if(!isNaN(Number($(this).data("id")))) {
						input_arr.push($(this).data("id"));
					}
				});
				$(this).find(".input:not(.layout-input)").val(JSON.stringify(input_arr));
			});
			var success_count = 0;
			var input_count = $(this).find(".input").length;
			$(this).find(".input:not(.group):not(.link)").each(function () {
				var target = $(this);
				$.ajax({
					url: "<?= getAjaxURL() ?>ajax_graph.php",
					type: "post",
					data: { type: target.data("type"), name: target.data("name"), value: target.val(), link: target.data("link") },
					success: function (response) {
						if(response == "1") {
							success_count++;
							if(success_count == input_count) {
								window.location.reload(true);
							}
						}
						if(response != "1") {
							alert("Đã có lỗi xảy ra trong quá trình xử lý. Vui lòng thử lại sau!");
						}
					}
				});
			});
			var group_arr = "#";
			$(this).find(".input.group").each(function () {
				var target = $(this);
				if(group_arr.split(target.data("name")).length > 1) {
					success_count++;
					return;
				}
				group_arr += target.data("name") + "#";
				var group_input = [];
				$(".group.group-"+target.data("name")).each(function () {
					group_input.push({ type: $(this).data("type"), name: $(this).data("group"), value: $(this).val(), link: $(this).data("link") });
				});
				var value = JSON.stringify(group_input);
				$.ajax({
					url: "<?= getAjaxURL() ?>ajax_graph.php",
					type: "post",
					data: { type: "group", name: target.data("name"), value: value },
					success: function (response) {
						if(response == "1") {
							success_count++;
							if(success_count == input_count) {
								window.location.reload(true);
							}
						}
						if(response != "1") {
							alert("Đã có lỗi xảy ra trong quá trình xử lý. Vui lòng thử lại sau!");
						}
					}
				});
			});
			$(this).find(".input.link:not(.group)").each(function () {
				var target = $(this);
				var group_input = { value: $(this).val(), link: $(this).data("link") };
				var value = JSON.stringify(group_input);
				$.ajax({
					url: "<?= getAjaxURL() ?>ajax_graph.php",
					type: "post",
					data: { type: target.data("type"), name: target.data("name"), value: value },
					success: function (response) {
						if(response == "1") {
							success_count++;
							if(success_count == input_count) {
								window.location.reload(true);
							}
						}
						if(response != "1") {
							alert("Đã có lỗi xảy ra trong quá trình xử lý. Vui lòng thử lại sau!");
						}
					}
				});
			});
			return false;
		});
		$(document).scroll(function () {
			var sctop = $(this).scrollTop();
			var lrtop = $(".layout-right").offset().top - 15;
			if(sctop >= lrtop) {
				var pstop = sctop - lrtop;
				$(".layout-right .panel-scroll").css("top", pstop + "px");
			}
			else {
				$(".layout-right .panel-scroll").css("top", "0");
			}
		});
		$(document).trigger("scroll");
	});
	function imgError(target) {
		$(target).attr("src", "../assets/img/no-image.png");
	}
</script>
<style>
.layout-container {
	padding: 10px;
	border: solid 1px #ccc;
	background: #f9f9f9;
}
.layout-container .well {
	border-radius: 0;
	margin-bottom: 0;
	border-color: #337AB7;
	background: rgba(0,0,0,.1);
	box-shadow: none;
	min-height: 108px;
}
.layout-container > center:first-child {
	margin-top: 10px;
	margin-bottom: 15px;
}
.layout-container > center:last-child {
	margin-top: 15px;
	margin-bottom: 10px;
}
.layout-container .row {
	margin: 0;
}
.layout-container .row > div {
	padding: 0;
}
.panel {
	border-radius: 0;
	margin-bottom: 0;
	font-weight: 600;
}
.panel-heading {
	border-radius: 0;
}
.panel-body {
	padding: 5px;
	overflow-x: hidden;
	overflow-y: auto;
	min-height: 65px;
}
.panel .category {
	display: inline-block;
	position: relative;
	margin: calc(12px / 2);
}
.layout-right .panel-body {
	padding: calc(8px - 5px / 2) calc(8px - (5px - 3px) / 2);
	min-height: 55px;
}
.layout-right .panel .category {
	margin: calc(5px / 2) calc((5px - 3px) / 2)
}
.layout-container .close {
	display: block !important;
	position: absolute !important;
	top: -9px !important;
	right: -9px !important;
	background: white !important;
	opacity: 1 !important;
	box-shadow: 0 0 1px black !important;
	width: 18px !important;
	height: 18px !important;
	line-height: 0 !important;
	font-size: 14px !important;
	border-radius: 50% !important;
	outline: none !important;
	-webkit-transition: background .2s;
	-o-transition: background .2s;
	transition: background .2s;
}
.ui-draggable-dragging .close {
	display: none !important;
}
.layout-container .close:hover {
	background: #ddd !important;
}
.category {
	text-align: center;
}
.fullwidth .draggable:not(.ui-draggable-dragging) {
	width: calc(100% - 12px) !important;
}
.layout-left {
	float: left;
	width: calc(100% - 250px);
}
.layout-right {
	position: relative;
	float: right;
	width: 240px;
}
.category {
	display: inline-block;
	padding: 5px 10px;
	border-radius: 4px;
	background: #fff;
	border: solid 1px rgba(0,0,0,.2);
	cursor: move;
	z-index: 9;
	width: max-content !important;
	width: -webkit-max-content !important;
	height: auto !important;
}
.layout-right .panel-scroll.loaded {
	position: absolute;
	top: 0;
}
.ui-draggable-dragging,
.ui-sortable-helper {
	color: #777;
}
.layout-left .category.draggable {
	color: #a94442;
}
.image-container,
.color-container,
.video-container {
	position: relative;
	box-shadow: 0 0 3px 1px black;
	margin: 8px;
}
.video-container .iframe-container {
	cursor: pointer;
}
.video-container iframe {
	width: 100%;
	height: 100px;
	pointer-events: none;
}
.image-container.panel-body,
.color-container.panel-body,
.video-container.panel-body {
	padding: 5px;
}
.color-container:before {
	content: "Không màu";
	position: absolute;
	right: 5px;
	bottom: 5px;
	left: 5px;
	text-align: center;
	color: #999;
}
.image-container .panel-body {
	min-height: max-content;
}
.image-container > div {
	cursor: pointer;
}
.image-container img {
	max-width: 100%;
	height: 100px;
	margin: auto;
	display: block;
	-webkit-transition: all .5s;
	-o-transition: all .5s;
	transition: all .5s;
}
.image-container .text-primary {
	margin-bottom: 5px;
}
.image-container .image-close,
.color-container .color-close,
.video-container .video-close {
	position: absolute;
	right: 15px;
	top: 15px;
	line-height: 14px;
	z-index: 999999999;
}
.image-container .image-label,
.color-container .color-label,
.video-container .video-label {
	position: absolute;
	/*top: 50%;*/
	/*left: 50%;*/
	top: 5px;
	left: 5px;
	width: max-content;
	max-width: calc(100% - 10px);
	padding: 2px 5px;
	margin: auto;
	font-size: 11px;
	line-height: 18px;
	box-shadow: 0 0 0 1px #000;
	pointer-events: none;
	z-index: 9;
	color: #000;
	background: rgba(255,255,255,.2);
	/*-webkit-transform: translate(-50%, -50%);*/
	/*-ms-transform: translate(-50%, -50%);*/
	/*-o-transform: translate(-50%, -50%);*/
	/*transform: translate(-50%, -50%);*/
	-webkit-transition: background .5s, color .5s, box-shadow .5s;
	-o-transition: background .5s, color .5s, box-shadow .5s;
	transition: background .5s, color .5s, box-shadow .5s;
}
.image-container:hover .image-label,
.color-container:hover .color-label,
.video-container:hover .video-label {
	background: #000;
	color: #fff;
	box-shadow: 0 0 0 1px #fff;
}
input[type="color"] {
	position: relative;
	display: block;
	margin: auto;
	width: 100%;
	height: 100px;
	outline: none !important;
	border: none;
	cursor: pointer;
	-webkit-transition: all .5s;
	-o-transition: all .5s;
	transition: all .5s;
}
input[type="color"]::-webkit-color-swatch-wrapper {
	padding: 0;
}
input[type="color"]::-webkit-color-swatch {
	border: none;
}
input[type="color" i] {
	padding: 0 !important;
}
</style>