<?php
include _lib."phpmailer/class.phpmailer.php";
$phpmailer = new PHPMailer(true);
$db = new database($config['database']);
$container = "container";

getTarget();

if (isset($_POST['contactbtn'])) {
	saveContact();
}

switch (true) {
	// case ($_REQUEST['param-1'] == "member"):
	// 	setResource(array( "source" => "member", "title" => "Tài khoản cá nhân", "item" => $information ));
	// 	break;
	
	case (is_array($category) && !empty($category)):
		$breadcrumb_string = getBreadcrumbString2(array( "table" => "category", "item" => $category ));
		setResource(array( "source" => $category['type'], "item" => $category ));
		break;
	case (is_array($product) && !empty($product)):
		$breadcrumb_string = getBreadcrumbString2(array( "table" => "product", "item" => $product ));
		$product = getItems(array("table" => "product", "id" => $product['id']));
		setResource(array( "source" => "product", "item" => $product ));
		break;
	case (is_array($post) && !empty($post)):
		$breadcrumb_string = getBreadcrumbString2(array( "table" => "post", "item" => $post ));
		setResource(array( "source" => "post", "item" => $post ));
		break;
	case ($_REQUEST['param-1'] == "" && $_REQUEST['param-2'] == "" && $_REQUEST['param-3'] == ""):
		$breadcrumb_array = array(
			array( "level" => "1", "link" => $config_url, "title" => $information['title'] )
		);
		$breadcrumb_string = getBreadcrumbString2();
		setResource(array( "source" => "index", "template" => "index", "item" => $information ));
		break;
	default:
		show_error();
		break;
}

if (!defined('_source')) {
	show_error();
}
if ($source!="" && file_exists(_source.$source.".php")) {
	include _source.$source.".php";
}

