<?php
// On cherche à développer une page index.php qui nous permet de générer n'importe quelle page de notre site
// Pour cela on teste la présence d'un paramètre GET s'appelant page
// Si le paramètre n'est pas présent on génère la page d'accueil par défaut
$page = "home";
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}

// echo "Nous allons générer la page {$page}";

// On importe le fichier contenant les constantes pour la base de données et les chemins de notre site
require("../config/index.php");

// Connexion à la base calvasse3000
$dsn = "mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE;
$db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

$pages = array(
    "home" => array(
        "model" => "HomeModel",
        "view" => "HomeView",
        "controller" => "HomeController"
    ),
    "register" => array(
        "model" => "RegisterModel",
        "view" => "RegisterView",
        "controller" => "RegisterController"
    ),
    "login" => array(
        "model" => "LoginModel",
        "view" => "LoginView",
        "controller" => "LoginController"
    ),
    "live" => array(
        "model" => "LiveModel",
        "view" => "LiveView",
        "controller" => "LiveController"
    ),
    "reset_password" => array(
        "model" => "ResetPasswordModel",
        "view" => "ResetPasswordView",
        "controller" => "ResetPasswordController"
    ),
    "new_password" => array(
        "model" => "NewPasswordModel",
        "view" => "NewPasswordView",
        "controller" => "NewPasswordController"
    )
);

$find = false;

foreach ($pages as $key => $value) {
    if($page === $key){
        $find = true;

        $model = $value['model'];
        $view = $value['view'];
        $controller = $value['controller'];
    }
}

if($find){

// On importe les diférentes classes (ex: HomeModel, HomeController et HomeView)
require(DIR_MODEL . $page . ".php");
require(DIR_CONTROLLER . $page . ".php");
require(DIR_VIEW . $page . ".php");

// Suitr à l'import nous avons la possibilité d'instancier les classes importées
$pageModel = new $model($db);
$pageController = new $controller($pageModel);
$pageView = new $view($pageController);

// Appel à la mémoire render() pour faire le rendu de la vue
$pageView->render();
}

?>