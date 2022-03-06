<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, 
                                   initial-scale=1, 
                                   shrink-to-fit=no" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Index|B8king</title>
    <base target="_self">

    <!--meta http-equiv="refresh" content="6;URL='index.php'">

    <link rel="stylesheet" href="root-directories/root-css/style.css?t=123" /-->

    <style>
        .detailscontent {
            display: none;
            min-height: 3em;
            width: 100%;
        }

        div#calendar {
            margin: 0px auto;
            padding: 0px;
            width: 602px;
        }

        div#calendar div.box {
            position: relative;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 40px;
            background-color: #3FA7D6;
        }

        div#calendar div.header {
            line-height: 40px;
            vertical-align: middle;
            position: absolute;
            left: 11px;
            top: 0px;
            width: 582px;
            height: 40px;
            text-align: center;
        }

        div#calendar div.header a.prev,
        div#calendar div.header a.next {
            position: absolute;
            top: 0px;
            height: 17px;
            display: block;
            cursor: pointer;
            text-decoration: none;
            color: #FFF;
        }

        div#calendar div.header span.title {
            color: #FFF;
            font-size: 18px;
        }

        div#calendar div.header a.prev {
            left: 0px;
        }

        div#calendar div.header a.next {
            right: 0px;
        }

        /*******************************Calendar Content Cells*********************************/
        div#calendar div.box-content {
            border: 1px solid #3FA7D6;
            border-top: none;
        }

        div#calendar ul.label {
            float: left;
            margin: 0px;
            padding: 0px;
            margin-top: 5px;
            margin-left: 5px;
        }

        div#calendar ul.label li {
            margin: 0px;
            padding: 0px;
            margin-right: 5px;
            float: left;
            list-style-type: none;
            width: 80px;
            height: 40px;
            line-height: 40px;
            vertical-align: middle;
            text-align: center;
            color: #000;
            font-size: 15px;
            background-color: transparent;
        }

        div#calendar ul.dates {
            float: left;
            margin: 0px;
            padding: 0px;
            margin-left: 5px;
            margin-bottom: 5px;
        }

        /** overall width = width+padding-right**/
        div#calendar ul.dates li {
            margin: 0px;
            padding: 0px;
            margin-right: 5px;
            margin-top: 5px;
            line-height: 80px;
            vertical-align: middle;
            float: left;
            list-style-type: none;
            width: 80px;
            height: 80px;
            font-size: 25px;
            background-color: #FFF;
            color: #000;
            text-align: center;
            position: relative;
        }

        :focus {
            outline: none;
        }

        div.clear {
            clear: both;
        }

        li div {
            display: flex;
        }

        li div form {
            display: inline;
            align-self: center;
            margin: 0;
            position: absolute;
            bottom: 2px;
        }

        div.open {
            background: #59CD90;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }

        div.booked {
            background: #D36135;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            line-height: inherit;
        }

        .submit {
            box-shadow: inset 0px 1px 0px 0px #ffffff;
            background: linear-gradient(to bottom, #ffffff 5%, #f6f6f6 100%);
            background-color: #ffffff;
            border-radius: 3px;
            border: 1px solid #dcdcdc;
            display: inline-block;
            cursor: pointer;
            color: #666666;
            font-size: 10px;
            font-weight: bold;
            padding: 3px 12px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #ffffff;
        }

        .submit:hover {
            background: linear-gradient(to bottom, #f6f6f6 5%, #ffffff 100%);
            background-color: #f6f6f6;
        }

        .submit:active {
            position: relative;
            top: 1px;
        }
    </style>

</head>

<body id="start">

    <header class="right vertical">
        <h1>
            b8♚
        </h1>
    </header>

    <?php
    include 'b8Calendar.php';
    include 'b8king.php';
    include 'b8kableCell.php';

    $booking = new Booking(
        'eurogymc_b8king',
        'localhost',
        'eurogymc_b8king',
        'Lola8114'
    );

    $bookableCell = new BookableCell($booking);

    $calendar = new Calendar();

    $calendar->attachObserver('showCell', $bookableCell);

    $bookableCell->routeActions();

    echo $calendar->show();

    ?>

    <main>

        <details>
            <summary>
                <b>Calendar</b><br />
                <i>DetailContent, SubTitle, SubTitle</i>
            </summary>
            <div class="left vertical">
                <a href="#">
                    <b onclick="details01toggle()">&bull; DetailContent</b>
                </a>
                <div id="details01content" class="detailscontent">
                </div>
                <script>
                    let details01contentFrame = document.getElementById('details01content');
                    details01contentFrame.style.display = 'none';

                    function details01toggle() {
                        if (details01contentFrame.style.display == 'none') {
                            details01contentFrame.style.display = 'initial';
                        } else {
                            details01contentFrame.style.display = 'none';
                        }
                    }
                </script>
            </div>
        </details>

        <section>
            <p>
                <a href="linkek.html">Filmek, könyvek, letöltési oldalak, webáruházak linkjei</a>.
            </p>
        </section>
    </main>

    <footer class="bottom center static">
        <h4>
            HU-1111 Budapest Bercsényi utca 6.<br /> &#9993; b6@b6.hu | &#9743; 30-4654562
        </h4>
    </footer>

</body>

</html>