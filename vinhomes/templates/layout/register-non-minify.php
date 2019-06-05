<form class="register-form" action="" method="post" accept-charset="UTF-8">
	<div class="form-title"><?= $lang['column_1'] ?></div>
	<table class="table">
		<tr>
			<td><input type="text" class="form-control" name="name" placeholder="<?= $lang['column_2'] ?>" required></td>
			<td rowspan="2"><textarea name="content" class="form-control" placeholder="<?= $lang['column_5'] ?>"></textarea></td>
		</tr>
		<tr>
			<td><input type="text" class="form-control" name="tel" placeholder="<?= $lang['column_3'] ?>" required></td>
		</tr>
		<tr>
			<td><input type="email" class="form-control" name="email" placeholder="<?= $lang['column_4'] ?>"></td>
			<td><button class="btn" type="submit" name="contactbtn" value="1"><?= $lang['column_6'] ?></button></td>
		</tr>
	</table>
</form>