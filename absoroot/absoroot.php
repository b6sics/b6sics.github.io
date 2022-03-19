<!DOCTYPE html>
<html lang="hu">

<?php

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    // ip from share internet
    $client_ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    // ip pass from proxy
    $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $client_ip = $_SERVER['REMOTE_ADDR'];
}
$client_datas = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $client_ip));

$message = "";
$subject = "";
$datetime = "";

$crlf = "\r\n";

if (isset($_POST['b6usermail'])) {
    $mail = $_POST['b6usermail'];
} else {
    header('Location: https://b6.hu');
}

if (empty($mail)) {
    header('Location: https://b6.hu');
}

if (isset($_POST['b6datetime'])) {
    $datetime = $_POST['b6datetime'];
} else {
    header('Location: https://b6.hu');
}

if (empty($datetime)) {
    header('Location: https://b6.hu');
}

$clientdate = explode(" ", $datetime);
if (count($clientdate) == 2) {
    $clienttime = explode(":", $clientdate[1]);
    if (count($clienttime) == 3) {
        if (preg_match('/^\d+$/', $clienttime[0]) &&
            preg_match('/^\d+$/', $clienttime[1]) &&
            preg_match('/^\d+$/', $clienttime[2]) ) {
                $clienthour = (int) $clienttime[0];
                $clientmin = (int) $clienttime[1];
                $clientsec = (int) $clienttime[2];
                if ($clienthour < 0 || $clienthour > 24) {
                    header('Location: https://b6.hu');
                }
                if ($clientmin < 0 || $clienthour > 59) {
                    header('Location: https://b6.hu');
                }
                if ($clientsec < 0 || $clienthour > 59) {
                    header('Location: https://b6.hu');
                }
        } else {
            header('Location: https://b6.hu');
        }
    } else {
        header('Location: https://b6.hu');
    }
} else {
    header('Location: https://b6.hu');
}


$datetime64 = base64_encode($datetime);

list($usec, $sec) = explode(" ", microtime());
$logindate = date("Y-m-d H:i:s") . substr($usec, 1);
$logintime = date("H:i:s") . substr($usec, 1);

$mail64 = base64_encode($mail);
$logindate64 = base64_encode($logindate);

$method = "aes256";
$iv_length = openssl_cipher_iv_length($method);
$iv = openssl_random_pseudo_bytes($iv_length);
$salttext = "áRVíZTűRő TüKöRFúRóGéP";
$saltpass = "ÁrvÍztŰrŐ tÜkÖrfÚrÓgÉp";
$saltstring = openssl_encrypt($salttext, $method, $saltpass, 0, $iv);
$salt = base64_encode(substr($saltstring, 0, 10));

$datafilename = $mail . $logintime . $salt;

$loginfile = "absoroot-64/logins/" . $datafilename . ".php";
$loginstream = fopen($loginfile, "w") or die("Unable to open file!");
fwrite($loginstream, "Client: " . $datetime);
fwrite($loginstream, PHP_EOL);
fwrite($loginstream, "Server: " . $logindate);
fwrite($loginstream, PHP_EOL);
fwrite($loginstream, $mail);
fwrite($loginstream, PHP_EOL);
fwrite($loginstream, "Client ip:        " . $client_ip);
fwrite($loginstream, PHP_EOL);
fwrite($loginstream, "Client city:      " . $client_datas['geoplugin_city']);
fwrite($loginstream, PHP_EOL);
fwrite($loginstream, "Client region:    " . $client_datas['geoplugin_regionName']);
fwrite($loginstream, PHP_EOL);
fwrite($loginstream, "Client country:   " . $client_datas['geoplugin_countryName']);
fwrite($loginstream, PHP_EOL);
fwrite($loginstream, "Client continent: " . $client_datas['geoplugin_continentName']);
fwrite($loginstream, PHP_EOL);
fclose($loginstream);
chmod($loginfile, 0600);

$confirmedlink = "https://b6.hu/confirm.php?m=$mail64&d=$logindate64";

?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, 
                                   initial-scale=1, 
                                   shrink-to-fit=no" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login|Abso-root</title>

    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="shortcut icon" type="image/png" href="favicon.png" />

    <base target="_self">

    <link rel="stylesheet" href="style.css?t=123" />

</head>

<body>
    <header>
        <img class="float_right" src="O.png" alt="" />
        <div class="align_right">
            <h1>Abso-root</h1>
            <h5><i> "O" is safety </i></h5>
        </div>
    </header>
    <main>
        <section>
            Az egyszeri belépéséhez szükséges linket elküldtük a <?php echo $mail; ?> e-mail címre.
        </section>
    </main>

    <?php

    function email_is_valid($email_address)
    {
        $email_address = filter_var($email_address, FILTER_SANITIZE_EMAIL);
        if (filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
            return $email_address;
        } else {
            return "security@levaipack.hu"; /* 3miLE6lOo1a8ll4 */
        }
    }

    $subject = 'Belépés ' . $datetime;
    $subject = filter_var($subject, FILTER_UNSAFE_RAW);


    $preferences = ["input-charset" => "UTF-8", "output-charset" => "UTF-8"];
    $subject = iconv_mime_encode('Subject', $subject, $preferences);
    $subject = substr($subject, strlen('Subject: '));

    $message .= "<html><body style='text-align: justify'>";
    $message .= "<h1> Belépés: </h1>";

    $message .= "<h3>Azonosító e-mail:</h3>";
    $message .= "$mail.</p>";
    $message .= "<p>Egyszeri belépést engedélyező hivatkozás:</p>";
    $message .= "<p><a href='$confirmedlink'>link</a></p>";
    $message .= "<p>Örülök, hogy újra látom!</p>";
    $message .= "<br /></body></html>";

    $message = base64_encode(wordwrap($message, 70, $crlf));

    $to = email_is_valid($mail);

    $deliveredTo = 'Delivered-to: ' . $to;

    mb_internal_encoding('UTF-8');

    $sender_name = mb_encode_mimeheader('b6.hu', 'UTF-8', 'Q');
    $from = 'From: ' . $sender_name . '<b6@b6.hu>';

    $replayTo = 'Reply-To: b6@b6.hu';

    $xSender = 'X-Sender: ' . $sender_name . '<b6@b6.hu>';
    $returnPath = 'Return-Path: ' . $sender_name . '<b6@b6.hu>';
    $envelopeFrom = 'Envelope-from: ' . $sender_name . '<b6@b6.hu>';

    $xMailer = 'X-Mailer: PHP/' . phpversion();

    $xPriority = 'X-Priority: 3';
    $xMsMailPriority = 'X-MSMail-Priority: High';
    $importance = 'Importance: 3';

    $xDate = 'Date:' . date("YmdHis");

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
        $xMailer . $crlf .
        $xPriority . $crlf .
        $xMsMailPriority . $crlf .
        $importance . $crlf .
        $xDate;

    mail($to, $subject, $message, $headers);

    ?>

    <footer>
        <h4>
            HU-1111 Budapest Bercsényi utca 6.<br />
            &#9993; b6@b6.hu | &#9743; 30-4654562
        </h4>
    </footer>

    <!--?php
    if($_POST['submitlogin'] != '' || isset($_POST['submitlogin'])) {
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