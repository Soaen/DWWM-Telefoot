<?php
if(!empty($_POST)){
    $email = trim(strip_tags($_POST['email']));
    $password = trim(strip_tags($_POST['password']));

    $db = new PDO("mysql:host=localhost;dbname=telefoot", "root", "root");

    $query = $db->prepare("SELECT * FROM users WHERE email LIKE :email");
    $query->bindParam(":email", $email);
    $query->execute();
    $result = $query->fetch();


    if(!empty($result) && password_verify($password, $result['password'])){
        session_start();

        $_SESSION['user']['firstname'] = $result['firstname'];

        //On stocke l'adresse ip pour palier à une attaque "session hijacking"
        $_SESSION['user']['ip'] = $_SERVER['REMOTE_ADDR'];


        header('Location: live');
    };

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion à l'espace utilisateur</title>
</head>
<body>

<h1>Connexion à l'espace utilisateur</h1>

<form action="" method="post">


    <div class="form-group">
        <label for="inputEmail">Email :</label>
        <input type="email" name="email" id="inputEmail">
    </div>
    <div class="form-group">
        <label for="inputPassword">Mot de passe :</label>
        <input type="password" name="password" id="inputPassword">
    </div>


    <input type="submit" value="Se connecter">
</form>
<div>
    <a href="register">Pas de compte ?</a>
</div>

<a href="reset_password">Mot de passe oublié ?</a>
    
</body>
</html>