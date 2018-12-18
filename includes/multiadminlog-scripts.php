<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function multiadminlog_admin_scripts ( $hook ) {

  wp_register_script(
    'multiadminlog',
    MULTIADMINLOG_PLUGIN_URL . 'admin/admin_js.js',
    ['jquery'],
    MULTIADMINLOG_VERSION
  );

  wp_localize_script( 'multiadminlog', 'multiadmins', [
    'hook' => $hook
    ]
  );

  if ( 'just_to_prevent_this_from_running_everytime' == $hook ){
    wp_enqueue_script( 'multiadminlog' );
  }

}
add_action( 'wp_enqueue_scripts', 'multiadminlog_admin_scripts' );
