<?php 

var_dump($_SESSION);
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

    <center><form action="" method="post">
        <input type="text" name="nomsess" id="" value=""> Nom de session<br> <br>
        <input type="date" name="datedeb" id="modlibmetier" value=""> Date de début<br> <br>
        <input type="date" name="datefin" id="modlibmetier" value=""> Nouvelle date de fin<br> <br>
        <select name="formateur" id="">
            <?php 
            $libmeiter = $_POST['libform'];
                $tform = FormateurMgr::getListFormateurs();
                for ($i = 0; $i<count($tform); $i++)
                {
                    if ($tform[$i]['Libéllé_Métier'] == $_POST['libform'])
                    {
                    echo '<option value="'. $tform[$i]['ID_Contact'] .'">'.$tform[$i]['Prénom'] . ' ' . $tform[$i]['Nom'] .'</option>';
                    }
                }
                
                ?>
        </select> Nouveau Formateur <input type="button" value="Créer nouveau formateur"> <br> <br>
        <input type="hidden" name="libform" value ="<?php echo $_POST['idform'];?>">
        <!-- <input type="hidden" name="libform" value=""> -->
        <button type="submit" name="action" value="ajout3">Ajouter</button>
      </form></center>
</body>
</html>
<?php }
else header("Location: Index.php"); ?>
