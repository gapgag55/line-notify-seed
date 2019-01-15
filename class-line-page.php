<?php


add_action('admin_menu', 'wpdocs_register_my_custom_submenu_page', 100);
 
function wpdocs_register_my_custom_submenu_page() {
  add_submenu_page(
    'edit.php?post_type=seed_confirm_log',
    'Line Notify',
    'Line Notify',
    'manage_options',
    'seed-notify-settings',
    'line_notify_page'
  );
}
 
function line_notify_page() {

  if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'line-notify-seed')) {
    update_option('line_notify_api', $_POST['line_notify_api']);
  }

  $api = get_option('line_notify_api');

  ?>
  <div class="wrap">
		<form method="post" action="" name="form">
    <h2 class="title"><?php _e('License', 'line-notify-seed');?></h2>
      <table class="form-table" width="100%">
        <tbody>
          <tr valign="top">
            <th scope="row" valign="top">
              <?php _e('API Key', 'line-notify-seed'); ?>
            </th>
            <td>
              <input id="seed_confirm_license_key" name="line_notify_api" type="text" class="regular-text" value="<?php esc_attr_e( $api ); ?>" />
            </td>
          </tr>
        </tbody>
      </table>
      <p class="submit">
        <?php wp_nonce_field( 'line-notify-seed' ) ?>
        <?php submit_button(); ?>
      </p>
    </form>
  </div>
  <?php
}
