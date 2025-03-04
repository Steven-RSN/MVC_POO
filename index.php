<?php
// Inclusion des fichiers nécessaires
include "MVC_POO/utils/utils.php";
include "MVC_POO/GenericController.php";
include "MVC_POO/ControllerHome.php";
include "MVC_POO/ControllerCategory.php";
include "MVC_POO/ControllerAccount.php";

// Récupération de la page demandée via l'URL


// Affichage de la page
$controller->render();
?>