<!DOCTYPE html>
<html>
	<head>
		<?= $this->TemplateEngine()->init($GLOBAL['head']) ?>
		<title><?= $GLOBAL['title'] ?></title>
	</head>
	<body class="layout-default" data-state="is-fixed">
		<?= $this->TemplateEngine()->init($GLOBAL['glob-preloader']) ?>

		<div class="layout-header">
			<?= $this->TemplateEngine()->init($GLOBAL['layout-header']) ?>
		</div>

		<div class="main-content" role="main">
			<?= $this->TemplateEngine()->init($GLOBAL['layout-main']) ?>
		</div>

		<div class="layout-footer">
			<?= $this->TemplateEngine()->init($GLOBAL['layout-footer']) ?>
		</div>

		<?= $this->TemplateEngine()->init($GLOBAL['glob-user-choice']) ?>
		<?= $this->TemplateEngine()->init($GLOBAL['footer']) ?>

	</body>
</html>
