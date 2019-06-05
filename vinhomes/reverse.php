<meta charset="utf-8">
<?php
if (is_file('home1.php')) {
	rename('home1.php', 'home.php');
	echo "KHÓA đuôi thành công!";
}
elseif (is_file('home.php')) {
	rename('home.php', 'home1.php');
	echo "MỞ khóa đuôi thành công!";
}
else
	echo "Error!";
?>
<br><a href=".">Quay lại trang chủ!</a>