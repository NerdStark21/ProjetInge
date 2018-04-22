<?php

$json_source = file_get_contents('http://localhost:3000/water_consumption?id=19800723488459');
$json_data_eau = json_decode($json_source, true);

?>