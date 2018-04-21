<header class="major">
	<h2>Historique de consommation à l'année</h2>
</header>
<div class="historique">
	<article>
		<div id="legende">
			<h5>Légende</h5>
			<p>Comparaison mois par mois par rapport aux habitations de même type :</p>
			<img src="images/button-red.png" height="15" width="15">Supérieure de 15%<br/>
			<img src="images/button-orange.png" height="15" width="15">Supérieure de 5 à 15%<br/>
			<img src="images/button-green.png" height="15" width="15">Inférieure ou égale (à 5% près)
		</div>
		<h3><img id="previousYear" src="images/fleche_gauche.png" alt="Fleche" height="15" width="15"><span id="year"></span><img id="nextYear" src="images/fleche_droite.png" alt="Fleche" height="15" width="15"></h3>
		<table>
			<thead>
   			<tr class="ligne_header">
   				<th class="grey h_nom">Type d'énergie<span></span></th>
       			<th class="monthClone">Mois<span></span></th>
   			</tr>
			</thead>
			<tbody>
		      	<tr class="water">
					<td class="energyType">Electricité</td>
					<td class="valueClone"></td>
				</tr>
		      	<tr class="electricity">
					<td class="energyType">Eau</td>
					<td class="valueClone"></td>
				</tr>
				<tr class="gas">
					<td class="energyType">Gaz</td>
					<td class="valueClone"></td>
				</tr>
			</tbody>
		</table>
        <div id="flags">
            <div class="flagClone">
                <img src="images/fleche_haut_rouge.ico" alt="Fleche rouge" height="50" width="30">
                <p>coucou</p>
            </div>
        </div>
	</article>
</div>
<article class="comparaison">
	<?php include "assets/js/comparaison.php";?>
	<div id="area1"></div>
	<div id="area2"></div>
</article>

<script type="text/javascript" src="assets/js/historique.js"></script>