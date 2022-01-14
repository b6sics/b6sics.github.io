<html>
<body>

<?php

if($_POST['submit'] != '' || isset($_POST['submit'])) {

foreach($_POST as $key => $val) {

echo 'Field name : '.$key .', Value : '.$val.'<br>';

$data[$key] = $val; //Thsi array holds all post data now.

}

}
?>
</body>
</html> 