<article class="comparaison">
	<P>
		Sur ce graphique, vous pouvez voir la répartition moyenne de vos dépenses mensuelles d'énergies, ainsi que celle des habitations similaires à la vôtre.
	</P>
	<script type="text/javascript" src="assets/js/d3.v3.js"></script>
	<script type="text/javascript" src="assets/js/comparaison.js"></script>
	<div id="area1"></div>
	<div id="area2"></div>
	<p>
		Faudra faire une étude ici !
	</p>
	<!--
			<p>
		<?php
		echo "Faite attention, vous consommez ";
		$elec = $ConsoElecJour[1] - $ConsoElecJour[0];
		$gaz = $ConsoGazJour[1] - $ConsoGazJour[0];
		$eau = $ConsoWaterJour[1] - $ConsoWaterJour[0];
		$gazBool = false;
		$eauBool = false;
		if($elec > 10){
			echo $elec."% d'électricité ";
		}
		else if($gaz > 10){
			echo $elec."% de gaz ";
			$gazBool = true;
		}
		else if($eau > 10){
			echo $eau."% d'eau ";
		}
		if($gaz > 10 && !$gazBool){
			echo "et ".$gazBool."% de gaz ";
		}
		if($eau > 10 && !$eauBool){
			echo "et ".$eauBool."% d'eau ";
		}
		echo "de plus que la moyenne des habitations de même type.";
		?>
	</p>
-->
</article>