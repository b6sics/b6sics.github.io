<?php
    $levAIhuCronLog = fopen("levAIhuCron.log", "w") or die("Unable to open file!");
    fwrite($levAIhuCronLog, "Log created: " . date("Y-m-d h:i:s"));
    fclose($levAIhuCronLog);
?>