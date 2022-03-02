<!DOCTYPE html>
<html lang="hu">

<?php
    $message = "";
    $subject = "";

    $crlf = "\r\n";

    if ( isset($_POST['basketList']) ) {
        $basket = $_POST['basketList'];
    } else {
        $basket = " no basketList ";
    }

    if ( isset($_POST['basketlist']) ) {
        $mail = $_POST['mail'];
    } else {
        $mail = "security@levaipack.hu";
    }

    if ( isset($_POST['mail']) ) {
        $phone = $_POST['phone'];
    } else {
        $phone = " [no phone number] ";
    }

    if ( empty($basket) ){
        $basket = "<pre> no basketList </pre><br />";
    }

    if ( empty($mail) ){
        $mail = "security@levaipack.hu";
    }

    if ( empty($phone) ){
        $phone = " [no phone number] ";
    }

    $confirmationlink = "https://levaipack.hu/confirm.php";

?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, 
                                   initial-scale=1, 
                                   shrink-to-fit=no" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Elküldve|Levai Pack</title>
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
                <i>Megrendelésed&nbsp;megerősítésre vár</i>
            </h2>
        </header>
        <!-- -------------- -->
        <!-- basket details -->
        <!-- -------------- -->
        <textarea id="basketList" name="basketList" 
        rows="<?php echo(substr_count($basket, ':')) ?>" readonly><?php
            echo $basket;
        ?></textarea>

        <article class="center vertical">
            <p>
                A(z) <?php echo $mail ?> e-mail címre megküldtük a megrendelés másolatát. Kérjük nyissa meg a levelet, majd kattintson az e-mailben található megerősítő hivatkozásra, hogy véglegesítse a megrendelést.<br />
                Munkatársunk a <?php echo $phone ?> telefonszámon keresni fogja a számlázással és a szállítással kapcsolatban.<br />
                Amennyiben nem erősíti meg rendelését - mert elállt vásárlási szándékától - nincs további teendője. A rendszer naponta 00:00:00-kor automatikusan törli a meg nem erősített rendeléseket.<br />
                Minden más esetben ( pl.: megrendelés törlése és módosítása, ajánlatkérés ) telefonon és/vagy e-mailben léphet kapcsolatba velünk. 
            </p>
        </article>
    </main>

<?php

function email_is_valid ($email_address){
	$email_address = filter_var($email_address, FILTER_SANITIZE_EMAIL);
	if (filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
		return $email_address;
	}
	else {
		return "security@levaipack.hu"; /* 3miLE6lOo1a8ll4 */
	}
}

$subject = 'Rendelés ' . date("Y-m-d H:m:s");
$subject = filter_var($subject, FILTER_UNSAFE_RAW);


$preferences = ["input-charset" => "UTF-8", "output-charset" => "UTF-8"];
$subject = iconv_mime_encode('Subject', $subject, $preferences);
$subject = substr($subject, strlen('Subject: '));

$message .= "<html><body style='text-align: justify'>";
$message .= "<h1> Vákumtasak rendelés: </h1>";

$message .= "<pre>" . $basket . "</pre><br />";

$message .= "<h3>Megrendelő elérhetőségei:</h3>";
$message .= "<p>telefon: $phone,<br />e-mail: $mail.</p>";
$message .= "<p>Kérjük kattintson a megerősítő hivatkozásra, hogy véglegesítse a megrendelést.</p>";
$message .= "<p><a href='$confirmationlink'>link</a></p>";
$message .= "<p>Munkatársunk a megadott telefonszámon keresni fogja a számlázással 
és a szállítással kapcsolatban.<br />
Amennyiben nem erősíti meg rendelését - mert elállt vásárlási szándékától - nincs további teendője. 
A rendszer naponta 00:00:00-kor automatikusan törli a meg nem erősített rendeléseket. Minden más 
esetben ( pl.: megrendelés törlése és módosítása, ajánlatkérés ) telefonon és/vagy e-mailben 
léphet kapcsolatba velünk.</p>";
$message .= "<p>Köszönöm megrendelését!</p>";
$message .= "<p>Lévai-Kiss Noémi<br />ügyvezető igazgató</p>";
$message .= "<p>&#9743; 30-7434249</p>";
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

mail($to, $subject, $message, $headers);

?>

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