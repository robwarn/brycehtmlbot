<?
namespace app\helpers;
use app\helpers\EmailTemplate as EmailTemplate;

class Form {
	private $mail = [];
	protected $error, $post, $name;
	public $fields, $fieldName;

	public function __construct($post) {
		$this->post = $post;
	}

	public function send($name) {
		$this->name = $name;
		$this->mail['header'] 	= 'From: ' .EMAIL . "\r\n";
		$this->mail['header'] 	.= 'Reply-To: ' . isset($this->post['email']) ? $this->post['email'] : EMAIL . "\r\n";
		$this->mail['header'] 	.= 'X-Mailer: PHP/' . phpversion();
		$this->mail['header']		.= "MIME-Version: 1.0\r\n";
		$this->mail['header']		.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$this->mail['receiver'] = RECEIVER;
		$this->mail['subject']	= preg_replace('/(?<! )(?<!^)[A-Z]/',' $0', $this->name) . ' - ' .NAME;
		$template = strtolower(preg_replace("/(?<=[a-zA-Z])(?=[A-Z])/", "-", $this->name));

		if (file_exists(TEMPLATES_EMAILS. "/{$template}.html")) {
			$this->mail['message'] = EmailTemplate::build($this->post, $template);
		} else {
			$this->mail['message'] = EmailTemplate::build($this->post, $template);
		}

		if (!strstr(HOST, 'localhost')) {
			mail($this->mail['receiver'], $this->mail['subject'], $this->mail['message'], $this->mail['header'], "-f " . EMAIL);
		}
	}

	public function appendField($name, $value = FALSE) {
		$this->fieldName = $name;
		$this->fields[$this->fieldName] = [
			'class' => str_replace('_', '-', $this->fieldName),
			'name' => $this->fieldName,
			'placeholder' => ucwords(str_replace('_', ' ', $this->fieldName)),
			'value' => ($value) ? ucwords(str_replace('_', ' ', $this->fieldName)) : '',
			'data-required' => 'false',
		];
		return $this;
	}

	public function setAttr($attributes) {
		if (is_array($attributes)) {
			foreach ($attributes as $key => $attribute) {
				$this->fields[$this->fieldName][$key] = $attribute;
			}
		} else {
			$this->fields[$this->fieldName]['type'] = $attributes;
		}
		return $this;
	}

	public function setRequired($bool) {
		$this->fields[$this->fieldName]['placeholder'] .= $bool ? '*' : '';
		$this->fields[$this->fieldName]['data-required'] = $bool ? 'true' : 'false';
		return $this;
	}

	public function validate($fields, $post) {
		$this->fields = $fields;
		$this->post = $post;
		if (isset($this->post) && !empty($this->post)) {
			foreach ($this->fields as $field) {
				if ($field['data-required'] == 'true') {
					if (empty($this->post[$field['name']]) || !isset($this->post[$field['name']]) || $this->post[$field['name']] == '') {
						$this->setError($field, 'empty');

					} elseif ($field['type'] == 'email') {
						if (!filter_var($this->post['email'], FILTER_VALIDATE_EMAIL)) {
							$this->setError($field, 'invalid');
						}
					} elseif ($field['type'] == 'phone') {
						print_r($this->post);
						if (filter_var($this->post['phone'], FILTER_VALIDATE_INT) === 0 || !filter_var($this->post['phone'], FILTER_VALIDATE_INT) === FALSE || strlen($this->post['phone']) !== 10) {
							$this->setError($field, 'invalid');
						}
					}
				} else {
					if (empty($this->post[$field['name']]) || !isset($this->post[$field['name']]) || $this->post[$field['name']] == '') {
						if ($field['type'] == 'email') {
							if (!filter_var($this->post['email'], FILTER_VALIDATE_EMAIL)) {
								$this->setError($field, 'invalid');
							}
						} elseif ($field['type'] == 'phone') {
							if (!empty($this->post['phone']) && (filter_var($this->post['phone'], FILTER_VALIDATE_INT) === 0 || !filter_var($this->post['phone'], FILTER_VALIDATE_INT) === FALSE || strlen($this->post['phone']) !== 10)) {
								$this->setError($field, 'invalid');
							}
						}
					}
				}
			}
		}
		if ($this->error) {
			foreach ($this->fields as $field) {
				if (!isset($this->fields[$field['name']]['error'])) {
					$this->fields[$field['name']]['value'] = $this->post[$field['name']];
				}
			}
		}
		return $this->fields;
	}

	private function setError($field, $errType) {
		switch ($errType) {
			case 'empty':
				$this->fields[$field['name']]['placeholder'] .= ' (required)';
				break;
			case 'invalid':
				$this->fields[$field['name']]['placeholder'] .= ' (invalid)';
				break;
			default:
				$this->fields[$field['name']]['placeholder'] .= ' (required)';
				break;
		}
		$this->error = true;
		$this->fields[$field['name']]['class'] = 'error';
		$this->fields[$field['name']]['error'] = 1;
	}
}
