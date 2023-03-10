<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "exercice";

$conn = mysqli_connect($hostname,$username,$password,$dbname);
if(!$conn){
    echo"Connexion à la base échouée".mysqli_connect_error();
}
?>