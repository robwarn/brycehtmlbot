<?
namespace app\core;

class Router {

	protected $controller;
	protected $method;
	protected $params;
	protected $route;

	public function __construct() {
		$this->route = $this->getRoute();

		if (isset($this->route[0])) {
			$this->controller = 'app\controllers\\' . $this->route[0];
			unset($this->route[0]);
			if (!class_exists($this->controller)) {
				$this->controller = 'app\controllers\Raise_404';
			}
		} else {
			$this->controller = 'app\controllers\Home';
		}

		$this->controller = new $this->controller;

		if (isset($this->route[1])) {
			if (method_exists($this->controller, $this->route[1])) {
				$this->method = $this->route[1];
				unset($this->route[1]);
			} else {
				$this->method = 'raise404';
			}
		} else {
			$this->method = 'index';
		}

		$this->params = (!empty($this->route)) ? array_values($this->route) : [];

		if (method_exists($this->controller, $this->method)) {
			call_user_func_array([$this->controller, $this->method], $this->params);
		}
	}

	protected function getRoute() {
		if (isset($_GET['url'])) {
			return explode('/', filter_var(rtrim(str_replace(' ', '_', ucwords(str_replace( '-', ' ', $_GET['url'] ))), '/')), FILTER_SANITIZE_URL);
		}
	}
}
