<?php
if ($_GET['m'] != '' || isset($_GET['m'])) {
    foreach ($_GET as $key => $val) {
        //echo 'Field name : '.$key .', Value : '. base64_decode($val) .'<br>';
        $data[$key] = base64_decode($val);
    }
}

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

function hash256($origin)
{
    $algo = "sha256";
    $binary = "true";
    return hash($algo, $origin, $binary);
}

$mail64 = $_GET['m'];
$orderdate64 = $_GET['d'];
$orderdate = $data['d'];
$confirmed = false;

$path = "absoroot-64/logins/";
$datetime = explode(" ", $data['d']);
$startstring = $data['m'] . $datetime[1];
$history = "absoroot-64/history/" . $data['m'] . $data['d'];

$user = explode("@", $data['m']);
$domain256 = hash256($user[2]);
$name256 = hash256($user[1]);
$user_dir = "absoroot-64/activity/" . $domain256 . "/" . $name256 . "/";

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

if ($confirmed) {
    if (!is_dir($user_dir)) {
        $userdata = salt3();
    } else {
        $files = glob($user_dir . "*");
        $userdata = $files[0];
    }
    $filestream = fopen($user_dir . $userdata, "w") or die("$userdata not exists");
    fwrite($filestream, $user_dir . "\n");
    fwrite($filestream, $userdata . "\n");
    fclose($filestream);
    header('Location: https://b6.hu/b8x');
} else {
    header('Location: https://b6.hu');
}
