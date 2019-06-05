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

$lang = $_POST['lang'];
if($lang != "") {
	$tmp = getItems(array("table" => "language", "id" => 0, "condition" => "where uri like '{$lang}' and enable>0"));
	if(!is_array($tmp) || empty($tmp))
		die(json_encode(array( "status" => "error", "message" => "Invalid language!" )));
}
$lang .= "/";
$where = array("enable > 0");

$product_type = $_POST['product_type'];
if ($product_type != "") {
	$where[] = " loaihinh like '%$product_type%'";
}

$duan = $_POST['duan'];
if ($duan != "") {
	$where[] = " project_id like '$duan'";
}

$acreages = $_POST['acreages'];
if ($acreages != "") {
	$where[] = " dientich like '%$acreages%'";
}

$room_number = $_POST['room_number'];
if ($room_number != "") {
	$where[] = " phongngu like '%$room_number%'";
}

$keyword = $_POST['keyword'];
if ($keyword != "") {
	$where[] = " title like '%$keyword%'";
}

$province_id = intval($_POST['province_id']);
if ($province_id > 0) {
	$where[] = "province like '$province_id'";
}


$where = " where ".implode(" and ", $where)." order by level desc, create_date desc";
$getItem = getItems(array("table" => "product", "condition" => $where));
$str = "";
foreach ($getItem as $item) {
	$getProvince = getItems(array("table" => "province", "id" => $province_id));
	$str .= '
	<div class="col-md-4 col-xs-12">
		<div class="product-item-container">
			<div class="item">
				<a href="'.$lang.$item['uri'].'.html">
					<div class="item-thumbnail"><img src="'.$item['thumbnail'].'" alt="Vinhomes - BĐS Bán"></div>
		
					<div class="item-title">
						<h2>'.$item['title'].'</h2>
					</div>
					<div class="item-body">
										<ul>
							<li> 
								<span>Địa điểm:</span>&nbsp;
									'.$getProvince['name'].'					
							</li>
							<li> 
								<span>Diện tích từ:</span>&nbsp;'.$item['dientich'].'</li>
							<li> 
								<span>Số phòng ngủ:</span>&nbsp;'.$item['phongngu'].'</li>
							<li> 
								<span>Loại hình:</span>&nbsp;'.$item['loaihinh'].'</li>
						</ul>
					</div>
				</a>
			</div>	
		</div>
	</div>
';
}

die(json_encode(array("status" => 1, "data" => $str,"post" => $_POST)));


?>