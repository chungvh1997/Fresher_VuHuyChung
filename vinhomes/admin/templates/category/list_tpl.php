<div class="well">Danh mục sản phẩm (<?=$pagination->count_item?>)</div>
    
<table class="table table-striped table-bordered text-center">
  <tbody><tr>
      <td class="text-left" colspan="15">
          <?php include _template."input/add.php"; ?>
      </td>
    </tr>
    <tr>
      <td colspan="15" class="text-left">
        <form method="post" onsubmit="getFilter('<?=$filterStr?>'); return false;">
          &nbsp;&nbsp;&nbsp;<span class="text-muted">Lọc theo:</span>&nbsp;&nbsp;
          <input id="title" type="text" class="filter form-control" placeholder="Từ khóa" style="width: auto; display: inline-block; background: white;" autofocus value="<?=@$_SESSION[$filterStr]['title']?>">
          <select id="parent_id" class="filter form-control" style="width: auto; display: inline-block; background: white;" onchange="getFilter('<?=$filterStr?>');">
            <option value="">-- Danh mục cha --</option>
              <?php foreach ($filter_items as $fi): ?>
                <option value="<?=$fi['id']?>" <?=$fi['id']==@$_SESSION[$filterStr]['parent_id'] ? "selected" : ""?>>
                      <?=$fi['title']?>
                </option>
              <?php endforeach ?>
          </select>
          <button type="submit" class="btn btn-success" style="margin-top: -3px;">Lọc</button>
          <button class="btn btn-danger" onclick="$('.filter').val(''); getFilter('<?=$filterStr?>');" style="margin-top: -3px;">Xóa lọc</button>
        </form>
      </td>
    </tr>
    <tr>
      <th><input class="selallbox" type="checkbox" onclick="$('.selbox').trigger('click');"></th>
      <th>STT</th>
      <th>Tiêu đề</th>
      <th>Danh mục cha</th>
      <!--<th>Mô-đun</th>-->
      <th>Đường dẫn</th>
      <?php if ($_GET['type'] == "page"): ?>
        <th>Danh sách ảnh</th>
      <?php endif ?>
      <th>Danh sách thẻ</th>
      <!-- <th>Thứ tự hiển thị</th> -->
      <th>Sửa</th>
      <th>Hiển thị</th>
      <?php if(in_array($type, array( "product", "brand", "nation" ))) { ?>
        <th>Nổi bật</th>
      <?php } ?>
      <th>Xóa</th>
      <th>Nhân đôi</th>
    </tr>
    <?php $u=($pagination->current-1)*$pagination->max_item; foreach ($items as $value) { $u++; ?>
    <tr>
      <td>
        <?php include _template."input/checkbox.php"; ?>
      </td>
      <td><?=$u?></td>
      <td><?=$value['title']?></td>
      <td>
        <?php
        if(intval(@$value['parent_id']) > 0):
          $ptitle = getTranslate("category", $row_language[0]['id'], $value['parent_id']);
          if(is_array($ptitle) && !empty($ptitle)):
            echo getCategoryPath($value['parent_id']);
          else:
            echo '<b class="text-danger">Đã xóa danh mục cha!</b>';
          endif;
        else:
          echo "...";
        endif;
        ?>
      </td>
      <td>
        <?php
        $url = getURL($value['uri'], true);
        $text = "Liên kết";
        $current_page = false;
        include _template."input/link.php";
        ?>
      </td>
      <?php if ($_GET['type'] == "page"): ?>
        
         <td>
          <?php
          $url = "index.php?com=category-image&type={$_GET['type']}&act=list&category_id=".$value['id'];
          $text = "Xem ảnh";
          $current_page = true;
          include _template."input/link.php";
          ?>
        </td>

      <?php endif ?>
     
      <td>
        <?php
        $url = "index.php?com=category-tab&type={$_GET['type']}&act=list&category_id=".$value['id'];
        $text = "Xem thẻ";
        $current_page = true;
        include _template."input/link.php";
        ?>
      </td>
      <!-- <td><?= $value['index'] ?></td> -->
      <td>
        <?php include _template."input/edit.php"; ?>
      </td>
      <td>
        <?php include _template."input/enable.php"; ?>
      </td>
      <?php if(in_array($type, array( "product", "brand", "nation" ))) { ?>
        <td>
          <?php $column="popular"; include _template."input/popular.php"; ?>
        </td>
      <?php } ?>
      <td>
	<?php include _template."input/delete.php"; ?>
      </td>
      <td>
	<?php include _template."input/duplicate.php"; ?>
      </td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="15">
        <?php include _template."input/add.php"; ?>
        <?php include _template."input/delall.php"; ?>
      </td>
    </tr>
</tbody></table>
      
<style type="text/css">
  .well {
    font-size: 30px;
    color: darkred;
    font-weight: bold;
    text-align: center;
  }
  .table th {
    text-align: center;
  }
  
  .table td {
    vertical-align: middle !important;
  }
</style>