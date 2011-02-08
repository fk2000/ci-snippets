	<div id="contents">
	<h2>Edit</h2>

	<?php // エラーメッセージ
		echo validation_errors();?>

	<form action="<?php echo site_url("edit/confirm");?>" method="post" accept-charset="utf-8">
	<input type="hidden" name="ticket" value="<?php echo $this->ticket;?>">
		<label for="title">タイトル</label>
		<input type="text" name="title" value="<?php echo set_value("title", "");?>" id="title" maxlength="100" size="50"  />
		<label for="code_type">言語</label>
		<?php echo form_dropdown("code_type", $code_type_options, $code_type_selected)?>
		<label for="code">コード</label>
		<textarea name="code" cols="90" rows="20" id="code"><?php echo set_value("code", "");?></textarea>
		<input type="submit" name="confirm" value="確認">
		<input type="reset" name="reset" value="リセット">
	</form>
<!--/#contents--></div>
