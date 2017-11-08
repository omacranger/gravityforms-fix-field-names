<?php
/*
Plugin Name: GravityForms Fix Field Names
Plugin URI:
Description: Changes input element name attributes to custom name (if set) to prevent auto filling invalid data.
Version: 0.1.0
Author: Logan Graham
Author URI:
Text Domain: gf-fix-field-names
*/

class GravityForms_Fix_Field_Names {
	private $allowed_fields = array(
		'GF_Field_Text',
		'GF_Field_Phone',
		'GF_Field_Number',
		'GF_Field_Email',
		'GF_Field_Textarea'
	);

	public function __construct() {
		add_filter( 'gform_field_input', array( $this, 'filter_field_input' ), 10, 5 );
		add_action( 'gform_pre_process', array( $this, 'pre_submission_filter' ), 8 );
	}

	/**
	 * @param $input
	 * @param GF_Field $field
	 * @param $value
	 * @param $lead_id
	 * @param $form_id
	 *
	 * @return mixed
	 */
	function filter_field_input( $input, $field, $value, $lead_id, $form_id ) {
		// Return if not an allowed field type
		if ( ! $this->is_allowed_field_type( $field ) ) {
			return '';
		}

		$field_name = $field->inputName;

		if ( ! empty( $field_name ) ) {
			$input = $field->get_field_input( $form_id, $value );
			$input = preg_replace( "/name='.*?'/", "name='$field_name'", $input );
		}

		return $input;
	}

	/**
	 * @param array $form
	 */
	function pre_submission_filter( $form ) {
		// Iterate through all fields and gather names, replace names with actual 'input' value

		foreach ( $form['fields'] as $field ) {
			if ( ! $this->is_allowed_field_type( $field ) ) {
				continue;
			}

			$field_name = $field->inputName;

			if ( ! empty( $field_name ) && isset( $_POST[ $field->inputName ] ) ) {
				$_POST[ 'input_' . $field->id ] = $_POST[ $field->inputName ];
			}
		}
	}

	/**
	 * Validates the current field type is an accepted one for modification
	 *
	 * @param $field
	 *
	 * @return bool
	 */
	function is_allowed_field_type( $field ) {
		return in_array( get_class( $field ), $this->allowed_fields );
	}
}

new GravityForms_Fix_Field_Names();