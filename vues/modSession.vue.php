<?php 
if ($_SESSION['droit'] == 1)
{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets\formations_style.css">
    <title>Modification de session</title>
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
    <center><form action="" method="post">
        <input type="text" name="modlibsess" id="" value="<?php echo $infoLib?>"> Nouveau nom de session<br> <br>
        <input type="date" name="moddatedeb" id="moddatedeb" value="<?php echo $infodeb ?>"> Nouvelle date de début<br> <br>
        <input type="date" name="momoddatefin" id="moddatefin" value="<?php echo $infofin ?>"> Nouvelle date de fin<br> <br>
        <select name="formateur" id="">
            <?php 
            $libmeiter = $_POST['libsession'];
                $tform = FormateurMgr::getListFormateurs();
                for ($i = 0; $i<count($tform); $i++)
                {
                    if ($tform[$i]['Libéllé_Métier'] == $_POST['libsession'])
                    {
                        
                        if ($tform[$i]['Prénom'] == $_POST['presession'])
                        {
                            echo '<option selected  name="test" value="'. $tform[$i]['ID_Formateur'] .'">'.$tform[$i]['Prénom'] . ' ' . $tform[$i]['Nom'] . '</option>' ;
                        }
                        else echo '<option name="test" value="'. $tform[$i]['ID_Formateur'] .'">'.$tform[$i]['Prénom'] . ' ' . $tform[$i]['Nom'] . '</option>';
                    }
                }
                
                ?>
        </select> Nouveau Formateur <input type="button" value="Créer nouveau formateur"> <br> <br>
        <input type="hidden" name="idsession" value ="<?php echo $_POST['idsession'];?>">
        <input type="hidden" name="idformation" value ="<?php echo $_POST['Idformation'];?>">
        <input type="hidden" name="libancien" value ="<?php echo $_POST['Libéllé_Session_de_Formation'];?>">
        
        <button type="submit" name="action" value="modifier2">Modifier</button>
       
      
        
    </form></center>
</body>
</html>
<?php }
else header("Location: Index.php"); ?>
