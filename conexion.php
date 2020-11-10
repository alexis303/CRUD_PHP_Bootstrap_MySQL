<?php

$usuario='root';
$pass ='';
$url = 'mysql:host=localhost;dbname=pruebaphp';




try {
    $pdo = new PDO($url, $usuario, $pass);
  
   
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}