function getTarget()
{
	global $db, $lang, $information, $layout, $design, $classify, $category, $product, $post;

	if ($_REQUEST['lang']!="") {
		if (@$_REQUEST['lang']!=@$_SESSION['lang']['uri']) {
			unset($_SESSION['filter']);
		}
		$lang = getItems(array("table" => "language", "id" => 0, "condition" => "where uri like '{$_REQUEST['lang']}' and enable>0"));
		if (!is_array($lang)) {
			show_error();
		}
	} else {
		$lang = getItems(array("table" => "language", "id" => 0, "condition" => "where enable>0 order by `index`"));
		if (!is_array($lang)) {
			show_error();
		}
	}
	$_SESSION['lang'] = $lang;
	if (isset($_POST['backuri'])) {
		redirect(getURL($_POST['backuri']));
	}

	$information = getItems(array("table" => "website", "id" => 0, "condition" => "where language_id like '{$lang['id']}' limit 1"));

	$layout = getLayout("layout");
	$design = getLayout("design");
	$classify = getLayout("classify");
	$home_id = array();
	foreach ($classify['home'] as $value) {
		$home_id[] = $value['id'];
	}
	foreach ($layout as $k => $l) {
		foreach ($l as $kl => $vl) {
			if(in_array($vl['id'], $home_id))
				$layout[$k][$kl]['uri'] = ".";
		}
	}
	foreach ($classify as $k => $l) {
		foreach ($l as $kl => $vl) {
			if(in_array($vl['id'], $home_id))
				$classify[$k][$kl]['uri'] = ".";
		}
	}

	$category = getItems(array("table" => "category", "id" => 0, "condition" => "where uri like '{$_REQUEST['param-1']}' and enable>0"));
	if (is_array($category) && !empty($category)) {
		foreach ($classify['contact'] as $r_contact) {
			if($category['id'] == $r_contact['id']) {
				$category['type'] = "contact";
				break;
			}
		}
			foreach ($classify['intro'] as $r_contact) {
			if($category['id'] == $r_contact['id']) {
				$category['type'] = "intro";
				break;
			}
		}
			foreach ($classify['tintuc'] as $r_contact) {
			if($category['id'] == $r_contact['id']) {
				$category['type'] = "tintuc";
				break;
			}
		}
			foreach ($classify['sukien'] as $r_contact) {
			if($category['id'] == $r_contact['id']) {
				$category['type'] = "sukien";
				break;
			}
		}
			foreach ($classify['search'] as $r_contact) {
			if($category['id'] == $r_contact['id']) {
				$category['type'] = "search";
				break;
			}
		}
			foreach ($classify['tuyendung'] as $r_contact) {
			if($category['id'] == $r_contact['id']) {
				$category['type'] = "tuyendung";
				break;
			}
		}
	}

	$db->query("select p.* from #_product p join #_category c on p.category_id = c.id
							where c.type like 'product'
							and p.uri like '{$_REQUEST['param-1']}'");
	$product = $db->fetch_array();
	if (is_array($product) && !empty($product))
		$product = getItems(array("table" => "product", "id" => $product['id']));

	$db->query("select p.* from #_post p join #_category c on p.category_id = c.id
							where c.type like 'post'
							and p.uri like '{$_REQUEST['param-1']}'");
	$post = $db->fetch_array();
	if (is_array($post) && !empty($post))
		$post = getItems(array("table" => "post", "id" => $post['id']));
}

function setResource($resource)
{
	global $template, $source, $tag, $seo, $title, $information;
	$template = (@$resource['template'] != "" ? $resource['template'] : "");
	$source = @$resource['source'];
	$tag = array(
		"h1" => @$resource['item']['h1']!="" ? $resource['item']['h1'] : $information['h1'],
		"h2" => @$resource['item']['h2']!="" ? $resource['item']['h2'] : $information['h2'],
		"h3" => @$resource['item']['h3']!="" ? $resource['item']['h3'] : $information['h3']
	);
	$seo = array(
		"keyword"   => @$resource['item']['keyword']!="" ? $resource['item']['keyword'] : $information['keyword'],
		"desc"      => @$resource['item']['desc']!="" ? $resource['item']['desc'] : $information['desc'],
		"thumbnail" => @$resource['item']['thumbnail']!='' ? $resource['item']['thumbnail'] : $information['favicon']
	);
	$title = @$resource['title']!='' ? $resource['title'] : @$resource['item']['title'];
	if($source != "index")
		$title = $information['title'] . " - " . $title;
}

function saveContact() {
	global $information, $phpmailer;
	// $token = $_POST['g-recaptcha-response'];
	// $ch = curl_init();
	// curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
	// $postfields = array(
	// 	"secret=6LfYf4EUAAAAALvVBIeyjjo35r43GI3rtazYg8Pb",
	// 	"response=".$token
	// );
	// curl_setopt($ch, CURLOPT_POST, 1);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, implode("&", $postfields));
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// $server_output = curl_exec($ch);
	// $server_output = json_decode($server_output);
	// $result = $server_output->success;
	// if ($result == true) {
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$condition = "";
		$data = array("name", "tel", "email", "content", "create_date");

		// $data_email = array(
		// 	"ten" => $_POST['name'],
		// 	"dienthoai" => $_POST['tel'],
		// 	"email" => $_POST['email'],
		// 	"noidung" => $_POST['content'],
		// 	"ngaytao" => date("d/m/Y H:i:s", time())
		// );
  //   $html = $information['email_content'];
  //   $text = "Họ tên: {$_POST['name']} <br>Điện thoại: {$_POST['tel']} <br>Email: {$_POST['email']} <br>Nội dung: {$_POST['content']} <br>Ngày tạo: {$data_email['ngaytao']} <br>";
  //   foreach ($data_email as $k => $d)
  //       $html = str_replace("#".$k."#", $d, $html);
  //   $sender = array(
  //       "host" => $information['email_host'],
  //       "port" => $information['email_port'],
  //       "username" => $information['email_send'],
  //       "password" => $information['password_send'],
  //       "email" => $information['email_send'],
  //       "name" => $information['email_name']
  //   );
  //   $rcpt = array( $information['email_receive'] );
  //   $content_arr = array(
  //       "subject" => $information['email_subject'],
  //       "html" => $html,
  //       "text" => $text
  //   );
    
  //   $phpmailer->init($sender, $rcpt, $content_arr, 0);
  //   $phpmailer->send();

		if (saveItem(array("table" => "contact", "data" => $data))) {
			alert("Thông tin liên hệ đã được gửi đi!");
			redirect(getCurrentPageURL());
		} else {
			alert("Đã có lỗi xảy ra!");
			back();
		}
	// }
	// else {
	// 	alert("Mã xác minh không đúng hoặc hết hạn!");
	// 	back();
	// }
}