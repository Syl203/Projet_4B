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
$req = "SELECT * FROM utilisateurs WHERE id_user = ?";
$sth = $connexion->prepare($req);
$sth->bindParam(1,$_GET["id_utilisateur"]);
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
    <title>Editer un utilisateur</title>
</head>
<body>
<?php require_once "menu.php"; ?>
    <div class="container">
        <div class="row-ajout">
            <form method="post" action="traitement_edition_utilisateur.php?id=<?= $_GET["id_utilisateur"] ?>">

                <label for="email">Email :</label><br>
                <input type="email" name="email_user" id="email" value="<?= $res["email_user"] ?>"><br><br>

                <label for="pass1">Password :</label><br>
                <input type="password" name="pass1" id="pass1"><br><br>

                <label for="pass2">Confirmer :</label><br>
                <input type="password" name="pass2" id="pass2"><br><br>

                <button type="submit" name="editer" class="btn btn-primary">Editer</button>
            </form>
        </div>
    </div>
</body>
</html>