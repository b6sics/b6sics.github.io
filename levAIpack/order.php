<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, 
                                   initial-scale=1, 
                                   shrink-to-fit=no" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Success|Levai Pack</title>
    <base target="_self">

    <link rel="stylesheet" href="https://b6sics.github.io/levAIpack/root-directories/root-css-2022/style.css?t=123" />

</head>

<body id="start">
    <a href="index3d2022.html" title="Főoldal">
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
        rows="<?php echo(substr_count($_POST['basketList'], ':')) ?>" readonly><?php
            echo $_POST['basketList'];
        ?></textarea>

        <article class="center vertical">
            <p>
                A(z) <?php echo $_POST['mail'] ?> e-mail címre megküldtük a megrendelés másolatát. Kérjük nyissa meg a levelet, majd kattintson az e-mailben található megerősítő hivatkozásra, hogy véglegesítse a megrendelést.<br />
                Munkatársunk a <?php echo $_POST['phone'] ?> telefonszámon keresni fogja a számlázással és a szállítással kapcsolatban.<br />
                Amennyiben nem erősíti meg rendelését - mert elállt vásárlási szándékától - nincs további teendője. A rendszer naponta 00:00:00-kor automatikusan törli a meg nem erősített rendeléseket.<br />
                Minden más esetben ( pl.: megrendelés törlése és módosítása, ajánlatkérés ) telefonon és/vagy e-mailben léphet kapcsolatba velünk. 
            </p>
        </article>
    </main>

<?php
$crlf = "\r\n";

function email_is_valid ($email_address){
	$email_address = filter_var($email_address, FILTER_SANITIZE_EMAIL);
	if (filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
		return $email_address;
	}
	else {
		return "security@levaipack.hu"; /* 3miLE6lOo1a8ll4 */
	}
}

$subject = 'Rendelés ';

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