<?php
require_once 'index.php'
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <script type="text/javascript" src="d3.v3.js"></script> <!-- !!!!!!!! IL EST NECESSAIRE D'INCLURE LES FICHIERS DE D3JS POUR FAIRE FONCTIONNER CE CODE !!!!! -->
        <title>D3 Test</title>

        <script type="text/javascript">
        	function visuPrevObj(valPrevElec, valPrevGaz, valPrevEau, valElec, valGaz, valEau, objElec, objGaz, objEau, hauteur, baseRect, ecartRect, couleurPrev, couleurObj, couleurVal, carreLegende)
        	{	
        		/* Role : Cette fonction affiche un histogramme à 3 classes (pour l'eau, le gaz et pour l'électricité).
				          Pour chaque classe on a une information de :
				          	- consommation effective : C'est la valeur (en €) que l'utilisateur a consommé depuis le début du mois courant.
				          	- prévision : C'est la valeur de consommation (en €) estimée en fin de de mois. Exemple :
				          				  Nous sommes le 10 janvier, et l'utilisateur a dépensé entre le 01/01 et 10/01 50 € d'eau (consommation effective d'eau égale à 50 €).
				          				  Si l'on suppose que la prévision est calculée par une interpolation simple, alors la prévision vaudra 155€ (car 31 jours/10 jours = 3.1, et 50*3.1 = 155).				          	
				          	- d'objectif : C'est l'objectif (en €) que l'utilisateur s'est fixé en début de mois.

        			Entrées :  - valPrevElec ; valPrevGaz ; ValPrevEau : les valeurs de consommations prévues en fin de mois (!!! A RENTRER EN € !!!) du logement de l'utilisateur, respectivement pour l'électricité, le gaz et l'eau.
        			           - valElec ; valGaz ; ValEau : les valeurs de consommations effectives (!!! A RENTRER EN € !!!), donc d'€ facturés depuis le début du mois courant.
        			           - objElec ; objGaz ; objEau : les objectifs de consommation (!!! A RENTRER EN € !!!) pour le mois courant.
        			           - hauteur : la hauteur de l'ensemble de la fonctionnalité (elle inclue donc les rectangles des histogrammes, mais aussi les légendes sous l'histogramme).
        			           - baseRect : largeur des rectangles de chaque classe.
        			           - ecartRect : l'écart entre les rectangles de chaque classe.
        			           - couleurPrev ; couleurObj ; couleurVal : La couleur des rectangles respectivement pour les prévisions, les objectifs, et la valeur consommée.
        			           - carreLegende : la taille des carrées des légendes sur le coté.
		            Exemple d'appel :
	
    			visuPrevObj(100.9999, 200, 280, 10, 100, 80, 300, 450, 195, 400, 70, 70, "rgb(28,148,255)", "rgb(186,186,186)"
    				, "rgb(255,140,0)", 25); 
				*/
        		var allVal = [valPrevElec, valPrevGaz, valPrevEau, valElec, valGaz, valEau, objElec, objGaz, objEau];
        		var prev = [valPrevElec, valPrevGaz, valPrevEau];
        		var obj = [objElec, objGaz, objEau];
        		var val = [valElec, valGaz, valEau];
        		var texteLegendeBas = ["Elec.", "Gaz", "Eau"];
        		var texteLegendeCote = ["Prévision", "Objectif", "Consommé depuis le début du mois"];
        		var couleurLegende = [couleurPrev, couleurObj, couleurVal];
        		var max = 0;
        		var legendeBas = 50;
    			for (var iter = 0; iter < 9; iter++)
    			{
    				if (allVal[iter] > max)
    				{
    					max = allVal[iter];
    				}
    			}    			

    			var svg = d3.select("body").append("svg") // CHANGER LE DOM !!!!!!!!
					.attr("width", baseRect*3 + ecartRect*2 + 70)
					.attr("height", hauteur)    

				var legende = d3.select("body").append("svg") // CHANGER LE DOM !!!!!!!!
					.attr("width", 350)
					.attr("height", hauteur)
					.append("g")			  	
				
				for (var iter = 0; iter < 3; iter++)
			    {					
					var hauteurRect = prev[iter]/max* (hauteur - legendeBas);
					svg.append("rect")
					.attr("x", 50 + (ecartRect + baseRect)*iter).attr("y", 20 + hauteur - legendeBas - hauteurRect)
					.attr("width", baseRect).attr("height", hauteurRect)
					.style("fill", couleurPrev)

					var hauteurRect = val[iter]/max* (hauteur - legendeBas);	
					svg.append("rect")
					.attr("x", 50 + (ecartRect + baseRect)*iter).attr("y", 20 + hauteur - legendeBas - hauteurRect)
					.attr("width", baseRect).attr("height", hauteurRect)
					.style("fill", couleurVal)

					var hauteurRect = obj[iter]/max* (hauteur - legendeBas);
					svg.append("rect")
					.attr("x", 50 + (ecartRect + baseRect)*iter).attr("y", 20 + hauteur - legendeBas - hauteurRect)
					.attr("width", baseRect).attr("height", 10)
					.style("fill", couleurObj)

					svg.append("text")
						.attr("x", ecartRect*iter + baseRect*(iter + 1) + 50 - baseRect*0.5-15)           
						.attr("y", hauteur - legendeBas + 40)       
						.attr("font-family", "sans-serif")
						.attr("font-size", "20px")  
						.style("fill", "grey")					
						.text(texteLegendeBas[iter])	

					legende.append("rect")
						.attr("x", 0).attr("y", (hauteur - carreLegende*6)*0.5 + 2*iter*carreLegende)
						.attr("width", carreLegende).attr("height", carreLegende)
						.style("fill", couleurLegende[iter]);

					legende.append("text")
						.style("fill", "grey")   
						.attr("x", carreLegende + 10)           
						.attr("y", (hauteur - carreLegende*6)*0.5 + carreLegende*0.7 + 2*iter*carreLegende)       
						.attr("font-family", "sans-serif")
						.attr("font-size", "16px")  
						.attr("font-weight", "bold")        
						.text(texteLegendeCote[iter]); 					
				}
				var ecarLigne = (hauteur - legendeBas)/5;
				var valLigne = max/5;
				for (var iter = 0; iter < 6; iter++)
    			{
    				svg.append("line")		
						.attr("x1", 50).attr("y1", 20 + ecarLigne*iter)		
						.attr("x2", baseRect*3 + ecartRect*2 + 50).attr("y2", 20 + ecarLigne*iter)
						.attr("stroke-width", 1)
                        .attr("stroke", "grey");
                    svg.append("text")
						.attr("x", 0)           
						.attr("y", 30 + ecarLigne*iter)       
						.attr("font-family", "sans-serif")
						.attr("font-size", "18px")  
						.style("fill", "grey")
						.text(Math.trunc(max - valLigne*iter) + "€");  						
    			} 					 
			}		    


	        </script>
    </head>
    	<body>
    		<div id="area1"></div>
			<div id="area2"></div>
    		<script type="text/javascript">
    			visuPrevObj(<?= $ConsoElecJour[1];  ?>	, <?= $ConsoGazJour[1];  ?>, <?= $ConsoWaterJour[1];  ?>, <?= $ConsoElecJour[0];  ?>, <?= $ConsoGazJour[0];  ?>, <?= $ConsoWaterJour[0];  ?>, <?= $ConsoElecJour[2];  ?>, <?= $ConsoGazJour[2];  ?>, <?= $ConsoWaterJour[2];  ?>, 400, 70, 70, "rgb(28,148,255)", "rgb(186,186,186)"
    				, "rgb(255,140,0)", 25);
    			
			</script>	        
    	</body>
</html>