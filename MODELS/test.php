<?php

$patern = "/^([a-z0-9\.]+@+[a-z]+(\.)+[a-z]{2,3})$/";
$text = "sank.auguste@gmail.com";
$regex = '/([^A-Za-z0-9, _@%$])/';
$pass = "avril";

echo preg_match($patern, $text) ? "Adresse valide" : "Adresse non valide";
echo "<br />";
echo preg_match($regex, $pass) ? "Mot de passe valide" : "Mot de passe non valide";