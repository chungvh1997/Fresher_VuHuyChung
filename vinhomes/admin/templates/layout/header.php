<?php include _source."ajax.php"; ?>

<div id="banner">
    <img class="img-responsive" width="100%" src="<?=count(explode("://", $information['banner_admin']))>1?$information['banner_admin']:str_replace("//", "/", $information['banner_admin'])?>">
</div>

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="container-fluid">
        <div class="navbar-header">
            <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> -->
            <a class="navbar-brand text-uppercase" href="<?=getBaseURL(true)?>" target="_blank">Xem website</a>
            <!-- <a class="navbar-brand text-uppercase" onclick="createSitemap();" style="font-size: 14px; color: blue;" href="javascript:void(0);">Tạo sitemap</a> -->
            <a class="navbar-brand text-uppercase" onclick="backupDatabase();" style="font-size: 14px; color: blue;" href="javascript:void(0);">Tạo sao lưu</a>
            <a class="navbar-brand text-uppercase" onclick="deleteBackup();" style="font-size: 14px; color: blue;" href="javascript:void(0);">Xóa sao lưu</a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?=$user!=false?"[".$user['fullname']."]":""?> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="index.php?com=user&act=update"><i class="fa fa-gear fa-fw"></i> Cá nhân</a></li>
                    <li class="divider"></li>
                    <li><a href="index.php?com=user&act=logout"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<script type="text/javascript">
$(document).ready(function() {
    $("button.navbar-toggle").click(function(){
        $(".sidebar").toggleClass("active");
    });
});
</script>

<style type="text/css">
    .navbar-brand {
        padding-left: 20px;
        padding-right: 20px;
        margin: 0 !important;
    }
    .navbar-brand:not(:last-child) {
        border-right: solid lightgray 1px;
    }
    .navbar-brand:hover {
        color: black !important;
        background-color: rgba(0,0,0,.1) !important;
    }
</style>