<?php
$lang = getItems(array("table" => "language", "id" => 0, "condition" => "limit 1"));
foreach ($lang as $k => $l)
	$lang[$k] = mb_strtolower($l, "UTF-8");
$row_category = getItems(array("table" => "category", "condition" => "where enable>0 order by `index`"));

$row_position = array(
	// Position
	'layout-top' => array("type" => "position", "name" => "layout", "group" => "top", "title" => "Menu top"),
	'layout-center' => array("type" => "position", "name" => "layout", "group" => "center", "title" => "Menu chính"),
	'layout-index-top' => array("type" => "position", "name" => "layout", "group" => "index-top", "title" => "Khu vực trang chủ 1 (khu vực giới thiệu)"),
	'layout-index-product' => array("type" => "position", "name" => "layout", "group" => "index-product", "title" => "Khu vực trang chủ 2 (khu vực nổi bật)"),
	'layout-footer-left' => array( "type" => "position", "name" => "layout", "group" => "footer-1", "title" => "Menu {$lang['column_11']} footer"),
	'layout-footer-right' => array( "type" => "position", "name" => "layout", "group" => "footer-2", "title" => "Menu {$lang['column_12']} footer"),
	// Container
	'design-general' => array("type" => "container", "title" => "Tổng quan website", "layout" => array(
		array("type" => "color", "name" => "design", "group" => "body-bg", "title" => "nền toàn website"),
		
	)),
	'design-footer' => array("type" => "container", "title" => "Footer", "layout" => array(
		array("type" => "color", "name" => "design", "group" => "footer-bg", "title" => "nền footer"),
		array("type" => "color", "name" => "design", "group" => "footer-ff", "title" => "nền thường đường kẻ tiêu đề footer"),
		array("type" => "color", "name" => "design", "group" => "footer-fg", "title" => "chữ thường footer + nền nổi đường kẻ tiêu đề footer"),
		array("type" => "color", "name" => "design", "group" => "footer-fv", "title" => "chữ nổi footer"),
		array("type" => "color", "name" => "design", "group" => "copyright-bg", "title" => "nền copyright"),
		array("type" => "color", "name" => "design", "group" => "copyright-fg", "title" => "chữ thường copyright"),
		array("type" => "color", "name" => "design", "group" => "copyright-fv", "title" => "chữ nổi copyright"),
	)),
	// Page Type
	'classify-home' => array("type" => "position", "name" => "classify", "group" => "home", "title" => "Trang chủ"),
	'classify-contact' => array("type" => "position", "name" => "classify", "group" => "contact", "title" => "Trang liên hệ"),
	'classify-intro' => array("type" => "position", "name" => "classify", "group" => "intro", "title" => "Trang Giới thiệu"),
	'classify-tintuc' => array("type" => "position", "name" => "classify", "group" => "tintuc", "title" => "Trang Tin tức"),
	'classify-sukien' => array("type" => "position", "name" => "classify", "group" => "sukien", "title" => "Trang Sự kiện"),
	'classify-search' => array("type" => "position", "name" => "classify", "group" => "search", "title" => "Trang tìm kiếm"),
	'classify-product' => array("type" => "position", "name" => "classify", "group" => "product", "title" => "Trang bất động sản"),
	'classify-tuyendung' => array("type" => "position", "name" => "classify", "group" => "tuyendung", "title" => "Trang tuyển dụng"),
);
$unlist = array();
foreach ($row_position as $r_position) {
	if(@$r_position['name'] != "")
		$unlist[] = "'".$r_position['name']."'";
	if(is_array($r_position['layout']) && !empty($r_position['layout'])) {
		foreach ($r_position['layout'] as $r_layout) {
			if(@$r_layout['name'] != "")
				$unlist[] = "'".$r_layout['name']."'";
		}
	}
}
if(is_array($unlist) && !empty($unlist))
	$db->query("delete from #_layout where name not in (".implode(",", $unlist).")");

