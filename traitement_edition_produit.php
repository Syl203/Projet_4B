<?php session_start(); 
if(!isset($_SESSION["connecte"])){
    header('Location:index.php');
}

if(isset($_POST["deconnecte"])){
    deconnexion();
}
function deconnexion(){
    session_unset();
    session_destroy();
    header('Location:index.php');
}
// On se connecte à la base de données
$user = "root";
$pass = "";

try{
    $connexion = new PDO('mysql:host=localhost;dbname=ecommerce;charset=UTF8',$user,$pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    $retour = $e->getMessage();
    die();
}
if(isset($_FILES["image_produit"])){
    $dir = "img/";
    $photo_produit = $dir. basename($_FILES["image_produit"]["name"]);
    $_POST["image_produit"] = $photo_produit;

    if(move_uploaded_file($_FILES["image_produit"]['tmp_name'], $photo_produit)){
        echo "<p>Le fichier est uploadé.</p>";
    }else{
        echo "<p>Erreur : téléchargement impossible !</p>";
    }
}
else{
    echo "<p>Le fichier est invalide.</p>";
}



if($connexion){
    $req = "UPDATE `produits` SET
        `nom_produit` = ?,
        `description_produit` = ?,
        `prix_produit` = ?,
        `stock_produit` = ?,
        `date_depot` = ?,
        `image_produit` = ? 
        WHERE id = ?";
    $update = $connexion->prepare($req);
    

    $update->execute(array(
        $_POST["nom_produit"],
        $_POST["description_produit"],
        $_POST["prix_produit"],
        $_POST["stock_produit"],
        $_POST["date_depot"],
        $_POST["image_produit"],
        $_GET["id"]
    ));

    if($update){
        echo "Produit Modifié";
    }
    else{
        echo "Erreur lors de la modification";
    }
}

header('Location:produits.php')
?>