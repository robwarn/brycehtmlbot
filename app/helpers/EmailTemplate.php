<?
namespace app\helpers;
use app\helpers\TemplateEngine as TemplateEngine;

class EmailTemplate {
  public function __construct() {}

  public static function build($data, $template) {
    $TemplateEngine = new TemplateEngine;

    $TemplateEngine->appendKeys('template.name', $template);
    $TemplateEngine->appendKeys('template.ucname', ucwords(str_replace('-', ' ', $template)));

    $content = '';
    foreach ($data as $key => $value) {
      $uckey = ucwords(str_replace('_', ' ', $key));
      $content .= "<li><strong>{$uckey}:</strong> {$value}</li>";
      $TemplateEngine->appendKeys($key, $value);
    }

    $TemplateEngine->appendKeys('template.content', $content);

    $temp = $template == 'one-sixty' ? $template : 'default';

    ob_start();
    require_once TEMPLATES_EMAILS. '/'. $temp . '.html';
    $emailTemplate = ob_get_clean();

    return $TemplateEngine->init($emailTemplate);
  }
}
