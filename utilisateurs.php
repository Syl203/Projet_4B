<?php
session_start();
if(!isset($_SESSION['connecte'])){
    header('Location:index.php');
}

//Connexion a PDO MySQL
try {
    $connexion = new PDO("mysql:host=localhost;dbname=ecommerce;charset=UTF8", "root", "");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "erreur " . $exception->getMessage();
}

//requete de selection de tous les utilisateurs
$sql = "SELECT * FROM `utilisateurs`";
$utilisateurs = $connexion->query($sql);


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
    <title>Gestion des utilisateurs</title>
</head>
<body>
<?php require_once "menu.php"; ?>
<div class="container">
    <div class="row-utilisateurs">
        <h1>Liste des utilisateurs</h1>
        <a href="ajouter_utilisateur.php" class="btn btn-primary">Ajouter</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mot de passe</th>
                    <th scope="col">Editer</th>
                    <th scope="col">Supprimer</th>
                </tr>
            </thead>
            <tbody>
            <?php
            //On recup notre tableau d'utilisateur et on parcours en bouclant sur un alias
            foreach ($utilisateurs as $utilisateur){
                ?>
                <tr>
                    <!--ici alis['intitulé de la colonne phpMyAdmin table utilisateurs']-->
                    <td scope="col"><?= $utilisateur['id_user'] ?></td>
                    <td><?= $utilisateur['email_user'] ?></td>
                    <td><?= $utilisateur['pass_user'] ?></td>
                    <td>
                        <a href="editer_utilisateur.php?id_utilisateur=<?= $utilisateur['id_user'] ?>" class="btn btn-success">EDITER</a>
                    </td>
                    <td>
                        <a href="supprimer_utilisateur.php?id_utilisateur=<?= $utilisateur['id_user'] ?>" class="btn btn-success">SUPPRIMER</a>
                    </td>
                </tr>
                <?php
            }

            ?>


            </tbody>
        </table>
    </div>
</div>
</body>
</html>