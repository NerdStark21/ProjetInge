<header class="major">
	<h2>Les documents</h2>
</header>
<?php
	$mois = date('M');
	if(confirmDate()!=true){	
		print <<<EOT
			<div>
				<label for="id">Document de $mois : </label>
				<a href="requirepdf.php">Ma conso&moi de $mois</a>
			</div>
EOT;
	}else{
		echo "pas encore";
	}
	confirmDate();
	function confirmDate(){
		$zero1=date("Y-m-d");
		//echo $zero1;
		$firstday = date('Y-m-01', strtotime($zero1)); 
		$lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
		//echo $lastday;
		if(strtotime($zero1)==strtotime($lastday)){ 
			//echo "ok";
			return true;
		}else{
			//echo "non";
			return false;
		}
	}
?>