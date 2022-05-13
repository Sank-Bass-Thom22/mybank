<?php
/* 
$patern = "/^([a-z0-9\.]+@+[a-z]+(\.)+[a-z]{2,3})$/";
$text = "sank.auguste@gmail.com";
$regex = '/([^A-Za-z0-9, _@%$])/';
$pass = "avril";

echo preg_match($patern, $text) ? "Adresse valide" : "Adresse non valide";
echo "<br />";
echo preg_match($regex, $pass) ? "Mot de passe valide" : "Mot de passe non valide";
*/

/*
$chaine = 'B@$$inK0nWende0';
$upc = preg_match('@[A-Z]@', $chaine);
$lwc = preg_match('@[a-z]@', $chaine);
$nbr = preg_match('@[0-9]@', $chaine);
$sc = preg_match('@[^\w]@', $chaine);

if(!$upc || !$lwc || !$nbr || !$sc || strlen($chaine) < 8) {
    echo "Chaine invalide.<br>";
    echo "UPPER = " . $upc . " LOWER = " . $lwc . " NUMBER = " . $nbr . " SC = " . $sc;
} else {
    echo"Chaine valide.<br>";
    echo "UPPER = " . $upc . ", LOWER = " . $lwc . ", NUMBER = " . $nbr . ", SC = " . $sc;
}
*/

/*
$email = 'auguste555@gmail.ac';
$em = preg_match('/^([a-z0-9\.]+@+[a-z]+(\.)+[a-z]{2,3})$/', $email);
echo $em;
*/

$str = 'Commentaires';
strlen($str) >= 8 ? $t = 1 : $t = 0;
echo $t;