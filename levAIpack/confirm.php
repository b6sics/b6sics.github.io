<!DOCTYPE html>
<html lang="hu">

<?php
    if($_GET['m'] != '' || isset($_GET['m'])) {
        foreach($_GET as $key => $val) {
            echo 'Field name : '.$key .', Value : '. base64_decode($val) .'<br>';
            $data[$key] = base64_decode($val);
        }
    }

    $datetime = explode(" ", $data['d']);
    $startstring = $data['m'] . $datetime[1];
    echo $startstring . "<br />\n";

    $order_path = "levAIorders/ordered/";
    $files = glob($order_path . '*'); 
    $confirmed_path = "levAIorders/confirmed/";
    foreach($files as $file) {
        if(is_file($file)) 
        $path_parts = pathinfo($file);

        if (strpos($path_parts['basename'], $startstring) === 0){
            //echo $path_parts['dirname'], "<br />\n";
            echo $path_parts['basename'], "<br />\n";
            //echo $path_parts['extension'], "<br />\n";
            //echo $path_parts['filename'], "<br />\n"; // filename is only since PHP 5.2.0
            $confirmedfile = $confirmed_path . $data['m'] . "-" . $data['d'] . ".b6txt";
            rename($file, $confirmedfile);
        }
    }
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, 
                                   initial-scale=1, 
                                   shrink-to-fit=no" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Megerősítve|Levai Pack</title>
    <base target="_self">

    <link rel="stylesheet" href="https://b6sics.github.io/levAIpack/root-directories/root-css-2022/style.css?t=123" />

</head>

<body id="start">
    <a href="https://levaipack.hu" title="Főoldal">
        <div class="animation">
            <div class="cube-mini">
                <div class="cube_face-mini cube_face-front-mini">Kft.</div>
                <div class="cube_face-mini cube_face-left-mini">Pack</div>
                <div class="cube_face-mini cube_face-top-mini">Lévai</div>
            </div>
        </div>
    </a>
    <header class="right vertical">
        <h1>
            Lévai&nbsp;Pack&nbsp;Kft.
        </h1>
    </header>

    <main>
        <header id="orderText">
            <h2>
                <i>Megrendelésed&nbsp;feldolgozás alatt</i>
            </h2>
        </header>

    </main>

    <footer class="bottom center static">
        <h4>
            HU-1113 Budapest Ábel Jenő utca 7.<br />
            &#9993; info@levaipack.hu | &#9743; 30-7434249
        </h4>
    </footer>

<!--?php
    if($_POST['submitOrder'] != '' || isset($_POST['submitOrder'])) {
        foreach($_POST as $key => $val) {
            echo 'Field name : '.$key .', Value : '.$val.'<br>';
            $data[$key] = $val;
        }
    }
?-->

    <script>
    </script>
</body>

</html>