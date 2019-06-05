<?php
$row_subcat = getItems(array("table" => "category", "condition" => "where parent_id like '{$category['id']}' and enable>0 order by `index`"));
if(is_array($row_subcat) && !empty($row_subcat))
	redirect(getURL($row_subcat[0]['uri']));

$row_breadcrumb = array($category['uri'] => $category['title']);
$id_list = array($category['parent_id']);
$not_list = array($category['id']);
do {
	$row_category = getItems(array("table" => "category", "condition" => "where id in (".implode(",", $id_list).") and id not in (".implode(",", $not_list).")"));
	foreach ($row_category as $r_category) {
		if(intval($r_category['parent_id']) > 0) {
			$id_list[] = $r_category['parent_id'];
		}
		$row_breadcrumb[$r_category['uri']] = $r_category['title'];
		$not_list[] = $r_category['id'];
	}
} while (is_array($row_category) && !empty($row_category));
$row_breadcrumb = array_reverse($row_breadcrumb);

$id_list = array_reverse($id_list);
$r_category = getItems(array("table" => "category", "id" => $id_list[0]));
$row_subcat = getItems(array("table" => "category", "condition" => "where parent_id like '{$r_category['id']}' and enable>0 order by `index`"));

$template = "page";
?>
