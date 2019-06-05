<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default" style="margin-top: 50px;">
            <div class="panel-heading">
                <h3 class="panel-title">Vui lòng đăng nhập</h3>
            </div>
            <div class="panel-body">
                <form action="" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control required" placeholder="Tên đăng nhập" id="username" name="username" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control required" placeholder="Mật khẩu" id="password" name="password" type="password" value="">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input id="showpassword" type="checkbox">Hiện mật khẩu
                            </label>
                        </div>
                        <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                    </fieldset>
                </form>
                <h5 class="label label-danger" <?=@$error!="" ? '' : 'style="display:none;"'?>><?=@$error?></h5>
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