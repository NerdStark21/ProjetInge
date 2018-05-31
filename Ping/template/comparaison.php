<?php
require_once 'functions/fct4.php';
?>
<article class="comparaison">
	<P>
		Sur ce graphique, vous pouvez voir la répartition moyenne de vos dépenses mensuelles d'énergies, ainsi que celle des habitations similaires à la vôtre.
	</P>
	<script type="text/javascript" src="assets/js/d3.v3.js"></script>
	<script type="text/javascript" src="assets/js/comparaison"></script>
	<script type="text/javascript">
		repartitionEnergies(<?= $PercentElecUtilisateur; ?>,
						    <?= $PercentGazUtilisateur; ?>, 
						    <?= $PercentEauUtilisateur; ?>,
						     <?= $PercentElecSimilaire; ?>,
						      <?= $PercentGazSimilaire; ?>,
						       <?= $PercentEauSimilaire; ?>,
						        135, 90, "rgb(28,148,255)", "rgb(255,140,0)", "rgb(1,186,186)", "15", 30, "20");  
	</script>
	<div id="area1"></div>
	<div id="area2"></div>
	<p>
		Faudra faire une étude ici !
	</p>
		<p>
		<?php
		require_once 'functions/fct4.php';
		echo "Faite attention, vous consommez ";
		$elec = $PercentElecUtilisateur  - $PercentElecSimilaire;
		$gaz = $PercentGazUtilisateur - $PercentGazSimilaire;
		$eau = $PercentEauUtilisateur - $PercentEauSimilaire;
		$gazBool = false;
		$eauBool = false;
		if($elec > 8){
			echo $elec."% d'électricité ";
		}
		else if($gaz > 8){
			echo $elec."% de gaz ";
			$gazBool = true;
		}
		else if($eau > 8){
			echo $eau."% d'eau ";
		}
		if($gaz > 8 && !$gazBool){
			echo "et ".$gazBool."% de gaz ";
		}
		if($eau > 8 && !$eauBool){
			echo "et ".$eauBool."% d'eau ";
		}
		echo "de plus que la moyenne des habitations de même type.";
		?>
	</p> 

</article>