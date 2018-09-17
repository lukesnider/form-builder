<?php
/**
 * Plugin Name: Form Builder
 * Description: Simple, elegant contact form builder.
 * Plugin URI: https://sniderwebdevelopment.com
 * Author: Snider Web Development
 * Version: 1.0.0
 * Author URI: https://sniderwebdevelopment.com
 *
 * Text Domain: swd-forms
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
define('FORMBUILDER_BASE', __DIR__);

require __DIR__ . '/vendor/autoload.php';

$formbuilder =  \FormBuilder\Plugin::getInstance();
