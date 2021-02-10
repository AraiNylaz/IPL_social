<?php

class AccueilController
{

    public function __construct() {}

    public function run()
    {
        $resultat = 'veuillez un email';
        $resultat = $this->analyserEmail($_POST['email']);
        require_once(CHEMIN_VUES . 'accueil.php');
    }

    public function analyserEmail($emailAVerfifier): bool
    {
        if (empty($emailAVerfifier)) {
            $resultat = 'vide';
            return false;
        } else {
            $pattern = "/^[a-z0-9]+(\.[a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]{1,3})$/";
            if(!preg_match($pattern, $emailAVerfifier)) {
                $resultat = 'email invalide';
                return false;
            }
            $resultat = 'email valide';
            return true;
        }
    }

}