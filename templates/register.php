<?php
ini_set("display_errors", 0);

if(!empty($_POST)){

    $errors = [];

    $firstname = trim(strip_tags($_POST["firstname"]));
    $email = trim(strip_tags($_POST["email"]));
    $password = trim(strip_tags($_POST["password"]));
    $retypePassword = trim(strip_tags($_POST["retypePassword"]));
    $retypeEmail = trim(strip_tags($_POST["retypeEmail"]));
}

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors["email"] = "L'email n'est pas valide";
    }


    if($password != $retypePassword){
        $errors["retypePassword"] = "Les deux mots de passe ne correspondent pas";
    }
    if($email != $retypeEmail){
        $errors["retypeEmail"] = "Les deux emails ne correspondent pas";
    }

    $uppercase = preg_match("/[A-Z]/", $password);
    $lowercase = preg_match("/[a-z]/", $password);
    $number = preg_match("/[0-9]/", $password);
    $specialChar = preg_match("/[a-zA-Z0-9]/", $password);

    if( !$uppercase || !$lowercase || !$number || !$specialChar || strlen($password) < 12){
        $errors["password"] = "Le mot de passe doit contenir 12 caractères minimum, une lettre majuscule, use lettre minuscule, une chiffre et un caractère spécial";
    }


    if(empty($errors)){
        $hash = password_hash($password, PASSWORD_DEFAULT);


        $db = new PDO("mysql:host=localhost;dbname=telefoot", "root", "root");

        $query = $db->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname,:email, :password)");
        $query ->bindParam(":firstname", $firstname);
        $query ->bindParam(":lastname", $lastname);
        $query ->bindParam(":email", $email);
        $query ->bindParam(":password", $hash);

        if($query->execute()){
            header("Location: login");
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un compte utilisateur</title>
</head>
<body>
    <h1>Création d'un compte utilisateur</h1>
    
    <form action="" method="post">

        <div class="form-group">
            <label for="inputFirstname">Prénom:</label>
            <input type="text" name="firstname" id="inputFirstname" value="<?= isset($firstname) ? $firstname : ""?>">
            
        </div>

        <div class="form-group">
            <label for="inputEmail">Email :</label>
            <input type="email" name="email" id="inputEmail" value="<?= isset($email) ? $email : ""?>">
            <?php
                if(isset($errors['email'])){
                    ?>
                        <p class="error"><?= $errors["email"] ?></p>
                    <?php
                }
            ?>
        </div>
        
        <div class="form-group">
            <label for="inputRetypeEmail">Confirmer email :</label>
            <input type="email" name="email" id="inputRetypeEmail">
            <?php
                if(isset($errors['retypeEmail'])){
                    ?>
                        <p class="error"><?= $errors["retypeEmail"] ?></p>
                    <?php
                }
            ?>
        </div>

        <div class="form-group">

            <label for="inputPassword">Mot de passe :</label>
            <input type="password" name="password" id="inputPassword" value="<?= isset($password) ? $password : ""?>">

            <?php
                if(isset($errors['password'])){
                    ?>
                        <p class="error"><?= $errors["password"] ?></p>
                    <?php
                }
            ?>

        </div>

        <div class="form-group">

            <label for="inputRetypePassword">Confirmation du mot de passe :</label>
            <input type="password" name="retypePassword" id="inputRetypePassword" value="<?= isset($retypePassword) ? $retypePassword  : ""?>">
            <?php
                if(isset($errors['retypePassword'])){
                    ?>
                        <p class="error"><?= $errors["retypePassword"] ?></p>
                    <?php
                }
            ?>
        </div>


        <input type="submit" value="Création du compte">

    </form>

    


</body>
</html>