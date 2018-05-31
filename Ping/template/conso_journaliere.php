<?php
require_once 'fct5.php'
?>
<article id="conso">
	<p>
		Sur ce graphique, vous pouvez voir ce que vous avez consommé entre le 1e du mois et aujourd'hui, une prévision de vos consommations en fin de mois et les objectifs que vous aviez fixés.
	</p>

	<script type="text/javascript" src="assets/js/d3.v3.js"></script>
	<script type="text/javascript" src = "assets/js/conso_journaliere"></script>
	<p>
		<?php
		echo "Faite attention, vous consommez ";
		$elec = $ConsoElecJour[1] - $ConsoElecJour[0];
		$gaz = $ConsoGazJour[1] - $ConsoGazJour[0];
		$eau = $ConsoWaterJour[1] - $ConsoWaterJour[0];
		$gazBool = false;
		$eauBool = false;
		if($elec > 10){
			echo $elec."% d'électricité "
		}
		else if($gaz > 10){
			echo $elec."% de gaz "
			$gazBool = true;
		}
		else if($eau > 10){
			echo $eau."% d'eau "
		}
		if($gaz > 10 && !$gazBool){
			echo "et ".$gazBool."% de gaz "
		}
		if($eau > 10 && !$eauBool){
			echo "et ".$eauBool."% d'eau "
		}
		echo "de plus que la moyenne des habitations de même type.";
		?>
	</p>
	<script type="text/javascript">
			visuPrevObj(
				<?= $ConsoElecJour[1];  ?>,
				<?= $ConsoGazJour[1];  ?>,
				<?= $ConsoWaterJour[1];  ?>,
				<?= $ConsoElecJour[0];  ?>,
				<?= $ConsoGazJour[0];  ?>,
				<?= $ConsoWaterJour[0];  ?>,
				<?= $ConsoElecJour[2];  ?>,
				<?= $ConsoGazJour[2];  ?>,
				<?= $ConsoWaterJour[2];  ?>,
				400, 70, 70, "rgb(28,148,255)", "rgb(186,186,186)"
    				, "rgb(255,140,0)", 25);
	</script>

</article>

