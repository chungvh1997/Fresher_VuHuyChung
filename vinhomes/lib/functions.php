<?php
if(!defined('_lib')) die("Error");

function alert($s){
	echo '<meta charset="utf-8"><script language="javascript"> alert("'.$s.'") </script>';
}
function back($n=1){
	echo '<script language="javascript">history.go("'.-intval($n).'");</script>';
	exit(1);
}
function delete_file($file){
	return @unlink(realpath("../" . $file));
}
function redirect($url='', $root=false){
	if($root)
		echo '<script language="javascript">window.location = "'.getBaseURL().$url.'" </script>';
	else
		echo '<script language="javascript">window.location = "'.$url.'" </script>';
	exit(1);
}
function show_error() {
	redirect(getBaseURL(true, false) . "404.html");
}
function getHostURL() {
    $pageURL = 'http';
	if(isset($_SERVER["HTTPS"])){
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}}
    	$pageURL .= "://";
    $pageURL .= $_SERVER["SERVER_NAME"];
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= ":".$_SERVER["SERVER_PORT"];
    }
    return $pageURL;
}
function getCurrentPageURL($str="", $page=true, $lang=true) {
    $pageURL = 'http';
	if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")
		$pageURL .= "s";
  $pageURL .= "://";
  if ($_SERVER["SERVER_PORT"] != "80")
      $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
  else
    $pageURL .= $_SERVER["SERVER_NAME"].str_replace(".html", "", $_SERVER["REQUEST_URI"]);
  if($page === false) {
		$pageURL = explode("/p=", $pageURL);
		if(count($pageURL) <= 1)
			$pageURL = explode("&p=", $pageURL[0]);
		$pageURL = $pageURL[0];
	}
	// if($_REQUEST['lang']=="" && $lang===true && count(explode("/admin/", $_SERVER['REQUEST_URI']))<=1)
	// 	$pageURL .= $_REQUEST['lang']."/";
	return $pageURL.$str;
}
function getURL($uri, $root=false, $lang=true){
	global $db;
	if($uri=="")
		return getBaseURL($root);
	if(count(explode("://", $uri)) > 1 || in_array($uri, array( "javascript:void(0);", "javascript:void(0)" )))
		return $uri;
	if(in_array($uri, array( "//", "#", "." )))
		return getBaseURL($root) . $uri;
	$uri = explode("/", $uri);
	for($i=0; $i<count($uri); $i++):
		$uri[$i] = changeTitle($uri[$i]);
	endfor;
	$uri = implode("/", $uri);
	return getBaseURL($root, $lang).$uri.".html";
}
function getBaseURL($root=false, $lang=true){
	$server= $_SERVER['PHP_SELF'];
	if($root)
		$server = str_replace("admin/", "", $server);
	if($_REQUEST['lang']!="" && $lang===true)
		$server .= $_REQUEST['lang']."/";
	return str_replace("index.php", "", $server);
}
function changeTitle($str){
	$str = stripUnicode($str);
	$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
	$str = preg_replace('/([^a-zA-Z0-9]+)/', ' ', $str);
	$str = preg_replace('/\s/', '-', trim($str));
	return $str;
}
function stripUnicode($str){
  if(!$str) return false;
   $unicode = array(
     'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
     'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
     'd'=>'đ',
     'D'=>'Đ',
     'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
   	  'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
   	  'i'=>'í|ì|ỉ|ĩ|ị',
   	  'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
     'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
   	  'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
     'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
   	  'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
     'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
   );
   foreach($unicode as $khongdau=>$codau) {
     	$arr=explode("|",$codau);
     	foreach ($arr as $value) {
     		$str = str_replace($arr,$khongdau,$str);
     	}

   }
   return $str;
}
function checkURI($table, $obj) {
	global $db;
	$tables = array( "category", "product", "post", "language" );
	if(!in_array($table, $tables))
		return $obj['uri'];

	for($u=0; ; $u++) {
		$error = 0;
		foreach ($tables as $value) {
			$condition = "";
			if($value == $table)
				$condition = "and id not like '{$obj['id']}'";
			$db->query("select id from #_{$value} where uri like '" . $obj['uri'] . ($u>0 ? "-".$u : "") . "' " . $condition);
			if( $db->num_rows() > 0 || in_array($obj['uri'] . ($u>0 ? "-".$u : ""), array("index")) ) {
				$error = 1;
				break;
			}
		}
		if($error == 0)
			return $obj['uri'] . ($u>0 ? "-".$u : "");
	}
}
function getYoutubeId($url) {
	$url = explode("/watch?v=", $url);
	if(count($url) > 1)
		return $url[1];
	$url = explode("/embed/", $url);
	if(count($url) > 1)
		return $url[1];
	return $url;
}
function getYoutubeImg($url) {
	return "//img.youtube.com/vi/".getYoutubeId($url)."/0.jpg";
}
function getYoutubeEmbed($url) {
	return "//www.youtube.com/embed/".getYoutubeId($url)."?rel=0";
}
function getYoutubeIframe($url) {
	return '<iframe width="100%" height="auto" src="'.getYoutubeEmbed($url).'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
	// return "<iframe width='100%' height='auto' src='".getYoutubeEmbed($url)."' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>";
}
function getUser() {
	global $db;
	if(@$_COOKIE['user']['username'] == "")
		return false;
	$db->query("select * from #_account where username like '{$_COOKIE['user']['username']}'");
	if($db->num_rows() == 0)
		return false;
	$result = $db->fetch_array();
	return $result;
}
function checkAdmin($d = null) {
  $result = getUser();
	return @$result['type'] == "admin";
}
function getAjaxURL($name){
	return getHostURL().getBaseURL(true, false)."admin/ajax/".$name;
}
function dump($var){
	if (is_array($var)) {
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}
	else
		var_dump($var);
}
function getTranslate($table, $language_id, $item_id, $column="*") {
	global $db;
	$db->query("select {$column} from #_translate where language_id like '{$language_id}' and item_id like '{$item_id}' and table_name like '{$table}'");
	$result = $db->fetch_array();
	unset($result['id']);
	unset($result['item_id']);
	unset($result['language_id']);
	return $result;
}
function getItems($args = array()) {
	global $db, $pagination;
	$options = array( "table" => false, "id" => false, "ids" => false, "condition" => false, "offset" => 0, "limit" => false, "pagination" => false, "paged" => false, "relationship" => "and", "orderby" => array("id asc") );
	foreach ($args as $key => $value)
		$options[$key] = $value;
	if ($options["table"] === false) {
		return false;
	}
	elseif ($options["condition"] !== false) {
		$sql = "select * from #_{$options["table"]} {$options["condition"]}";
	}
	else {
		$sql = "select * from #_{$options["table"]}";
		$condition = array();
		if($options["id"] !== false)
			$condition[] = "id like '{$options["id"]}'";
		if($ids !== false) {
			if(is_array($options["ids"]) && !empty($options["ids"]))
				$condition[] = "id in (".implode(",", $options["ids"]).")";
			elseif(trim($options["ids"]) != "")
				$condition[] = "id in ({$options["ids"]})";
		}
		if(!empty($condition))
			$sql .= " where ".implode(" ".$options["relationship"]." ", $condition);
		if(is_array($options["orderby"]) && !empty($options["orderby"]))
			$orderby = " order by ".implode(",", $options["orderby"]);
		else
			$orderby = "";
		$sql .= $orderby;
	}
	$db->query($sql);
	if($db->num_rows() == 0)
		return false;
	$items = $db->result_array();
	if($options["id"] === false) {
		if($options["limit"] !== false) {
			if($options["pagination"] === true) {
				if($options["paged"] !== false)
					$items = $pagination->paging($items, $options["limit"], $options["paged"]);
				else
					$items = $pagination->paging($items, $options["limit"]);
			}
			else {
				$items = array_slice($items, $options["offset"], $options["limit"]);
			}
		}
		elseif($options["offset"] > 0)
			$items = array_slice($items, $options["offset"]);
	}
	for($i=0; $i<count($items); $i++):
		$translate = getTranslate($options['table'], $_SESSION['lang']['id'], $items[$i]['id']);
		foreach($translate as $column => $value):
			$items[$i][$column] = $value;
		endforeach;
	endfor;
	if($options["id"] !== false) {
		return $items[0];
	}
	return $items;
}
function getLayout($name) {
	global $db, $pagination;
	if($name === false)
		return false;
	$db->query("select * from #_layout where name like '{$name}' limit 1");
	if($db->num_rows() <= 0)
		return false;
	$r_layout = $db->fetch_array();
	$items = array();
	switch (true) {
		case $r_layout['type'] == "group":
			$value = json_decode($r_layout['value']);
			foreach ($value as $v) {
				$t = get_object_vars($v);
				switch($t['type']) {
					case "position":
						$category = array();
						$r_position = json_decode($t['value']);
						foreach ($r_position as $rs) {
							$db->query("select * from #_category where id like '{$rs}' limit 1");
							if($db->num_rows() > 0)
								$category[] = $db->fetch_array();
						}
						for($i=0; $i<count($category); $i++):
							$translate = getTranslate("category", $_SESSION['lang']['id'], $category[$i]['id']);
							foreach($translate as $column => $value):
								$category[$i][$column] = $value;
							endforeach;
						endfor;
						$items[$t['name']] = $category;
						break;
					case "image":
						$items[$t['name']] = array("thumbnail" => $t['value'], "link" => $t['link']);
						break;
					case "color":
						$items[$t['name']] = $t['value'];
						break;
					case "video":
						$items[$t['name']] = array("thumbnail" => getYoutubeImg($t['value']), "link" => $t['value'], "iframe" => getYoutubeIframe($t['value']));
						break;
				}
			}
			return $items;
			break;
		case $r_layout['type'] == "position":
			$r_position = json_decode($r_layout['value']);
			foreach ($r_position as $rs) {
				$db->query("select * from #_category where id like '{$rs}' limit 1");
				if($db->num_rows() > 0)
					$items[] = $db->fetch_array();
			}
			for($i=0; $i<count($items); $i++):
				$translate = getTranslate("category", $_SESSION['lang']['id'], $items[$i]['id']);
				foreach($translate as $column => $value):
					$items[$i][$column] = $value;
				endforeach;
			endfor;
			return $items;
			break;
		case $r_layout['type'] == "image":
			$value = json_decode($r_layout['value']);
			return get_object_vars($value);
			break;
		case $r_layout['type'] == "video":
			$value = json_decode($r_layout['value']);
			$value->iframe = getYoutubeIframe($value->value);
			return get_object_vars($value);
			break;
		default:
			return $r_layout['value'];
			break;
	}
	return false;
}
function saveItem($args = array()) {
	global $db;
	$options = array( "table" => false, "data" => array(), "condition" => "", "affix" => "", "insert" => false );
	foreach ($args as $key => $value)
		$options[$key] = $value;
	if($options['table'] === false)
		return false;
	if($options['affix']!="")
		$options['affix'] = "_".$options['affix'];
	$item = array();
	foreach ($options['data'] as $index) {
		if($index == "uri") {
			if($_POST["uri"]!="") {
				$item["uri"] = $_POST["uri"];
			}
			else
				$item["uri"] = changeTitle(trim($_POST["title"]));
		}
		elseif($index == "password")
			$item["password"] = md5($_POST["password"]);
		elseif($index == "create_date") {
			if($options['condition'] == "")
				$item["create_date"] = time();
		}
		else
			$item[$index] = trim($_POST[$index.$options['affix']]);
	}

	$db->setTable($options['table']);
	if($options['insert']===false && $options['condition'] != "") {
		$db->setCondition($options['condition']);
		$db->select();
		if($db->num_rows()==0 && in_array($options['table'], array( "translate", "contact" ))) {
			$item["id"] = $db->getMaxId($options['table']);
			$db->setCondition();
			return $db->insert($item);
		}
		if(@$item["uri"] != "") {
			$db->select();
			$item["id"] = $db->fetch_array();
			$item["id"] = $item["id"]["id"];
			if($_POST["uri"]=="")
				$item["uri"] = checkURI($options['table'], $item);
		}
		return $db->update($item);
	}
	else {
		if($_POST["id{$options['affix']}"]!="" && $options['table']!="translate")
			$item["id"] = $_POST["id{$options['affix']}"];
		else
			$item["id"] = $db->getMaxId($options['table']);
		if(@$item["uri"] != "" && $_POST["uri"]=="")
			$item["uri"] = checkURI($options['table'], $item);
		$db->setCondition();
		return $db->insert($item);
	}
}
function getFilter($filterStr, $prefix = "") {
	$filter = array();
	if(@$_SESSION[$filterStr] == "")
		return "";
	foreach ($_SESSION[$filterStr] as $key => $value)
		if($value != "") {
			if(count(explode("_id", $key)) > 1)
				$filter[] = "{$key} like '{$value}'";
			else
				$filter[] = "{$key} like '%{$value}%'";
		}
	if(empty($filter))
		return "";
	return $prefix." ".implode(" and ", $filter);
}

