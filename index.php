<?php 
session_start();



if(isset($_POST) && !empty($_POST)){
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

    $email_user = trim(htmlspecialchars($_POST['email']));
    $password_user = trim(htmlspecialchars($_POST['password']));

    $sql = "SELECT *  FROM `utilisateurs` WHERE `email_user` = ? AND `pass_user` = ?";
    $requete = $connexion->prepare($sql);
    $requete->bindParam(1,$email_user);
    $requete->bindParam(2,$password_user);
    $requete->execute();

    if ($requete->rowCount() >= 0) {
        $ligne = $requete->fetch();var_dump($ligne);
        if($ligne){
            $email = $ligne['email_user'];
            $password = $ligne['pass_user'];
            var_dump($ligne);
            if ($email_user === $email && $password_user === $password){
                $_SESSION["connecte"] = $email_user;
                header("Location: produits.php");
            } else {
                echo "<div class='mt-3 container'>
                    <p class='alert alert-danger p-3'>Erreur de connexion: merci de verifié votre email et mot de passe</p>
            </div>";
            }
        }else {
            echo "<div class='mt-3 container'>
                    <p class='alert alert-danger p-3'>Erreur de connexion : merci de verifier votre email et mot de passe</p>
            </div>";
        }



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
    <title>Connexion</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <form method="post" action="index.php">
                <h1>Connexion</h1>
                <label for="email">Entrez votre email :</label><br>
                <input type="email" name="email" placeholder="Votre email" id="email"><br><br>
                <label for="password">Entrez votre password :</label><br>
                <input type="password" name="password" id="password"><br><br>
                <button type="submit" name="btn-click" class="btn btn-warning">Envoyer</button>

                <?php if(isset($erreur)){
                    echo "<span class='erreur'>" . $erreur . "</span>";
                } ?>
            </form>
        </div>
    </div>
</body>
</html>