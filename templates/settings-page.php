<?php

if ( $_POST['submit'] == 'Save Log' )
{

  if ( isset( $_POST['multiadminlog_proper'] ) && !empty( $_POST['multiadminlog_proper'] ) )
  {
    global $wpdb;

    $table_name       = $wpdb->prefix . "multiadminlog";
    $the_esc_log      = esc_sql( $_POST['multiadminlog_proper'] );
    $current_user     = wp_get_current_user();
    $current_user_id  = $current_user->id;
    $curr_time        = current_time( 'mysql' );

    $wpdb->insert( $table_name,
      array(
        'admin_log' => $the_esc_log,
        'admin_id'  => $current_user_id,
        'time'      => $curr_time
      )
    );

    $message = __( 'Log has been added', 'multiadminlog' );
    multiadminlog_form_feedback_message( $message, 'success' );

  }
  else
  {
    $message = __( 'Type some content first', 'multiadminlog' );
    multiadminlog_form_feedback_message( $message, 'error' );
  }

}

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

    <!-- The function that was created in settings page -->
    <?php settings_fields( 'multiadminlog_settings_section' ); ?>

    <!-- The actual page name from jquery hook setup -->
    <?php do_settings_sections( 'multiadminlog_addnew' ); ?>

    <!-- The submit button -->
    <?php submit_button( 'Save Log' ); ?>

  </form>

</div>
