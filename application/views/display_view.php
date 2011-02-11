<div id="contents">
<?php foreach($list as $code):?>

<?php echo anchor("display/code/" . $code["id"], "<h3 class='title " . $code["id"] ."'>" . $code["title"] . "</h3>", $code["title"]);?>
<?php endforeach;?>
<div id="pagination">
<?php echo $pager;?>
</div>
<!--/#contents--></div>
