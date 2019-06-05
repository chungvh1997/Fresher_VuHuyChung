<?
header('Content-Type: application/xml; charset=utf-8');
@define ( '_template' , './templates/');
@define ( '_source' , './sources/');
@define ( '_lib' , './lib/');
include_once _lib."config.php";
include_once _lib."class.database.php";
include_once _lib."functions.php";
$db = new database($config['database']);
$http = $_SERVER['HTTPS']=="on" ? "https://" : "http://";

	$exits_link = array();
	$links = array();
	$db->query("select * from #_category
							where enable>0 order by parent_id, `index`");
	$categories = $db->result_array();
	$db->query("select * from #_language where enable>0 order by `index`");
	$languages = array( array("uri" => "") );
	if($db->num_rows() > 1)
		$languages = array_merge($languages, $db->result_array());
	foreach ($languages as $language) {
		$lang = ($language['uri']!="" ? $language['uri']."/" : "");
		if (!in_array($lang, $exits_link)) {
			$links[] = "<url>
			<loc>{$http}{$config_url}/$lang</loc>
			<changefreq>daily</changefreq>
			<priority>1.00</priority>
			</url>";
			$exits_link[] = $lang;
		}
		foreach ($categories as $category) {
			if(in_array( $category['uri'], array( ".", "..", "javascript:void(0)", "javascript:void(0);" ) ))
				continue;
			if(!in_array($lang.$category['uri'], $exits_link)) {
				$links[] = "<url>
				<loc>{$http}{$config_url}/{$lang}{$category['uri']}.html</loc>
				<changefreq>daily</changefreq>
				<priority>1.00</priority>
				</url>";
				$exits_link[] = $lang.$category['uri'];
			}
			$db->query("select * from #_product where category_id like '{$category['id']}'
				and enable>0 order by popular desc, level desc, create_date desc");
			$products=$db->result_array();
			foreach (@$products as $product) {
				if(!in_array($lang.$product['uri'], $exits_link))
					$links[] = "<url>
					<loc>{$http}{$config_url}/{$lang}{$product['uri']}.html</loc>
					<changefreq>daily</changefreq>
					<priority>1.00</priority>
					</url>";
					$exits_link[] = $lang.$product['uri'];
			}
			$db->query("select * from #_post where category_id like '{$category['id']}'
				and enable>0 order by popular desc, level desc, create_date desc");
			$posts=$db->result_array();
			foreach (@$posts as $post) {
				if(!in_array($lang.$post['uri'], $exits_link))
					$links[] = "<url>
					<loc>{$http}{$config_url}/{$lang}{$post['uri']}.html</loc>
					<changefreq>daily</changefreq>
					<priority>1.00</priority>
					</url>";
					$exits_link[] = $lang.$post['uri'];
			}
		}
	}
	$str = "<?xml version='1.0' encoding='UTF-8'?>
	<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'
	xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'
	xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'>
	".implode("
	", $links)."
	</urlset>
	";
	die($str);
	?>