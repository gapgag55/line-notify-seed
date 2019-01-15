<?php
/*
 * Plugin Name: Line Notify with Seed Confirm Pro
 * Plugin URI:
 * Description: Notify Business Owner via Line and integrated with Seed Comfirm
 * Version: 1.0.3
 * Author: Kopkap
 * Author URI:
 * Text Domain: line-notify-seed
 * Domain Path: /languages
 * Requires at least: 5.0.0
 * Tested up to: 5.0.0
 */

require __DIR__ . '/vendor/autoload.php';

use LineNotifyWithSeed\SeedConfirmPro;
use LineNotifyWithSeed\Notifier;


add_action( 'init', 'check_update' , 12 );
function check_update() {

  Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/gapgag55/line-notify-seed',
    __FILE__,
    'seed-confirm-notification'
  );

}

add_action( 'init', 'seed_notify_init' , 13 );
function seed_notify_init() {

  if (SeedConfirmPro::submit()) {

    $notifier    = new Notifier();
    $seedConfirm = new SeedConfirmPro();
  
    $data = [
      'name'    => $seedConfirm->getName(),
      'contact' => $seedConfirm->getContact(),
      'order'   => $seedConfirm->getOrder(),
      'amount'  => $seedConfirm->getAmount(),
      'bank'    => $seedConfirm->getAccountBank(),
      'date'    => $seedConfirm->getDate(),
      'time'    => $seedConfirm->getTime(),
      'slip'    => $seedConfirm->getSlip()
    ];
  
    $notifier->sendMessage($data);
    
  }  
  
}
