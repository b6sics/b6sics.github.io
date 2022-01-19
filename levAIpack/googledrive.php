<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, 
                                   initial-scale=1, 
                                   shrink-to-fit=no" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Google Drive|Levai Pack</title>
    <base target="_self">

    <link rel="stylesheet" href="https://b6sics.github.io/levAIpack/root-directories/root-css-2022/style.css?t=123" />

    <script>
        let tableArray = [];
        let pape70 = [];
        let pape90 = [];

        function loadXMLDoc( pathTOtextfile ) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                showTable(this.responseText);
            }
        };
        xhttp.open("GET", pathTOtextfile , true);
        xhttp.send();
        }

    </script>

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
                <i>Vákum&nbsp;tasakok</i>
            </h2>
        </header>
        <div id='googleTable'>

        </div>

        <script> 
        function showTableContent() {
            var goTBL = document.getElementsByTagName('TABLE')[0];

            for (var x = 0; x < goTBL.rows.length; x++) {
                for (var y = 0; y < goTBL.rows[x].cells.length; y++) {
                    googleTable.innerHTML += "." + (goTBL.rows[x].cells[y].firstChild.data).padStart(15,".");
                    googleTable.innerHTML += ".";
                }
                googleTable.innerHTML += "<br />";
            }
        }

        let googleTable = document.getElementById('googleTable');
        link001="https://docs.google.com/spreadsheets/d/1Lhvw5Pi8FAl0GDmlQoTMyKPZURQQBdDqr_hny7VirAU/edit?usp=sharing";
        loadXMLDoc(link001);

        function showTable(table){
            googleTable.innerHTML = "";
            table = table.slice(table.indexOf("<table"), 8 + table.indexOf("</table>"));
            googleTable.innerHTML += table;
            showTableContent();
        }
        </script>
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

</body>

</html>