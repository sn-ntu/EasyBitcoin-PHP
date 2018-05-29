<?php
require_once('easybitcoin.php');
if (isset($_POST['addr'])){
    $bitcoin = new Bitcoin('username', 'password', 'localhost', '8332');
    $bitcoin->sendtoaddr($_POST['addr'], 10);
} else{
    echo "invalid operation";
}
