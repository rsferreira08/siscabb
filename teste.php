<?php
$money = "10.000,32";

$aux = explode(',',$money);

echo str_replace('.','',$aux[0]) . "." . $aux[1];

?>