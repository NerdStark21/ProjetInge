<?php 
require_once './api/api_data_elec.php';
require_once './api/api_data_eau.php';
require_once './api/api_data_gaz.php';

// =====================================================================================================================
// ================================F O N C T I O N N A L I T E  4 ======================================================
// =====================================================================================================================
$data = '[';


// à voir 
/*echo '<table class="table table-bordered table-hover table-striped">';
	echo '<thead> <tr>
                        <th>id</th>
                        <th>start</th>
                        <th>end</th>
                        <th>value</th>
                    </tr>
          </thead> ';
    echo '<tbody>';
                     */

foreach($json_data_elec as $v){
   
        foreach($v['dates'] as $s){


           $data .= "{ period: '".$s['start']."-".$s['end']."', value: ".$s['value']."},";
                
                 // Round() permet d'arrondir un nombre réel 
                  $newdateform = array(
                    'start' => $s['start'],
                    'end' => $s['end'],
                    'value' => $s['value'],
                    'ConsoEuro' => round($s['value']*0.14670,2),
                    'moyenneHabSimilaire' => $s['moyenneHabSimilaire'],
                    'ConsoEuroSimilaire' => round($s['moyenneHabSimilaire']*0.14670,2));
                  $tabConsommation[] = $newdateform;
                  //                                |Prix du kWh - Option base   |Prix du kWh - Heures creuses
                  // EDF - Tarif Bleu (réglementé)  |0,14 670 €                  |0,12 440 €
                
          // echo '<tr><td> ID </td> <td>'.$s['start'].'</td>  <td>'.$s['end'].'</td><td>'.$s['value'].'</td> </tr>';
        }
    //break ; 
}
foreach($json_data_gaz as $v){
   
        foreach($v['dates'] as $s){


           $data .= "{ period: '".$s['start']."-".$s['end']."', value: ".$s['value']."},";
                
                     // Round() permet d'arrondir un nombre réel 
                   $key=searchforDate($s['start'],$tabConsommation);
                   $tabConsommation[$key]['valueGaz']=$s['value'];
                   $tabConsommation[$key]['ConsoEuroGaz']=round($s['value']*0.0545);
                   $tabConsommation[$key]['moyenneHabSimilaireGaz']=$s['moyenneHabSimilaire'];
                   $tabConsommation[$key]['ConsoEuroSimilaireGaz']=round($s['moyenneHabSimilaire']*0.0545);

                   //Le prix du kWh de gaz chez EDF
                   //Tarif                                 Abonnement annuel (toutes zones)           Prix du kWh par zone tarifaire (€ TTC)
                   // Conso 2 (de 6000 à 11 000 kWh/an)    235.68 € TTC                                0.0545
           //echo '<tr><td> ID </td> <td>'.$s['start'].'</td>  <td>'.$s['end'].'</td><td>'.$s['value'].'</td> </tr>';
        }
    //break ; 
}

// Méthode qui permet de parcourir le tableau tabConsommation :
function searchforDate($date, $array) {
   foreach ($array as $key => $val) {
       if ($val['start'] === $date) {
           return $key;
       }
   }
   return null;
}
foreach($json_data_eau as $v){
   
        foreach($v['dates'] as $s){
            if($s['value'] < 0) {$s['value']=-$s['value'];}


           $data .= "{ period: '".$s['start']."-".$s['end']."', value: ".$s['value']."},";
                
                 // Round() permet d'arrondir un nombre réel 
                   $key=searchforDate($s['start'],$tabConsommation);
                   $tabConsommation[$key]['valueEau']=$s['value'];
                   $tabConsommation[$key]['ConsoEuroEau']=round($s['value']*1,4);
                   $tabConsommation[$key]['moyenneHabSimilaireEau']=$s['moyenneHabSimilaire'];
                   $tabConsommation[$key]['ConsoEuroSimilaireEau']=round($s['moyenneHabSimilaire']*1,4);


        }

}





$data= substr($data, 0,-1);
$data.=']';

$totalConsommations=0;
$totalConsommationsSimilaire=0;
$totalElec=0;
$totalGaz=0;
$totalEau=0;
$totalElecSimilaire=0;
$totalGazSimilaire=0;
$totalEauSimilaire=0;

// boucle permettant de calculer la somme en € de chaque énergie pour l'utilisateur et les logements similaires 
for($i=0;$i<sizeof($tabConsommation);$i++){
    $totalConsommations=$tabConsommation[$i]['ConsoEuro']+$tabConsommation[$i]['ConsoEuroGaz']+$tabConsommation[$i]['ConsoEuroEau']+$totalConsommations;
    $totalConsommationsSimilaire=$tabConsommation[$i]['ConsoEuroSimilaire']+$tabConsommation[$i]['ConsoEuroSimilaireGaz']+$tabConsommation[$i]['ConsoEuroSimilaireEau']+$totalConsommationsSimilaire;

    $totalElec=$tabConsommation[$i]['ConsoEuro']+$totalElec;
    $totalGaz=$tabConsommation[$i]['ConsoEuroGaz']+$totalGaz;
    $totalEau=$tabConsommation[$i]['ConsoEuroEau']+$totalEau;

    $totalElecSimilaire=$tabConsommation[$i]['ConsoEuroSimilaire']+$totalElecSimilaire;
    $totalGazSimilaire=$tabConsommation[$i]['ConsoEuroSimilaireGaz']+$totalGazSimilaire;
    $totalEauSimilaire=$tabConsommation[$i]['ConsoEuroSimilaireEau']+$totalEauSimilaire;

}
 // Pourcentage de consommation de l'utilisateur X
 $PercentElecUtilisateur=round(($totalElec/$totalConsommations)*100,2);
 $PercentGazUtilisateur=round(($totalGaz/$totalConsommations)*100,2);
 $PercentEauUtilisateur=round(($totalEau/$totalConsommations)*100,2);
 // Pourcentage de consommation des logements similaires
 $PercentElecSimilaire=round(($totalElecSimilaire/$totalConsommationsSimilaire)*100,2);
 $PercentGazSimilaire=round(($totalGazSimilaire/$totalConsommationsSimilaire)*100,2);
 $PercentEauSimilaire=round(($totalEauSimilaire/$totalConsommationsSimilaire)*100,2);

function percentageOf( $number, $totalConsommations, $decimals = 2 ){
    return round( $number / $totalConsommations * 100, $decimals );
}
/*  echo "En deux ans vous avez payé :  Elec : ".$totalElec."€ Gaz : ".$totalGaz."€ Eau :".$totalEau." Total que vous avez payé :  ".$totalConsommations."€ <br> Vos voisins ont payé : Elec ".$totalElecSimilaire."€ Gaz :".$totalGazSimilaire." Eau :".$totalEauSimilaire." Total qu'ils ont payé : ".$totalConsommationsSimilaire."€ <br>" ;

  echo " Percent Utilisateur Elec : ".$PercentElecUtilisateur."% Gaz :".$PercentGazUtilisateur."% Eau :".$PercentEauUtilisateur."% <br> Percent Log Similaire Elec : ".$PercentElecSimilaire."% Gaz :".$PercentGazSimilaire."% Eau : ".$PercentEauSimilaire."% ";*/


?>