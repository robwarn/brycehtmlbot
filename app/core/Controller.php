<?
namespace app\core;
class Controller {
	public function getView($name, $page, $template = 'default') {
		return new \app\core\View($name, $page, $this->getModel($name), $template);
	}

	public function getModel($name) {
		$file = MODELS . '/' . $name . '.php';
		if (file_exists($file)) {
			$name = '\app\models\\' . $name;
			return new $name;
		}
	}

	public function raise404() {
		$this->getView('Raise404', 'index');
	}
}
