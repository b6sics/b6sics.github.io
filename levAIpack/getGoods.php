<!DOCTYPE html>
<html lang="hu">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, 
                                   initial-scale=1, 
                                   shrink-to-fit=no" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Storage|Levai Pack</title>
	<base target="_self">

	<style>
	body {
		font-family: "Courier New", Courier, monospace;
	}
</style>
</head>

<?php
  
$goods = 'https://docs.google.com/spreadsheets/d/156xAche9RhcTgxcZTb9Zw0kZ0mHZrXZ5vAEn5QtDgB0/edit?usp=sharing';

	$far = $goods;
	$local = 'prices.html';

	$price65u = 0;
	$price85u = 0;

	get_prices($far, $local);

	echo '<br />';

$goods = 'https://docs.google.com/spreadsheets/d/13OhmO6r2dIBfOfEd7i78oVigMQVF_gJYyPCjODtprQU/edit?usp=sharing';

	$far = $goods;
	$local = 'goods.html';

	get_goods($far, $local);

	echo '<br />';

	echo 'E-n-d<br>';
      
	function get_goods($url, $local_file){
		global $price65u, $price85u;
		if (file_put_contents($local_file, file_get_contents($url))){
				echo $local_file, ": File downloaded successfully", '<br>';
			$dom = new DOMDocument;
			$html = file_get_contents($local_file);
			@$dom->loadHTML($html);
			$rows = $dom->getElementsByTagName('tr');

			$mygoods = fopen("goods.js", "w") or die("Unable to open file!");

			$txt = "const goods = [\n";
			fwrite($mygoods, $txt);
		
			$name = 'PA/PE 70 Vákumtasak';
			echo '<br />', $name, '<br />', $price65u, ' Ft<br />';
			$row = 8;
			while ($row < 50) {
				if($rows[$row]->nodeValue != '') {
					$cells = $rows[$row]->getElementsByTagName('td');
					if($cells[0]->nodeValue != '') {
						$sizes = explode("*", $cells[0]->nodeValue);
						$l1 = floatval($sizes[0]);
						$l2 = floatval($sizes[1]);
						echo $l1, ' x ', $l2, ', ';
						$storage = str_replace(",", "", $cells[1]->nodeValue);
						$someString = str_pad($storage, 7, "*", STR_PAD_LEFT);
						$someString = str_replace("*", "&nbsp;", $someString);
						echo $someString, ', ';
						$package = str_replace(",", "", $cells[2]->nodeValue);
						$mb_length = mb_strlen($package,'UTF-8');
						$length = strlen($package);
						$someString = str_pad($package, 10 - $mb_length + $length, "*", STR_PAD_LEFT);
						$someString = str_replace("*", "&nbsp;", $someString);
						echo $someString, ', ';
						$price = ceil($price65u * $l1 * $l2 / 10000);
						echo $price, ' Ft/db;<br />';
						$txt = "\t".'"'.$name.','.$storage.','.$l1.'*'.$l2.','.$price.'Ft/db"'.",\n";
						fwrite($mygoods, $txt);
						}
				}
				$row++;
			}

			$name = 'PA/PE 90 Vákumtasak';
			echo '<br />', $name, '<br />', $price85u, ' Ft<br />';
			$row = 8;
			while ($row < 50) {
				if($rows[$row]->nodeValue != '') {
					$cells = $rows[$row]->getElementsByTagName('td');
					if($cells[5]->nodeValue != '') {
						$sizes = explode("*", $cells[4]->nodeValue);
						$l1 = floatval($sizes[0]);
						$l2 = floatval($sizes[1]);
						echo $l1, ' x ', $l2, ', ';
						$storage = str_replace(",", "", $cells[5]->nodeValue);
						$someString = str_pad($storage, 7, "*", STR_PAD_LEFT);
						$someString = str_replace("*", "&nbsp;", $someString);
						echo $someString, ', ';
						$package = str_replace(",", "", $cells[6]->nodeValue);
						$mb_length = mb_strlen($package,'UTF-8');
						$length = strlen($package);
						$someString = str_pad($package, 10 - $mb_length + $length, "*", STR_PAD_LEFT);
						$someString = str_replace("*", "&nbsp;", $someString);
						echo $someString, ', ';
						$price = ceil($price85u * $l1 * $l2 / 10000);
						echo $price, ' Ft/db;<br />';
						$txt = "\t".'"'.$name.','.$storage.','.$l1.'*'.$l2.','.$price.'Ft/db"'.",\n";
						fwrite($mygoods, $txt);
					}
				}
				$row++;
			}
			$txt = "\t".'"last line,'.'0,'.'in '.'storage,'.'database"'."\n";
			$txt .= "];\n";
			fwrite($mygoods, $txt);
			fclose($mygoods);
		} else {
			echo $local_file, ": File downloading failed.";
		}
	}

	function get_prices($url, $local_file){
		global $price65u, $price85u;

		if (file_put_contents($local_file, file_get_contents($url))){
				echo $local_file, ": File downloaded successfully", '<br />';
			$dom = new DOMDocument;
			$html = file_get_contents($local_file);
			@$dom->loadHTML($html);
			$rows = $dom->getElementsByTagName('tr');
		
			if($rows[3]->nodeValue != '') {
					echo '[ ' . $rows[3]->nodeValue . ' ]<br />';
					$cells = $rows[3]->getElementsByTagName('td');
					$price65u = floatval($cells[6]->nodeValue);
					echo $price65u, ';<br />';
					$price85u = floatval($cells[7]->nodeValue);
					echo $price85u, ';<br />';
			}
		} else {
			echo $local_file, ": File downloading failed.";
		}
	}
?>