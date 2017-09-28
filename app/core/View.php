<?
namespace app\core;
use app\helpers\HeadScript as HeadScript;
use app\helpers\TemplateEngine as TemplateEngine;

class View {
	protected $model, $name, $page, $template;
	public function __construct($name, $page, $model, $template) {
		$this->model = $model;
		$this->name = str_replace('_', '', $name);
		$this->page = $page;
		$this->template = $template;
		$this->render();
	}

	private function render() {
		$GLOBAL['title'] = $this->name == 'Raise404'
			? '404 - Page Not Found'
			: NAME .' - ' . preg_replace('/(?<! )(?<!^)[A-Z]/',' $0', $this->name);

		$GLOBAL['head'] = $this->setGlobal(TEMPLATES.'/head.php');
		$GLOBAL['layout-header'] = $this->setGlobal(TEMPLATES_LAYOUTS.'/layout-header.php');
		$GLOBAL['layout-main'] = $this->setGlobal(VIEWS."/{$this->name}/{$this->page}.php");
		$GLOBAL['layout-footer'] = $this->setGlobal(TEMPLATES_LAYOUTS.'/layout-footer.php');
		$GLOBAL['head'] = $GLOBAL['head'] . HeadScript::$head;
		$GLOBAL['footer'] = HeadScript::$footer;
		require TEMPLATES."/{$this->template}.php";
	}

	public function HeadScript() {
		return new HeadScript;
	}

	public function TemplateEngine() {
		return new TemplateEngine;
	}

	protected function getModule($module) {
		return new \app\core\Module($module, $this->model);
	}

	private function setGlobal($file) {
		ob_start();
		require $file;
		return ob_get_clean();
	}

}
