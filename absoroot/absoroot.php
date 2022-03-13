<!DOCTYPE html>
<html lang="hu">

<?php
$message = "";
$subject = "";

$crlf = "\r\n";

if (isset($_POST['mail'])) {
    $mail = $_POST['mail'];
} else {
    $mail = "security@levaipack.hu";
    header('Location: https://b6.hu');
}

if (empty($mail)) {
    $mail = "security@levaipack.hu";
    header('Location: https://b6.hu');
}

$logindate = date("Y-m-d H:m:s");
$logintime = date("H:m:s");

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

$loginfile = "logins/" . $datafilename . ".php";
$loginstream = fopen($loginfile, "w") or die("Unable to open file!");
fwrite($loginstream, $logindate);
fwrite($loginstream, PHP_EOL);
fwrite($loginstream, $mail);
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
        <div>
            A belépéséhez szükséges linket elküldtük a <?php echo $mail; ?> e-mail címre.
        </div>
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

    $subject = 'Belépés ' . $logindate;
    $subject = filter_var($subject, FILTER_UNSAFE_RAW);


    $preferences = ["input-charset" => "UTF-8", "output-charset" => "UTF-8"];
    $subject = iconv_mime_encode('Subject', $subject, $preferences);
    $subject = substr($subject, strlen('Subject: '));

    $message .= "<html><body style='text-align: justify'>";
    $message .= "<h1> Belépés: </h1>";

    $message .= "<h3>Azonosító:</h3>";
    $message .= "e-mail: $mail.</p>";
    $message .= "<p>Kérjük kattintson a megerősítő hivatkozásra a belépéshez:</p>";
    $message .= "<p><a href='$confirmedlink'>link</a></p>";
    $message .= "<p>Örülünk, hogy újra látjuk!</p>";
    $message .= "<br /></body></html>";

    $message = base64_encode(wordwrap($message, 70, $crlf));

    if (isset($_POST['mail'])) {
        $to = email_is_valid($_POST['mail']);
    } else {
        $to = "security@levaipack.hu";
    }

    $deliveredTo = 'Delivered-to: ' . $to;

    mb_internal_encoding('UTF-8');

    $sender_name = mb_encode_mimeheader('levaipack.hu', 'UTF-8', 'Q');
    $from = 'From: ' . $sender_name . '<levaipack@levaipack.hu>';

    $replayTo = 'Reply-To: levaipack@levaipack.hu';

    $xSender = 'X-Sender: ' . $sender_name . '<levaipack@levaipack.hu>';
    $returnPath = 'Return-Path: ' . $sender_name . '<levaipack@levaipack.hu>';
    $envelopeFrom = 'Envelope-from: ' . $sender_name . '<levaipack@levaipack.hu>';

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