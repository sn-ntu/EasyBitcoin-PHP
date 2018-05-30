<?php


// --- CONFIG ---

$addressField = 'addr';
$captchaField = 'g-recaptcha-response';
$captchaSecret = '6LfIO1wUAAAAAKDR2KW3nbAbKuSXRZQWm9HpJ290';

$amountToSend = 10;

function stop($message = null, $code = 400) {
    // clear the old headers
    header_remove();
    // set the actual code
    http_response_code($code);
    // set the header to make sure cache is forced
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    // treat this as json
    header('Content-Type: application/json');
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
        );
    // ok, validation error, or failure
    header('Status: '.$status[$code]);
    // return the encoded json
    echo json_encode(array(
        'status' => $code < 300, // success or not?
        'message' => $message
        ));
    exit();
}

// validate method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    stop('something went wrong');
}

// check fields
if (!isset($_POST[$addressField])) {
    // TODO proper address validation
    stop('Please provide a valid Zcoin address');
}

$address = stripslashes($_POST[$addressField]);

if (!isset($_POST[$captchaField])) {
    stop('Humans only! Check the captcha');
}

$captcha = stripslashes($_POST[$captchaField]);

// validate captcha
$verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$captchaSecret}&response={$captcha}");
$captcha_success = json_decode($verify);

if ($captcha_success->success == false) {
  //This user was not verified by recaptcha.
  stop('Sorry, you\'re out. Humans only...');
}


// get ready
require_once('easybitcoin.php');
$bitcoin = new Bitcoin('username','password','localhost','8332');

// send it
$bitcoin->sendtoaddr($address, $amountToSend);

stop('💰💰💰 Check your address 💰💰💰', 200);
