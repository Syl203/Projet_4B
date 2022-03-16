<?php
session_start();
if (!isset($_SESSION["connecte"])) {
    header('Location:index.php');
}

if (isset($_POST["deconnecte"])) {
    deconnexion();
}
function deconnexion()
{
    session_unset();
    session_destroy();
    header('Location:index.php');
}

if($_POST["pass1"] != $_POST["pass2"]){
    header('Location:editer_utilisateur.php');
}

// On se connecte à la base de données
$user = "root";
$pass = "";

try {
    $connexion = new PDO('mysql:host=localhost;dbname=ecommerce;charset=UTF8', $user, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $retour = $e->getMessage();
    die();
}
if($connexion){
    $req = "UPDATE `utilisateurs` SET
        `email_user` = ?,
        `pass_user` = ?
         WHERE id_user = ?";
    $update = $connexion->prepare($req);

    $update->execute(array(
        $_POST["email_user"],
        $_POST["pass1"],
        $_GET["id"]
    ));
}

header('Location:utilisateurs.php')
?>