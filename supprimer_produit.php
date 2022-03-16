<?php session_start();
if(!isset($_SESSION["connecte"])){
    header('Location:index.php');
}

$user = "root";
$pass = "";
$id_prod = $_GET["id"];

try{
    $connexion = new PDO('mysql:host=localhost;dbname=ecommerce;charset=UTF8',$user,$pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $retour = "<p class='container alert alert-success text-center' >Vous êtes connecté à PDO</p>";
}
catch(PDOException $e){
    $retour = $e->getMessage();
    die();
}

$req = 'SELECT * FROM produits WHERE id = ?';
$sth = $connexion->prepare($req);
$sth->bindParam(1, $id_prod, PDO::PARAM_INT);
$sth->execute();
$res = $sth->fetch(PDO::FETCH_ASSOC);


if(isset($_POST["suppression"])){
$requette = "DELETE FROM produits WHERE id = ?";
$del = $connexion->prepare($requette);
$del->bindParam(1, $id_prod);
$del->execute();
if($del){
    echo "<p class='alert alert-success'>Produit bien supprimé !</p>";
    echo "<a href='produits.php'>Retour</a>";
}else{
    echo "<p class='alert alert-danger'>Erreur lors de la supression du produit !</p>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <title>Supprimer un produit</title>
</head>
<body>
<?php require_once "menu.php"; ?>
    <div class="container">
        <h1>SUPPRIMER UN PRODUIT</h1>
        <p style="color:#FFFFFF;">Vous êtes sur le point de supprimer le produit : <strong><?= $res["nom_produit"] ?></strong></p>
        <form method="post">
            <button class="btn btn-danger" type="submit" name="suppression">CONFIRMER</button>
        </form>
    </div>
</body>
</html>