<?
spl_autoload_register(function ($class) {
	$root = __DIR__;
	$file = $root . '/' . str_replace('\\', '/', $class) . '.php';
	if (is_readable($file)) {
		require_once $file;
	}
});

app\config\Root_Config::init();
app\config\Host_Config::init();
app\config\DB_Config::init();
app\config\Website_Config::init();

new app\core\Router;
