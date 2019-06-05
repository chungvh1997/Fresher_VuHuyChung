<div class="well">Cập nhật thông tin website</div>

<form action="" method="post" enctype="multipart/form-data">
  <ul class="nav nav-tabs" role="tablist">
<?php foreach($row_language as $k_language => $r_language): ?>
    <li role="presentation" <?= $k_language==0 ? 'class="active"' : "" ?>>
      <a href="#<?= $r_language['uri'] ?>" aria-controls="<?= $r_language['uri'] ?>" role="tab" data-toggle="tab">
        <img src="<?= $r_language['thumbnail'] ?>" style="height: 30px;">
      </a>
    </li>
<?php endforeach; ?>
  </ul>
  <div class="tab-content">
        <?php foreach($row_language as $k_language => $r_language): $item = $items[$k_language]; ?>
    <div id="<?= $r_language['uri'] ?>" role="tabpanel" class="tab-pane fade <?= $k_language==0 ? "in active" : "" ?>">
      <table class="table">
        <tr>
          <td colspan="2" class="text-center">
            <input name="savebtn" type="submit" class="btn btn-success" value="Lưu lại">
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">Tên website (title):</label></td>
          <td class="col-xs-10">
            <input name="id_<?=$r_language['uri']?>" type="hidden" value="<?=@$item['id']?>">
            <input name="title_<?=$r_language['uri']?>" type="text" class="form-control required" placeholder="Nhập tên website" title="Tên website hiển thị trên thẻ trình duyệt" value="<?=$item['title']?>" autofocus>
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">Icon hiện tại:</label></td>
          <td class="col-xs-10">
            <img id="favicon_<?=$r_language['uri']?>" src="<?=$item['favicon']!=''?(count(explode("://", $item['favicon']))>1?$item['favicon']:str_replace("//", "/", $item['favicon'])):''?>" alt="Chưa có hình đại diện" onclick="openBrowser('#favicon_<?=$r_language['uri']?>', '#favicon__<?=$r_language['uri']?>');" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-primary" onclick="openBrowser('#favicon_<?=$r_language['uri']?>', '#favicon__<?=$r_language['uri']?>');">Chọn hình</button>&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-danger" onclick="$('#favicon__<?=$r_language['uri']?>').val('');$('#favicon_<?=$r_language['uri']?>').attr('src','');">Xóa hình hiện tại</button>
            <input id="favicon__<?=$r_language['uri']?>" name="favicon_<?=$r_language['uri']?>" type="hidden" value="<?=$item['favicon']?>">
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">Lời chào:</label></td>
          <td class="col-xs-10">
            <input id="slogan" name="slogan_<?=$r_language['uri']?>" class="form-control" placeholder="Nhập lời chào trên top" type="text" value="<?=$item['slogan']?>">
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">Điện thoại liên hệ:</label></td>
          <td class="col-xs-10">
            <input id="tel" name="tel_<?=$r_language['uri']?>" class="form-control" placeholder="Nhập điện thoại" type="text" value="<?=$item['tel']?>">
          </td>
        </tr>
        <!-- <tr>
          <td class="col-xs-2"><label class="form-control">Số Fax:</label></td>
          <td class="col-xs-10">
            <input id="fax" name="fax_<?=$r_language['uri']?>" class="form-control" placeholder="Nhập số fax" type="text" value="<?=$item['fax']?>">
          </td>
        </tr> -->
        <tr>
          <td class="col-xs-2"><label class="form-control">Email liên hệ:</label></td>
          <td class="col-xs-10">
            <input id="email_receive" name="email_receive_<?=$r_language['uri']?>" class="form-control" placeholder="Nhập email" type="email" value="<?=$item['email_receive']?>">
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">Hotline:</label></td>
          <td class="col-xs-10">
            <input name="hotline_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập hotline" title="Hotline dành cho khách hàng" value="<?=$item['hotline']?>">
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">Key word:</label></td>
          <td class="col-xs-10">
            <input name="keyword_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập keyword" title="Keyword hỗ trợ SEO website" value="<?=$item['keyword']?>">
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">Description:</label></td>
          <td class="col-xs-10">
            <input name="desc_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập description" title="Description hỗ trợ SEO website" value="<?=$item['desc']?>">
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">Đường dẫn trang Facebook:</label></td>
          <td class="col-xs-10">
            <input name="facebook_<?=$r_language['uri']?>" class="form-control" placeholder="Nhập đường dẫn trang Facebook" title="Đường dẫn trang Facebook" value="<?=$item['facebook']?>">
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">Google maps:</label></td>
          <td class="col-xs-10">
            <textarea name="maps_<?=$r_language['uri']?>" rows="5" class="form-control" placeholder="Nhập mã nhúng Google maps" title="Bản đồ cuối trang và liên hệ"><?=$item['maps']?></textarea>
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">Livechat:</label></td>
          <td class="col-xs-10">
            <textarea name="livechat_<?=$r_language['uri']?>" class="form-control" placeholder="Nhập mã livechat" title="Khung cửa sổ livechat hiển thị góc dưới màn hình" rows="5"><?=$item['livechat']?></textarea>
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">Script mở rộng chèn tại thẻ &lt;head&gt;:</label></td>
          <td class="col-xs-10">
            <textarea name="script_head_<?=$r_language['uri']?>" class="form-control" placeholder="Nhập script mở rộng chèn tại thẻ &lt;head&gt;" title="Script mở rộng chèn tại thẻ &lt;head&gt;" rows="5"><?=$item['script_head']?></textarea>
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">Script mở rộng chèn tại thẻ &lt;body&gt;:</label></td>
          <td class="col-xs-10">
            <textarea name="script_body_<?=$r_language['uri']?>" class="form-control" placeholder="Nhập script mở rộng chèn tại thẻ &lt;body&gt;" title="Script mở rộng chèn tại thẻ &lt;body&gt;" rows="5"><?=$item['script_body']?></textarea>
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">H1:</label></td>
          <td class="col-xs-10">
            <input name="h1_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập H1" title="H1, H2, H3 có chức năng tăng mức độ SEO nhờ vào các từ khóa" value="<?=$item['h1']?>">
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">H2:</label></td>
          <td class="col-xs-10">
            <input name="h2_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập H2" title="H1, H2, H3 có chức năng tăng mức độ SEO nhờ vào các từ khóa" value="<?=$item['h2']?>">
          </td>
        </tr>
        <tr>
          <td class="col-xs-2"><label class="form-control">H3:</label></td>
          <td class="col-xs-10">
            <input name="h3_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập H3" title="H1, H2, H3 có chức năng tăng mức độ SEO nhờ vào các từ khóa" value="<?=$item['h3']?>">
          </td>
        </tr>
        <tr>
          <td colspan="2" class="text-center">
            <input name="savebtn" type="submit" class="btn btn-success" value="Lưu lại">
          </td>
        </tr>
      </table>
    </div>
<?php endforeach; ?>
  </div>
</form>

<style type="text/css">
  .well {
    font-size: 30px;
    color: darkred;
    font-weight: bold;
    text-align: center;
  }
  .table td {
    border: none !important;
  }
  .table td img {
    max-width: 100%;
    max-height: 100px;
  }
  
  label.form-control {
    border: none;
    box-shadow: none;
  }
  
  input[type='file'],
  select {
    width: auto !important;
  }

  input[type='color'] {
    width: 100px !important;
    cursor: pointer;
  }
  
  abbr {
    color: gray;
  }
</style>
