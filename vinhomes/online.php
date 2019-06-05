<?php
session_start();
@define ( '_template' , './templates/');
@define ( '_source' , './sources/');
@define ( '_lib' , './lib/');
include_once _lib."config.php";
include_once _lib."functions.php";
include_once _lib."class.database.php";
$db = new database($config['database']);

date_default_timezone_set("Asia/Ho_Chi_Minh");
$db->setTable("online");
$filter = " order by time desc";
if(isset($_SESSION['filter']['online_date']) && $_SESSION['filter']['online_date'] != "")
	$filter = "where time >= ".strtotime($_SESSION['filter']['online_date'])." and time < ".(strtotime($_SESSION['filter']['online_date']." +1 day")).$filter;
$db->setCondition($filter);
$db->select();
?>

<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">
  	<script src="./assets/js/jquery.min.js"></script>
	</head>

	<body>
		<div class="container">
			<h1 class="text-center"><span class="text-primary"><strong>Thống kê truy cập</strong></span></h1>
			<div class="form-inline" style="margin-bottom: 10px;">
				<input id="online_date" class="filter form-control" type="date" value="<?=isset($_SESSION['filter']['online_date'])?$_SESSION['filter']['online_date']:''?>" max="<?=date('Y-m-d')?>" style="font-weight: bold; min-width: 200px;">
				<button class="btn btn-success" type="button" style="padding-left: 20px; padding-right: 20px; font-weight: bold;margin: 0 10px;" onclick="getFilter();">Lọc</button>
				<button class="btn btn-danger" type="button" style="padding-left: 20px; padding-right: 20px; font-weight: bold;" onclick="$('#online_date').val(''); getFilter();">Xóa lọc</button>
				<b style="float: right; height: 34px; line-height: 34px;">Tổng cộng: <?=$db->num_rows()?></b>
			</div>
			<table class="table table-bordered table-striped">

				<tr>
					<th class="text-center">Địa chỉ IP</th>
					<th class="text-center">Thời gian truy cập</th>
				</tr>

			<?php foreach ($db->result_array() as $value) {
				$h = date('H', $value['time']);
				$i = date('i', $value['time']);
				$s = date('s', $value['time']);
				$d = date('d/m/Y', $value['time']);
				$now = $value['time'] > (time() - 60*10);
				?>
				<tr>
					<td class="text-center"><small><?=$value['ip']!=""?$value['ip']:'Không xác định'?></small><?=$now?' <b class="label label-success">Đang online</b>':''?></td>
					<td class="text-center"><small><b style="color: darkblue;"><?=$h?></b> giờ <b style="color: darkblue;"><?=$i?></b> phút <b style="color: darkblue;"><?=$s?></b> giây, ngày <b style="color: darkred;"><?=$d?></b></small></td>
				</tr>
			<?php } ?>

			</table>
		</div>

  	<?php include _template."layout/backtotop.php" ?>

  	<script type="text/javascript">
  		$(document).ready(function() {
  			<?php if(!isset($_SESSION['filter']['online_date'])): ?>
  				getFilter();
  			<?php endif ?>
  			setInterval(function() { location.reload(true); }, 1000*60*5);
  		});
  		function getFilter() {
  			filterStr = $('.filter').attr("id") + '&&' + $('.filter').val();
  			$.post(
  				'admin/ajax/ajax.php',
  				{ table: null, column: 'filter', id:null, value: filterStr },
  				function(data) {
  					if(data == '1')
  						location.reload(true);
  				}
				);
  		}
  	</script>
	</body>
</html>