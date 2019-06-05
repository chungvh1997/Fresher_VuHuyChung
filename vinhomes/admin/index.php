<?php
header('X-XSS-Protection:0');
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
@define ( '_template' , './templates/');
@define ( '_source' , './sources/');
@define ( '_lib' , '../lib/');
include_once _lib."config.php";
include_once _lib."class.database.php";
include_once _lib."functions.php";
include_once _lib."pagination.php";
include_once _lib."file_requick_admin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
  <link href="<?=getBaseURL(true)?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=getBaseURL(true)?>assets/css/bootstrap-theme.min.css" rel="stylesheet">
  <link href="<?=getBaseURL(true)?>assets/css/dashboard.css" rel="stylesheet">
  <link href="<?=getBaseURL(true)?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script src="<?=getBaseURL(true)?>assets/js/jquery.min.js"></script>
  <script src="<?=getBaseURL(true)?>assets/js/bootstrap.min.js"></script>
  <script src="<?=getBaseURL(true)?>assets/js/metisMenu.js"></script>
  <link rel="shortcut icon" href="<?=getBaseURL(true).$information['favicon']?>">
  <title><?=$information['title']?></title>
</head>

<body style="min-width: 1170px;">
  <?php if(@$_COOKIE['user']['username'] != ""): ?>
    <div id="header">
      <?php include _template."layout/header.php"; ?>
    </div>
    <div id="content" class="container-fluid">
      <div class="row">
        <div class="col-xs-2 sidebar">
          <?php include _template."layout/sidebar.php"; ?>
        </div>
        <div class="col-xs-10 main">
          <?php include _template.$template."_tpl.php"; ?>
        </div>
      </div>
    </div>
    <?php include _template."layout/footer.php";
  else:
    include _template.$template."_tpl.php";
  endif;?>

  <style type="text/css">
  /*html, body {
    user-select: none;
    -webkit-user-select: none;
    cursor: default;
  }*/
  textarea.form-control {
    resize: vertical;
  }
</style>
<script src="<?=getBaseURL(true)?>assets/ckeditor/ckeditor.js"></script>
<script src="<?=getBaseURL(true)?>assets/ckfinder/ckfinder.js"></script>
<script>CKEDITOR.dtd.$removeEmpty['span'] = false;</script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".editor").each(function() {
      CKEDITOR.replace( this.id, {
        contentsCss: ['<?=getBaseURL(true)?>assets/css/bootstrap.min.css'],
        enterMode: CKEDITOR.ENTER_BR,
        autoParagraph: false,
        qtBorder: '1',
        qtStyle: { 'border-collapse' : 'collapse' },
        qtClass: 'table_ckeditor',
        qtCellPadding: '5',
        qtCellSpacing: '5',
        width: '100%',
        height: 300,
        resize_enabled: false,
        removePlugins: 'resize',
        removePlugins : 'elementspath',
        filebrowserImageBrowseUrl: '<?=getBaseURL(true)?>assets/ckfinder/ckfinder.html?Type=<?= $resourceType != "" ? $resourceType : "files" ?>',
        filebrowserFlashBrowseUrl: '<?=getBaseURL(true)?>assets/ckfinder/ckfinder.html?Type=<?= $resourceType != "" ? $resourceType : "files" ?>',
        filebrowserLinkBrowseUrl: '<?=getBaseURL(true)?>assets/ckfinder/ckfinder.html?Type=<?= $resourceType != "" ? $resourceType : "files" ?>',
        filebrowserImageUploadUrl: '<?=getBaseURL(true)?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '<?=getBaseURL(true)?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        filebrowserLinkUploadUrl: '<?=getBaseURL(true)?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload'
      });
    });
    $('*[disabled]').each(function() {
      $('form').append('<input name="'+$(this).attr('name')+'" type="hidden" value="'+$(this).val()+'">');
    });
  });
  function openBrowser(imgid, inputid, volumeid='image', rf=undefined, cb=undefined) {
    var selectedImage = function(fileUrl) {
      if(rf == undefined || rf == false) {
        $(imgid).attr("src", fileUrl);
        $(inputid).val(fileUrl);
        if(cb != undefined)
          setTimeout(function() { cb(fileUrl); }, 100);
      }
      else {
        if(fileUrl.split("://").length <= 1 && fileUrl[0] == "/")
          fileUrl = fileUrl.slice(1);
        rf(fileUrl);
      }
    };
    var finder = new CKFinder();
    finder.resourceType = "<?= $resourceType != "" ? $resourceType : "files" ?>";
    if($(inputid).data("type") != undefined && $(inputid).data("type") != "")
      finder.resourceType = $(inputid).data("type");
    finder.selectActionFunction = selectedImage;
    finder.popup();
  }
</script>
<script>
  $(document).ready(function () {
    $("form").submit(function () {
      if($(this).find(".required").length > 0) {
        var kt = 0;
        $(this).find(".required").each(function () {
          if($(this).val() == "" || $(this).val() == null) {
            kt=1;
            alert("Vui lòng nhập nội dung trường '" + $(this).attr("title") + "'");
            $(this).focus();
          }
        });
        if(kt == 1)
          return false;
      }
    });
  });
</script>
<style type="text/css">
  table img,
  .well img,
  table svg,
  .well svg {
    max-width: 150px;
    height: auto !important;
    background-color: #E9E9E9 !important;
  }
</style>
<script src="../assets/js/smoothScroll.js"></script>
<script>
  $(document).ready(function () {
    $.smoothScroll();
  });
</script>
</body>
</html>
