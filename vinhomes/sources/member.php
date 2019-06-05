<?php
$type = @$_REQUEST['param-2'];
if($type == "") show_error();
$table = "account";

if(@$_SESSION['member']['username'] != "") {
	$member = getItem($table, null, "where type like 'member' and username like '{$_SESSION['member']['username']}'");
}
elseif($type == "save" and $_POST['id'] != "")
	redirect(getURL("member/login"));
elseif(!in_array($type, array("login", "register", "save")))
	redirect(getURL("member/login"));

switch (true) {
	case $type == "login":
		if(@$_SESSION['member']['username'] != "")
			redirect(getURL("member/manager"));
		if(@$_POST['username']!="" && @$_POST['password']!="")
			if(login()) {
				if($_REQUEST['param-1'] == "member") {
					redirect(getURL("member/manager"));
				}
				else
					redirect(getCurrentPageURL());
			}
			else
				$error = "Tên đăng nhập hoặc mật khẩu không đúng!";
		$template = "member/login";
		break;
	case $type == "register":
		if(@$_SESSION['member']['username'] != "")
			redirect(getURL("member/setting"));
		$row_province = getItems("province", "order by name not in ('Hồ Chí Minh', 'Hà Nội'), type, name", false);
		$template = "member/register";
		break;
	case $type == "logout":
		logout();
		redirect(getURL("member/login"));
		break;
	case $type == "setting":
		$row_province = getItems("province", "order by name not in ('Hồ Chí Minh', 'Hà Nội'), type, name", false);
		$row_district = getItems("district", "order by type, name", false);
		$row_ward = getItems("ward", "order by type, name", false);
		$template = "member/register";
		break;
	case $type == "save":
		if(isset($_POST['savebtn'])) {
			if(md5(str_replace(" ", "", $_REQUEST['captcha_dangky'])) == $_SESSION['captcha_dangky'] || md5(str_replace(" ", "", $_REQUEST['captcha_dangky'])) == $_SESSION['captcha_register']):
				$data = array("username", "email", "fullname", "enable", "type", "tel", "province", "district", "ward");
				if($_POST['password'] != "")
					$data[] = "password";
				$_POST['enable'] = 1;
				$_POST['type'] = "member";
				if(@$_POST['id'] != "") {
					$item = getItem($table, null, "where id not like '{$_POST['id']}' and (username like '{$_POST['email']}' or (email like '{$_POST['email']}' and email not like ''))");
					$condition = "where type like 'member' and id like '{$_POST['id']}'";
				}
				else {
					$item = getItem($table, null, "where username like '{$_POST['email']}' or (email like '{$_POST['email']}' and email not like '')");
				}
				if(@$item != false && @$item != "") {
					if(@$_POST['id'] != "")
						alert("Email đã được sử dụng!");
					else
						alert("Tên đăng nhập hoặc email đã được sử dụng!");
					back();
				}
				elseif(saveItem($table, $data, @$condition)) {
					if(@$_POST['id'] != "")
						alert("Thông tin đã được cập nhật!");
					else
						alert("Đăng ký thành công!");
					if($_POST['password'] != "") {
						logout();
						redirect(getURL("member/login"));
					}
					else
						redirect(getURL("member/setting"));
				}
				else {
					alert("Đã có lỗi xảy ra!");
					back();
				}
			else:
				alert("Mã xác thực không đúng!");
				back();
			endif;
		}
		else {
			alert("Không nhận được dữ liệu!");
			back();
		}
		break;
	case $type == "submit":
		define("_base_folder", getBaseURL()."upload/user_product");
		define("_user_folder", "./upload/user_product");
		$row_category = getItems("category", "where type like 'product' and uri not like 'du-an' and enable>0 order by parent_id, position, `index`, title", false);
		$row_project = getItem("category", null, "where uri like 'du-an'");
		$row_project = getItems("product", "where category_id like '{$row_project['id']}' and enable>0 order by create_date desc, popular desc, category_id, title", false);
		if(@$_SESSION['member']['username'] == "")
			redirect(getURL("member/login"));
		if(isset($_POST['savebtn'])) {
			if(md5(str_replace(" ", "", $_REQUEST['captcha_submit'])) == $_SESSION['captcha_submit']) {
				$data = array("title", "uri", "thumbnail", "category_id", "project_id", "serial", "price", "tel", "acreage", "address", "province", "district", "ward", "description", "create_date", "id");
				if(@$_POST['id'] == "") {
					$_POST['enable'] = 0;
					$_POST['user_id'] = $member['id'];
					$data[] = "enable";
					$data[] = "user_id";
					$_POST['id'] = $db->getMaxId("product");
				}
				else
					$condition = "where id like '{$_POST['id']}'";
				$_POST['create_date'] = time();
				$row_name = array();
				if(@$_POST['thumbnail'] != "") {
					if(!is_dir(_user_folder))
						mkdir(_user_folder, 0755);
					$row_thumbnail = explode(";;", $_POST['thumbnail']);
					foreach ($row_thumbnail as $k_thumbnail => $r_thumbnail) {
						$base64 = explode(";base64,", $r_thumbnail);
						$img = base64_decode($base64[1]);
						$name = _user_folder . "/" . changeTitle($_POST['title']) . "-" . $member['username'] . "-" . ($k_thumbnail+1) . ".png";
						$k = 1;
						while (file_exists($name)) {
							$name = _user_folder . "/" . changeTitle($_POST['title']) . "-" . $member['username'] . "-" . ($k_thumbnail+1) . "-" . $k . ".png";
							$k++;
						}
						$row_name[] = array(
							"name" => $name,
							"base_name" => str_replace(_user_folder, _base_folder, $name),
							"content" => $img
						);
					}
					foreach($row_name as $r_name):
						file_put_contents($r_name['name'], $r_name['content']);
						chmod($r_name['name'], 0755);
					endforeach;
					$_POST['thumbnail'] = $row_name[0]['base_name'];
				}
				$item = getItem("product", $_POST['id']);
				if(@$item['thumbnail'] != "")
					unlink($item['thumbnail']);
				if(saveItem("product", $data, @$condition)) {
					$items = getItems("product_image", "where product_id like '{$_POST['id']}'");
					foreach($items as $r_item):
						unlink($r_item['thumbnail']);
					endforeach;
					$db->query("delete from #_product_image where product_id like '{$_POST['id']}'");
					$data = array("product_id", "thumbnail", "enable", "index");
					$_POST['product_id'] = $_POST['id'];
					$_POST['enable'] = 1;
					for($i=1; $i<count($row_name); $i++):
						$_POST['thumbnail'] = $row_name[$i]['base_name'];
						$_POST['index'] = $i;
						saveItem("product_image", $data);
					endfor;
					if(@$condition == "")
						alert("Thông tin đã được gửi đi và đang chờ duyệt!");
					redirect(str_replace("/member/edit/".$_POST['id'], "/member/manager", str_replace("/member/submit", "/member/manager", getCurrentPageURL())).".html");
				}
				else {
					alert("Đã xảy ra lỗi!");
					back();
				}
			}
			else {
				alert("Mã xác thực không đúng!");
				back();
			}
		}
		$row_province = getItems("province", "order by name not in ('Hồ Chí Minh', 'Hà Nội'), type, name", false);
		$row_district = getItems("district", "order by type, name", false);
		$row_ward = getItems("ward", "order by type, name", false);
		$template = "member/submit";
		break;
	case $type == "manager":
		if(@$_SESSION['member']['username'] == "")
			redirect(getURL("member/login"));
		$row_product = getItems("product", "where user_id like '{$member['id']}'", true, 10);
		$template = "member/manager";
		break;
	case $type == "edit":
		define("_base_folder", getBaseURL()."upload/user_product");
		define("_user_folder", "./upload/user_product");
		if(@$_SESSION['member']['username'] == "")
			redirect(getURL("member/login"));
		$id = @$_REQUEST['param-3'];
		if($id == "")
			redirect(getURL("member/manager"));

		$row_category = getItems("category", "where type like 'product' and uri not like 'du-an' and enable>0 order by parent_id, position, `index`, title", false);
		$row_project = getItem("category", null, "where uri like 'du-an'");
		$row_project = getItems("product", "where category_id like '{$row_project['id']}' and enable>0 order by create_date desc, popular desc, category_id, title", false);

		$r_edit = getItem("product", $id);
		$row_thumbnail = getItems("product_image", "where product_id like '{$r_edit['id']}'");

		$photos = array();
		if($r_edit['thumbnail'] != "")
			$photos[] = $r_edit['thumbnail'];
		foreach ($row_thumbnail as $r_thumbnail):
			if($r_thumbnail["thumbnail"] != "")
				$photos[] = $r_thumbnail['thumbnail'];
		endforeach;

		$row_file = array();
		foreach ($photos as $photo) {
			$base64 = file_get_contents(str_replace(_base_folder, _user_folder, $photo));
			$row_file[] = array(
				"name" => $photo,
				"data" => base64_encode($base64)
			);
		}
		$row_province = getItems("province", "order by name not in ('Hồ Chí Minh', 'Hà Nội'), type, name", false);
		$row_district = getItems("district", "order by type, name", false);
		$row_ward = getItems("ward", "order by type, name", false);
		$template = "member/submit";
		break;
	case $type == "delete":
		if(@$_SESSION['member']['username'] == "")
			redirect(getURL("member/login"));
		$id = @$_REQUEST['param-3'];
		if($id == "")
			redirect(getURL("member/manager"));
		$items = getItems("product_image", "where product_id like '{$id}'");
		foreach($items as $r_item):
			unlink(@$r_item['thumbnail']);
		endforeach;
		unset($items);
		$db->query("delete from #_product_image where product_id like '{$id}'");
		$item = getItem("product", $id);
		unlink(@$item['thumbnail']);
		unset($item);
		$db->query("delete from #_product where id like '{$id}'");
		redirect(str_replace("/member/delete/".$id, "/member/manager", getCurrentPageURL()).".html");
		break;

	default:
		show_error();
		break;
}

function login() {
	global $db;
	$username = mysql_escape_string($_POST['username']);
	$db->query("select * from #_account where type like 'member' and username like '{$username}'");
	if($db->num_rows() == 0)
		return false;
	$user = $db->fetch_array();
	if($user['password'] == md5($_POST['password'])) {
		$_SESSION['member'] = array("username" => $user['username']);
		return true;
	}
	else {
		unset($_SESSION['member']);
		return false;
	}
}

function logout() {
	unset($_SESSION['member']);
}
?>