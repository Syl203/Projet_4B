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
    <title>Ajouter un produit</title>
</head>
<body>
<?php require_once "menu.php"; ?>
    <div class="container">
        <div class="row-ajout">
            <form method="post" action="traitement_ajout_produit.php" enctype="multipart/form-data">
                <label for="nom_produit">Nom du produit :</label><br>
                <input type="text" name="nom_produit" id="nom_produit"><br><br>

                <label for="description_produit">Description :</label><br>
                <textarea name="description_produit" id="description_produit"></textarea><br><br>

                <label for="prix_produit">Prix :</label><br>
                <input type="number" name="prix_produit" id="prix_produit"> Eur<br><br>

                <label for="stock_produit">En stock ? :</label><br>
                <select name="stock_produit" id="stock_produit">
                    <option value="1">En stock</option>
                    <option value="0">Rupture de stock</option>
                </select><br><br>

                <label for="date_depot">Date de dépot :</label><br>
                <input type="date" name="date_depot" id="date_depot"><br><br>

                <label for="image_produit">Selectionner une image :</label><br>
                <input type="file" name="image_produit" id="image_produit"><br><br>

                <button type="submit" name="ajout" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</body>
</html>