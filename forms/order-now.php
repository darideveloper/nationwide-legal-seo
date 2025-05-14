<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'anikola@nationwidelegal.com';

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
  $contact->subject = "Website - Order Now";

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials

  $contact->smtp = array(
    'host' => 'smtp.office365.com',
    'username' => 'web@nationwidelegal.com',
    'password' => 'Aria_NWL_2024',
    'port' => '587'
  );

  if ($_POST['form_type'] == 'Service of Process') {
    // Información del servicio
    $contact->add_message($_POST['form_type'], 'Service Type'); // Asegúrate de tener este campo en el formulario
    // Información del contacto
    $contact->add_message($_POST['servicerequest'], 'Service Request'); // Asegúrate de tener este campo en el formulario
    $contact->add_message($_POST['name1'], 'Full Name (Contact Name)');
    $contact->add_message($_POST['email1'], 'Email');
    $contact->add_message($_POST['phonenumber1'], 'Phone Number');
    $contact->add_message($_POST['company1'], 'Company');
    $contact->add_message($_POST['address1'], 'Address');
    $contact->add_message($_POST['city1'], 'City');
    $contact->add_message($_POST['state1'], 'State');
    $contact->add_message($_POST['zip1'], 'Zip');

    // Información del pedido (Party Being Served)
    $contact->add_message($_POST['party_served1'], 'Party Being Served');
    $contact->add_message($_POST['address2_1'], 'Address');
    $contact->add_message($_POST['city2_1'], 'City');
    $contact->add_message($_POST['state2_1'], 'State');
    $contact->add_message($_POST['zip2_1'], 'Zip');

    // Campos opcionales de dirección adicional
    $contact->add_message($_POST['address3_1'], 'Additional Address (optional)');
    $contact->add_message($_POST['city3_1'], 'Additional City');
    $contact->add_message($_POST['state3_1'], 'Additional State');
    $contact->add_message($_POST['zip3_1'], 'Additional Zip');

    // Mensajes y otros campos
    $contact->add_message($_POST['documents1'], 'List of Documents');
    $contact->add_message($_POST['message1'], 'Special Instructions');
  }

  if ($_POST['form_type'] == 'E-Filing') {
    // Información del servicio
    $contact->add_message($_POST['form_type'], 'Service Type');
    // Información del contacto
    $contact->add_message($_POST['name2'], 'Full Name (Contact Name)');
    $contact->add_message($_POST['email2'], 'Email');
    $contact->add_message($_POST['phonenumber2'], 'Phone Number');
    $contact->add_message($_POST['company2'], 'Company');
    $contact->add_message($_POST['address2'], 'Address');
    $contact->add_message($_POST['city2'], 'City');
    $contact->add_message($_POST['state2'], 'State');
    $contact->add_message($_POST['zip2'], 'Zip');

    // Información del pedido (E-Filing)
    $contact->add_message($_POST['court-name2'], 'Court Name');
    $contact->add_message($_POST['case-number2'], 'Case Number');
    $contact->add_message($_POST['case-title2'], 'Case Title');

    // Mensajes y otros campos
    $contact->add_message($_POST['documents2'], 'List of Documents');
    $contact->add_message($_POST['message2'], 'Special Instructions');

    // Información adicional de servicios (opcional)
    $contact->add_message(isset($_POST['eServe']) ? 'Yes' : 'No', 'e-Serve');
    $contact->add_message(isset($_POST['courtesyCopyDelivery']) ? 'Yes' : 'No', 'Courtesy Copy Delivery');
    $contact->add_message(isset($_POST['courtesyFeeAdvancing']) ? 'Yes' : 'No', 'Courtesy Fee Advancing');
  }

  if ($_POST['form_type'] == 'Court Services') {
    // Información del contacto
    $contact->add_message($_POST['name3'], 'Full Name (Contact Name)');
    $contact->add_message($_POST['email3'], 'Email');
    $contact->add_message($_POST['phonenumber3'], 'Phone Number');
    $contact->add_message($_POST['company3'], 'Company');
    $contact->add_message($_POST['address3'], 'Address');
    $contact->add_message($_POST['city3'], 'City');
    $contact->add_message($_POST['state3'], 'State');
    $contact->add_message($_POST['zip3'], 'Zip');

    // Información del pedido
    $contact->add_message($_POST['court-name3'], 'Court Name');
    $contact->add_message($_POST['case-number3'], 'Case Number');
    $contact->add_message($_POST['case-title3'], 'Case Title');
    $contact->add_message($_POST['documents3'], 'List of Documents');
    $contact->add_message($_POST['message3'], 'Special Instructions');

    // Información adicional de servicios (opcional)
    $contact->add_message(isset($_POST['counterFiling3']) ? 'Yes' : 'No', 'Additional Service: Counter Filing');
    $contact->add_message(isset($_POST['courtResearch3']) ? 'Yes' : 'No', 'Additional Service: Court Research');
    $contact->add_message(isset($_POST['courtesyFeeAdvancing3']) ? 'Yes' : 'No', 'Additional Service: Courtesy Fee Advancing');
  }

  if ($_POST['form_type'] == 'Investigations') {
    // Información del contacto
    $contact->add_message($_POST['name4'], 'Full Name (Contact Name)');
    $contact->add_message($_POST['email4'], 'Email');
    $contact->add_message($_POST['phonenumber4'], 'Phone Number');
    $contact->add_message($_POST['company4'], 'Company');
    $contact->add_message($_POST['address4'], 'Address');
    $contact->add_message($_POST['city4'], 'City');
    $contact->add_message($_POST['state4'], 'State');
    $contact->add_message($_POST['zip4'], 'Zip');

    // Información del pedido
    $contact->add_message($_POST['party_served4'], 'Party Being Served');
    $contact->add_message($_POST['address2_4'], 'Address of Party Being Served');
    $contact->add_message($_POST['city2_4'], 'City of Party Being Served');
    $contact->add_message($_POST['state2_4'], 'State of Party Being Served');
    $contact->add_message($_POST['zip2_4'], 'Zip of Party Being Served');

    // Dirección adicional (opcional)
    $contact->add_message($_POST['address3_4'], 'Additional Address');
    $contact->add_message($_POST['city3_4'], 'City of Additional Address');
    $contact->add_message($_POST['state3_4'], 'State of Additional Address');
    $contact->add_message($_POST['zip3_4'], 'Zip of Additional Address');

    // Documentos y instrucciones especiales
    $contact->add_message($_POST['documents4'], 'List of Documents');
    $contact->add_message($_POST['message4'], 'Special Instructions');
  }

  if ($_POST['form_type'] == 'Court Reporting') {
    // Información del contacto
    $contact->add_message($_POST['name5'], 'Full Name (Contact Name)');
    $contact->add_message($_POST['email5'], 'Email');
    $contact->add_message($_POST['phonenumber5'], 'Phone Number');
    $contact->add_message($_POST['company5'], 'Company');
    $contact->add_message($_POST['address5'], 'Address');
    $contact->add_message($_POST['city5'], 'City');
    $contact->add_message($_POST['state5'], 'State');
    $contact->add_message($_POST['zip5'], 'Zip');

    // Información del pedido
    $contact->add_message($_POST['party_served5'], 'Party Being Served');
    $contact->add_message($_POST['address2_5'], 'Address of Party Being Served');
    $contact->add_message($_POST['city2_5'], 'City of Party Being Served');
    $contact->add_message($_POST['state2_5'], 'State of Party Being Served');
    $contact->add_message($_POST['zip2_5'], 'Zip of Party Being Served');

    // Dirección adicional (opcional)
    $contact->add_message($_POST['address3_5'], 'Additional Address');
    $contact->add_message($_POST['city3_5'], 'City of Additional Address');
    $contact->add_message($_POST['state3_5'], 'State of Additional Address');
    $contact->add_message($_POST['zip3_5'], 'Zip of Additional Address');

    // Documentos y instrucciones especiales
    $contact->add_message($_POST['documents5'], 'List of Documents');
    $contact->add_message($_POST['message5'], 'Special Instructions');
  }

  if ($_POST['form_type'] == 'Subpoena Services') {
    // Información del contacto
    $contact->add_message($_POST['name6'], 'Full Name (Contact Name)');
    $contact->add_message($_POST['email6'], 'Email');
    $contact->add_message($_POST['phonenumber6'], 'Phone Number');
    $contact->add_message($_POST['company6'], 'Company');
    $contact->add_message($_POST['address6'], 'Address');
    $contact->add_message($_POST['city6'], 'City');
    $contact->add_message($_POST['state6'], 'State');
    $contact->add_message($_POST['zip6'], 'Zip');

    // Información del pedido
    $contact->add_message($_POST['party_served6'], 'Party Being Served');
    $contact->add_message($_POST['address2_6'], 'Address of Party Being Served');
    $contact->add_message($_POST['city2_6'], 'City of Party Being Served');
    $contact->add_message($_POST['state2_6'], 'State of Party Being Served');
    $contact->add_message($_POST['zip2_6'], 'Zip of Party Being Served');

    // Dirección adicional (opcional)
    $contact->add_message($_POST['address3_6'], 'Additional Address');
    $contact->add_message($_POST['city3_6'], 'City of Additional Address');
    $contact->add_message($_POST['state3_6'], 'State of Additional Address');
    $contact->add_message($_POST['zip3_6'], 'Zip of Additional Address');

    // Documentos y instrucciones especiales
    $contact->add_message($_POST['documents6'], 'List of Documents');
    $contact->add_message($_POST['message6'], 'Special Instructions');

    // Información sobre el Oficial de Declaración
    $depositionOfficer = isset($_POST['depositionOfficerYes']) ? 'Yes' : 'No';
    $contact->add_message($depositionOfficer, 'Are we acting as your Deposition Officer?');
  }

  // $contact->cc = array('jcaamal@nationwidelegal.com');
  echo $contact->send();
?>