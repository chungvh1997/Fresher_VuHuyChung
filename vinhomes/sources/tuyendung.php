<?php 
	$row_category = getItems(array("table" => "category","condition" => "where uri = 'tuyen-dung'"));
	foreach ($row_category as $r_category) {
		
	}

	$get_post_td = getItems(array("table" => "post","condition" => "where category_id = '{$r_category['id']}'"));
	$template = "tuyendung";
 ?>