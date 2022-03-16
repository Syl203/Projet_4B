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
    <title>Détails du produit</title>
</head>
<body>
<?php require_once "menu.php"; ?>
    <div class="container">
        <div class="row-produits">
            <h1 class="text-center">Description du produit</h1>
            <p><?php echo $res['nom_produit']; ?></p>
            <p>Prix : <?php echo $res['prix_produit']; ?> €</p>
            <p>Description : <?php echo $res['description_produit']; ?></p>
            <p><img src="<?= $res['image_produit'] ?>" width="300px"/></p>
            <p>Disponibilité : 
                <?php if($res["stock_produit"] === 1){
                    echo "En stock";
                }else{echo "Rupture de stock";} ?></p>
            <p><a class="btn btn-warning" href="#">ACHETER</a></p>
        </div>
    </div>
</body>
</html>