<?php
switch (true) {
	case is_array($category) && $category['type']=="post":
		$category_id = array($category['id']);
		$row_id = $category_id;
		while (is_array($row_id) && !empty($row_id)) {
			$row_cat = getItems(array("table" => "category", "condition" => "where parent_id in (".implode(",", $row_id).") and enable>0 order by `index`"));
			$row_id = array();
			foreach($row_cat as $r_cat)
				$row_id[] = $r_cat['id'];
			$category_id = array_merge($category_id, $row_id);
		}

		$limit = 12;
		$step = 12;
		
		$row_post = getItems(array("table" => "post", "condition" => "where category_id in (".implode(",", $category_id).") and enable>0 order by level desc, create_date desc, title"));

		$num_post = count($row_post);
		$row_post = array_slice($row_post, 0, $limit);

		// $row_post = $pagination->paging($row_post, $limit, $_REQUEST['p']);
		
		$row_breadcrumb = array($category['uri'] => $category['title']);
		$id_list = array($category['parent_id']);
		$not_list = array($category['id']);
		do {
			$row_category = getItems(array("table" => "category", "condition" => "where id in (".implode(",", $id_list).") and id not in (".implode(",", $not_list).")"));
			foreach ($row_category as $r_category) {
				if(intval($r_category['parent_id']) > 0) {
					$id_list[] = $r_category['parent_id'];
				}
				$row_breadcrumb[$r_category['uri']] = $r_category['title'];
				$not_list[] = $r_category['id'];
			}
		} while (is_array($row_category) && !empty($row_category));
		$row_breadcrumb = array_reverse($row_breadcrumb);

		$template = "post";
		break;

	case is_array($post):

		$limit = 8;
		$step = 12;

		$row_relative_cat = getItems(array("table" => "post", "condition" => "where category_id like '{$post['category_id']}' and enable>0 and id not like '{$post['id']}' order by level, create_date desc, title"));
		$num_post = count($row_relative_cat);
		$row_relative_cat = $pagination->paging($row_relative_cat, $limit, $_REQUEST['p']);

		$row_breadcrumb = array($post['uri'] => $post['title']);
		$id_list = array($post['category_id']);
		$not_list = array("''");
		do {
			$row_category = getItems(array("table" => "category", "condition" => "where id in (".implode(",", $id_list).") and id not in (".implode(",", $not_list).")"));
			foreach ($row_category as $r_category) {
				if(intval($r_category['parent_id']) > 0) {
					$id_list[] = $r_category['parent_id'];
				}
				$row_breadcrumb[$r_category['uri']] = $r_category['title'];
				$not_list[] = $r_category['id'];
			}
		} while (is_array($row_category) && !empty($row_category));
		$row_breadcrumb = array_reverse($row_breadcrumb);

		$template = "post_detail";
		if($_SESSION['view_history']['post-'.$post['id']] == "") {
			$db->query("update #_post set view = view + 1 where id like '{$post['id']}'");
			$_SESSION['view_history']['post-'.$post['id']] = "1";
		}
		
		if ($post['category_id'] == $classify['tuyendung'][0]['id']) {
			$template = "tuyendung_detail";
		}
		break;

	default:
		show_error();
		break;
}
?>