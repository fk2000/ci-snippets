	<div id="contents">
		<h3><?php echo "[" . code_name(set_value("code_type")) . "]",set_value("title");?></h3>
		<pre class="brush: <?php echo set_value("code_type");?>"><?php echo str_replace("\r\n\n", "\n", set_value("code"));?></pre>
<?php
	echo form_open("edit/complete"),
		form_hidden("title", set_value("title")),
		form_hidden("code_type", set_value("code_type")),
		form_hidden("code", str_replace("\r\n\n", "\n", set_value("code"))),
		form_submit("complete", "登録"),
		form_close();?>
<?php
	echo form_open("edit"),
		form_hidden("title", set_value("title")),
		form_hidden("code_type", set_value("code_type")),
		form_hidden("code", str_replace("\r\n\n", "\n", set_value("code"))),
		form_submit("complete", "修正"),
		form_close();?>

	<!--/#contents--></div>
