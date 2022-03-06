<!DOCTYPE html>
<html lang="hu">

<?php
    if($_GET['m'] != '' || isset($_GET['m'])) {
        foreach($_GET as $key => $val) {
            //echo 'Field name : '.$key .', Value : '. base64_decode($val) .'<br>';
            $data[$key] = base64_decode($val);
        }
    }

    $to = $data['m'];
    $orderdate = $data['d'];

    function send_closed_mail($text){
        global $to, $orderdate;
        $crlf = "\r\n";

        if ($to == "b6@b6.hu"){
            $home = "security@levaipack.hu";
        } else {
            $home = "info@levaipack.hu";
        }

        $subject = 'Teljesített rendelés ' . $orderdate;
        $subject = filter_var($subject, FILTER_UNSAFE_RAW);
        
        $preferences = ["input-charset" => "UTF-8", "output-charset" => "UTF-8"];
        $subject = iconv_mime_encode('Subject', $subject, $preferences);
        $subject = substr($subject, strlen('Subject: '));
        
        $message = "<html><body style='text-align: justify'>";
        $message .= "<h1> Véglegesített rendelés ( " . $orderdate . " ) </h1>";
        
        $message .= "<pre>" . $text . "</pre><br />";
        
        $message .= "<p>mailed from levaipack.hu ". date("Y.m.d. H:m:s") . "</p>";
        $message .= "<br /></body></html>";
        
        $message = base64_encode(wordwrap($message, 70, $crlf));
        
        $deliveredTo = 'Delivered-to: ' . $home;

        mb_internal_encoding('UTF-8');
        
        $sender_name = mb_encode_mimeheader('levaipack.hu', 'UTF-8', 'Q');
        $from = 'From: ' . $sender_name . '<levaipack@levaipack.hu>';
        
        $replayTo = 'Reply-To: levaipack@levaipack.hu';
        
        $xSender = 'X-Sender: '. $sender_name . '<levaipack@levaipack.hu>';
        $returnPath = 'Return-Path: '. $sender_name . '<levaipack@levaipack.hu>';
        $envelopeFrom = 'Envelope-from: '. $sender_name . '<levaipack@levaipack.hu>';
        
        $xMailer = 'X-Mailer: PHP/' . phpversion();
        
        $xPriority = 'X-Priority: 3';
        $xMsMailPriority = 'X-MSMail-Priority: High';
        $importance = 'Importance: 3';
        
        $xDate = 'Date:' . date("YmdHms");
        
        //$cC[] = 'Cc: security@levaipack.hu';
        //$bCC[] = 'Bcc: security@levaipack.hu';
        
        $headers = 'MIME-Version: 1.0' . $crlf;
        $headers .= 'Content-Type: text/html; charset=utf-8' . $crlf;
        $headers .= 'Content-Transfer-Encoding: base64' . $crlf;
        
        $headers .= $deliveredTo . $crlf .
                    $from . $crlf .
                    $replayTo . $crlf .
                    $xSender . $crlf .
                    $returnPath . $crlf .
                    $envelopeFrom . $crlf .
                    $xMailer. $crlf .
                    $xPriority. $crlf .
                    $xMsMailPriority. $crlf .
                    $importance. $crlf .
                    $xDate;
        
        mail($home, $subject, $message, $headers);
    }

    $datetime = explode(" ", $data['d']);
    $startstring = $data['m'] . $datetime[1];
    //echo $startstring . "<br />\n";

    $confirmedname = $data['m'] . "-" . $data['d'];

    $order_path = "levAIorders/ordered/";
    $files = glob($order_path . '*'); 
    $confirmed_path = "levAIorders/confirmed/";
    $confirmedfile = $confirmed_path . $confirmedname . ".b6txt";

    foreach($files as $file) {
        if(is_file($file)) 
        $path_parts = pathinfo($file);

        if (strpos($path_parts['basename'], $startstring) === 0){
            //echo $path_parts['dirname'], "<br />\n";
            //echo $path_parts['basename'], "<br />\n";
            //echo $path_parts['extension'], "<br />\n";
            //echo $path_parts['filename'], "<br />\n"; // filename is only since PHP 5.2.0
            rename($file, $confirmedfile);
            $text = file_get_contents($confirmedfile);

            send_closed_mail($text);
        }
    }
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, 
                                   initial-scale=1, 
                                   shrink-to-fit=no" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Teljesítve|Levai Pack</title>
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
<?php
    if (file_exists($savedfile)){
        echo "<i>Megrendelés&nbsp;teljesítve</i><br />\n";
        echo "</h2>\n";
        echo "<div style='margin: 0 2em;'>\n";
        echo "<pre>", file_get_contents($savedfile), "\n</pre>\n";
        echo "</div>\n";
} else {
        echo "              <i>Az aktát&nbsp; törölték.<br /></i>\n";
        echo "            </h2>\n";
    }
?>
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