<?php

include_once("b6_calender.php");

?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,
                                   initial-scale=1,
                                   maximum-scale=1, 
                                   shrink-to-fit=no" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Abso-root</title>

    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="shortcut icon" type="image/png" href="favicon.png" />

    <!--link rel="stylesheet" href="https://b6sics.github.io/absoroot/style.css" /-->
    <link rel="stylesheet" href="style.css" />

</head>

<body>
    <header>
        <img class="float_right" src="O.png" alt="" />
        <div class="align_right">
            <h1>Abso-root</h1>
            <h5><i> "O" is safety </i></h5>
        </div>
    </header>
    <main class="main_home">
        <div>
            <table style="margin: 0 auto;">
                <?php
                $day = date('d', $date_lastMonthLastMonday);
                echo "<tr>";
                for ($xx = 0; $xx <= 6; $xx++) {
                    echo "<td>";
                    echo $day;
                    $day++;
                    if ($day > $lastMonthLength) {
                        $day = 1;
                    }
                    echo "</td>";
                }
                echo "</tr>";
                for ($yy = 1; $yy <= 5; $yy++) {
                    echo "<tr>";
                    for ($xx = 0; $xx <= 6; $xx++) {
                        echo "<td>";
                        echo $day;
                        $day++;
                        if ($day > $thisMonthLength) {
                            $day = 1;
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </main>
    <footer>
        &copy; 2020-<?php echo date("Y"); ?>
    </footer>

</body>
<script>
</script>

</html>