$template = "graph/edit";

function getGraph($opts = array()) {
	global $db;
	if(!is_array($opts) || empty($opts))
		return "Error!";
	switch ($opts['type']) {
		case "image":
			$item = getItems(array("table" => "layout", "id" => 0, "condition" => "where name like '{$opts['name']}'"));
			$group = array("class" => @$opts['group']!="" ? "group group-{$opts['name']}" : "", "attribute" => @$opts['group']!="" ? $opts['group'] : "");
			$link = array("attribute" => "", "function" => "", "class" => "");
			if(@$opts['group'] != "") {
				$value = getGroupValues($item['value'], $opts['group']);
				$item['value'] = $value['value'];
				$item['link'] = $value['link'];
			}
			elseif(@$opts['link'] === true) {
				$value = getImageValues($item['value']);
				$item['value'] = $value['value'];
				$item['link'] = $value['link'];
			}
			if(@$opts['link'] === true) {
				$link = array(
					'attribute' => "data-link=\"".($item['link']!=""?$item['link']:"javascript:void(0);")."\"",
					'function' => "function(url){ var result = prompt('Nhập địa chỉ liên kết khi click vào hình ảnh:'); if(!result) return; $('#{$opts['name']}_input').data('link', result); }",
					'class' => 'link'
				);
			}
			$result = array("<div class=\"panel panel-primary panel-{$opts['name']}\"><div class=\"panel-heading\">Hình {$opts['title']}</div><div class=\"panel-body\"><div class=\"image-container\"><button type=\"button\" class=\"close image-close\" onclick=\"$('#{$opts['name']}_input_{$group['attribute']}').val(''); $('#{$opts['name']}_input_{$group['attribute']}').data('link', 'javascript:void(0);'); $('#{$opts['name']}_img_{$group['attribute']}').attr('src','');\">x</button><div onclick=\"openBrowser('#{$opts['name']}_img_{$group['attribute']}', '#{$opts['name']}_input_{$group['attribute']}', 'image', false, {$link['function']});\"><img id=\"{$opts['name']}_img_{$group['attribute']}\" src=\"{$item['value']}\" onerror=\"imgError(this)\" title=\"Chọn hình {$opts['title']}\" style=\"cursor: pointer;\"><input class=\"input {$group['class']} {$link['class']}\" id=\"{$opts['name']}_input_{$group['attribute']}\" name=\"{$opts['name']}\" type=\"hidden\" data-type=\"image\" value=\"{$item['value']}\" data-name=\"{$opts['name']}\" data-value=\"\" data-group=\"{$group['attribute']}\" {$link['attribute']}><div class=\"image-label\">Hình {$opts['title']}</div></div></div></div></div>");
			break;
		case "color":
			$item = getItems(array("table" => "layout", "id" => 0, "condition" => "where name like '{$opts['name']}'"));
			$group = array("class" => @$opts['group']!="" ? "group group-{$opts['name']}" : "", "attribute" => @$opts['group']!="" ? $opts['group'] : "");
			if(@$opts['group'] != "") {
				$value = getGroupValues($item['value'], $opts['group']);
				$item['value'] = $value['value'];
			}
			$opacity = $item['value'] == "" ? "style=\"opacity:0;\"" : "";
			$result = array("<div class=\"panel panel-primary panel-{$opts['name']}\"><div class=\"panel-heading\">Màu {$opts['title']}</div><div class=\"panel-body\"><div class=\"color-container\"><button type=\"button\" class=\"close color-close\" onclick=\"$('#{$opts['name']}_input_{$group['attribute']}').val(''); $('#{$opts['name']}_color_{$group['attribute']}').css('opacity', '0');\">x</button><input title=\"Chọn màu {$opts['title']}\" id=\"{$opts['name']}_color_{$group['attribute']}\" value=\"{$item['value']}\" onchange=\"$('#{$opts['name']}_input_{$group['attribute']}').val($(this).val()); $(this).css('opacity', '1');\" type=\"color\" {$opacity}><input id=\"{$opts['name']}_input_{$group['attribute']}\" class=\"input {$group['class']}\" name=\"{$opts['name']}\" type=\"hidden\" value=\"{$item['value']}\" data-type=\"color\" data-name=\"{$opts['name']}\" data-value=\"\"><div class=\"color-label\">Màu {$opts['title']}</div></div></div></div>");
			break;
		case "video":
			$item = getItems(array("table" => "layout", "id" => 0, "condition" => "where name like '{$opts['name']}'"));
			$group = array("class" => @$opts['group']!="" ? "group group-{$opts['name']}" : "", "attribute" => @$opts['group']!="" ? $opts['group'] : "");
			if(@$opts['group'] != "") {
				$value = getGroupValues($item['value'], $opts['group']);
				$item['value'] = $value['value'];
			}
			$opacity = $item['value'] == "" ? "style=\"opacity:0;\"" : "";
			$result = array("<div class=\"panel panel-primary panel-{$opts['name']}\"><div class=\"panel-heading\">Video {$opts['title']}</div><div class=\"panel-body\"><div class=\"video-container\" style=\"float: left; width: calc(100% / ".min($column, count($opts['layout']))." - 16px);\"><button type=\"button\" class=\"close video-close\" onclick=\"$('#{$opts['name']}_input_{$group['attribute']}').val(''); $('#{$opts['name']}_video_{$group['attribute']}').css('opacity', '0');\">x</button><div class='iframe-container' title=\"Nhập link youtube video {$opts['title']}\" id=\"{$opts['name']}_video_{$group['attribute']}\" onclick=\"var result=prompt('Nhập link youtube video {$opts['title']}'); if(!result) return; $('#{$opts['name']}_input_{$group['attribute']}').val(result); $(this).find('iframe').attr('src', result.replace('/watch?v=', '/embed/')); $(this).css('opacity', '1');\" {$opacity}>".getYoutubeIframe($item['value'])."</div><input class=\"input {$group['class']}\" id=\"{$opts['name']}_input_{$group['attribute']}\" name=\"{$opts['name']}\" type=\"hidden\" value=\"{$item['value']}\" data-type=\"video\" data-name=\"{$opts['name']}\" data-value=\"\" data-group=\"{$group['attribute']}\"><div class=\"video-label\">Video {$opts['title']}</div></div></div></div>");
			break;
		case "position":
			$class = "";
			$column = 4;
			if($opts['fullwidth'] === true) {
				$class="fullwidth";
			}
			if(intval($opts['column']) > 0) {
				$column = $opts['column'];
			}
			$r_position = getItems(array("table" => "layout", "id" => 0, "condition" => "where name like '{$opts['name']}'"));
			if(@$opts['group'] != "") {
				$value = getGroupValues($r_position['value'], $opts['group']);
				$r_position['value'] = $value['value'];
			}
			$r_position = json_decode($r_position['value']);
			$layout = "";
			if(is_array($opts['layout']) && !empty($opts['layout'])) {
				foreach ($opts['layout'] as $bg) {
					$item = getItems(array("table" => "layout", "id" => 0, "condition" => "where name like '{$bg['name']}'"));
					$group = array("class" => @$bg['group']!="" ? "group group-{$bg['name']}" : "", "attribute" => @$bg['group']!="" ? $bg['group'] : "");
					$link = array("attribute" => "", "function" => "", "class" => "");
					if(@$bg['group'] != "") {
						$value = getGroupValues($item['value'], $bg['group']);
						$item['value'] = $value['value'];
						$item['link'] = $value['link'];
					}
					elseif (@$bg['link'] === true) {
						$value = getImageValues($item['value']);
						$item['value'] = $value['value'];
						$item['link'] = $value['link'];
					}
					if(@$bg['link'] === true) {
						$link = array(
							'attribute' => "data-link=\"".($item['link']!=""?$item['link']:"javascript:void(0);")."\"",
							'function' => "function(url){ var result = prompt('Nhập địa chỉ liên kết khi click vào hình ảnh:'); if(!result) return; $('#{$bg['name']}_input').data('link', result); }",
							'class' => "link"
						);
					}
					if($bg['type'] == "image") {
						$layout .= "<div class=\"image-container\" style=\"float: left; width: calc(100% / ".min($column, count($opts['layout']))." - 16px);\"><button type=\"button\" class=\"close image-close\" onclick=\"$('#{$bg['name']}_input_{$group['attribute']}').val(''); $('#{$bg['name']}_input_{$group['attribute']}').data('link', 'javascript:void(0);'); $('#{$bg['name']}_img_').attr('src','');\">x</button><div onclick=\"openBrowser('#{$bg['name']}_img_{$group['attribute']}', '#{$bg['name']}_input_{$group['attribute']}', 'image', false, {$link['function']});\"><img id=\"{$bg['name']}_img_{$group['attribute']}\" src=\"{$item['value']}\" onerror=\"imgError(this)\" title=\"Chọn hình {$bg['title']}\" style=\"cursor: pointer;\"><input class=\"input layout-input {$group['class']} {$link['class']}\" id=\"{$bg['name']}_input_{$group['attribute']}\" name=\"{$bg['name']}\" type=\"hidden\" data-type=\"image\" value=\"{$item['value']}\" data-name=\"{$bg['name']}\" data-value=\"\" {$link['attribute']} data-group=\"{$group['attribute']}\"><div class=\"image-label\">Hình {$bg['title']}</div></div></div>";
					}
					elseif($bg['type'] == "color") {
						$opacity = $item['value'] == "" ? "style=\"opacity:0;\"" : "";
						$layout .= "<div class=\"color-container\" style=\"float: left; width: calc(100% / ".min($column, count($opts['layout']))." - 16px);\"><button type=\"button\" class=\"close color-close\" onclick=\"$('#{$bg['name']}_input_{$group['attribute']}').val(''); $('#{$bg['name']}_color_{$group['attribute']}').css('opacity', '0');\">x</button><input title=\"Chọn màu {$bg['title']}\" id=\"{$bg['name']}_color_{$group['attribute']}\" value=\"{$item['value']}\" onchange=\"$('#{$bg['name']}_input_{$group['attribute']}').val($(this).val()); $(this).css('opacity', '1');\" type=\"color\" {$opacity}><input class=\"input layout-input {$group['class']}\" id=\"{$bg['name']}_input_{$group['attribute']}\" name=\"{$bg['name']}\" type=\"hidden\" value=\"{$item['value']}\" data-type=\"color\" data-name=\"{$bg['name']}\" data-value=\"\" data-group=\"{$group['attribute']}\"><div class=\"color-label\">Màu {$bg['title']}</div></div>";
					}
					elseif($bg['type'] == "video") {
						$opacity = $item['value'] == "" ? "style=\"opacity:0;\"" : "";
						$layout .= "<div class=\"video-container\" style=\"float: left; width: calc(100% / ".min($column, count($opts['layout']))." - 16px);\"><button type=\"button\" class=\"close video-close\" onclick=\"$('#{$bg['name']}_input_{$group['attribute']}').val(''); $('#{$bg['name']}_video_{$group['attribute']}').css('opacity', '0');\">x</button><div class='iframe-container' title=\"Nhập link youtube video {$bg['title']}\" id=\"{$bg['name']}_video_{$group['attribute']}\" onclick=\"var result=prompt('Nhập link youtube video {$bg['title']}'); if(!result) return; $('#{$bg['name']}_input_{$group['attribute']}').val(result); $(this).find('iframe').attr('src', result.replace('/watch?v=', '/embed/')); $(this).css('opacity', '1');\" {$opacity}>".getYoutubeIframe($item['value'])."</div><input class=\"input layout-input {$group['class']}\" id=\"{$bg['name']}_input_{$group['attribute']}\" name=\"{$bg['name']}\" type=\"hidden\" value=\"{$item['value']}\" data-type=\"video\" data-name=\"{$bg['name']}\" data-value=\"\" data-group=\"{$group['attribute']}\"><div class=\"video-label\">Video {$bg['title']}</div></div>";
					}
				}
			}
			$group = array("class" => @$opts['group']!="" ? "group group-{$opts['name']}" : "", "attribute" => @$opts['group']!="" ? $opts['group'] : "");
			$result = array("<div class=\"panel panel-primary panel-position {$class}\"><div class=\"panel-heading\">{$opts['title']}</div><div class=\"position-container panel-body sortable\"><input class=\"input {$group['class']}\" type=\"hidden\" name=\"position[{$opts['name']}]\" value=\"\" data-type=\"position\" data-name=\"{$opts['name']}\" data-value=\"\" data-group=\"{$group['attribute']}\">{$layout}<div class=\"clearfix\"></div>");
			foreach ($r_position as $r_p) {
				$r_category = getItems(array("table" => "category", "id" => $r_p));
				$rs = "<div data-id=\"{$r_category['id']}\" class=\"category text-primary\">{$r_category['title']}<button class=\"close hidden\" type=\"button\" title=\"Gỡ bỏ\" onclick=\"$(this).parent().remove()\">x</button></div>";
				$result[] = $rs;
			}
			$result[] = "</div></div>";
			break;
		case "container":
			$class = "";
			$column = 4;
			if($opts['fullwidth'] === true) {
				$class="fullwidth";
			}
			if(intval($opts['column']) > 0) {
				$column = $opts['column'];
			}
			$layout = "";
			if(is_array($opts['layout']) && !empty($opts['layout'])) {
				foreach ($opts['layout'] as $bg) {
					$item = getItems(array("table" => "layout", "id" => 0, "condition" => "where name like '{$bg['name']}'"));
					$group = array("class" => @$bg['group']!="" ? "group group-{$bg['name']}" : "", "attribute" => @$bg['group']!="" ? $bg['group'] : "");
					$link = array("attribute" => "", "function" => "", "class" => "");
					if(@$bg['group'] != "") {
						$value = getGroupValues($item['value'], $bg['group']);
						$item['value'] = $value['value'];
						$item['link'] = $value['link'];
					}
					elseif($bg['link'] === true) {
						$value = getImageValues($item['value']);
						$item['value'] = $value['value'];
						$item['link'] = $value['link'];
					}
					if($bg['type'] == "image") {
						if($bg['link'] === true) {
							$link = array(
								'attribute' => "data-link=\"".($item['link']!=""?$item['link']:"javascript:void(0);")."\"",
								'function' => "function(url){ var result = prompt('Nhập địa chỉ liên kết khi click vào hình ảnh:'); if(!result) return; $('#{$bg['name']}_input').data('link', result); }",
								'class' => "link"
							);
						}
						$layout .= "<div class=\"image-container\" style=\"float: left; width: calc(100% / ".min($column, count($opts['layout']))." - 16px);\"><button type=\"button\" class=\"close image-close\" onclick=\"$('#{$bg['name']}_input_{$group['attribute']}').val(''); $('#{$bg['name']}_input_{$group['attribute']}').data('link', 'javascript:void(0);'); $('#{$bg['name']}_img_{$group['attribute']}').attr('src','');\">x</button><div onclick=\"openBrowser('#{$bg['name']}_img_{$group['attribute']}', '#{$bg['name']}_input_{$group['attribute']}', 'image', false, {$link['function']});\"><img id=\"{$bg['name']}_img_{$group['attribute']}\" src=\"{$item['value']}\" onerror=\"imgError(this)\" title=\"Chọn hình {$bg['title']}\" style=\"cursor: pointer;\"><input class=\"input layout-input {$group['class']} {$link['class']}\" id=\"{$bg['name']}_input_{$group['attribute']}\" name=\"{$bg['name']}\" type=\"hidden\" data-type=\"image\" value=\"{$item['value']}\" data-name=\"{$bg['name']}\" data-value=\"\" {$link['attribute']} data-group=\"{$group['attribute']}\"><div class=\"image-label\">Hình {$bg['title']}</div></div></div>";
					}
					elseif($bg['type'] == "color") {
						$opacity = $item['value'] == "" ? "style=\"opacity:0;\"" : "";
						$layout .= "<div class=\"color-container\" style=\"float: left; width: calc(100% / ".min($column, count($opts['layout']))." - 16px);\"><button type=\"button\" class=\"close color-close\" onclick=\"$('#{$bg['name']}_input_{$group['attribute']}').val(''); $('#{$bg['name']}_color_{$group['attribute']}').css('opacity', '0');\">x</button><input title=\"Chọn màu {$bg['title']}\" id=\"{$bg['name']}_color_{$group['attribute']}\" value=\"{$item['value']}\" onchange=\"$('#{$bg['name']}_input_{$group['attribute']}').val($(this).val()); $(this).css('opacity', '1');\" type=\"color\" {$opacity}><input class=\"input layout-input {$group['class']}\" id=\"{$bg['name']}_input_{$group['attribute']}\" name=\"{$bg['name']}\" type=\"hidden\" value=\"{$item['value']}\" data-type=\"color\" data-name=\"{$bg['name']}\" data-value=\"\" data-group=\"{$group['attribute']}\"><div class=\"color-label\">Màu {$bg['title']}</div></div>";
					}
					elseif($bg['type'] == "video") {
						$opacity = $item['value'] == "" ? "style=\"opacity:0;\"" : "";
						$layout .= "<div class=\"video-container\" style=\"float: left; width: calc(100% / ".min($column, count($opts['layout']))." - 16px);\"><button type=\"button\" class=\"close video-close\" onclick=\"$('#{$bg['name']}_input_{$group['attribute']}').val(''); $('#{$bg['name']}_video_{$group['attribute']}').css('opacity', '0');\">x</button><div class='iframe-container' title=\"Nhập link youtube video {$bg['title']}\" id=\"{$bg['name']}_video_{$group['attribute']}\" onclick=\"var result=prompt('Nhập link youtube video {$bg['title']}'); if(!result) return; $('#{$bg['name']}_input_{$group['attribute']}').val(result); $(this).find('iframe').attr('src', result.replace('/watch?v=', '/embed/')); $(this).css('opacity', '1');\" {$opacity}>".getYoutubeIframe($item['value'])."</div><input class=\"input layout-input {$group['class']}\" id=\"{$bg['name']}_input_{$group['attribute']}\" name=\"{$bg['name']}\" type=\"hidden\" value=\"{$item['value']}\" data-type=\"video\" data-name=\"{$bg['name']}\" data-value=\"\" data-group=\"{$group['attribute']}\"><div class=\"video-label\">Video {$bg['title']}</div></div>";
					}
				}
			}
			$result = array("<div class=\"panel panel-primary panel-position {$class}\"><div class=\"panel-heading\">{$opts['title']}</div><div class=\"position-container panel-body\">{$layout}<div class=\"clearfix\"></div>");
			$result[] = "</div></div>";
			break;
		default:
			return "Error!";
			break;
	}
	return implode("", $result);
}
function getGroupValues($value, $name) {
	$value = json_decode($value);
	foreach ($value as $v) {
		if($v->name == $name)
			return get_object_vars($v);
	}
}
function getImageValues($value) {
	$value = json_decode($value);
	return get_object_vars($value);
}
?>