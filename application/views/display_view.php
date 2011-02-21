<div id="contents">
	<?php
		if( ! empty($list)):
			foreach($list as $code):

				echo anchor("display/code/" . (int)$code["id"],
							"<h3 class='title " . (int)$code["id"] ."'>[" . code_name($code["code_type"]) . "] " .
									form_prep($code["title"]) .
											"</h3>");
			endforeach;
	?>

<!--/#contents--></div>

<div id="pagination">

<?php
		echo $pager;
		else:
	?>

	<p>スニペットが登録されていません。</p>

<?php endif;?>
<!--/#pagination--></div>
