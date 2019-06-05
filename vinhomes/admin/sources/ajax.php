<script type="text/javascript">
$(document).ready(function () {
	$("body").append('`<div class="loading hidden" style="position: fixed; top: 0; right: 0; bottom: 0; left: 0; background-color: rgba(0,0,0,.5) !important; z-index: 999999999; background: url(../assets/img/loading.gif) center no-repeat;"></div>`');
});
function update(table, id, column, value, target = undefined) {
  if(column == 'delete' || column == 'delall') {
    if(confirm("Bạn chắc chắn muốn xóa?") == false)
      return;
		$("body > .loading").removeClass("hidden");
  }
  $.post(
    '<?=getAjaxURL()?>' + 'ajax.php',
    { table: table, column: column, id: id, value: value },
    function(data) {
      if((column == "enable" || column == "popular") && target != undefined) {
        if(target.find(".glyphicon-remove").length) {
          target.find(".glyphicon").removeClass("glyphicon-remove");
          target.find(".glyphicon").addClass("glyphicon-ok");
          target.data("value", 0);
        }
        else{
          target.find(".glyphicon").removeClass("glyphicon-ok");
          target.find(".glyphicon").addClass("glyphicon-remove");
          target.data("value", 1);
        }
      }
      else {
				$("body > .loading").addClass("hidden");
				$(".table").load(" .table");
        // document.location.reload(true);
      }
    }
  );
}
function delall(table) {
	var id = "(";
	$("input.selbox").each(function() {
		if($(this).is(":checked"))
			id = id + "'" + $(this).attr("id") + "',";
	});
	if(id == "(")
		alert("Bạn chưa chọn sản phẩm nào!");
	else {
		id = id.substr(0, id.length - 1) + ")";
		update(table, id, 'delall', null);
	}
}
function backupDatabase(){
	$("body > .loading").removeClass("hidden");
	$.post(
		'<?=getAjaxURL()?>' + 'ajax.php',
		{ table: null, column: 'backup', id:null, value: null },
		function(data) {
			if(data == "1") {
				$("body > .loading").addClass("hidden");
				alert("Sao lưu thành công!");
				window.open("<?= getAjaxURL() ?>" + "IMG_Backup/upload.zip");
			}
			else {
				$("body > .loading").addClass("hidden");
				alert(data);
			}
		}
	);
}
function deleteBackup() {
	$("body > .loading").removeClass("hidden");
	$.post(
		'<?=getAjaxURL()?>' + 'ajax.php',
		{ table: null, column: 'delete_backup', id:null, value: null },
		function(data) {
			if(data == "1") {
				$("body > .loading").addClass("hidden");
				alert("Đã xóa bộ đệm sao lưu!");
			}
			else {
				$("body > .loading").addClass("hidden");
				alert(data);
			}
		}
	);
}
function getFilter(tbl = "<?=$com?>_filter", reload = true, refunc = undefined) {
	$("body > .loading").removeClass("hidden");
	var filterStr = [];
	$('.filter').each(function() {
		var val = this.value;
		if(val == "")
			val = "####";
		filterStr.push(this.id + '&&' + val);
	});
	filterStr = filterStr.join('&&&');
	$.post(
		'<?=getAjaxURL()?>' + 'ajax.php',
		{ table: tbl, column: 'filter', id:null, value: filterStr },
		function(data) {
			$("body > .loading").addClass("hidden");
			if(data == '1' && reload)
				$(".table").load(" .table");
				// location.reload(true);
			if(refunc != undefined)
				refunc();
		}
	);
}
function load_sel(obj, val=undefined, callback=undefined) {
	$.post(
		'<?=getAjaxURL()?>' + 'ajax.php',
		{ table: $(obj).data("table"), column: 'location', id: obj.value },
		function(data) {
			var target = $($(obj).data("target"));
			target.html(target.data("default") + data);
		}
		);
}
function duplicate(table, id) {
	$("body > .loading").removeClass("hidden");
	$.post(
		'<?=getAjaxURL()?>' + 'duplicate.php',
		{ table: table, id: id },
		function(data) {
			$("body > .loading").addClass("hidden");
			if(data == "1")
				$(".table").load(" .table");
				// window.location.reload();
		}
	);
}
</script>