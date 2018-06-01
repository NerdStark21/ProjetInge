<?php 
	//header("Content-type: text/html; charset=utf-8");
require_once './api/api_data_elec.php';
require_once './api/api_data_eau.php';
require_once './api/api_data_gaz.php';
# set locale first
setlocale (LC_TIME, 'fr_FR.utf8','fra');
//require_once 'BackEndFunctions.php';
$money = array("0","0","0");

$mois = date('m/Y');
// On affiche la consommation du mois actuel 
	foreach($json_data_elec as $v){

		foreach($v['dates'] as $s){
			if( $s['start']== "01/".$mois ){

				$money[0] = round($s['value']*0.14670,2);}
			}
		
	}
	foreach($json_data_gaz as $v){

		foreach($v['dates'] as $s){
			if( $s['start']== "01/".$mois ){

				$money[2] = round($s['value']*0.0545,2);}
			}
		}


		foreach($json_data_eau as $v){

			foreach($v['dates'] as $s){

				if( $s['start']== "01/".$mois ){

					$money[1] = round($s['value']*1.4,2);
				}
			}  
		}


/*	$money[0]=getConsommationElec(19800723488459,"01/01/2016");
	$money[1]=getConsommationEau(19800723488459,"01/01/2016");
	$money[2]=getConsommationGaz(19800723488459,"01/01/2016");*/
	

	//define('FPDF_FONTPATH','/Library/WebServer/Documents/derby/font/');
	require("fpdf/fpdf.php"); 
	$energies = array("Electrique","Eau","Gaz");

	$pdf=new FPDF('p','mm','A4'); 
	$pdf->AddPage(); 
	$pdf->Image('logo.png'); 
	//set font to arial, blod, 16
	$pdf->SetFont('Arial','B',25); 
	//Cell(width,height,text,border(0:no border;1:bordered),end line(0:continue;1:new line),[align])
	$pdf->Cell(180,20,"SaintEnergy",0,2,'C'); 
	$pdf->SetFont('Arial','',16); 
	
	$anne=date("Y");
	
	// Pour l'instant on affiche le mois actuel 
	$pdf->Cell(240,15,"Votre consommation du mois de ".strftime('%B')." 20".date("y"),0,2,'C');
	$nom = "";
	$frais = round($money[0]+$money[1]+$money[2],2);
	$identifiant= " Id Linky : ".$idLinky;
	$appele = "Bonjour $nom,";
	$content = "Le montant total de votre facture est : $frais Euros.";
	$pdf->Cell(75,15,$identifiant,0,2,'C');
	$pdf->Cell(40,15,$appele,0,2,'C');
	$pdf->Cell(40,30,$content,0,1);
	$pdf->SetFont('Arial','B',18); 
	$pdf->Cell(130  ,20,"Type d'energie",1,0);
	$pdf->Cell(59   ,20,"Frais(euros)",1,1);
	$pdf->SetFont('Arial','',16); 
	$pdf->Cell(130  ,8,$energies[0],1,0);
	$pdf->Cell(59   ,8,$money[0],1,1);
	$pdf->Cell(130  ,8,$energies[1],1,0);
	$pdf->Cell(59   ,8,$money[1],1,1);
	$pdf->Cell(130  ,8,$energies[2],1,0);
	$pdf->Cell(59   ,8,$money[2],1,1);
	$pdf->Output('D', "consommation_".$mois.".pdf"); 

	?> 
