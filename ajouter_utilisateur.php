<?php 
session_start();
define('EMAIL','mounier.s@site.com');
define('PASSWORD','zangetsu');

if(isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"]) && isset($_POST["password_2"]) && !empty($_POST["password_2"])){
    if($_POST["password"] === $_POST["password_2"]){
        $email = trim(htmlspecialchars($_POST["email"]));
        $password = trim(htmlspecialchars($_POST["password"]));
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

        $req = "INSERT INTO `utilisateurs`(`email_user`, `pass_user`) VALUES (?,?)";
        $insert = $connexion->prepare($req);
        $insert->bindParam(1,$email);
        $insert->bindParam(2,$password);
        $insert->execute();

        header('Location:index.php');
    }
    else{
        echo "<p class='alert alert-danger'>Mauvais mot de passe</p>";
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
    <title>Ajouter un utilisateur</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <form method="post">
                <h1>Enregistrer un utilisateur</h1>
                <label for="email">Entrez votre email :</label><br>
                <input type="email" name="email" placeholder="Votre email" id="email"><br>
                
                <label for="password">Entrez votre password :</label><br> 
                <input type="password" name="password" id="password"><br>
                
                <label for="password_2">Vérifiez votre password :</label><br>
                <input type="password" name="password_2" id="password_2"><br>
                <br>
                <button type="submit" name="btn-click" class="btn btn-warning">Envoyer</button>

                <?php if(isset($erreur)){
                    echo "<span class='erreur'>" . $erreur . "</span>";
                } ?>
            </form>
        </div>
    </div>
</body>
</html>