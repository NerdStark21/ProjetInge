<?php

$idLinky=19800723488459;
$json_source = file_get_contents('http://localhost:3000/electricity_consumption?id='.$idLinky);
$json_data_elec = json_decode($json_source, true);

?>