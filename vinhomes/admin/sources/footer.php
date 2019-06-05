<?php
$table = "website";
$resourceType = "image";
$items = array();
$row_language = getItems(array("table" => "language", "orderby" => array("`index`")));
foreach($row_language as $r_language):
	$item = getItems(array("table" => $table, "id" => 0, "condition" => "where language_id like '{$r_language['id']}'"));
	if(!is_array($item)) {
		$_POST['language_id'] = $r_language['id'];
		saveItem(array("table" => $table, "data" => array("language_id"), "insert" => true));
		unset($_POST['language_id']);
		$item = getItems(array("table" => $table, "id" => 0, "condition" => "where language_id like '{$r_language['id']}'"));
	}
	$items[] = $item;
endforeach;
$template = "footer";

if(isset($_POST['savebtn'])) {
	foreach($row_language as $r_language):
		$data = array( "information", "copyright" );
		if(!saveItem(array("table" => $table, "data" => $data, "condition" => "where id like '{$_POST['id_'.$r_language['uri']]}' and language_id like '{$r_language['id']}'", "affix" => $r_language['uri']))) {
			alert("Lỗi cập nhật dữ liệu!");
			back();
		}
	endforeach;
	redirect(getCurrentPageURL());
}
?>
