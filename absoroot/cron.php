<?php
$b6huCronLog = fopen("b6huCron.log", "w") or die("Unable to open file!");
fwrite($b6huCronLog, "Log created: " . date("Y-m-d h:i:s") . PHP_EOL);

$today = date("Y-m-d");

$path = "logins/";
$files = glob($path . '*');
foreach ($files as $file) {
    if (is_file($file))
        $f_today = date("Y-m-d", filemtime($file));
    if ($today == $f_today) {
        $path_parts = pathinfo($file);
        fwrite($b6huCronLog, "login today: " . $path_parts['basename'] . PHP_EOL);
    } else {
        unlink($file);
    }
}
fclose($b6huCronLog);
