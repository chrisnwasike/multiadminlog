<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;

$all_logs   = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}multiadminlog ORDER BY time DESC", ARRAY_A );
$version    = get_option( 'multiadminlog_db_version' );

/*
  $current_user = wp_get_current_user();
  $current_user_id = $current_user->id;
  $current_user_fullname = $current_user->last_name. ' '.$current_user->first_name;
*/

?>

<div class="wrap">

  <h1><?php esc_html_e( get_admin_page_title() ) ?>
    <small><?php esc_html_e( 'Version', 'multiadminlog' ); ?>: <?php esc_html_e( $version, 'multiadminlog' ); ?></small>
  </h1>

  <div class="multiadminlog_wrapper">
    <table>
    </table>
      <?php if ( count($all_logs) > 0 ) { ?>
      <?php foreach ($all_logs as $logs) { ?>
        <div class="records">
        <?php

          $admin_info     = get_userdata($logs['admin_id']);
          $logger_info    = $admin_info->last_name .  ", " . $admin_info->first_name.' [ID: '. $admin_info->id .']';
          $log_content    = $logs['admin_log'];
          $log_time       = date('g:ia jS M Y', strtotime($logs['time']));

        ?>
          <div class="logger">
            <span class="logger_info"><?php esc_html_e( $logger_info, 'multiadminlog' ); ?></span>
            <br>
            <span class="log_date"><i><?php _e($log_time, 'multiadminlog' ); ?></i></span>
          </div>
          <hr>
          <div class="log_proper">
            <?php esc_html_e( $log_content, 'multiadminlog' ); ?>
          </div>

        </div> <!-- records -->
      <?php } ?>
    <?php } else { ?>
      <div class="records">
        <?php esc_html_e( 'No logs found.', 'multiadminlog' ); ?>
      </div>
    <?php } ?>

  </div> <!--multiadminlog_wrapper-->

</div> <!-- wrap -->
