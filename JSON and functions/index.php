<?php 
// Note : Les fichiers json compactés ne contiennent pas d'indentation, c'est le format qui est renvoyé par une API Rest.
// Pour modifier des paramètres il faut le faire sur les fichiers json non compactés 

// Consommation Electricité Moyenne 
// Parameter : (id : identifiant compteur, dated : date de consommation) 
function getConsommationElec($id,$dated) {
    $json_source = file_get_contents('json\jsonEleccompact.json');
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
   $intvaleur=(int)$valeur;
   echo $intvaleur; 
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
   $intvaleur=(int)$valeur;
   echo $intvaleur; 
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
   $intvaleur=(int)$valeur;
   echo $intvaleur; 
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
   $intvaleur=(int)$valeur;
   echo $intvaleur; 
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
   $intvaleur=(int)$valeur;
   echo $intvaleur; 
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
echo "Consommation Moyenne Elec : ",getConsommationElec(19800723488459,'01/01/2016');
echo "<br>";
echo " Consommation Moyenne Elec log similaires :",getConsommationElecm(19800723488459,'01/01/2016');




   

?>