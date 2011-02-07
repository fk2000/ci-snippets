<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>PageName | SiteName</title>
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="copyright" content="Yuya Terajima/e2esound.com">

	<link rel="stylesheet" href="<?php echo site_url("css/style.css");?>">
</head>
<body id="PageName">
	<header>
	<h1>CI-SNIPPETS</h1>
	</header>
	<div id="contents">
	<h2>Edit</h2>
	<?php
		echo form_open("edit/confirm"),
			form_hidden("ticket", $ticket),
			form_label("タイトル", "title"),
			form_input($form_title_attr),
			form_label("言語", "code_type"),
			form_dropdown("code_type", $code_type_options, "text"),
			form_label("コード", "code"),
			form_textarea($form_code_attr),
			form_submit("confirm", "確認"),
			form_reset("reset", "リセット"),
			form_close();?>
	<!--/#contents--></div>
	<footer>

	</footer>
</body>
</html>
