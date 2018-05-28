
<?php
$row = 0;
if (($handle = fopen("astuces.csv", "r")) !== FALSE){
	while (($data = fgetcsv($handle, 1000, ";")) !== FALSE){
		if($row !=0){
			$num = count($data);
			if($data[1] == "water"){
				echo "<p>".$data[0]."</p>";
			}
			//for ($c=0; $c < $num; $c++) {
			//	echo "<p>".$c."</p>";
			//	echo "<p>".$data[$c]."</p>";
			//}
		}
		$row++;
	}
	fclose($handle);
}

?>

<span class="button">Astuce suivante</span>
<span class="button">Astuce précédente</span>