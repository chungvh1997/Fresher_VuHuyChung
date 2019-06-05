<link rel="stylesheet" type="text/css" href="./assets/imageuploadify/imageuploadify.min.css">
<script type="text/javascript" src="./assets/imageuploadify/imageuploadify.js"></script>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="login-panel panel panel-default row" style="margin-top: 50px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Đăng tin miễn phí</h3>
                    </div>
                    <div class="panel-body">
                        <form action="<?= getURL("member/submit") ?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                            <fieldset>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Tiêu đề: </label><input name="title" type="text" class="form-control" placeholder="Nhập tiêu đề" value="<?= @$r_edit['title'] ?>" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label>Danh mục: </label>
                                        <select name="category_id" class="form-control" title="Danh mục sản phẩm" required>
                                            <option value="" selected>-- Chọn danh mục --</option>
                                            <?php foreach($row_category as $r_category): ?>
                                                <option value="<?= $r_category['id'] ?>" <?= @$r_edit['category_id']==$r_category['id'] ? "selected" : "" ?>>
                                                    <?= $r_category['title'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Dự án: </label>
                                        <select name="project_id" class="form-control" title="Danh mục sản phẩm">
                                            <option value="" selected>-- Chọn dự án --</option>
                                            <?php foreach($row_project as $r_project): ?>
                                                <option value="<?= $r_project['id'] ?>" <?= @$r_edit['project_id']==$r_project['id'] ? "selected" : "" ?>>
                                                    <?= $r_project['title'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Mã BĐS: </label>
                                        <input name="serial" type="text" class="form-control" placeholder="Nhập mã bất động sản" value="<?= @$r_edit['serial'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Giá: </label>
                                        <input name="price" type="text" class="form-control" placeholder="Nhập giá" value="<?= @$r_edit['price'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Số phòng: </label>
                                        <input name="tel" type="text" class="form-control" placeholder="Nhập số phòng" value="<?= @$r_edit['tel'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Diện tích: </label>
                                        <input name="acreage" type="text" class="form-control" placeholder="Nhập diện tích" value="<?= @$r_edit['acreage'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ: </label>
                                        <input name="address" type="text" class="form-control" placeholder="Nhập địa chỉ liên hệ" value="<?= @$r_edit['address'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Tỉnh - Thành phố: </label>
                                        <select class="form-control fleft" name="province" data-table="district" data-target="#content select[name='district']" onchange="load_sel(this);">
                                            <option value="" selected disabled>Chọn Tỉnh - Thành phố</option>
                                            <?php foreach (@$row_province as $r_province): ?>
                                                <option value="<?=$r_province['id']?>" <?= $r_province['id']==@$r_edit['province'] ? "selected" : "" ?>>
                                                    <?=$r_province['type']?> <?=$r_province['name']?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Quận - Huyện: </label>
                                        <select class="form-control fleft" name="district" data-table="ward" data-target="#content select[name='ward']" onchange="load_sel(this);" data-default="<option value='' selected disabled>Chọn Quận - Huyện</option>">
                                            <option value="" selected disabled>Chọn Quận - Huyện</option>
                                            <?php foreach (@$row_district as $r_district): ?>
                                                <option value="<?=$r_district['id']?>" <?= $r_district['id']==@$r_edit['district'] ? "selected" : "" ?>>
                                                    <?=$r_district['type']?> <?=$r_district['name']?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Phường - Xã: </label>
                                        <select class="form-control fleft" name="ward" data-default="<option value='' selected disabled>Chọn Phường - Xã</option>">
                                            <option value="" selected disabled>Chọn Phường - Xã</option>
                                            <?php foreach (@$row_ward as $r_ward): ?>
                                                <option value="<?=$r_ward['id']?>" <?= $r_ward['id']==@$r_edit['ward'] ? "selected" : "" ?>>
                                                    <?=$r_ward['type']?> <?=$r_ward['name']?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Mã xác thực: </label>
                                        <input class="form-control" type="text" name="captcha_submit" placeholder="Nhập mã xác thực" required>
                                    </div>
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <img class="captcha-img" src="<?=getBaseURL()._source.'captcha.php'?>?ext=submit" style="max-height: 34px; width: auto; margin-left: 5px;">
                                        <img src="<?=getBaseURL()?>assets/img/signupmd-refresh.png" style="max-height: 34px; width: auto; cursor: pointer;" onclick="$('#content .captcha-img').attr('src', '<?=getBaseURL()._source?>captcha.php?ext=submit&t=' + Math.random()); refreshCaptcha();">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả: </label>
                                        <textarea name="description" rows="4" class="form-control" placeholder="Nhập mô tả"><?= @$r_edit['description'] ?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Ảnh đại diện: </label><br><input id="thumbnail" data-name="thumbnail" type="file" accept="image/*" multiple>
                                        <input name="thumbnail" type="hidden">
                                    </div>
                                </div>
                                <div class="button-container col-xs-12 text-center">
                                    <input type="hidden" name="id" value="<?= @$r_edit['id'] ?>">
                                    <button type="submit" name="savebtn" class="btn btn-lg btn-success button-block">Đăng tin</button>&nbsp;&nbsp;
                                    <a href="<?= str_replace("/member/edit", "/member/manager", str_replace("/member/submit", "/member/manager", getCurrentPageURL())).".html" ?>" class="btn btn-lg btn-warning button-block">Quay lại</a>
                                </div>
                            </fieldset>
                        </form>
                        <h5 class="label label-danger" <?=@$error!="" ? '' : 'style="display:none;"'?>><?=@$error?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var imageuploadify = $("#thumbnail").imageuploadify();
        var file_header = "data:image/jpeg;base64,";
        <?php if(!empty($row_file)): ?>
            var files = [];
            <?php foreach ($row_file as $file): ?>
                files.push({
                    name: '<?=$file['name']?>',
                    size: 0,
                    type: "image/jpeg",
                    src: file_header + '<?=$file['data']?>'
                });
            <?php endforeach; ?>
            imageuploadify.addFiles(files);
        <?php endif; ?>
    });
    function validation() {
        var length = $(".imageuploadify-container").length;
        if(length > 8) {
            alert("Số lượng tối đa cho phép là 8 hình!");
            return false;
        }
        return true;
    }
</script>
<style type="text/css">
    .form-group {
        float: left;
        width: 100%;
        line-height: 34px;
        margin-bottom: 5px;
    }
    .form-group label {
        float: left;
        width: 150px;
        margin-bottom: 0;
    }
    .form-group .form-control {
        float: right;
        width: calc(100% - 155px);
    }
    .form-group textarea {
        resize: vertical;
        min-height: 50px;
    }
    .button-block {
        display: inline-block;
        width: auto;
        margin-top: 15px;
    }
    .imageuploadify {
        min-height: 0;
    }
    .imageuploadify .imageuploadify-images-list i {
        display: none;
    }
    .imageuploadify .imageuploadify-images-list span.imageuploadify-message {
        border: none;
    }
    .imageuploadify .imageuploadify-images-list button.btn-default {
        margin-top: 5px;
    }
</style>