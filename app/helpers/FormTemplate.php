<?
namespace app\helpers;
class FormTemplate {
	protected $elem;
	protected $options;
	function __construct($name, $options) {
		$this->elem = $name;
		$this->options = $options;
		if (in_array($this->elem['type'], ['text', 'phone', 'email', 'password'])) {
			echo '<input
				class="' .$this->elem['class'] .'"
				type="' .$this->elem['type'] .'"
				name="' .$this->elem['name'] .'"
				value="' .$this->elem['value'] .'"
				placeholder="' .$this->elem['placeholder'] .'"
				data-required="' .$this->elem['data-required'] .'">';
		} elseif ($this->elem['type'] == 'checkbox' && is_array($this->options)) {
			$i = 0;
			foreach ($this->options as $option) {
				echo '<div class="' .$this->elem['class'] . '-wrap">';
					echo '<div class="' .$this->elem['class'] . '-input-' .$i . '" role="checkbox">';
						echo '<input
							class="' .$this->elem['class'] .'"
							type="' .$this->elem['type'] .'"
							name="' .$this->elem['name'] . '_' .$i .'"
							value="' .$option .'"
							placeholder="' .$this->elem['placeholder'] .'"
							data-required="' .$this->elem['data-required'] .'">';
					echo '</div>';
					echo'<span class="label">' .str_replace('_', ' ', $option) .'</span><br>';
				echo '</div>';
				$i++;
			}

		} elseif ($this->elem['type'] == 'radio' && is_array($this->options)) {
			$i = 0;
			foreach ($this->options as $option) {
				echo '<div class="' .$this->elem['class'] . '-wrap">';
					echo '<div class="' .$this->elem['class'] . '-input-' .$i . '" role="radio">';
						echo '<input
							class="' .$this->elem['class'] .'"
							type="' .$this->elem['type'] .'"
							name="' .$this->elem['name'] .'"
							value="' .$option .'"
							placeholder="' .$this->elem['placeholder'] .'"
							data-required="' .$this->elem['data-required'] .'">';
					echo '</div>';
					echo'<span class="label">' .str_replace('_', ' ', $option) .'</span><br>';
				echo '</div>';
				$i++;
			}
		} elseif ($this->elem['type'] == 'select' && is_array($this->options)) {
			echo '<select
					class="' .$this->elem['class'] .'"
					name="' .$this->elem['name'] .'">';
			foreach ($this->options as $option) {
				echo '<option value="' .$option .'">' .str_replace('_', ' ', ucwords($option)) .'</option>';
			}
			echo '</select>';

		} elseif ($this->elem['type'] == 'textarea') {
			echo '<textarea
				class="' .$this->elem['class'] .'"
				name="' .$this->elem['name'] .'"
				value="' .$this->elem['value'] .'"
				placeholder="' .$this->elem['placeholder'] .'"
				data-required="' .$this->elem['data-required'] .'"
			></textarea>';
		}
	}
}
