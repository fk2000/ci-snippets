<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>PageName | SiteName</title>
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="copyright" content="Yuya Terajima/e2esound.com">

	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" href="./css/import.css">

	<link href="<?php echo base_url();?>css/shCore.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/shThemeDefault.css" rel="stylesheet" type="text/css">

</head>
<body id="PageName">
	<header>

	</header>
	<div id="contents">
		<h3><?php echo "[" . set_value("code_type", "") . "]",set_value("title", "");?></h3>
		<textarea class="brush: <?php echo set_value("code_type", "text");?>"><?php echo set_value("code", "");?></textarea>
	<!--/#contents--></div>
	<footer>

	</footer>
<script type="text/javascript" src="<?php echo base_url();?>js/shCore.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/shBrushPhp.js"></script>
<script type="text/javascript">
	SyntaxHighlighter.config.tagName = "textarea";
	SyntaxHighlighter.all();
</script>

</body>
</html>
