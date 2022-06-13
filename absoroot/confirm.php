<?php

include_once("validation_ab6date.php");
include_once("validation_email.php");

if (isset($_GET['m'])) {
    foreach ($_GET as $key => $val) {
        //echo 'Field name : '.$key .', Value : '. base64_decode($val) .'<br>';
        $data[$key] = base64_decode($val);
    }
    $mail64 = $_GET['m'];
} else {
    header($home_url);
}

if (isset($_GET['d'])) {
    $orderdate64 = $_GET['d'];
    $orderdate = $data['d'];
} else {
    header($home_url);
}

if (!isset($data)) {
    header($home_url);
}

if (!isset($mail64)) {
    header($home_url);
}

// TODO: validation mail/datetime 

function salt3()
{
    $method = "aes256";
    $iv_length = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $salttext = "áRVíZTűRő TüKöRFúRóGéP";
    $saltpass = "ÁrvÍztŰrŐ tÜkÖrfÚrÓgÉp";
    $saltstring = openssl_encrypt($salttext, $method, $saltpass, 0, $iv);
    return base64_encode(substr($saltstring, 0, 10));
}

function hash128($origin)
{
    $algo = "md5";
    $binary = "true";
    return hash($algo, $origin, $binary);
}

$confirmed = false;

$path = "absoroot-64" . DIRECTORY_SEPARATOR . "logins" . DIRECTORY_SEPARATOR;
$datetime = explode(" ", $data['d']);
$startstring = $data['m'] . $datetime[1];
$history = "absoroot-64/history/" . $data['m'] . $data['d'];

$user = explode("@", $data['m']);
$domain128 = base64_encode(hash128($user[1]));
$name128 = base64_encode(hash128($user[0]));
$user_dir = "absoroot-64" . DIRECTORY_SEPARATOR . "activity" . DIRECTORY_SEPARATOR . $domain128 . DIRECTORY_SEPARATOR . $name128;

$files = glob($path . '*');
foreach ($files as $file) {
    if (is_file($file)) {
        $path_parts = pathinfo($file);
        if (strpos($path_parts['basename'], $startstring) === 0) {
            rename($file, $history);
            $confirmed = true;
        }
    }
}

$userdata = "no-user-data";

if ($confirmed) {
    if (!is_dir($user_dir)) {
        echo "mkdir(): ";
        echo mkdir("." . DIRECTORY_SEPARATOR . $user_dir, 0700, true);
        echo "<br />";
        $userdata = salt3();
    } else {
        $files = glob($user_dir . DIRECTORY_SEPARATOR . "*");
        $path_parts = pathinfo($files[0]);
        $userdata = $path_parts['basename'];
    }
    $filestream = fopen($user_dir . DIRECTORY_SEPARATOR . $userdata, "w") or die("$userdata not exists");
    fwrite($filestream, $user_dir . "\n");
    fwrite($filestream, $userdata . "\n");
    fclose($filestream);
    header('Location: https://b6.hu/b8x');
} else {
    header($home_url);
}
