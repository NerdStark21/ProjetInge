<?php 
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

 //   echo "Water ".$ConsoWaterJour[0]." ".$ConsoWaterJour[1]." ".$ConsoWaterJour[2]."<br>";
 //   echo "Gaz  : ".$ConsoGazJour[0]." ".$ConsoGazJour[1]." ".$ConsoGazJour[2]."<br>";
 //   echo "Elec :".$ConsoElecJour[0]." ".$ConsoElecJour[1]." ".$ConsoElecJour[2];



    ?>