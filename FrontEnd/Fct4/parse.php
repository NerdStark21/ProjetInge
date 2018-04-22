<?php 
require_once './api/api_data_elec.php';
require_once './api/api_data_eau.php';
require_once './api/api_data_gaz.php';

/*
echo "<pre>";
print_r($json_data);
echo "</pre>";
*/
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
            if($s['value'] < 0) {$s['value']=-$s['value'];}


           $data .= "{ period: '".$s['start']."-".$s['end']."', value: ".$s['value']."},";
                
                 // Round() permet d'arrondir un nombre réel 
                  $newdateform = array(
                    'start' => $s['start'],
                    'end' => $s['end'],
                    'value' => $s['value'],
                    'ConsoEuro' => round($s['value']*0.14670,2),
                    'moyenneHabSimilaire' => $s['moyenneHabSimilaire'],
                    'ConsoEuroSimilaire' => round($s['moyenneHabSimilaire']*0.14670,2));
                  $printedElec[] = $newdateform;
                  //                                |Prix du kWh - Option base   |Prix du kWh - Heures creuses
                  // EDF - Tarif Bleu (réglementé)  |0,14 670 €                  |0,12 440 €
                
          // echo '<tr><td> ID </td> <td>'.$s['start'].'</td>  <td>'.$s['end'].'</td><td>'.$s['value'].'</td> </tr>';
        }
    //break ; 
}
foreach($json_data_gaz as $v){
   
        foreach($v['dates'] as $s){
            if($s['value'] < 0) {$s['value']=-$s['value'];}


           $data .= "{ period: '".$s['start']."-".$s['end']."', value: ".$s['value']."},";
                
                     // Round() permet d'arrondir un nombre réel 
                   $key=searchforDate($s['start'],$printedElec);
                   $printedElec[$key]['valueGaz']=$s['value'];
                   $printedElec[$key]['ConsoEuroGaz']=round($s['value']*0.0545);
                   $printedElec[$key]['moyenneHabSimilaireGaz']=$s['moyenneHabSimilaire'];
                   $printedElec[$key]['ConsoEuroSimilaireGaz']=round($s['moyenneHabSimilaire']*0.0545);

                   //Le prix du kWh de gaz chez EDF
                   //Tarif                                 Abonnement annuel (toutes zones)           Prix du kWh par zone tarifaire (€ TTC)
                   // Conso 2 (de 6000 à 11 000 kWh/an)    235.68 € TTC                                0.0545
           //echo '<tr><td> ID </td> <td>'.$s['start'].'</td>  <td>'.$s['end'].'</td><td>'.$s['value'].'</td> </tr>';
        }
    //break ; 
}

// Méthode qui permet de parcourir le tableau printedElec :
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
                   $key=searchforDate($s['start'],$printedElec);
                   $printedElec[$key]['valueEau']=$s['value'];
                   $printedElec[$key]['ConsoEuroEau']=round($s['value']*1,4);
                   $printedElec[$key]['moyenneHabSimilaireEau']=$s['moyenneHabSimilaire'];
                   $printedElec[$key]['ConsoEuroSimilaireEau']=round($s['moyenneHabSimilaire']*1,4);

               // Tarif stéphanoise des eaux   1,4€ le M3
                
           //echo '<tr><td> ID </td> <td>'.$s['start'].'</td>  <td>'.$s['end'].'</td><td>'.$s['value'].'</td> </tr>';
        }
    //break ; 
}





$data= substr($data, 0,-1);
$data.=']';

/*echo $data;
/*
                         <th>id</th>
                        <th>start</th>
                        <th>end</th>
                        <th>value</th>*/
/*echo '<tfoot> <tr>
                      
                    </tr>
          </tfoot> </table> ';


echo '<div class="panel-body">
        <div id="morris-area-chart"></div>
    </div>';  
    for($i=0;$i<sizeof($printedElec);$i++){
        echo $printedElec[$i]["start"] ."\t". $printedElec[$i]["end"]." Electricité :  ". $printedElec[$i]["value"]." KWH ==> \t ". $printedElec[$i]["ConsoEuro"]." € \t Elec Hab Simi".$printedElec[$i]["moyenneHabSimilaire"]."\t". $printedElec[$i]["ConsoEuroSimilaire"]." € \t ********  Gaz :\t ".$printedElec[$i]["valueGaz"]." KWH \t ".$printedElec[$i]["ConsoEuroGaz"]." € \t Gaz Hab Simi : ".$printedElec[$i]["moyenneHabSimilaireGaz"]." KWH ==> \t ".$printedElec[$i]["ConsoEuroSimilaireGaz"]." € \t ********  Eau :\t ".$printedElec[$i]["valueEau"]." M3 \t ".$printedElec[$i]["ConsoEuroEau"]." € \t Eau Hab Simi : ".$printedElec[$i]["moyenneHabSimilaireEau"]." M3 ==> \t ".$printedElec[$i]["ConsoEuroSimilaireEau"]." € \t <br>";
    }*/
$totalConsommations=0;
$totalConsommationsSimilaire=0;
$totalElec=0;
$totalGaz=0;
$totalEau=0;
$totalElecSimilaire=0;
$totalGazSimilaire=0;
$totalEauSimilaire=0;

// boucle permettant de calculer la somme en € de chaque énergie pour l'utilisateur et les logements similaires 
for($i=0;$i<sizeof($printedElec);$i++){
    $totalConsommations=$printedElec[$i]['ConsoEuro']+$printedElec[$i]['ConsoEuroGaz']+$printedElec[$i]['ConsoEuroEau']+$totalConsommations;
    $totalConsommationsSimilaire=$printedElec[$i]['ConsoEuroSimilaire']+$printedElec[$i]['ConsoEuroSimilaireGaz']+$printedElec[$i]['ConsoEuroSimilaireEau']+$totalConsommationsSimilaire;

    $totalElec=$printedElec[$i]['ConsoEuro']+$totalElec;
    $totalGaz=$printedElec[$i]['ConsoEuroGaz']+$totalGaz;
    $totalEau=$printedElec[$i]['ConsoEuroEau']+$totalEau;

    $totalElecSimilaire=$printedElec[$i]['ConsoEuroSimilaire']+$totalElecSimilaire;
    $totalGazSimilaire=$printedElec[$i]['ConsoEuroSimilaireGaz']+$totalGazSimilaire;
    $totalEauSimilaire=$printedElec[$i]['ConsoEuroSimilaireEau']+$totalEauSimilaire;

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
  echo "En deux ans vous avez payé :  Elec : ".$totalElec."€ Gaz : ".$totalGaz."€ Eau :".$totalEau." Total que vous avez payé :  ".$totalConsommations."€ <br> Vos voisins ont payé : Elec ".$totalElecSimilaire."€ Gaz :".$totalGazSimilaire." Eau :".$totalEauSimilaire." Total qu'ils ont payé : ".$totalConsommationsSimilaire."€ <br>" ;

  echo " Percent Utilisateur Elec : ".$PercentElecUtilisateur."% Gaz :".$PercentGazUtilisateur."% Eau :".$PercentEauUtilisateur."% <br> Percent Log Similaire Elec : ".$PercentElecSimilaire."% Gaz :".$PercentGazSimilaire."% Eau : ".$PercentEauSimilaire."% ";

?>