
<p>
	Sur cette page, nous vous donnons des astuces pour moins consommer, en fonction de vos habitudes.<br/>
	Vous êtes très consommateur <?php 
	switch($_GET["energy"]){
		case "water":
		echo "<span>d'eau</span>";
		break;
		case "electricity":
		echo "<span>d'électricité</span>";
		break;
		case "gas":
		echo "<span>de gaz</span>";
		break;
	}
	?>, nous vous conseillons donc :
</p>
<p>
	<?php
	$row = 0;
	if (($handle = fopen("astuces.csv", "r")) !== FALSE){
		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE){
			if($row !=0){
				$num = count($data);
				if($data[1] == $_GET["energy"]){
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
</p>