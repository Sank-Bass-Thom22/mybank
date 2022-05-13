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
    $message = $adminC->getError();

    if (!empty($message)) {
        header('LOCATION: ../index.php?message=' . $message);
    } else {
        $adminM = new AdminM();
        $row = $adminM->Sign_in($adminC);

        if (!empty($row))
        {
            if (password_verify($row['password'], PASSWORD_BCRYPT))
            {
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                if ($row['degree'] == 1)
                {
                    header('LOCATION: ../VIEWS/SUPER/index.php');
                } else {
                    header('LOCATION: ../VIEWS/SIMPLE/index.php');
                }
            } else {
                $message = 'Mot de passe incorrect.';
            }
        } else {
            $message = 'Compte inexistant.';
        }
        header('LOCATION: ../index.php?message=' . $message);
    }
} elseif (isset($_POST['sign_up'])) {
    $Donnees = $_POST['Donnees'];

    foreach ($Donnees as $key => $value) {
        $Donnees[$key] = htmlspecialchars(strip_tags(trim($value)));
    }

    $adminC = new AdminC($Donnees);
    $message = $adminC->getError();

    if (!empty($message)) {
        header('LOCATION: ../VIEWS/SUPER/register.php?message=' . $message);
    } else {
        $adminM = new AdminM();
        $code = $adminM->Sign_u.p($adminC);

        switch ($code)
        {
            case 100: $message = 'Administrateur nommé avec succès!';
            break;
            case 200: $message = 'ERREUR : Compte non créer. Veuillez rééssayer.';
            break;
            default: $message = 'AVERTISSEMENT : L\'adresse Email renseignée est déjà utilisé par un autre compte.';
        }
        header('LOCATION: ../VIEWS/SUPER/register.php?message=' . $message);
    }
} elseif(isset($_POST['resetpassword']))
{
    $Donnees = $_POST['Donnees'];

    foreach ($Donnees as $key => $value) {
        $Donnees[$key] = htmlspecialchars(strip_tags(trim($value)));
    }

    $adminC = new AdminC($Donnees);
    $message = $adminC->getError();

    if (!empty($message)) {
        header('LOCATION: ../VIEWS/SUPER/forgot-password.php?message=' . $message);
    } else {
        $adminM = new AdminM();
        $code = $adminM->ResetPassword($adminC);

        if ($code == 103)
        {
            $message = 'Mot de passe réinitialisé avec succès!';
        }  else {
            $message = 'ERREUR : La réinitialisation a échoué. Vérifier les informations renseignées puis rééssayer.';
        }
        header('LOCATION: ../VIEWS/SUPER/forgot-password.php?message=' . $message);
    }
} elseif(isset($_GET['FullAdminList']))
{
    $adminM = new AdminM();
    $query = $adminM->All_admin();
    ?>

    <?php ob_start(); ?>

    <?php
    echo "<table>";
    
    while($rows = $query->fetch())
    {
        $id = $rows['id_admin'];
        echo "<tr>";
        echo "<td>" . $rows['firstname'] . "</td>";
        echo "<td>" . $rows['lastname'] . "</td>";
        echo "<td>" . $rows['email'] . "</td>";
        echo "<a href='../../CONTROLLERS/authentication.php?DetailAdmin='$id>Voir plus</a>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<a href=''>Fermer</a>";
    ?>

    <?php $content = ob_get_clean(); ?>

    <?php
} else {}
