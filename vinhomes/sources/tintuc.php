<?php 
	
	$class_id = $classify['tintuc'][0]['id'];
	$getCategory = getItems(array("table" => "category","condition" => "where parent_id = {$class_id}"));


	
	$template ="tintuc";
 ?>