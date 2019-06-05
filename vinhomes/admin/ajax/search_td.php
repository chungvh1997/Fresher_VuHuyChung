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

$keyword = $_GET['keyword'];
if ($keyword != "") {
	$keyword = str_replace("đ", "d", str_replace("Đ", "D", $keyword));
	$where[] = "replace(replace(title, 'đ', 'd'), 'Đ', 'd') like '%{$keyword}%'";
}

$classify = getLayout("classify");

$where = " where ".implode(" and ", $where)." and category_id like '{$classify['tuyendung'][0]['id']}' order by create_date desc";
$getItem = getItems(array("table" => "post", "condition" => $where));
$str = "<table>
						<thead>
							<tr>
								<th>Vị trí</th>
								<th>Mô tả</th>
							</tr>
						</thead>
						<tbody>
		
						";
foreach ($getItem as $r_post_td) {
	$str .= '
		<tr class="product-search-td">
			<td>
				<a href="'. $r_post_td['uri'] .'">'. $r_post_td['title'] .'</a>
			</td>
			<td style="padding-top: 10px;padding-bottom: 10px;">
				'. $r_post_td['description'] .'
			</td>
		</tr>
	';
}
$str .='

</tbody>
					</table>';
die(json_encode(array("status" => 1, "data" => $str)));


?>