<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default" style="margin-top: 50px;">
            <div class="panel-body">
                <form action="" method="post">
                    <fieldset>
                        <div class="heading text-primary text-uppercase text-center" style="font-size: 24px; margin: 10px 0 20px 0;"><b>Đăng nhập vào hệ thống</b></div>
                        <div class="form-group text-center text-danger" <?=@$error!="" ? '' : 'style="display:none;"'?> style="padding: 5px; font-size: 16px;"><?=@$error?></div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Tên đăng nhập" id="username" name="username" type="text" autofocus required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Mật khẩu" id="password" name="password" type="password" value="" required>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input id="showpassword" type="checkbox">Hiện mật khẩu
                            </label>
                        </div>
                        <div class="form-group text-center">Chưa có tài khoản? <a href="<?= getURL("member/register") ?>"><b>Đăng ký</b></a> ngay!</div>
                        <button type="submit" class="btn btn-lg btn-success btn-block">Đăng nhập</button>
                    </fieldset>
                </form>
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
</script>