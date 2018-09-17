<?php
namespace FormBuilder;

use FormBuilder\Plugin;

class AjaxManager {

  public function __construct(){
    //add_action("wp_ajax_swd_update_post_meta", [$this, 'update_post_meta']);
    add_action('wp_ajax_swd_save_form', [$this, 'save_form']);
  }
  public function save_form() {
    $success = false;
    $post_id = $_POST['post_id'];
    echo '<pre>';print_r($_POST);die;
    $return = [
      'success' => $success,
    ];
    wp_send_json($return);
    wp_die();
  }
  public function update_post_meta(){
    $success = false;
    $post_id = $_POST['post_id'];
    foreach($_POST['data'] AS $key => $value){
      if(update_post_meta($post_id, $key, $value)){
        $success = true;
      }
    }

    $return = [
      'success' => $success,
    ];
    wp_send_json($return);
    wp_die();
  }
}
