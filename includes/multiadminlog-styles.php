<?php

// Load CSS on all admin pages
function multiadminlog_admin_styles( $hook ) {

  wp_register_style(
    'multiadminlog',
    MULTIADMINLOG_PLUGIN_URL . 'admin/admin_styles.css',
    [],
    MULTIADMINLOG_VERSION
  );

  if( 'toplevel_page_multiadminlog' == $hook || 'multi-admin-logs_page_multiadminlog_addnew' == $hook ) {
    wp_enqueue_style( 'multiadminlog' );
  }

}
add_action( 'admin_enqueue_scripts', 'multiadminlog_admin_styles' );
//use wp_enqueue_style() for front CSS
