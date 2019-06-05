<?php
$table = "account";
$type = @$_REQUEST['type'];
if($type == "")
	$filterType = array("'user'", "'admin'");
else
	$filterType = array("'member'");
$filterType = implode(", ", $filterType);
// $type_list = array( "user" => "Cộng tác viên", "admin" => "Quản trị viên", "member" => "Tài khoản cá nhân" );
$type_list = array( "user" => "Cộng tác viên", "admin" => "Quản trị viên" );
switch (true) {
	case in_array($act, array("login", "")):
		if(@$_POST['username']!="" && @$_POST['password']!=""):
			if(login()):
				redirect("index.php");
			else:
				$error = "Tên đăng nhập hoặc mật khẩu không đúng!";
			endif;
		endif;
		$template = "user/login";
		break;
	case $act=="logout":
		logout();
		redirect("index.php?com=user&act=login");
                  
	case $act=="list":
		if(!checkAdmin())
			show_error();
		$items = getItems(array("table" => $table, "condition" => "where type in ({$filterType}) order by username", "limit" => 20, "pagination" => true));
		$paging = $pagination->getSource("&p");
		$template = "user/list";
		break;
	case $act=="edit":
		if($_REQUEST['id'] != "") {
			$item = getItems(array("table" => $table, "id" => $_REQUEST['id']));
			if(!is_array(@$item)) show_error();
		}
		$template = "user/edit";
		break;
	case $act=="update":
		$item = getUser();
		$template = "user/edit";
		break;
	case $act=="save":
		$user = getUser();
		if(!checkAdmin())
			if($user['id'] != $_POST['id'])
				show_error();
		if(isset($_POST['savebtn'])) {
			$data = array("username", "email", "fullname", "address", "tel", "type", "enable");
			if($_POST['password'] != "")
				$data[] = "password";
			if(@$_POST['id'] != "") {
				$item = getItems(array("table" => $table, "id" => 0, "condition" => "where id not like '{$_POST['id']}' and (username like '".trim($_POST['username'])."' or (email like '{$_POST['email']}' and email not like ''))"));
				$condition = "where id like '{$_POST['id']}'";
			}
			else {
				$item = getItems(array("table" => $table, "id" => 0, "condition" => "where username like '".trim($_POST['username'])."' or (email like '{$_POST['email']}' and email not like '')"));
			}
			if(@$item != false && @$item != "") {
				alert("Tên đăng nhập hoặc email đã tồn tại!");
				back();
			}
			elseif(saveItem(array("table" => $table, "data" => $data, "condition" => @$condition))) {
				if($_POST['react'] == "update" && $type != "member") {
					logout();
					redirect("index.php?com=user&act=login");
				}
				redirect( preg_replace('/(&id=\d*)/', '', str_replace("&act=save", "&act=list", getCurrentPageURL())) );
			}
			else {
				alert("Lỗi lưu dữ liệu!");
				back();
			}
		}
	default:
		redirect(getBaseURL(true)."404.html");
		break;
}
  
function login() {
	global $db;
	$username = mysql_escape_string($_POST['username']);
	$db->query("select * from #_account where type in ('user', 'admin') and username like '{$username}'");
	if($db->num_rows() == 0)
		return false;
	$user = $db->fetch_array();
	if($user['password'] == md5($_POST['password'])) {
          setcookie("user[username]", $user['username'], time() + 86400*30, "/");
		return true;
	}
	else {
    setcookie("user[username]", "", time() - 3600, "/");
		return false;
	}
}
  
function logout() {
    setcookie("user[username]", "", time() - 3600, "/");
}
?>