<?php
session_start();

$db = new PDO("mysql:host=localhost;dbname=telefoot", "root", "root");

if(isset($_GET['token']) && !isset($_SESSION['user'])){
    $token = trim(strip_tags($_GET['token']));
    $query = $db -> prepare("SELECT email FROM password_reset WHERE token LIKE :token");
    $query -> bindParam(":token", $token);
    $query -> execute();
    $result = $query->fetch();

    if(!empty($result)){
        $_SESSION['user']['email'] = $result['email'];
    }else{
        header('Location: index.php');
    };

}else if(isset($_POST['password']) && isset($_SESSION['user'])){
    $password = trim(strip_tags($_POST['password']));
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = $db->prepare("UPDATE users SET password = :password WHERE email like :email");
    $query -> bindParam(":password", $hash);
    $query -> bindParam(":email", $_SESSION['user']['email']);
    if($query -> execute()){
        session_destroy();
        header('Location: login.php');
    }else{
        echo "Problème de mise à jour du mdp";
    }
}else{
    header('Location: index.php');

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe</title>
</head>
<body>
    <h1>Nouveau mot de passe</h1>

    <form action="" method="post">
        <div class="form-group">
            <label for="inputPassword">Nouveau mot de passe :</label>
            <input type="password" name="password" id="inputPassword">
        </div>

        <input type="submit" value="Envoyer">
    </form>
</body>
</html>
