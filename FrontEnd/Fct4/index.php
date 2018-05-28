<?php 
// Note : Les fichiers json compactés ne contiennent pas d'indentation, c'est le format qui est renvoyé par une API Rest.
// Pour modifier des paramètres il faut le faire sur les fichiers json non compactés 

// Consommation Electricité Moyenne 
// Parameter : (id : identifiant compteur, dated : date de consommation) 
function getConsommationElec($id,$dated) {
  $json_source = file_get_contents('http://localhost:3000/electricity_consumption');
  $json_data = json_decode($json_source, true);
  $strid=(string)$id;
  foreach($json_data as $v){
    if ( $v['id']== $strid){
      foreach($v['dates'] as $s){
        if( $s['start']== $dated){
          global $valeur;
          $valeur = $s['value'];
        }

      }

    }

  }
  $intvaleur=(int)$valeur*0.12440;
  return $intvaleur;

   //                                |Prix du kWh - Option base   |Prix du kWh - Heures creuses
  // EDF - Tarif Bleu (réglementé)  |0,14 670 €                  |0,12 440 €
}

// Moyenne Consommation Electricité des habitations similaires
// Parameter : (id : identifiant compteur, dated : date de consommation) 
function getConsommationElecm($id,$dated) {
  $json_source = file_get_contents('json\jsonEleccompact.json');
  $json_data = json_decode($json_source, true);
  $strid=(string)$id;
  foreach($json_data as $v){
    if ( $v['id']== $strid){
      foreach($v['dates'] as $s){
        if( $s['start']== $dated){
          global $valeur;
          $valeur = $s['moyenneHabSimilaire'];
        }           
      }

    }

  }
  $intvaleur=(int)$valeur*0.12440;
  return $intvaleur; 
}


// Moyenne Consommation Gaz  
// Parameter : (id : identifiant compteur, dated : date de consommation) 
function getConsommationGaz($id,$dated) {
  $json_source = file_get_contents('json\jsonGazcompact.json');
  $json_data = json_decode($json_source, true);
  $strid=(string)$id;
  foreach($json_data as $v){
    if ( $v['id']== $strid){
      foreach($v['dates'] as $s){
        if( $s['start']== $dated){
          global $valeur;
          $valeur = $s['value'];
        }

      }

    }

  }
  $intvaleur=(int)$valeur*0.0545;
  return $intvaleur; 

                    //Le prix du kWh de gaz chez EDF
                   //Tarif                                 Abonnement annuel (toutes zones)           Prix du kWh par zone tarifaire (€ TTC)
                   // Conso 2 (de 6000 à 11 000 kWh/an)    235.68 € TTC                                0.0545
}
// Moyenne Consommation Gaz des habitations similaires
// Parameter : (id : identifiant compteur, dated : date de consommation) 
function getConsommationGazm($id,$dated) {
  $json_source = file_get_contents('json\jsonGazcompact.json');
  $json_data = json_decode($json_source, true);
  $strid=(string)$id;
  foreach($json_data as $v){
    if ( $v['id']== $strid){
      foreach($v['dates'] as $s){
        if( $s['start']== $dated){
          global $valeur;
          $valeur = $s['moyenneHabSimilaire'];
        }

      }

    }

  }
  $intvaleur=(int)$valeur*0.0545;
  return $intvaleur; 
}
// Moyenne Consommation Eau  
// Parameter : (id : identifiant compteur, dated : date de consommation) 
function getConsommationEau($id,$dated) {
  $json_source = file_get_contents('json\jsonEaucompact.json');
  $json_data = json_decode($json_source, true);
  $strid=(string)$id;
  foreach($json_data as $v){
    if ( $v['id']== $strid){
      foreach($v['dates'] as $s){
        if( $s['start']== $dated){
          global $valeur;
          $valeur = $s['value'];
        }

      }

    }

  }
  $intvaleur=(int)$valeur*1.4;
  return $intvaleur; 

// Tarif stéphanoise des eaux   1,4€ le M3


}
// Moyenne consommation Eau des habitations similaires
// Parameter : (id : identifiant compteur, dated : date de consommation) 
function getConsommationEaum($id,$dated) {
  $json_source = file_get_contents('json\jsonEaucompact.json');
  $json_data = json_decode($json_source, true);
  $strid=(string)$id;
  foreach($json_data as $v){
    if ( $v['id']== $strid){
      foreach($v['dates'] as $s){
        if( $s['start']== $dated){
          global $valeur;
          $valeur = $s['moyenneHabSimilaire'];
        }

      }

    }

  }
  $intvaleur=(int)$valeur;
  echo $intvaleur; 
}

// Test des fonctions :
/*echo "Consommation Moyenne Elec : ",getConsommationElec(19800723488459,'01/01/2016');
echo "<br>";
echo " Consommation Moyenne Elec log similaires :",getConsommationElecm(19800723488459,'01/01/2016');*/

