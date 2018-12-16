<?php

function multiadminlog_settings () {

  //if plugin settings don't exist, then create them
  //But I'm not actually using options and the options table
  /*
  if ( !get_option( 'multiadminlog_settings' )) {
    add_option( 'multiadminlog_settings' );
  }
  */

  //Define (at least) one section for our fields
  add_settings_section(
    //Unique ID for this section
    'multiadminlog_settings_section',
    //Section Title
    '',
    //Callback for an optional description
    '',
    //Admin page to add section to
    'multiadminlog_addnew'
  );

  add_settings_field(
    'admin_log_textarea',
    __( 'Enter Log', 'multiadminlog' ),
    'multiadminlog_log_textarea',
    'multiadminlog_addnew',
    'multiadminlog_settings_section'
  );

  register_setting(
    'multiadminlog_settings',
    'multiadminlog_settings'
  );

}
add_action( 'admin_init', 'multiadminlog_settings' );


//Register my settings_slug, from register_setting() so errors can show
function multiadminlog_notices() {

    settings_errors( 'multiadminlog_settings' );
}
add_action( 'admin_notices', 'multiadminlog_notices' );



function multiadminlog_log_textarea () {

  //Use this if options is storing some specific setting text and need to display it
  //But I'm not actually using options and the options table
  /*
  $options = get_option( 'multiadminlog_settings' );
  $custom_text = '';

  if ( isset( $options[ 'custom_text' ] ) ) {
    $custom_text = esc_html( $options[ 'custom_text' ] );
  }
  */
  _e('<textarea style="width:100%" name="multiadminlog_proper" rows="4" placeholder="Write Log"></textarea>', 'multiadminlog' );

}
