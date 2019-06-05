<?php

	if(isset($_POST['q'])) {
		$_SESSION['search']['title'] = $_POST['q'];
		redirect(getCurrentPageURL());
	}
	$keyword = $_SESSION['search']['title'];
	$keyword = preg_replace('/đ/i', 'd', $keyword);
	$category = array( "title" => "Kết quả tìm kiếm theo từ khóa '{$keyword}'" );
	if($keyword == "")
		$category = array( "title" => "Kết quả tìm kiếm theo mọi từ khóa" );

	$limit = 12;
	$step = 12;

	$db->query("select p.*, t.*, p.id from #_product p join #_translate t on p.id=t.item_id where t.language_id like '{$lang['id']}' and t.table_name like 'product' and p.enable>0 ".($keyword!="" ? "and replace(replace(t.title, 'đ', 'd'), 'Đ', 'd') like '%{$keyword}%'" : "")." order by p.level desc, p.create_date desc, t.title");
	$num_product = $db->num_rows();

	$row_product = $db->result_array();
	$row_product = $pagination->paging($row_product, $limit, $_REQUEST['p']);
	$paging = $pagination->getSource();
		
	$row_breadcrumb = array("search" => $category['title']);


	$template = "product";

?>