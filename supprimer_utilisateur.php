<?php
session_start();
if(!isset($_SESSION["connecte"])){
    header('Location:index.php');
}

try {
    $connexion = new PDO("mysql:host=localhost;dbname=ecommerce;charset=UTF8", "root", "");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $exception){
    echo "erreur " .$exception->getMessage();
}
$id = $_GET["id_utilisateur"];
$sql = "DELETE FROM `utilisateurs` WHERE id_user= ?";
$requete = $connexion->prepare($sql);
$requete->bindParam(1, $id);
$requete->execute();

if($requete == true){
    header('Location:utilisateurs.php');
}