<?php
require_once 'fct5.php'
?>
<article id="conso">
	<p>
		Sur ce graphique, vous pouvez voir ce que vous avez consommé entre le 1e du mois et aujourd'hui, une prévision de vos consommations en fin de mois et les objectifs que vous aviez fixés.
	</p>

	<script type="text/javascript" src="assets/js/d3.v3.js"></script>
	<script type="text/javascript" src = "assets/js/conso_journaliere"></script>
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

