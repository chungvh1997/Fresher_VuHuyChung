<?php
session_start();
@define ( '_template' , '../../templates/');
@define ( '_source' , '../../sources/');
@define ( '_lib' , '../../lib/');
include_once _lib."config.php";
include_once _lib."class.database.php";
// include_once _lib."pagination.php";
include_once _lib."functions.php";
$db = new database($config['database']);

$current = intval($_POST['current']);
$step = intval($_POST['step']);

$category_id = array(intval($_POST["category_id"]));
$row_id = $category_id;
while (is_array($row_id) && !empty($row_id)) {
	$row_cat = getItems(array("table" => "category", "condition" => "where parent_id in (".implode(",", $row_id).") and enable>0 order by `index`"));
	$row_id = array();
	foreach($row_cat as $r_cat)
		$row_id[] = $r_cat['id'];
	$category_id = array_merge($category_id, $row_id);
}

$row_post = getItems(array("table" => "post", "condition" => "where category_id in (".implode(",", $category_id).") and id not like '{$_POST['post_id']}' and enable>0 order by level desc, create_date desc, title limit {$current},{$step}"));
$db->query("select id from #_post where category_id in (".implode(",", $category_id).") and id not like '{$_POST['post_id']}' and enable>0");
$continue = ($db->num_rows() > $current + $step);
$str = "";
foreach ($row_post as $r_post):
	$str .= '<div class="'.$_POST['container'][0].'">
		<div class="'.$_POST['container'][1].'">
			<div class="item">
				<a href="'.$lang.$r_post['uri'].'.html">
					<div class="item-thumbnail">
						<img src="'.$r_post['thumbnail'].'">
					</div>
					<div class="item-heading">
						<div class="item-title">'.$r_post['title'].'</div>
						<div class="item-description">'.$r_post['description'].'</div>
					</div>
				</a>
			</div>
		</div>
	</div>';
endforeach;
$result = array( "data" => $str, "continue" => $continue );
die(json_encode($result));
?>