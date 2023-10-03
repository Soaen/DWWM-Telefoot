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
$dsn = "mysql:host=" . DB_HOSTNAME . ";dbname" . DB_DATABASE;
$db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

// On importe les diférentes classes (ex: HomeModel, HomeController et HomeView)
require(DIR_MODEL . "home.php");
require(DIR_CONTROLLER . "home.php");
require(DIR_VIEW . "home.php");

// Suitr à l'import nous avons la possibilité d'instancier les classes importées
$pageModel = new HomeModel($db);
$pageController = new HomeController($pageModel);
$pageView = new HomeView($pageController);

// Appel à la mémoire render() pour faire le rendu de la vue
$pageView->render();

?>