function getCategoryPath($id = "") {
	global $db;
	$cat = getItems(array("table" => "category", "id" => $id));
	if($id == "" || !is_array($cat) || empty($cat))
		return "";
	$id_list = array($cat['parent_id'] => $cat['title']);
	$not_list = array($cat['id']);
	do {
		$row_category = getItems(array("table", "category", "condition" => "where id in (".implode(",", array_keys($id_list)).") and id not in (".implode(",", $not_list).") and type like '{$cat['type']}'"));
		foreach ($row_category as $r_category) {
			$id_list[$r_category['parent_id']] = $r_category['title'];
			$not_list[] = $r_category['id'];
		}
	} while (is_array($row_category) && !empty($row_category));
	$id_list = array_reverse($id_list);
	return implode(" / ", array_values($id_list));
}

function getSize($width, $height) {
	return "<div>(&nbsp;<font style=\"color:red; font-weight: 900;\">{$width}</font>px&nbsp;&nbsp;*&nbsp;&nbsp;<font style=\"color:red; font-weight: 900;\">{$height}</font>px&nbsp;)</div>";
}

function getBreadcrumbString($breadcrumb_array) {
	$str = "<script type='application/ld+json'>{";
	$str .= '"@context":"https://schema.org",';
	$str .= '"@type":"BreadcrumbList",';
	$str .= '"itemListElement":[';
	foreach ($breadcrumb_array as $kbr => $br):
		$str .= '{';
		$str .= '"@type":"ListItem",';
		$str .= '"position":'.$br['level'].',';
		$str .= '"item":{';
		$str .= '"@id":"'.$br['link'].'",';
		$str .= '"name":"'.$br['title'].'"';
		$str .= '}';
		$str .= '}';
		if($kbr < count($breadcrumb_array)-1)
			$str .= ',';
	endforeach;
	$str .= "]}</script>";
	return $str;
}

