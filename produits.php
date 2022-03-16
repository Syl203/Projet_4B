<?php
session_start();
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

// Connexion à la base de données PDO (PHP DATA OBJECT)
$user = "root";
$pass = "";

try{
    $connexion = new PDO('mysql:host=localhost;dbname=ecommerce;charset=UTF8',$user,$pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $retour = "<p class='container alert alert-success text-center' >Vous êtes connecté à PDO</p>";
}
catch(PDOException $e){
    $retour = $e->getMessage();
    die();
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
    <title>Produits</title>
</head>
<body>
<?php require_once "menu.php"; ?>
    <div class="container">
        
        <div class="row-produits">
            <h1 class="center">Nos produits</h1>
            <div class="produits">
            <?php 
            
            $req = "SELECT * FROM produits";
            $sth = $connexion->prepare($req);
            $sth->execute();

            $res = $sth->fetchAll(PDO::FETCH_ASSOC);
            foreach ($res as $key){ ?>
                <div class="produit">
                    <h2><?= $key["nom_produit"]; ?></h2>
                    <p class="description-produit"><?= $key["description_produit"]; ?></p>
                    <p><strong>Prix : <?= $key["prix_produit"]; ?> €</strong></p>
                    <img src="<?= $key["image_produit"]; ?>" width="180px" />
                    <?php if($key["stock_produit"] === 1){
                        $disponibilite = "En stock";
                    }
                    else{
                        $disponibilite = "Rupture de stock";
                    }
                    ?>
                    <p><?= $disponibilite; ?></p>
                    <a class="btn btn-warning" href="details_produit.php?id=<?= $key["id"] ?>">Détails</a>
                    <a class="btn btn-danger" href="supprimer_produit.php?id=<?= $key["id"] ?>">Supprimer</a>
                    <a class="btn btn-warning" href="editer_produit.php?id=<?= $key["id"] ?>">Editer</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#id-<?= $key["id"] ?>">
                    Modale
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="id-<?= $key["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?= $key["nom_produit"] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                </div>
                                <div class="modal-body">
                                    <p style="text-align:justify;"><span style="text-decoration: underline;font-weight:bold;">Description</span> : <?= $key["description_produit"]  ?></p>
                                    <p><strong>Prix : <?= $key["prix_produit"] ?> EUR</strong> </p>
                                    <img src="<?= $key["image_produit"] ?>" width="280px">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

                    
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>