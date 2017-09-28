<?
namespace app\controllers;
class Home extends \app\core\Controller {
	function index() {
		$this->getView(substr(get_called_class(), strrpos(get_called_class(), '\\') + 1), __FUNCTION__);
	}
}
