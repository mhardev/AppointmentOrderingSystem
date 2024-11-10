<?php
include('config/dbcon.php');
include('Services/EmailService.php');

$number = $_GET['number'];

for ($i = 0; $i < 6; $i++) {
    $randomNumbers[] = rand(1, 9);
}

$verifCode = implode('', $randomNumbers);

// $client->messages->create(
    // The number you'd like to send the message to
   // sprintf("+63$number", $number),
    //[
        // A Twilio phone number you purchased at https://console.twilio.com
      //  'from' => '+12402928227',
        // The body of the text message you'd like to send
        //'body' => sprintf("Hi! This is MOTO-JEN, Please don't share your verification code to anyone. Verification Code: $verifCode", $verifCode)
    //]
//);

echo json_encode($verifCode);

