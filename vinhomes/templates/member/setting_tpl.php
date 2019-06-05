<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-xs-12">
                <div class="login-panel panel panel-default" style="margin-top: 50px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cập nhật thông tin tài khoản '<?=$member['username']?>'</h3>
                    </div>
                    <div class="panel-body">
                        <form action="<?=getURL("member/save")?>" method="post" onsubmit="return validate(this);">
                            <fieldset>
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?=@$member['id']?>">
                                    <input type="hidden" name="username" value="<?=@$member['username']?>">
                                    <label>Mật khẩu mới: </label><input id="password" name="password" type="password" class="form-control" placeholder="Nhập mật khẩu" title="Mật khẩu đăng nhập vào hệ thống" value="">
                                </div>
                                <div class="form-group">
                                   <label>Xác nhận mật khẩu mới: </label><input id="confirm" type="password" class="form-control" placeholder="Nhập lại mật khẩu" title="Xác nhận mật khẩu đăng nhập vào hệ thống" value="">
                                </div>
                                <div class="form-group">
                                   <label>Email: </label><input name="email" type="email" class="form-control" placeholder="Nhập tên đăng nhập" title="Tên đăng nhập vào hệ thống" value="<?=$member['email']?>" required>
                                </div>
                                <div class="form-group">
                                   <label>Họ tên người dùng: </label><input name="fullname" type="text" class="form-control" placeholder="Nhập tên người dùng" title="Tên đầy đủ của người dùng" value="<?=$member['fullname']?>">
                                </div>
                                <div class="form-group">
                                   <label>Địa chỉ người dùng: </label><input name="address" type="text" class="form-control" placeholder="Nhập địa chỉ người dùng" title="Địa chỉ của người dùng" value="<?=$member['address']?>">
                                </div>
                                <div class="form-group">
                                   <label>Điện thoại người dùng: </label><input name="tel" type="text" class="form-control" placeholder="Nhập điện thoại người dùng" title="Điện thoại của người dùng" value="<?=$member['tel']?>">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input id="showpassword" type="checkbox">Hiện mật khẩu
                                    </label>
                                </div>
                                <button type="submit" name="savebtn" class="btn btn-lg btn-success btn-block">Cập nhật</button>
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
$(document).ready(function() {
    $("#showpassword").change(function() {
        if($("#showpassword").is(":checked"))
            $("#password").attr("type", "text");
        else
            $("#password").attr("type", "password");
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