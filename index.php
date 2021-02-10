<?php

define('CHEMIN_VUES', 'views/');

require_once(CHEMIN_VUES . 'header.php');


$action = (isset($_GET['action'])) ? htmlentities($_GET['action']) : 'default';

require_once('controllers/AccueilController.php');
$controller = new AccueilController();
$controller->run();

require_once(CHEMIN_VUES . 'footer.php');

?>