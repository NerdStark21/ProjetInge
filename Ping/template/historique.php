
<header class="major">
	<h2>Historique de consommation à l'année</h2>
</header>


<article id="legende_navigation">
	<section id="legende">
		<h2>Légende</h2>
		<p>Ce tableau récapitule vos consommations en € pour une année.<br/>Le code couleur se rapporte à votre consommation par rapport à la moyenne des consommations des habitations de même type que la vôtre :</p>
		<img src="images/button-red.png" height="15" width="15"><span>Consommation supérieure d'au moins 15%</span><br/>
		<img src="images/button-orange.png" height="15" width="15"><span>Consommation supérieure de 5 à 15%</span><br/>
		<img src="images/button-green.png" height="15" width="15"><span>Consommation inférieure ou égale (à 5% près)</span>
	</section>
	<aside id="form">
		<div id="form_ajax">
			<!-- C'est ici qu'on va faire apparaitre la boite de dialogue pour que l'utilisateur rentre les infos pour le rajout d'un marqueur -->
		</div>
		<div id="ajoutflag">
	       	<span class="button ajout" title="Grâce à ce bouton, vous pouvez enregistrer les différents travaux de votre habitation">Ajout d'un marqueur</span>
	    </div>
	</aside>
</article>

<section id="navigation">
	<h3>
		<img id="previousYear" src="images/fleche_gauche.png" alt="Fleche" height="15" width="15">
		<span id="year"></span>
		<img id="nextYear" src="images/fleche_droite.png" alt="Fleche" height="15" width="15">
	</h3>
</section>

<div class="clear"></div>

<article id="historique">
	<table>
		<thead>
			<tr class="ligne_header">
				<th class="grey h_nom">Type d'énergie<span></span></th>
   			<th class="monthClone">Mois<span></span></th>
			</tr>
		</thead>
		<tbody>
	      	<tr class="water">
				<td class="energyType">Eau<!--<img src="images/warning.png" width="20" height="20">--></td>
				<td class="valueClone"></td>
			</tr>
	      	<tr class="electricity">
				<td class="energyType">Electricité</td>
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
            <span></span>
        </div>
    </div>
</article>
<article id="msg">

</article>

<article id="interval">
	<section>
		<p>Sélection d'une période :</p>
		<form>
			<div id="select_month">
				<label for="month">Mois : </label>
				<select name="month" id="month" >
					<!-- Généré automatiquement en js -->
				</select>
			</div>
			<div id="select_year">
				<label for="year">Année : </label>
				<select name="year" id="year">
					<!-- Généré automatiquement en js -->
				</select>
			</div>
			<div id="select_energy">
				<label for="energy">Energie : </label>
				<select name="energy" id="energy">
					<!-- Généré automatiquement en js -->
				</select>
			</div>
			<div class="button select" title="Vous pouvez comparer votre consommation avant et après un changement dans votre logement">Comparer</div>
		</form>
	</section>
	<section id ="text_comparaison">
		<!-- Généré en js -->
	</section>
</article>

<script type="text/javascript" src="assets/js/historique.js"></script>