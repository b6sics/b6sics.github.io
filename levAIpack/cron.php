<?php
    $levAIhuCronLog = fopen("levAIhuCron.log", "w") or die("Unable to open file!");
    fwrite($levAIhuCronLog, "Log created: " . date("Y-m-d h:i:s"));
    fclose($levAIhuCronLog);

    $order_path = "levAIorders/ordered/";
    $files = glob($order_path . '*'); 
    foreach($files as $file) {
        if(is_file($file)) 
            unlink($file); 
    }
?>