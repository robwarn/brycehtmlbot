<?
namespace app\core;
class Module {
	protected $model, $name, $post, $get, $viewModel, $formAction;
	public function __construct($name, $data) {
		$this->name = $name;
		$this->viewModel = $data;
		$this->formAction = $this->isForm() ? PAGE . $this->urlQuery() . 'key=' . $this->getModel()->key . '#' . $this->name : null;
	}

	public function load() {
		$this->post  	= filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$this->get  	= filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

		if ($this->isForm()) {
			if (!empty($this->post) && $this->get['key'] == $this->getModel()->key) {
				if ($this->isValid()) {
					$this->getView(true);
					$this->getModel()->form->send($this->name);
				} else {
					$this->getView();
				}
			} else {
				$this->getView();
			}
		} else {
			$this->getView();
		}
	}

	private function getView($bool = false) {
		if ($bool) {
			require MODULES_VIEWS . '/' . $this->name . '/success.php';
		} else {
			require MODULES_VIEWS . '/' . $this->name . '/default.php';
		}
	}

	private function getModel() {
		$model = '\app\modules\models\\' . $this->name;
		return isset($this->get['key']) ? new $model($this->post, $this->get['key']) : new $model($this->post);
	}

	private function isForm() {
		return isset($this->getModel()->form) ? true : false;
	}

	private function isValid() {
		if (method_exists($this->getModel()->form, 'validate')) {
			return $this->getModel()->fields == $this->getModel()->form->validate($this->getModel()->fields, $this->post) ? true : false;
		}
		return false;
	}

	protected function urlQuery() {
		return strpos(HOST . PAGE, '?') ? '&' : '?';
	}

	protected function HeadScript() {
		return new \app\helpers\HeadScript;
	}
}
