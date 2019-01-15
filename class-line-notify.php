<?php 

namespace LineNotifyWithSeed;

use KS\Line\LineNotify;

class Notifier {

  private $notifier;

  public function __construct() {
    $this->notifier = new LineNotify(get_option('line_notify_api'));
  }

  public function sendMessage($data) {
    $text  = "\n";
    $text .= "Order: "  .$data['order']     . "\n";
    $text .= "Name: "   .$data['name']      . "\n";
    $text .= "Contact: ".$data['contact']   . "\n";
    $text .= "Amount: " .$data['amount']    . "\n";
    $text .= "Bank: "   .$data['bank']      . "\n";
    $text .= "Date: "   .$data['date']      . "\n";
    $text .= "Time: "   .$data['time'];

    $this->notifier->send($text, $data['slip']);
  }
}