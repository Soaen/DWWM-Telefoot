<?php
require('../vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;

define("HOST", "http://localhost:8888/telefoot/");

if(isset($_POST['email'])){
    $email = trim(strip_tags($_POST['email']));

    $token =bin2hex(random_bytes(50));

    $db = new PDO("mysql:host=localhost;dbname=telefoot", "root", "root");
    $query = $db-> prepare("INSERT INTO password_reset (email, token) VALUES (:email, :token)");
    $query -> bindParam(':email', $email);
    $query -> bindParam(':token', $token);

    if($query->execute()){

        $phpmailer = new PHPMailer();
        
        $phpmailer -> isSMTP();

        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 25;
        $phpmailer->Username = 'd409f3da5a37a1';
        $phpmailer->Password = 'c4e06e6a39c4af';

        $phpmailer -> From = "contact@dwwm.fr";

        $phpmailer -> FromName = "Akali";

        $phpmailer -> addAddress($email);

        $phpmailer -> isHTML();

        $phpmailer -> CharSet = "UTF-8";

        $phpmailer -> Subject = "Réinitialisation du mot de passe";

        $url = HOST . "new_password/{$token}";
        $phpmailer -> Body = "<a href=\"{$url}\">Réinitialisation du mot de passe</a>";

        $phpmailer -> send();

    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oubli d'un mot de passe</title>
</head>
<body>
    
    <h1>J'ai oublié mon mot de passe 😱</h1>

    <form action="" method="post">

        <div class="form-group">
            <label for="inputEmail">Email :</label>
            <input type="email" name="email" id="inputEmail">
        </div>

        <input type="submit" value="Envoyer">

    </form>

</body>
</html>