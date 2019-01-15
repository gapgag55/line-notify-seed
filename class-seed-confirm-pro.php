<?php

namespace LineNotifyWithSeed;

class SeedConfirmPro {

  public function getName() {
  return $this->get('seed-confirm-name');
  }

  public function getContact() {
    return $this->get('seed-confirm-contact');
  }

  public function getOrder() {
    return $this->get('seed-confirm-order');
  }

  public function getAmount() {
    return $this->get('seed-confirm-amount');
  }

  public function getAccountBank() {
    return $this->get('seed-confirm-account-number');
  }

  public function getDate() {
    return $this->get('seed-confirm-date');
  }

  public function getTime() {
    return $this->get('seed-confirm-hour') . ':' . $this->get('seed-confirm-minute');
  }

  public function getSlip() {
    $post = wp_get_recent_posts([
      'post_type' => 'seed_confirm_log',
    ], ARRAY_A);

    $url = get_post_meta($post[0]['ID'], 'seed-confirm-image')[0];
    return $url;
  }

  public static function submit() {

    $isPostMethod = $_SERVER['REQUEST_METHOD'] === 'POST';
    $hasPostId    = array_key_exists('postid', $_POST);
    $hasNonce     = array_key_exists('_wpnonce' , $_POST);
    $hasOrder     = \wp_verify_nonce($_POST['_wpnonce'], 'seed-confirm-form-'.$_POST['postid']);

    return $isPostMethod && $hasPostId && $hasNonce && $hasOrder;
  }

  private function get($name) {
    return $_POST[$name];
  }
}