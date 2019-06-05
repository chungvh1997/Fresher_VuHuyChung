<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-xs-12">
                <div class="login-panel panel panel-default" style="margin-top: 50px;">
                    <div class="panel-body">
                        <form id="signupfrm" action="<?= getURL("member/save") ?>" method="post" accept-charset="UTF-8" onsubmit="return signupfrm_valid(this);">
                            <div class="heading text-primary text-uppercase text-center" style="font-size: 24px; margin: 10px 0 20px 0;"><b><?=@$_SESSION['member']['username']!="" ? "Cập nhật thông tin cá nhân ({$member['username']})" : "Đăng ký tài khoản" ?></b></div>
                            <div class="content-row">
                                <?php if(@$_SESSION['member']['username']!=""): ?>
                                    <input type="hidden" name="id" value="<?= $member['id'] ?>">
                                    <input type="hidden" name="username" value="<?= $member['username'] ?>">
                                <?php else: ?>
                                    <input class="form-control fleft" type="text" name="username" placeholder="Tên đăng nhập" style="width: calc(100% - 30px);">&nbsp;&nbsp;<b style="color: red; line-height: 34px;">*</b>
                                <?php endif; ?>
                            </div>
                            <div class="content-row">
                                <input class="form-control fleft" type="text" name="email" placeholder="Địa chỉ email" style="width: calc(100% - 30px);" value="<?= @$member['email'] ?>">&nbsp;&nbsp;<b style="color: red; line-height: 34px;">*</b>
                            </div>
                            <div class="content-row">
                                <input class="form-control fleft" type="password" name="password" placeholder="Mật khẩu" style="width: calc(50% - 20px);">
                                <input class="form-control fleft" type="password" name="confirm" placeholder="Nhập lại mật khẩu" style="width: calc(50% - 20px); margin-left: 10px;">&nbsp;&nbsp;<b style="color: red; line-height: 34px;">*</b>
                            </div>
                            <div class="content-row">
                                <input class="form-control fleft" type="text" name="tel" placeholder="Điện thoại di động" style="width: calc(100% - 30px);" value="<?= @$member['tel'] ?>">&nbsp;&nbsp;<b style="color: red; line-height: 34px;">*</b>
                            </div>
                            <div class="content-row">
                                <input class="form-control fleft" type="text" name="fullname" placeholder="Tên đầy đủ" style="width: calc(100% - 30px);" value="<?= @$member['fullname'] ?>">&nbsp;&nbsp;<b style="color: red; line-height: 34px;">*</b>
                            </div>
                            <!-- <div class="content-row">
                                <input class="form-control fleft" type="date" name="ngaysinh" max="<?=date('Y-m-d', strtotime('-18 Years'))?>" placeholder="Ngày sinh" style="width: calc(100% - 30px);">
                            </div> -->
                            <!-- <div class="fleft" style="margin-bottom: 5px;">
                                <input id="nammd" type="radio" name="gioitinh" value="1" style="margin-left: 20px;" checked>&nbsp;&nbsp;<label for="nammd" style="font-weight: normal;">Nam</label>
                                <input id="numd" type="radio" name="gioitinh" value="0" style="margin-left: 30px;">&nbsp;&nbsp;<label for="numd" style="font-weight: normal;">Nữ</label>
                            </div> -->
                            <div class="content-row">
                                <select class="form-control fleft" name="province" data-table="district" data-target="#signupfrm select[name='district']" onchange="load_sel(this);" style="width: calc(35% - 15px); -font-size: 12px;">
                                    <option value="" selected disabled>Chọn Tỉnh - Thành phố</option>
                                    <?php foreach (@$row_province as $r_province): ?>
                                        <option value="<?=$r_province['id']?>" <?= $r_province['id']==@$member['province'] ? "selected" : "" ?>>
                                            <?=$r_province['type']?> <?=$r_province['name']?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                                <select class="form-control fleft" name="district" data-table="ward" data-target="#signupfrm select[name='ward']" onchange="load_sel(this);" data-default="<option value='' selected disabled>Chọn Quận - Huyện</option>" style="width: calc(35% - 15px); margin-left: 7.5px; -font-size: 12px;">
                                    <option value="" selected disabled>Chọn Quận - Huyện</option>
                                    <?php foreach (@$row_district as $r_district): ?>
                                        <option value="<?=$r_district['id']?>" <?= $r_district['id']==@$member['district'] ? "selected" : "" ?>>
                                            <?=$r_district['type']?> <?=$r_district['name']?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                                <select class="form-control fleft" name="ward" data-default="<option value='' selected disabled>Chọn Phường - Xã</option>" style="width: calc(30% - 15px); margin-left: 7.5px; -font-size: 12px;">
                                    <option value="" selected disabled>Chọn Phường - Xã</option>
                                    <?php foreach (@$row_ward as $r_ward): ?>
                                        <option value="<?=$r_ward['id']?>" <?= $r_ward['id']==@$member['ward'] ? "selected" : "" ?>>
                                            <?=$r_ward['type']?> <?=$r_ward['name']?>
                                        </option>
                                    <?php endforeach ?>
                                </select>&nbsp;&nbsp;<b style="color: red; line-height: 34px;">*</b>
                            </div>
                            <!-- <div class="fleft" style="margin-bottom: 5px;">
                                <input id="canhanmd" type="radio" name="loaihinh" value="1" style="margin-left: 20px;" checked>&nbsp;&nbsp;<label for="canhanmd" style="font-weight: normal;">Cá nhân</label>
                                <input id="tochucmd" type="radio" name="loaihinh" value="0" style="margin-left: 30px;">&nbsp;&nbsp;<label for="tochucmd" style="font-weight: normal;">Tổ chức</label>
                            </div> -->
                            <div class="content-row">
                                <input class="form-control fleft" type="text" name="captcha_dangky" placeholder="Nhập mã xác thực" style="width: calc(50% - 5px);">
                                <img class="captcha-img fleft" src="<?=getBaseURL()._source.'captcha.php'?>?ext=register" style="max-width: calc(50% - 40px); max-height: 34px; width: auto; margin-left: 10px;">
                                <img class="fleft" src="<?=getBaseURL()?>assets/img/signupmd-refresh.png" style="max-width: 30px;
                                max-height: 34px; width: auto; margin-left: 5px; cursor: pointer;" onclick="$('#signupfrm .captcha-img').attr('src', '<?=getBaseURL()._source?>captcha.php?ext=register&t=' + Math.random()); refreshCaptcha();">
                            </div>
                            <div class="fleft text-center" style="margin-top: 10px; margin-bottom: 20px;">
                                <button type="submit" name="savebtn" class="btn form-control" style="font-size: 16px; box-shadow: none; border: none; height: 50px; background: #055698; color: white; border-radius: 10px;"><b>Đăng ký</b></button>
                            </div>
                            <div class="fleft" style="-font-size: 12px;">
                                <div>Chú ý: Tên đăng nhập không thể thay đổi sau khi đăng ký.</div>
                                <div>
                                    Để được trợ giúp vui lòng liên hệ hotline
                                    <font style="color: #375699;"><?= $information['hotline'] ?></font> -
                                    hoặc email
                                    <font style="color: #375699;"><?= $information['email_receive'] ?></font>
                                </div>
                            </div>
                            <div class="text-center">Đã là thành viên?&nbsp;&nbsp;<a href="<?= getURL("member/login") ?>"><b>Đăng nhập</b></a> ngay!</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $("#showpassword").change(function() {
        if($("#showpassword").is(":checked"))
            $("#password, #confirm").attr("type", "text");
        else
            $("#password, #confirm").attr("type", "password");
    });
});
function validate(frm) {
    if(frm.password.value != frm.confirm.value) {
        alert("Xác nhận mật khẩu không trùng khớp!");
        frm.password.focus();
        return false;
    }
    return true;
}
</script>