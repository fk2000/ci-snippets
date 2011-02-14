<div id="contents">
<h3><?php echo "[" . $code["code_type"] . "]" .$code["title"];?></h3>
<pre class="brush: <?php echo $code["code_type"];?>">
<?php echo htmlspecialchars($code["code"], ENT_QUOTES, "UTF-8");?>
</pre>
<?php
echo
form_open("edit/delete"),
	form_hidden("id", $this->uri->segment(3)),
	form_hidden("ticket", $this->ticket),
	form_submit("deleteCode", "削除", "onclick='deleteConfirm()'"),
	form_close();
?>
</div>
<!--/#contents--></div>
