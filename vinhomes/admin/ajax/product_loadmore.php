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
$readmore = $_POST['readmore'];
$lang = $_POST['lang'];
if($lang != "") {
	$tmp = getItems(array("table" => "language", "id" => 0, "condition" => "where uri like '{$lang}' and enable>0"));
	if(!is_array($tmp) || empty($tmp))
		die(json_encode(array( "status" => "error", "message" => "Invalid language!" )));
}
$lang .= "/";

$category_id = array(intval($_POST["category_id"]));
$row_id = $category_id;
while (is_array($row_id) && !empty($row_id)) {
	$row_cat = getItems(array("table" => "category", "condition" => "where parent_id in (".implode(",", $row_id).") and enable>0 order by `index`"));
	$row_id = array();
	foreach($row_cat as $r_cat)
		$row_id[] = $r_cat['id'];
	$category_id = array_merge($category_id, $row_id);
}

$row_product = getItems(array("table" => "product", "condition" => "where category_id in (".implode(",", $category_id).") and id not like '{$_POST['product_id']}' and enable>0 order by level desc, create_date desc, title limit {$current},{$step}"));
$db->query("select id from #_product where category_id in (".implode(",", $category_id).") and id not like '{$_POST['product_id']}' and enable>0");
$continue = ($db->num_rows() > $current + $step);
$str = "";

foreach ($row_product as $r_product):
	$data = getItems(array("table" => "province" ,"id" => $r_product['province']));
	$str .= '<div class="'.$_POST['container'][0].'">
		<div class="'.$_POST['container'][1].'">
			<div class="item">
				<a href="'. getURL($r_product['uri']) .'">
					<div class="item-thumbnail"><img src="'. $r_product['thumbnail'] .'"></div>
					<div class="item-title">
						<h2>'. $r_product['title'] .'</h2>
					</div>
						<div class="item-body">		
								
							<ul>
								<li> 
									<span>Địa điểm:</span>&nbsp;'.$data['name'].'
									
								</li>
								<li> 
									<span>Diện tích từ:</span>&nbsp;'. $r_product['dientich'] .'
								</li>
								<li> 
									<span>Số phòng ngủ:</span>&nbsp;'. $r_product['phongngu'] .'
								</li>
								<li> 
									<span>Loại hình:</span>&nbsp;'. $r_product['loaihinh'] .'
								</li>
							</ul>
						</div>
				</a>
			</div>
		</div>
	</div>';
endforeach;

json_encode($str);

$result = array( "data" => $str, "continue" => $continue );
die(json_encode($result));
?>