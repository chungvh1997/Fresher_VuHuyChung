<?php
$sql="select*from table_category where module='tin-tuc' and level=0 and hienthi=1 order by id desc";
$d->query($sql);
$rss_tintuc=$d->result_array();
$title = "Kênh rss";
?>