<?php

require('classes/Database.php');
require('classes/Helper.php');
require('classes/Customer.php');

$helper = new Helper();

$name = (string) $_POST['name'] ?? '';
$phone = (string) $_POST['phone'] ?? '';
$email = (string) $_POST['email'] ?? '';

if ($helper->isEmpty([$name, $phone, $email])) {
  echo 'All fields are required';
} else {
  if ($helper->isValidEmail($email)) {
    $customer = new Customer($email);

    if (!$customer->isEmailTaken()) {
      $customer->addCustomer($name, $phone, $email);
    }

    echo 'Thank you for your requesed. We will contact you within 24 hours';
  }
}
