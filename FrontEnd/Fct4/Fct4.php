<?php
require_once 'parse.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <script type="text/javascript" src="d3.v3.js"></script>
        <title>D3 Test</title>

        <script type="text/javascript">
        	function repartitionEnergies(valUtilElec, valUtilGaz, valUtilEau, valLogElec, valLogGaz, valLogEau, rayonExt, rayonInt, couleurElec, couleurGaz, couleurEau, taillePolice, tailleLegende, taillePoliceLegendes)
        	{	  
        		/* Role : Cette fonction affiche deux graphiques (de type pie chart) qui représentent la répartition de la facture d'energie entre l'eau le gaz et l'électricité, pour le logement de l'utilisateur et pour les logements de même type.

        			Entrées :  - valUtilElec ; valUtilGaz ; ValUtilEau : les valeurs de consommation (!!! A RENTRER EN % D'EUROS !!!) du logement de l'utilisateur, respectivement pour l'électricité, l'eau et le gaz.
        			           - valLogElec ; valLogGaz ; ValLogEau : les valeurs de consommation (!!! A RENTRER EN % D'EUROS !!!) des habitations du même type que celle de l'utilisateur, respectivement pour l'électricité, l'eau et le gaz.
        			           - rayonExt : rayon exterieur du cercle du diagramme.
        			           - rayonInt : rayon intérieur du cercle du diagramme (mettre à 0 pour avoir un cercle plein, et donc un diagramme de type camembert).
        			           - couleurElec ;  couleurGaz ; couleurEau : couleur avec lequelles s'affichent les différentes sources d'énergie.
        			           - taillePolice : taille du texte à l'intérieur du diagramme (les %)
        			           - tailleLegende : taille des carrés de couleur correspondant aux legendes.
        			           - taillePoliceLegendes : taille du texte de légendes (aussi bien les légendes sous les diagrammes que celles sur le côté)

		            Exemple d'appel :
	
    			repartitionEnergies(50, 40.2, 9.8, 50, 24.5, 25.5, 130, 90, "rgb(28,148,255)", "rgb(255,140,0)", "rgb(1,186,186)", "15", 30, "20");   

    				!!! ON NOTE BIEN QUE LA SOMME DE TOUTES LES VALEURS DE CONSOMMATION, AUSSI BIEN POUR LE LOGEMENT DE L'UTILISATEUR QUE POUR LES HABITATIONS DE MEME TYPE, VAUT 100. !!!!*/



    			var hauteurLegendeBas = 50;
    			var texteLegendeBas = ["Votre logement", "Logements similaires"];
    			var couleurLegendeCote = [couleurEau, couleurGaz, couleurElec];
    			var texteLegendeCote = ["Eau", "Gaz", "Electricité"];

			    dataUtl = [{"label":valUtilElec + "%", "value":valUtilElec, "color": couleurElec }, 
			            {"label":valUtilGaz + "%", "value":valUtilGaz, "color": couleurGaz }, 
			            {"label":valUtilEau + "%", "value":valUtilEau, "color": couleurEau }];

	            dataLog = [{"label":valLogElec + "%", "value":valLogElec, "color": couleurElec }, 
			            {"label":valLogGaz + "%", "value":valLogGaz, "color": couleurGaz }, 
			            {"label":valLogEau + "%", "value":valLogEau, "color": couleurEau }];

	            data = [dataUtl, dataLog];									

			    for (var iter = 0; iter < 2; iter++) // Boucle d'affichage des diagrammes.
			    {
			    	/* !!!!!! DEBUT AFFICHAGE DIAGRAMMES !!!!!!! */
			    	var vis = d3.select("body")
			        	.append("svg:svg")	
		    			.data([data[iter]])                   
			            .attr("width", rayonExt*2 + 50)           
			            .attr("height", rayonExt*2 + 50)
				        .append("svg:g")            
			            .attr("transform", "translate(" + rayonExt + "," + rayonExt + ")"); 				

				    var arc = d3.svg.arc()              
				        .outerRadius(rayonExt)
				        .innerRadius(rayonInt);

				    var pie = d3.layout.pie()  
				    	.sort(null)         
				        .value(function(d) { return d.value; });    

				    var arcs = vis.selectAll("g.slice")     
				        .data(pie)                           
				        .enter()                             
			            .append("svg:g")                
		                .attr("class", "slice");    

			        arcs.append("svg:path")
			        	.attr("d", arc)
		                .attr("fill", function(d, i) { return data[iter][i].color; } );                        

			        arcs.append("svg:text")                                  
		                .attr("transform", function(d) {                   
			                d.innerRadius = rayonInt;
			                d.outerRadius = rayonExt;
			                return "translate(" + arc.centroid(d) + ")";
			            })
			            .attr("text-anchor", "middle")  
			            .attr("font-family", "sans-serif")
			            .attr("font-size", taillePolice)    
			            .attr("font-weight", "bold") 
			            .attr("fill", "white")                   
			            .text(function(d, i) { return data[iter][i].label; } );   

		            /* !!!!!! FIN AFFICHAGE DIAGRAMMES !!!!!!! */

		            /* !!!!!! DEBUT AFFICHAGE DU TEXTE SOUS LES DIAGRAMMES !!!!!!! */
		            vis.append("text")        
				    .style("fill", "black")   				         
				    .attr("y", rayonExt + hauteurLegendeBas - 5)      
				    .attr("font-family", "sans-serif")
	                .attr("font-size", taillePoliceLegendes)  
	                .attr("font-weight", "bold")        
				    .attr("text-anchor", "middle") 
				    .text(texteLegendeBas[iter]);  
				    /* !!!!!! FIN AFFICHAGE DU TEXTE SOUS LES DIAGRAMMES !!!!!!! */
			    }
			    /* !!!!!! DEBUT AFFICHAGE LEGENDES SUR LES COTES DES DIAGRAMMES !!!!!!! */
				var legende = d3.select("body").append("svg")
					.attr("width", 250)
					.attr("height", rayonExt*2)
					.append("g")
				for (var iter = 0; iter < 3; iter++)
			    {	
			    		/* !!!!!! DEBUT AFFICHAGE DES RECTANGLES DES LEGENDES !!!!!!! */				
						legende.append("rect")
						.attr("x", 0).attr("y", rayonExt*2/3 + (-1+2*iter)*tailleLegende - hauteurLegendeBas)
						.attr("width", tailleLegende).attr("height", tailleLegende)
						.style("fill", couleurLegendeCote[iter]);
						/* !!!!!! FIN AFFICHAGE DES RECTANGLES DES LEGENDES !!!!!!! */

						/* !!!!!! DEBUT AFFICHAGE DU TEXTE DES LEGENDES !!!!!!! */
						legende.append("text")
						.style("fill", "black")   
						.attr("x", tailleLegende + 20)           
						.attr("y", rayonExt*2/3 + tailleLegende*(-1+2*iter) - hauteurLegendeBas*0.5)       
						.attr("font-family", "sans-serif")
						.attr("font-size", taillePoliceLegendes)  
						.attr("font-weight", "bold")        
						.text(texteLegendeCote[iter]); 
						/* !!!!!! FIN AFFICHAGE DU TEXTE DES LEGENDES !!!!!!! */
				}
				/* !!!!!! FIN AFFICHAGE LEGENDES SUR LES COTES DES DIAGRAMMES !!!!!!! */
					 
			}		    

	        </script>
    </head>
    	<body>
    		<div id="area1"></div>
			<div id="area2"></div>
    		<script type="text/javascript">
    			repartitionEnergies(<?= $PercentElecUtilisateur ?>, <?= $PercentGazUtilisateur ?>, <?= $PercentEauUtilisateur ?>, <?= $PercentElecSimilaire ?>, <?= $PercentGazSimilaire ?>, <?= $PercentEauSimilaire ?>, 130, 90, "rgb(28,148,255)", "rgb(255,140,0)"
    				, "rgb(1,186,186)", "15", 30, "20");   

			</script>	        
    	</body>
</html>

