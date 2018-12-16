<?php

function multiadminlog_menus ()
{
  add_menu_page(
    __( 'All Admin Logs', 'multiadminlog'),
    __( 'Multi-Admin Logs', 'multiadminlog'),
    'manage_options',
    'multiadminlog',
    'multiadminlog_settings_page_markup',
    'dashicons-groups',
    100
  );

  add_submenu_page(
    'multiadminlog',
    __( 'All Admin Logs', 'multiadminlog'),
    __( 'All Logs', 'multiadminlog'),
    'manage_options',
    'multiadminlog'
  );

  add_submenu_page(
    'multiadminlog',
    __( 'Add New Admin Log', 'multiadminlog'),
    __( 'Add Log', 'multiadminlog'),
    'manage_options',
    'multiadminlog_addnew',
    'multiadminlog_settings_page_addnew'
  );

}
add_action( 'admin_menu', 'multiadminlog_menus');


function multiadminlog_settings_page_markup()
{
  if ( !current_user_can( 'manage_options' )) {
    return;
  }

  include( MULTIADMINLOG_PLUGIN_DIR . 'templates/all_logs.php');
}

function multiadminlog_settings_page_addnew()
{
  if ( !current_user_can( 'manage_options' )) {
    return;
  }

  include( MULTIADMINLOG_PLUGIN_DIR . 'templates/add_log.php');
}
