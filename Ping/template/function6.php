<?php

// Fonction qui permet d'afficher l'historique de consommation pour une date donnée 

function getConsommationElecYear($id,$annee) {
    $json_sourceElec = file_get_contents('http://localhost:3000/db');
    /*$json_sourceGaz = file_get_contents('http://localhost:3000/gaz_consumption');
    $json_sourceWater = file_get_contents('http://localhost:3000/water_consumption/');*/

    $json_data = json_decode($json_sourceElec, true);
    $strid=(string)$id;

	$tabElec=array();
  $tabGaz=array();
  $tabWater=array();
	$tab = array();
	
    foreach($json_data['electricity_consumption'] as $v)    {
        if ( $v['id']== $strid ) {
		foreach($v['dates'] as $s)   { 
          if( $annee==  strftime("%Y", strtotime($s['start']) )) {
                //array_push($tab,[ "water" => strftime("%d", strtotime($s['start'])), "electricity" => $s['value']], "gaz" => 1 );
               //array_push($tabWater, [  strftime("%d", strtotime($s['start']) ) ]);
               array_push($tabElec,  round($s['moyenneHabSimilaire']*0.14670) ) ; 
               //array_push($tabGaz, [ 1 ] );
          }                 
                    }          
                }        
            }


   foreach($json_data['gaz_consumption'] as $v)    {
        if ( $v['id']== $strid ) {
    foreach($v['dates'] as $s)   { 
          if( $annee==  strftime("%Y", strtotime($s['start']) )) {
                //array_push($tab,[ "water" => strftime("%d", strtotime($s['start'])), "electricity" => $s['value']], "gaz" => 1 );
               array_push($tabGaz,   round($s['moyenneHabSimilaire']*0.0545)) ; 
          }                 
                    }          
                }        
            }

    foreach($json_data['water_consumption'] as $v)    {
        if ( $v['id']== $strid ) {
    foreach($v['dates'] as $s)   { 
          if( $annee==  strftime("%Y", strtotime($s['start']) )) {
                //array_push($tab,[ "water" => strftime("%d", strtotime($s['start'])), "electricity" => $s['value']], "gaz" => 1 );
               array_push($tabWater,  round($s['moyenneHabSimilaire']*1.4) ); 
          }                 
                    }          
                }        
            }




            $tab =  [ "water" => $tabWater, "electricity" => $tabElec, "gas" => $tabGaz  ];  
    return $tab;
        }
	
   




// donnée 2016 à modifier apres
echo json_encode(getConsommationElecYear(19800723488459,"2018"));

   
   
   
?>