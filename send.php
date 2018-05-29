<?php
require_once('easybitcoin.php');
if (isset($_POST['addr'])){
    $bitcoin = new Bitcoin('username', 'password', 'localhost', '8332');
    $bitcoin->sendtoaddress($_POST['addr'], 10, "Zcoin testnet faucet");
} else{
    echo "invalid operation";
}
