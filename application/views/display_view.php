<div id="contents">
<?php foreach($list as $code):?>

<?php echo anchor("display/code/" . $code["id"], "<h3 class='title " . $code["id"] ."'>[" . $code["code_type"] . "]" . $code["title"] . "</h3>", $code["title"]);?>
<?php endforeach;?>
<!--/#contents--></div>
<div id="pagination">
<?php echo $pager;?>
</div>
