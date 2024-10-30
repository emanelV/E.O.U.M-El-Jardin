<?php
$host = 'localhost';
$user = 'root';
$db = 'eljardinn';
$pass='';
try {
    $conn = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(Exception $e){
    'error: '.$e->getMessage();
    
}   


?>