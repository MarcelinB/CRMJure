<?php 

// var_dump($_SESSION);
if ($_SESSION['droit'] == 1)
{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter session formation</title>
    <link rel="stylesheet" href="../assets\formations_style.css">
</head>
<body>
<header class="HEADER">
        <h1>FORMATIONS</h1>
    </header>
    <div class="CONNECTED-AS">
    <span>Connecté en tant que : <?php echo $_SESSION['log']; ?></span>
                <center><a href="../class/deco.php">Déconnexion</a></center>
    </div>
    <div class="CHOICES">
        <form action="../Acceuil.php" method="POST">
            <button type="submit" name="action" value="Accueil" id="btn">Accueil</button>
        </form>
        <form action="../controlleur\controlleurSF.class.php" method="post">
            <button type="submit" name="action" value="afficheSessionForm" id="btn">Formations</button>
        </form>
        <form action="../controlleur/controlleurFormateurs.php" method="POST">
            <button type="submit" name="action" value="afficheListeFormateurs" id="btn">Formateurs</button>
        </form>
        <form action="../vues/Examens.vue.php" method="POST">
            <button type="submit" value="Examens" id="btn">Examens</button>
        </form>
        <form action="../vues/Jures.vue.php" method="POST">
            <button type="submit" value="Jurés" id="btn">Jurés</button>
        </form>
    </div>
    

    <?php 
    $tForm = Formation_Manager::getListFormations();
    // var_dump($tForm);
    for ($i = 0; $i<count($tForm); $i++)
    {
        echo 
        '<center><form action="../controlleur\controlleurSF.class.php" method="post">
        <input type="hidden" name="idform" value="'. $tForm[$i]['ID_Formation'].'">
        <input type="hidden" name="libform" value="'. $tForm[$i]['Libéllé_Formation'].'">
        <button type="submit" name="action" value="ajout2">'
        . $tForm[$i]['Libéllé_Formation'].'</button></a></form></center>';
    }


    ?>
</body>
</html>
<?php }
else header("Location: Index.php"); ?>