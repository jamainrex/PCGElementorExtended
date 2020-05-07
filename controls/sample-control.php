<?php
/**
 * Sample control.
 *
 * A sample control class template.
 *
 * @since 1.0.0
 */
class Sample_Control extends \Elementor\Base_Data_Control {

	/**
	 * Get sample control type.
	 *
	 * Retrieve the control type, in this case `sample`.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return 'sample';
	}

	/**
	 * Enqueue sample control scripts and styles.
	 *
	 * Used to register and enqueue custom scripts and styles used by the sample control.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue() {
		// Styles
		wp_register_style( 'sample', 'https://cdnjs.cloudflare.com/ajax/libs/sample/3.4.1/sample.css', [], '3.4.1' );
		wp_enqueue_style( 'sample' );

		// Scripts
		wp_register_script( 'sample', 'https://cdnjs.cloudflare.com/ajax/libs/sample/3.4.1/sample.js', [], '3.4.1' );
		wp_register_script( 'sample-control', '/assets/js/sample-control.js', [ 'sample', 'jquery' ], '1.0.0' );
		wp_enqueue_script( 'sample-control' );
	}

	/**
	 * Get sample control default settings.
	 *
	 * Retrieve the default settings of the sample control. Used to return
	 * the default settings while initializing the sample control.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'label_block' => true,
			'rows' => 3,
			'sample_options' => [],
		];
	}

	/**
	 * Render sample control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<textarea id="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-tag-area" rows="{{ data.rows }}" data-setting="{{ data.name }}" placeholder="{{ data.placeholder }}"></textarea>
			</div>
		</div>
		<# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{{ data.description }}}</div>
			<# } #>
		<?php
	}

}