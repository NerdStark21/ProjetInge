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





function getConsommationElecJour($id,$dated,$jour) {
    $json_source = file_get_contents('http://localhost:3000/electricity_consumption/');
    $json_data = json_decode($json_source, true);
    $strid=(string)$id;
    $valeur=0;
    $objectif=0;
    foreach($json_data as $v){
        if ( $v['id']== $strid){
            foreach($v['dates'] as $s){
                if( $s['start']== $dated){
                    $objectif=$s['objectif'];
                  $x=1;
                    foreach($s['daily'] as $c){
                        for( $i=1; $i<=$jour;$i++){
                              if($x<=$jour){
                                 
                                  
                                   $valeur = $c["jour$x"] + $valeur;
                                   $x++;
                          }

                     }
                
                         }
                    }
           
                }
        
            }
   

        }

 $intvaleur=(int)$valeur*0.12440;
 $interpolation =  (30 * $intvaleur / $jour)*0.12440;
 $objectif=$objectif*0.12440;


   return array($intvaleur,$interpolation,$objectif);
}

function getConsommationGazJour($id,$dated,$jour) {
    $json_source = file_get_contents('http://localhost:3000/gaz_consumption/');
    $json_data = json_decode($json_source, true);
    $strid=(string)$id;
    $valeur=0;
    $objectif=0;
    foreach($json_data as $v){
        if ( $v['id']== $strid){
            foreach($v['dates'] as $s){
                if( $s['start']== $dated){
                  $objectif=$s['objectif'];
                  $x=1;
                    foreach($s['daily'] as $c){
                        for( $i=1; $i<=$jour;$i++){
                              if($x<=$jour){
                                 
                                  
                                   $valeur = $c["jour$x"] + $valeur;
                                   $x++;
                          }

                     }
                
                         }
                    }
           
                }
        
            }
   

        }

   $intvaleur=(int)$valeur*0.0545;
  $interpolation =  (30 * $intvaleur / $jour)*0.0545;
  $objectif=$objectif*0.0545;


   return array($intvaleur,$interpolation,$objectif);
}
function getConsommationWaterJour($id,$dated,$jour) {
    $json_source = file_get_contents('http://localhost:3000/water_consumption/');
    $json_data = json_decode($json_source, true);
    $strid=(string)$id;
    $valeur=0;
    $objectif=0;
    foreach($json_data as $v){
        if ( $v['id']== $strid){
            foreach($v['dates'] as $s){
              
                if( $s['start']== $dated){
                  $objectif=$s['objectif'];
                  $x=1;
                    foreach($s['daily'] as $c){
                        for( $i=1; $i<=$jour;$i++){
                              if($x<=$jour){
                                 
                                  
                                   $valeur = $c["jour$x"] + $valeur;
                                   $x++;
                          }

                     }
                
                         }
                    }
           
                }
        
            }
   

        }
       $date = DateTime::createFromFormat("d/m/Y", $dated);
      /*echo $date->format("d"); //day
      echo $date->format("m"); //month
      echo $date->format("Y"); //year*/


   // Les valeurs en €   
   $intvaleur=(int)$valeur*1.4;
   $interpolation =  (30 * $intvaleur / $jour)*1.4;
   $objectif=$objectif*1.4;


   return array($intvaleur,$interpolation,$objectif);
}

/*
function getObjectifWaterMensuel($id,$dated) {
    $json_source = file_get_contents('http://localhost:3000/water_consumption/');
    $json_data = json_decode($json_source, true);
    $strid=(string)$id;
    $valeur=0;
    foreach($json_data as $v){
        if ( $v['id']== $strid){
            foreach($v['dates'] as $s){
              if( $s['start']== $dated){
                echo $s['objectif'];
                }
                }
        
            }
        }
}*/

/*function getObjectifElecMensuel($id,$dated) {
    $json_source = file_get_contents('http://localhost:3000/electricity_consumption/');
    $json_data = json_decode($json_source, true);
    $strid=(string)$id;
    $valeur=0;
    foreach($json_data as $v){
        if ( $v['id']== $strid){
            foreach($v['dates'] as $s){
              if( $s['start']== $dated){
                echo $s['objectif'];
                }
                }
        
            }
        }
}


function getObjectifGazMensuel($id,$dated) {
    $json_source = file_get_contents('http://localhost:3000/gaz_consumption/');
    $json_data = json_decode($json_source, true);
    $strid=(string)$id;
    $valeur=0;
    foreach($json_data as $v){
        if ( $v['id']== $strid){
            foreach($v['dates'] as $s){
              if( $s['start']== $dated){
                echo $s['objectif'];
                }
                }
        
            }
        }
}*/


       /* $valeur=0;
              $x=$jour

              for ($i = 1; $i <= $jour; $i++) {
                   $valeur = $c["jour$jour"] + $valeur;
                   $jour=$jour-1;
                    }*/



// Prévisions de consommation 
$previsionWater= getConsommationWaterJour(19800723488459,"01/01/2016",15)[1];
$previsionElec=getConsommationElecJour(19800723488459,"01/01/2016",15)[1];
$previsionGaz=getConsommationGazJour(19800723488459,"01/01/2016",15)[1];
// Objectif de consommation mensuelle pour le citoyen X 
$objectifElec=getConsommationElecJour(19800723488459,"01/01/2016",15)[2];
$objectifGaz=getConsommationGazJour(19800723488459,"01/01/2016",15)[2];
$objectifWater=getConsommationWaterJour(19800723488459,"01/01/2016",15)[2];
// Consommation journalière pour les 3 énérgies 
$consoWaterJour=getConsommationWaterJour(19800723488459,"01/01/2016",15)[0];
$consoElecJour=getConsommationElecJour(19800723488459,"01/01/2016",15)[0];
$consoGazJour=getConsommationGazJour(19800723488459,"01/01/2016",15)[0];

echo $objectifGaz;
echo $previsionGaz;
echo $consoGazJour;

   
   
?>