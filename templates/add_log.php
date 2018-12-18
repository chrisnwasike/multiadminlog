<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="wrap">

  <?php

    if ( !current_user_can( 'manage_options' ) ) {
      return;
    }
    include( MULTIADMINLOG_PLUGIN_DIR . 'templates/settings-page.php');

  ?>

</div>