/*
===========================F O N C T I O N N A L I T E    5 ====================================
*/
// BackEnd Fonctionnalité 5 ( définir une prévision en fonction de la consommation au jour J d'un citoyen)
// getConsommationXJour sont des fonctions qui renvoient des tableaux de taille 3

// La première case est pour la consommation d'une énergie par jour 
// La deuxième case est pour la prévision d'une énergie pour la fin du mois actuel 
// La troisième case est pour l'objectif qui a été défini pour le citoyen    

function getConsommationElecJour($id,$dated,$jour) {
  $json_source = file_get_contents('http://localhost:3000/electricity_consumption/',$id);
  $json_data = json_decode($json_source, true);
  $strid=(string)$id;
  $valeur=0;
  $objectif=0;
  $flag=false;
  foreach($json_data as $v){
    if ( $v['id']== $strid){
      foreach($v['dates'] as $s){
        if( $s['start']== $dated){
          $flag=true;
          $objectif=$s['objectif'];

          foreach($s['daily'] as $c){
            for( $i=1; $i<=$jour;$i++){

             $valeur = $c["jour".$i] + $valeur;

           }

         }

       }
     }
     if($flag==true) break;
     $iteration++; 
     echo "iteration".$iteration;  

   }

 }




$intvaleur=(int)$valeur*0.12440;
$interpolation =  (30 * $intvaleur / $jour);
$objectif=$objectif*0.12440;


return array($intvaleur,$interpolation,$objectif);
}

function getConsommationGazJour($id,$dated,$jour) {
  $json_source = file_get_contents('http://localhost:3000/gaz_consumption/',$id);
  $json_data = json_decode($json_source, true);
  $strid=(string)$id;
  $valeur=0;
  $objectif=0;
  $flag=false;
  foreach($json_data as $v){
    if ( $v['id']== $strid){
      $iteration=0;
      foreach($v['dates'] as $s){
        if( $s['start']== $dated){
          $flag=true;
          $objectif=$s['objectif'];

          foreach($s['daily'] as $c){
            for( $i=1; $i<=$jour;$i++){



             $valeur = $c["jour".$i] + $valeur;

           }

         }

       }
       if($flag==true) break;
       $iteration++; 
       echo "iteration".$iteration;      
     }

   }       
 }


 $intvaleur=(int)$valeur*0.0545;
 $interpolation =  (30 * $intvaleur / $jour);
 $objectif=$objectif*0.0545;


 return array($intvaleur,$interpolation,$objectif);
}
function getConsommationWaterJour($id,$dated,$jour) {
  $json_source = file_get_contents('http://localhost:3000/water_consumption/',$id);
  $json_data = json_decode($json_source, true);
  $strid=(string)$id;
  $valeur=0;
  $objectif=0;
  $flag=false;
  foreach($json_data as $v){
    if ( $v['id']== $strid){
      $iteration=0;
      foreach($v['dates'] as $s){

        if( $s['start']== $dated ){
          $flag=true;
          $objectif=$s['objectif'];
          $iteration=0;
          foreach($s['daily'] as $c){

            for( $i=1; $i<=$jour;$i++){

             $valeur = $c["jour".$i] + $valeur;


           }

         }

       }  
       if($flag==true) break;
       $iteration++; 
       echo "iteration".$iteration;     
     }        
   }

 }
      // $date = DateTime::createFromFormat("d/m/Y", $dated);
      /*echo $date->format("d"); //day
      echo $date->format("m"); //month
      echo $date->format("Y"); //year*/


   // Les valeurs en €   
      $intvaleur=(int)$valeur*1.4;
      $interpolation =  (30 * $intvaleur / $jour);
      $objectif=$objectif*1.4;


      return array($intvaleur,$interpolation,$objectif);
    }



// Stockage des 3 tableaux dans 3 variables ( ConsoElecJour, ConsoGazJour et ConsoWaterJour  )             
    $ConsoElecJour=getConsommationElecJour(19800723488459,"01/01/2016",4);
    $ConsoGazJour=getConsommationGazJour(19800723488459,"01/01/2016",4);
    $ConsoWaterJour=getConsommationWaterJour(19800723488459,"01/01/2016",4);

    echo "Water ".$ConsoWaterJour[0]." ".$ConsoWaterJour[1]." ".$ConsoWaterJour[2]."<br>";
    echo "Gaz  : ".$ConsoGazJour[0]." ".$ConsoGazJour[1]." ".$ConsoGazJour[2]."<br>";
    echo "Elec :".$ConsoElecJour[0]." ".$ConsoElecJour[1]." ".$ConsoElecJour[2];





// Test une fonction qui fait le boulot des 3 fonctions pour diminuer le temps de traitement ( on fait le parse 3 fois c'est fastidieux)



    ?>