	<div id="contents">
		<h3><?php echo "[" . $code_type . "]",set_value("title", "");?></h3>
		<pre class="brush: <?php echo set_value("code_type", "text");?>"><?php echo $code;?></pre>
<?php
	echo form_open("edit/complete"),
		form_hidden("title", $title),
		form_hidden("code_type", $code_type),
		form_hidden("code", $code),
		form_hidden("ticket", $this->ticket),
		form_submit("complete", "登録"),
		form_close();?>
<?php
	echo form_open("edit"),
		form_hidden("title", $title),
		form_hidden("code_type", $code_type),
		form_hidden("code", $code),
		form_hidden("ticket", $this->ticket),
		form_submit("complete", "修正"),
		form_close();?>

	<!--/#contents--></div>
