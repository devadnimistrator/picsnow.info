<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function my_load_css($path, $echo = true) {
	$css_html = '<link href="' . base_url("assets/" . $path) . '" rel="stylesheet">';
	if ($echo) {
		echo $css_html;
	}

	return $css_html;
}

function my_load_js($path, $echo = true) {
	$css_html = '<script src="' . base_url("assets/" . $path) . '"></script>';
	if ($echo) {
		echo $css_html;
	}

	return $css_html;
}

function my_show_msg($msgs, $type = 'info', $output = true) {
	if (is_array($msgs)) {

	} else {
		$msgs = array($msgs);
	}
	$html = "";
	foreach ($msgs as $field => $msg) {
		$html .= '<div class="alert alert-info alert-' . $type . ' alert-dismissible fade in" role="alert" data-validate-field="' . $field . '">';
		$html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
		$html .= $msg;
		$html .= '</div>';
		$html .= "\n";
	}

	if ($output) {
		echo $html;
	} else {
		return $html;
	}
}

function my_show_form_validateion_errors($msgs, $output = true) {
	$html = "";
	if (count($msgs) > 0) {
		$html = '<div class="form-validation-errors">' . "\n";
		$html .= my_show_msg($msgs, "error", false);
		$html .= "\n" . '<div>';
	}
	if ($output) {
		echo $html;
	} else {
		return $html;
	}
}
