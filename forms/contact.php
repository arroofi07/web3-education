<?php

/**
 * Requires the "PHP Email Form" library
 * The "PHP Email Form" library is available only in the pro version of the template
 * The library should be uploaded to: vendor/php-email-form/php-email-form.php
 * For more info and help: https://bootstrapmade.com/php-email-form/
 */

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'axeanonym@gmail.com';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
    if (!class_exists('PHP_Email_Form')) {
      die('Class PHP_Email_Form does not exist!');
    }
  } else {
    die('Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;

  $contact->to = $receiving_email_address;
  $contact->from_name = isset($_POST['name']) ? $_POST['name'] : '';
  $contact->from_email = isset($_POST['email']) ? $_POST['email'] : '';
  $contact->subject = isset($_POST['subject']) ? $_POST['subject'] : '';

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
    $contact->smtp = array(
        'host' => 'example.com',
        'username' => 'example',
        'password' => 'pass',
        'port' => '587'
    );
    */

  $contact->add_message($contact->from_name, 'From');
  $contact->add_message($contact->from_email, 'Email');
  $contact->add_message(isset($_POST['message']) ? $_POST['message'] : '', 'Message', 10);

  echo $contact->send() ? 'OK' : 'Message could not be sent.';
} else {
  // If the request method is not POST, display an error message or redirect
  http_response_code(405);
  echo 'Method Not Allowed';
}
