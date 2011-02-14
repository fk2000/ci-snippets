<div id="contents">
<?php
if(!empty($list)):
foreach($list as $code):?>

<?php echo anchor("display/code/" . $code["id"], "<h3 class='title " . $code["id"] ."'>[" . code_name($code["code_type"]) . "] " . $code["title"] . "</h3>", $code["title"]);?>
<?php endforeach;?>
<!--/#contents--></div>
<div id="pagination">
<?php echo $pager;?>
<?php else:?>
<p>スニペットが登録されていません。</p>
<?php endif;?>
</div>