function getBreadcrumbString2($args = array()) {
	global $config_url, $information;
	$breadcrumb_array = array(array( "level" => "1", "link" => $config_url, "title" => $information['title'] ));
	switch (true) {
		case in_array($args['table'], array('category')):
			$row_emp = array($args['item']);
			$r_id = $args['item']['parent_id'];
			do {
				$r_emp = getItems(array( "table" => "category", "id" => $r_id ));
				if(is_array($r_emp) && !empty($r_emp)) {
					$row_emp[] = $r_emp;
					$r_id = $r_emp['parent_id'];
				}
			} while(is_array($r_emp) && !empty($r_emp));
			$row_emp = array_reverse($row_emp);
			foreach ($row_emp as $k_emp => $r_emp) {
				$breadcrumb_array[] = array(
					"level" => $k_emp + 2,
					"link" => $config_url."/".$r_emp['uri'].".html",
					"title" => $r_emp['title']
				);
			}
			break;
		case in_array($args['table'], array("product", "post")):
			$row_emp = array($args['item']);
			$r_id = $args['item']['category_id'];
			do {
				$r_emp = getItems(array( "table" => "category", "id" => $r_id ));
				if(is_array($r_emp) && !empty($r_emp)) {
					$row_emp[] = $r_emp;
					$r_id = $r_emp['parent_id'];
				}
			} while(is_array($r_emp) && !empty($r_emp));
			$row_emp = array_reverse($row_emp);
			foreach ($row_emp as $k_emp => $r_emp) {
				$breadcrumb_array[] = array(
					"level" => $k_emp + 2,
					"link" => $config_url."/".$r_emp['uri'].".html",
					"title" => $r_emp['title']
				);
			}
			break;
	}
	$str = "<script type='application/ld+json'>{";
	$str .= '"@context":"https://schema.org",';
	$str .= '"@type":"BreadcrumbList",';
	$str .= '"itemListElement":[';
	foreach ($breadcrumb_array as $kbr => $br):
		$str .= '{';
		$str .= '"@type":"ListItem",';
		$str .= '"position":'.$br['level'].',';
		$str .= '"item":{';
		$str .= '"@id":"'.$br['link'].'",';
		$str .= '"name":"'.$br['title'].'"';
		$str .= '}';
		$str .= '}';
		if($kbr < count($breadcrumb_array)-1)
			$str .= ',';
	endforeach;
	$str .= "]}</script>";
	return $str;
}
?>
