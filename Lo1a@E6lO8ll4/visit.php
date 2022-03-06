<html>
<body>
	<div id="wrapper">

		<div id="detail_div">
<?php

foreach($_SERVER as $key => $val) {
    echo 'Field name : '.$key .', Value : '.$val.'<br>';
    $data[$key] = $val;
}

$ipaddress = $_SERVER['REMOTE_ADDR'];
$page = "http://" . $_SERVER['HTTP_HOST'] . "" . $_SERVER['PHP_SELF'];
$referrer = $_SERVER['HTTP_REFERER'];
$datetime = date("F j, Y, g:i a");
$useragent = $_SERVER['HTTP_USER_AGENT'];

echo "<p>IP Address : " . $ipaddress . "</p>";
echo "<p>Current Page : " . $page . "</p>";
echo "<p>Referrer : " . $referrer . "</p>";
echo "<p>Current Time : " . $datetime . "</p>";
echo "<p>Browser : " . $useragent . "</p>";

function getUserIpAddr()
{
    if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
        // ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $dataArray = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));
    print_r($dataArray);
    echo "<br>";
    echo gettype($dataArray) . "<br>";
    echo count($dataArray) . "<br>";
    echo "<p>IP Address : " . $ip . "</p>";
    echo "<p>User request  : " . $dataArray['geoplugin_request'] . "</p>";
    echo "<p>User city  : " . $dataArray['geoplugin_city'] . "</p>";
    echo "<p>User region  : " . $dataArray['geoplugin_region'] . "</p>";
    echo "<p>User regionCode  : " . $dataArray['geoplugin_regionCode'] . "</p>";
    echo "<p>User regionName  : " . $dataArray['geoplugin_regionName'] . "</p>";
    echo "<p>User areaCode  : " . $dataArray['geoplugin_areaCode'] . "</p>";
    echo "<p>User dmaCode  : " . $dataArray['geoplugin_dmaCode'] . "</p>";
    echo "<p>User countryCode  : " . $dataArray['geoplugin_countryCode'] . "</p>";
    echo "<p>User countryName  : " . $dataArray['geoplugin_countryName'] . "</p>";
    echo "<p>User inEU  : " . $dataArray['geoplugin_inEU'] . "</p>";
    echo "<p>User euVATrate  : " . $dataArray['geoplugin_euVATrate'] . "%</p>";
    echo "<p>User continentCode  : " . $dataArray['geoplugin_continentCode'] . "</p>";
    echo "<p>User continentName  : " . $dataArray['geoplugin_continentName'] . "</p>";
    echo "<p>User latitude  : " . $dataArray['geoplugin_latitude'] . "</p>";
    echo "<p>User longitude  : " . $dataArray['geoplugin_longitude'] . "</p>";
    echo "<p>User locationAccuracyRadius  : " . $dataArray['geoplugin_locationAccuracyRadius'] . "</p>";
    echo "<p>User timezone  : " . $dataArray['geoplugin_timezone'] . "</p>";
    echo "<p>User currencyCode  : " . $dataArray['geoplugin_currencyCode'] . "</p>";
    echo "<p>User currencySymbol  : " . $dataArray['geoplugin_currencySymbol'] . "</p>";
    echo "<p>User currencySymbol_UTF8  : " . $dataArray['geoplugin_currencySymbol_UTF8'] . "</p>";
    echo "<p>User currencyConverter  : " . $dataArray['geoplugin_currencyConverter'] . "</p>";
    return $ip;
}

echo 'User Real IP - ' . getUserIpAddr();

?>
</div>

	</div>
</body>
</html>