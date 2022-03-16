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

if($connexion){
    $req = "INSERT INTO produits (
        id, 
        nom_produit,
        description_produit,
        prix_produit,
        stock_produit,
        date_depot,
        image_produit) 
        VALUES (?,?,?,?,?,?,?)";
    $insert = $connexion->prepare($req);
    $insert->bindParam(1,$_POST["id"]);
    $insert->bindParam(2,$_POST["nom_produit"]);
    $insert->bindParam(3,$_POST["description_produit"]);
    $insert->bindParam(4,$_POST["prix_produit"]);
    $insert->bindParam(5,$_POST["stock_produit"]);
    $insert->bindParam(6,$_POST["date_depot"]);
    $insert->bindParam(7,$_POST["image_produit"]);

    $insert->execute();

    if($insert){
        echo "Produit ajouté";
    }
    else{
        echo "Erreur lors de l'ajout";
    }
}

header('Location:produits.php')
?>