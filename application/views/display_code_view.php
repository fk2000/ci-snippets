<div id="contents">
	<h3>
		<?php echo "[" . code_name($code["code_type"]) . "] " . form_prep($code["title"]);?>
	</h3>

	<pre class="brush: <?php echo $code["code_type"];?>"><?php echo str_replace("\r\n\n", "\n", form_prep($code["code"]));?></pre>

	<?php // 削除ボタン
		echo
			form_open("edit/delete"),
				form_hidden("id", $this->uri->segment(3)),
				form_submit("deleteCode", "削除", "onclick='deleteConfirm()'"),
			form_close();
	?>

<!--/#contents--></div>
