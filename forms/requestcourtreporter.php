<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'emann@nationwidelegal.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = "Court Reporter Request";

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  
  $contact->smtp = array(
    'host' => 'smtp.office365.com',
    'username' => 'web@nationwidelegal.com',
    'password' => 'Aria_NWL_2024',
    'port' => '587'
  );

  $contact->add_message( $_POST['name'], 'Contact Name');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['phone'], 'Phone');
  $contact->add_message( $_POST['lawfirm'], 'Law Firm');
  $contact->add_message( $_POST['state'], 'State');
  $contact->add_message($_POST['mode'] ?? '', 'Remote / In-Person / Hybrid');
  $contact->add_message($_POST['jobdate'] ?? '', 'Job Date');
  $contact->add_message($_POST['stime'] ?? '', 'Start Time');
  $contact->add_message($_POST['timezone'] ?? '', 'Time Zone');
  $contact->add_message($_POST['message'] ?? '', 'Message');
  $contact->add_message($_POST['aboutus'] ?? '', 'How did you hear about us?');
  $contact->add_message($_POST['servicerequest'] ?? '', 'What services are you interested in?');
  $contact->add_message($_POST['monthly'] ?? '', 'Estimated Monthly Volume');
  $contact->cc = array('sales@nationwidelegal.com');
  echo $contact->send();
?>