<?php
session_start();

require_once('../MODELS/administratorC.php');
require_once('../MODELS/administratorM.php');

if (isset($_POST['sign_in'])) {
    $Donnees = $_POST['Donnees'];

    foreach ($Donnees as $key => $value) {
        $Donnees[$key] = htmlspecialchars(strip_tags(trim($value)));
    }

    $adminC = new AdminC($Donnees);
    $error = $adminC->getError();

    if (!empty($error)) {
        header('LOCATION: ../index.php?error=' . $error);
    } else {
        $adminM = new AdminM();
        $code = $adminM->Sign_in($adminC);

        switch ($code) {
            case 101:
                $_SESSION['adminname'] = $adminC->getAdminname();
                $_SESSION['email'] = $adminC->getEmail();
                header('LOCATION: ../VIEWS/dashboard1.php');
                break;
            case 102:
                $_SESSION['adminname'] = $adminC->getAdminname();
                $_SESSION['email'] = $adminC->getEmail();
                header('LOCATION: ../VIEWS/dashboard2.php');
                break;
            case 201:
                $error = "ERREUR : Compte inexistant. Vérifier vos informations d'authentifications.";
                header('LOCATION: ../index.php?error = ' . $message);
                break;
            case 202:
                $message = "ERREUR : Mot de passe incorrect.";
                header('LOCATION: ../index.php?error = ' . $message);
                break;
        }
    }
} elseif (isset($_POST['sign_up'])) {
    $Donnees = $_POST['Donnees'];

    foreach ($Donnees as $key => $value) {
        $Donnees[$key] = htmlspecialchars(strip_tags(trim($value)));
    }

    $adminC = new AdminC($Donnees);
    $error = $adminC->getError();

    if (!empty($error)) {
        header('LOCATION: ../index.php?error = ' . $error);
    } else {
        $adminM = new AdminM();
        $code = $adminM->Sign_up($adminC);

        switch ($code) {
            case 100:
                $message = "Administrateur nommer avec succès!";
                header('LOCATION: ../VIEWS/registration.php?message =' . $message);
                break;
            case 200:
                $message = "ERREUR : Compte non créer, veuillez rééssayer!";
                header('LOCATION: ../VIEWS/registration.php?message =' . $message);
                break;
            case 300:
                $message = "ALERTE : L'adresse E-mail renseignée est déjà utilisée!";
                header('LOCATION: ../VIEWS/registration.php?message = ' . $message);
                break;
        }
    }
} else {}
