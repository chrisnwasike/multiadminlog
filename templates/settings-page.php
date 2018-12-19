<?php
// Confirm access is from WP
if ( ! defined( 'ABSPATH' ) ) exit;

// Confirm user has authority
if ( !current_user_can( 'manage_options' ) ) {
  exit;
}


if ( $_POST['submit'] == 'Save Log' ) //Was button clicked?
{
  if ( isset( $_POST['multiadminlog_proper'] ) && !empty( $_POST['multiadminlog_proper'] ) ) //Was there some form of content?
  {
    if ( check_admin_referer( 'add_log_action', '_multiadmin_nonce' ) ) //Was the same from on WP submitted?
    {
      global $wpdb;

      $table_name       = $wpdb->prefix . "multiadminlog"; //Get the plugin table
      $the_esc_log      = esc_sql( $_POST['multiadminlog_proper'] ); //Sanitize the input
      $current_user     = wp_get_current_user(); //Get current Admin user info
      $current_user_id  = $current_user->id; //Extract only the ID
      $curr_time        = current_time( 'mysql' ); //Current time

      //Insert everything into the database
      $wpdb->insert( $table_name,
        array(
          'admin_log' => $the_esc_log,
          'admin_id'  => $current_user_id,
          'time'      => $curr_time
        )
      );

      //Send out success message
      $message = __( 'Log has been added', 'multiadminlog' );
      multiadminlog_form_feedback_message( $message, 'success' );
    }
    else
    {
      //Send out error message
      $message = __( 'Security verification failed, please try again', 'multiadminlog' );
      multiadminlog_form_feedback_message( $message, 'error' );
    }
  }
  else
  {
    //Sent out error message
    $message = __( 'Type some content first', 'multiadminlog' );
    multiadminlog_form_feedback_message( $message, 'error' );
  }

}

//Function handles notices and error notifications WP style
function multiadminlog_form_feedback_message( $message, $mode ) {
  ?>
  <div class="notice notice-<?php _e( $mode, 'multiadminlog' ); ?> is-dismissible">
      <p><?php _e( $message, 'multiadminlog' ); ?></p>
  </div>
  <?php
}


?>
<div class="wrap">

  <h1><?php esc_html_e( get_admin_page_title() ) ?></h1>

  <form method="post" action="">

    <!-- Create a nonce field -->
    <?php wp_nonce_field('add_log_action', '_multiadmin_nonce'); ?>

    <!-- The function that was created in settings page -->
    <?php settings_fields( 'multiadminlog_settings_section' ); ?>

    <!-- The actual page name from jquery hook setup -->
    <?php do_settings_sections( 'multiadminlog_addnew' ); ?>

    <!-- The submit button -->
    <?php submit_button( 'Save Log' ); ?>

  </form>

</div>
