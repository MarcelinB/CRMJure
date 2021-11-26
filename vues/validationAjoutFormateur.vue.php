<?php 
if ($_SESSION['droit'] == 1)
{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formateur ajouté</title>
    <link rel="stylesheet" href="../assets/formateurs_style.css">
</head>
<body>
<header class="HEADER">
        <h1>FORMATEURS</h1>
    </header>
    <div class="CONNECTED-AS">
        <span>Connecté en tant que :</span>
        <form action="../index.php" method="POST">
            <input type="submit" value="Se déconnecter" id="btnDeco">
        </form>
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
    <div class="deleteFormaMsg"> 
        <p>       
        <?php 
            $msg =  'Le formateur suivant a bien été ajouté : <br /><br />' . 
                    $_POST['nouveauNom'] . ' ' . $_POST['nouveauPrenom'] . ' => ' . 
                    $_POST['formationSelected'];
            echo $msg;
        ?>
        </p>
    </div>
</body>
</html>
<?php }
else header("Location: Index.php"); ?>