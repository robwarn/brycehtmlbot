<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{website.compiled}}/master.css">
<link rel="icon" type="image/png" href="{{website.favicon}}">
<script type="text/javascript"> var DIST = '{{website.dist}}'</script>
<?
  $this->HeadScript()->prependScript('{{website.url}}/public/libs/scripts/jquery-3.2.1.min.js');
  $this->HeadScript()->prependScript('{{website.dist}}/base-dist.js');
  $this->HeadScript()->prependScript('{{website.dist}}/injector-dist.js');

  $root_stylesheet = ROOT.'/public/styles/compiled/'.strtolower($this->name).'-'.$this->page.'.css';
  $stylesheet = '{{website.compiled}}/'.strtolower($this->name).'-'.$this->page.'.css';
  if (file_exists($root_stylesheet)) {
    $this->HeadScript()->appendStyleSheet($stylesheet);
  }

  if (filter_input_array(INPUT_POST)) {
    $this->HeadScript()->prependScript('{{website.url}}/public/scripts/dist/form-submit-dist.js');
  }

?>
