<ul class="nav nav-sidebar">
  <li class="active">
    <a data-toggle="collapse" href="#nav-1" aria-expanded="false"><i class="glyphicon glyphicon-th-list"></i> Sản phẩm<span class="fa arrow"></span></a>
  </li>
  <ul id="nav-1" class="nav collapse">
    <li>
      <a data-id="#nav-1" data-com="product_category" href="index.php?com=category&act=list&type=product">Danh mục sản phẩm</a>
    </li>
    <li>
      <a data-id="#nav-1" data-com="project_category" href="index.php?com=category&act=list&type=project">Danh mục dự án</a>
    </li>
    <li>
      <a data-id="#nav-1" data-com="_product" href="index.php?com=product&act=list">Sản phẩm</a>
    </li>
  </ul>
  <li class="active">
    <a data-toggle="collapse" href="#nav-2" aria-expanded="false"><i class="glyphicon glyphicon-th-list"></i> Bài viết<span class="fa arrow"></span></a>
  </li>
  <ul id="nav-2" class="nav collapse">
    <li>
      <a data-id="#nav-2" data-com="post_category" href="index.php?com=category&act=list&type=post">Danh mục bài viết</a>
    </li>
    <li>
      <a data-id="#nav-2" data-com="_post" href="index.php?com=post&act=list">Bài viết</a>
    </li>
  </ul>
  <li class="active">
    <a data-toggle="collapse" href="#nav-3" aria-expanded="false"><i class="glyphicon glyphicon-th-list"></i> Danh mục trang<span class="fa arrow"></span></a>
  </li>
  <ul id="nav-3" class="nav collapse">
    <li>
      <a data-id="#nav-3" data-com="page_category" href="index.php?com=category&act=list&type=page">Danh mục trang</a>
    </li>
    <!-- <?php $row_page = getItems(array("table" => "category", "condition" => "where type like 'page' and enable>0 order by `index`, title")) ?>
    <?php foreach ($row_page as $r_page): ?>
      <li>
        <a data-id="#nav-3" data-com="page_<?= $r_page['id'] ?>_category" href="index.php?com=category&act=edit&type=page&id=<?= $r_page['id'] ?>"><?= $r_page['title'] ?></a>
      </li>
    <?php endforeach ?> -->
  </ul>
  <li class="active">
    <a data-toggle="collapse" href="#nav-4" aria-expanded="false"><i class="glyphicon glyphicon-th-list"></i> Hình ảnh & Liên kết<span class="fa arrow"></span></a>
  </li>
  <ul id="nav-4" class="nav collapse">
    <li>
            <a data-id="#nav-4" data-com="video_image" href="index.php?com=image&act=list&type=video">Video</a>
    </li>
    <li>
      <a data-id="#nav-4" data-com="slide_image" href="index.php?com=image&act=list&type=slide">Hình ảnh trình chiếu</a>
    </li>
    <li>
      <a data-id="#nav-4" data-com="slide_image" href="index.php?com=image&act=list&type=popular">Hình ảnh nổi bật</a>
    </li>
    <li>
      <a data-id="#nav-4" data-com="link_image" href="index.php?com=image&act=list&type=link">Liên kết mạng xã hội</a>
    </li>
    <li>
      <a data-id="#nav-4" data-com="link_image" href="index.php?com=image&act=list&type=share">Chia sẻ mạng xã hội</a>
    </li>
  </ul>
  <li class="active">
    <a data-toggle="collapse" href="#nav-5" aria-expanded="false"><i class="glyphicon glyphicon-th-list"></i> <?=checkAdmin() ? "Tài khoản & T" : "T"?>in liên hệ<span class="fa arrow"></span></a>
  </li>
  <ul id="nav-5" class="nav collapse">
    <li>
      <a data-id="#nav-5" data-com="_contact" href="index.php?com=contact&act=list">Tin liên hệ</a>
    </li>
    <!-- <li>
            <a data-id="#nav-5" data-com="member_user" href="index.php?com=user&act=list&type=member">Tài khoản cá nhân</a>
    </li> -->
		<?php if(checkAdmin()): ?>
    <li>
      <a data-id="#nav-5" data-com="_user" href="index.php?com=user&act=list">Tài khoản quản trị</a>
    </li>
		<?php endif; ?>
  </ul>
  <li class="active">
    <a data-toggle="collapse" href="#nav-19" aria-expanded="false"><i class="glyphicon glyphicon-th-list"></i> Giao diện<span class="fa arrow"></span></a>
  </li>
  <ul id="nav-19" class="nav collapse">
    <li>
      <a data-id="#nav-19" data-com="layout_graph" href="index.php?com=graph&type=layout">Quản lý bố cục</a>
    </li>
    <li>
      <a data-id="#nav-19" data-com="design_graph" href="index.php?com=graph&type=design">Hình ảnh và màu sắc</a>
    </li>
    <li>
      <a data-id="#nav-19" data-com="classify_graph" href="index.php?com=graph&type=classify">Phân loại danh mục</a>
    </li>
  </ul>
  <li class="active">
    <a data-toggle="collapse" href="#nav-10" aria-expanded="false"><i class="glyphicon glyphicon-menu-hamburger"></i> Thiết lập<span class="fa arrow"></span></a>
  </li>
  <ul id="nav-10" class="nav collapse">
    <li>
      <a data-id="#nav-10" data-com="_language" href="index.php?com=language&act=list">Ngôn ngữ</a>
    </li>
    <li>
      <a data-id="#nav-10" data-com="_website" href="index.php?com=website">Thông tin website</a>
    </li>
    <li>
      <a data-id="#nav-10" data-com="_footer" href="index.php?com=footer">Thông tin footer</a>
    </li>
    <li>
      <a data-id="#nav-10" data-com="_email" href="index.php?com=email">Thông tin email</a>
    </li>
    <!-- <li>
            <a data-id="#nav-10" data-com="color" href="index.php?com=color">Bảng màu & hình nền</a>
    </li> -->
  </ul>
</ul>

<script type="text/javascript">
  $(document).ready(function() {
    $('a[data-toggle="collapse"]').click(function() {
      $(".nav.collapse:not(" + $(this).attr("href") + ")").collapse("hide");
    });
    <?php if(@$com=="category" && $_GET['type']=="page" && $_GET['id'] != ""): ?>
      $('[data-com="<?=@$_GET['type']?>_<?= @$_GET['id'] ?>_<?=preg_replace('/(-+.*$)/', '', @$com)?>"]').addClass("active");
      $($('[data-com="<?=@$_GET['type']?>_<?= @$_GET['id'] ?>_<?=preg_replace('/(-+.*$)/', '', @$com)?>"]').data("id")).collapse("show");
    <?php else: ?>
      $('[data-com="<?=@$_GET['type']?>_<?=preg_replace('/(-+.*$)/', '', @$com)?>"]').addClass("active");
      $($('[data-com="<?=@$_GET['type']?>_<?=preg_replace('/(-+.*$)/', '', @$com)?>"]').data("id")).collapse("show");
    <?php endif; ?>
    if($("a.active").length == 0)
      $("#nav-1").collapse("show");
    $(window).resize(function () {
      setTimeout(function() {
        $("#content").css("min-height", ($(window).outerHeight() -
                $("#header").outerHeight() -
                $("#footer").outerHeight()) + "px");
      });
    });
    $(window).trigger("resize");
  });
</script>

<style media="screen">
  .sidebar {
    position: relative;
    overflow: visible;
  }
  li.active {
    border-bottom: solid rgb(66,139,150) 1px;
  }
  ul.nav.collapse a.active {
    background: rgb(230,230,230);
  }
</style>
