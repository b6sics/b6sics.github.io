<?php
session_start();

$_SESSION["pageName"] = "b6dataCenter";
//echo 'php: session_start();<br />';

foreach ($_SESSION as $key => $val) {
    //echo 'php: $_SESSION["' . $key . '"] = ' . $val . '<br />';
    $sessionData[$key] = $val;
}

?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, 
                                   initial-scale=1, 
                                   shrink-to-fit=no" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DataCenter|B6SicS</title>
    <base target="_self">

    <style type="text/css">
        html {
            overflow: auto;
        }

        html,
        body,
        div,
        iframe {
            margin: 0px;
            padding: 0px;
            height: 100%;
            border: none;
        }

        iframe {
            display: block;
            width: 100%;
            border: none;
            overflow-y: auto;
            overflow-x: hidden;
        }
    </style>

</head>

<body id="start">
    <iframe src="https://b6sics.github.io/flashCards/index.html" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%" scrolling="auto">
    </iframe>
</body>

</html>