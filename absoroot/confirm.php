<?php
if ($_GET['m'] != '' || isset($_GET['m'])) {
    foreach ($_GET as $key => $val) {
        //echo 'Field name : '.$key .', Value : '. base64_decode($val) .'<br>';
        $data[$key] = base64_decode($val);
    }
}

$to = $data['m'];
$mail64 = $_GET['m'];
$orderdate64 = $_GET['d'];
$orderdate = $data['d'];
$confirmed = false;

$path = "logins/";
$datetime = explode(" ", $data['d']);
$startstring = $data['m'] . $datetime[1];

$files = glob($path . '*');
foreach ($files as $file) {
    if (is_file($file)) {
        $path_parts = pathinfo($file);
        if (strpos($path_parts['basename'], $startstring) === 0) {
            unlink($file);
            $confirmed = true;
        }
    }
}

if ($confirmed) {
    header('Location: https://b6.hu/b8x');
} else {
    header('Location: https://b6.hu');
}
