	<div id="contents">
	<h2>Edit</h2>

	<?php // エラーメッセージ
		echo validation_errors();?>

<?php echo form_open("edit/confirm");?>
	<label for="title">タイトル</label>
	<input type="text" name="title" value="<?php echo set_value("title", "");?>" id="title" maxlength="100" size="50"  />
	<label for="code_type">言語</label>
	<?php echo form_dropdown("code_type", $code_type_options, $code_type_selected)?>
	<label for="code">コード</label>
	<textarea name="code" cols="90" rows="20" id="code"><?php echo str_replace("\r\n\n", "\n", htmlspecialchars_decode(set_value("code", "")));?></textarea>
<?php
	echo form_submit("confirm", "確認"),
		form_reset("reset", "リセット"),
		form_close();
?>
<!--/#contents--></div>
