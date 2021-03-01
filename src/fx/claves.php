<?php 
$clave='oboe1';
$clave2 = password_hash($clave, PASSWORD_DEFAULT, ['cost' => 15]);
echo $clave2;
?>