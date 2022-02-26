<?php
  
$goods = 'https://docs.google.com/spreadsheets/d/156xAche9RhcTgxcZTb9Zw0kZ0mHZrXZ5vAEn5QtDgB0/edit?usp=sharing';

	$far = $goods;
	$local = 'goods.html';
	get_far_file($far, $local);
	echo '<br>';

	echo 'E-n-d<br>';
      
function get_far_file($url, $local_file){
	if (file_put_contents($local_file, file_get_contents($url))){
        	echo $local_file, ": File downloaded successfully", '<br>';
		$dom = new DOMDocument;
		$html = file_get_contents($local_file);
		@$dom->loadHTML($html);
		$rows = $dom->getElementsByTagName('tr');

		$cells = $rows[0]->getElementsByTagName('th');
		foreach ($cells as $cell){
			echo $cell->nodeValue;
			if($cell->hasAttribute('colspan')) {
				$colspan = $cell->getAttribute('colspan');
				echo ' (colspan = ' . $colspan . ')';
			}
			echo ', ';
		}	
		echo '<br>';

		$row = 1;
		while ($row < 6) {
			if($rows[$row]->nodeValue != '') {
				echo '[ ' . $rows[$row]->nodeValue . ' ] ';
				$cells = $rows[$row]->getElementsByTagName('td');
				foreach ($cells as $cell){
					echo $cell->nodeValue, ', ';
				}
	    			echo '<br>';
				$row++;
			}
		}
	} else {
		echo $local_file, ": File downloading failed.";
	}
}
?>