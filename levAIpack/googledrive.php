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
                <i>Vákum&nbsp;tasakok</i>
            </h2>
        </header>
        <div id='tableData'>

        </div>
        <div id='googleTable'>

        </div>

        <script> 
        function showTableContent() {

            for (var x = 7; x < goTBL.rows.length; x++) {
                for (var y = 1; y < 4; y++) {
                    if (goTBL.rows[x].cells[y] != null){
                        if (goTBL.rows[x].cells[y].innerHTML != ""){
                            tableData.innerHTML += "|" + goTBL.rows[x].cells[y].innerHTML.replace("&nbsp;", " ").padStart(15,".");
                            tableData.innerHTML += "|";
                        }
                    }
                }
                if (goTBL.rows[x].cells[1].innerHTML != ""){
                    tableData.innerHTML += "<br />";
                }
            }

            tableData.innerHTML += "<br />";
            tableData.innerHTML += "<br />";

            for (var x = 7; x < goTBL.rows.length; x++) {
                for (var y = 5; y < 8; y++) {
                    if (goTBL.rows[x].cells[y] != null){
                        if (goTBL.rows[x].cells[y].innerHTML != ""){
                            tableData.innerHTML += "|" + goTBL.rows[x].cells[y].innerHTML.replace("&nbsp;", " ").padStart(15,".");
                            tableData.innerHTML += "|";
                        }
                    }
                }
                if (goTBL.rows[x].cells[5].innerHTML != ""){
                    tableData.innerHTML += "<br />";
                }
            }
        }

        let googleTable = document.getElementById('googleTable');
        let tableData = document.getElementById('tableData');
        var goTBL;
        link001="https://docs.google.com/spreadsheets/d/13OhmO6r2dIBfOfEd7i78oVigMQVF_gJYyPCjODtprQU/edit?usp=sharing";
        loadXMLDoc(link001);

        function showTable(table){
            googleTable.innerHTML = "";
            table = table.slice(table.indexOf("<table"), 8 + table.indexOf("</table>"));
            googleTable.innerHTML += table;
            goTBL = document.getElementsByTagName('TABLE')[0];
            googleTable.innerHTML += "rows: ";
            googleTable.innerHTML += goTBL.rows.length;
            googleTable.innerHTML += " ; columns: ";
            googleTable.innerHTML += goTBL.rows[10].cells.length;
            googleTable.innerHTML += "<br />";
            googleTable.innerHTML += "<br />";
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

<?php
    function download_remote($url , $save_path) {
        $f = fopen( $save_path , 'w');
        $handle = fopen($url , "rb");
         
        while (!feof($handle)) {
            $contents = fread($handle, 8192);
            fwrite($f , $contents);
        }
         
        fclose($handle);
        fclose($f);
    }
    
    function popup2browser ( $saved_path ) {
        $file_saved = fopen( $saved_path , "r") or exit("Unable to open target file!");

        while(!feof($file_saved)) {
                echo fgets($file_saved);
        }

        fclose($file_saved);
    }

    $link001="https://docs.google.com/spreadsheets/d/1Lhvw5Pi8FAl0GDmlQoTMyKPZURQQBdDqr_hny7VirAU/edit?usp=sharing";
    //download_remote($link001, "login.btxt");
    //popup2browser("login.btxt");

?>
</body>

</html>