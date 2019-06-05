<?php
$type = @$_REQUEST['type'];
if($type == "") show_error();
$table = "image";
$resourceType = "image";
$type_title = array(
	"slide" => "hình ảnh trình chiếu",
	"link" => "hình ảnh liên kết mạng xã hội",
	"introduction" => "hỉnh ảnh giới thiệu",
	"review" => "hình ảnh đánh giá khách hàng",
	"popular" => "hình ảnh nổi bật",
	"share" => "hình ảnh chia sẻ mạng xã hội",
	"partner" => "hình ảnh đối tác",
	"adv" => "hình ảnh"
);
$title = $type_title[$type];

switch (true) {
	case $act=="list":
		$items = getItems(array("table" => $table, "condition" => "where type like '{$type}' order by `index`", "limit" => 10, "pagination" => true));
		$paging = $pagination->getSource("&p");
		$template = "image/list";
		break;
	case $act=="edit":
		if($_REQUEST['id'] != "")
			$item = getItems(array("table" => $table, "id" => $_REQUEST['id']));
		$template = "image/edit";
		break;
	case $act=="save":
		if(isset($_POST['savebtn'])) {
			if (count(explode("//www.youtube.com", @$_POST['link'])) > 1 && @$_POST['thumbnail'] == "") {
				$_POST['thumbnail'] = getYoutubeImg($_POST['link']);
			}elseif(@$_POST['url'] != "")
				$_POST['thumbnail'] = $_POST['url'];
			$data = array("title", "thumbnail", "link","font_awesome" ,"description", "content", "index", "enable", "type");
			if(@$_POST['id'] != "")
				$condition = "where id like '{$_POST['id']}'";
			if(saveItem(array("table" => $table, "data" => $data, "condition" => @$condition)))
				redirect( preg_replace('/(&id=\d*)/', '', str_replace("&act=save", "&act=list", getCurrentPageURL())) );
			else {
				alert("Lỗi lưu dữ liệu!");
				back();
			}
		}
		else {
			alert("Không nhận được dữ liệu!");
			back();
		}
		break;
	default:
		show_error();
		break;
}
?>