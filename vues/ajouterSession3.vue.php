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
    $flag1 = false;
    $flag2 = false;
    // var_dump($_POST);
    
    if ($_POST['datedeb'] > $_POST['datefin'])
    {
        echo 'Erreur : Date de début postérieur à la date de fin 
        <br> <br> <a href="javascript:history.go(-1)">Modifier</a>' ;
        $flag1 = true;
    }
    elseif (rtrim($_POST['nomsess']) == '')
    {
        echo 'Erreur : Nom de session vide 
        <br> <br> <a href="javascript:history.go(-1)">Modifier</a>' ;
        $flag2 = true;
    }
    $listS = Formation_Session_Manager::getListSessionFormations();
    // var_dump($listS);
    for ($i = 0; $i<count($listS); $i++)
    {
        if (strtoupper($_POST['nomsess']) == $listS[$i]['Libéllé_Session_de_Formation'])
        {
            echo 'Erreur : Nom de session de formation déjà exsitante 
        <br> <br> <a href="javascript:history.go(-1)">Modifier</a>' ;
        $flag2 = true;
        }
    }
    if ($flag1 == false AND $flag2 == false) 
    {
        Formation_Session_Manager::addSessionFormation(strtoupper($_POST['nomsess']), $_POST['formateur'], $_POST['datedeb'],
        $_POST['datefin'], $_POST['libform']);
        echo '<center><h1>Formation ajoutée !</h1></center>';
    }
    
    
    
    
    ?>
</body>
</html>
<?php }
else header("Location: Index.php"); ?>
