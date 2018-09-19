<?php
namespace FormBuilder;

use FormBuilder\Traits\Singleton;
use FormBuilder\Bootstrap;
use FormBuilder\Backend;
use FormBuilder\AjaxManager;

class Plugin {

  use Singleton;

  private $version = '1.0.0';

  private $backend;

  private $ajax;

  private $widgets;

  public function init(){
    add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue'] );
    add_action('admin_menu', [$this, 'swd_plugin_page']);
    $this->backend = Backend::getInstance();
    $this->ajax = new AjaxManager;
    add_action('init', [$this, 'widgets']);
    //add_action( 'wp_enqueue_scripts', [$this, 'frontend_enqueue'] );
  }
  public function widgets(){
    $this->widgets = Backend::getInstance()->widgets($this->widgets);
  }
  public function admin_enqueue($hook){
    if('toplevel_page_swd_form_builder' == $hook){
      wp_enqueue_style( 'swd-form-builder-css', plugins_url( 'swd-forms' ) . '/src/resources/build/dist/backend.css' );
      wp_register_script( 'swd-form-builder-js', plugins_url( 'swd-forms' ) . '/src/resources/build/dist/backend.js', array('jquery'), $this->version,true );
      wp_localize_script( 'swd-form-builder-js', 'formBuilderData', ['post_id' => get_the_ID(), 'form_widgets' => $this->widgets] );
      wp_enqueue_script( 'swd-form-builder-js' );
    }
  }
  public function swd_plugin_page(){
      add_menu_page('Form Builder', 'Form Builder', 'administrator', 'swd_form_builder', [$this, 'swd_plugin_page_display'], 'dashicons-feedback',60);
  }
  public function swd_plugin_page_display() {
    $this->backend->plugin_page();
  }
}
