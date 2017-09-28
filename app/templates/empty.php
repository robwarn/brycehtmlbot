<!DOCTYPE html>
<html>
	<head>
		<?= $this->TemplateEngine()->init($GLOBAL['head']) ?>
		<title><?= $GLOBAL['title'] ?></title>
	</head>
	<body class="layout-empty">
		<?= $this->TemplateEngine()->init($GLOBAL['glob-preloader']) ?>

		<div class="main-content" role="main">
			<?= $this->TemplateEngine()->init($GLOBAL['layout-main']) ?>
		</div>

		<?= $this->TemplateEngine()->init($GLOBAL['glob-user-choice']) ?>
		<?= $this->TemplateEngine()->init($GLOBAL['footer']) ?>

	</body>
</html>
