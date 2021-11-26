<?php 
if ($_SESSION['droit'] == 1)
{?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Formateur</title>
    <link rel="stylesheet" href="../assets/formateurs_style.css">
</head>
<body>
<header class="HEADER">
        <h1>FORMATEURS</h1>
    </header>
    <div class="CONNECTED-AS">
    <span>Connecté en tant que : <?php echo $_SESSION['log']; ?></span>
                <center><a href="../class/deco.php">Déconnexion</a></center>
    </div>
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
    </div>
    <p id="titreForm">Veuillez remplir les champs que vous souhaitez modifier :</p>
    <div class="FORM">
        <div class="LOGIN-FORM">
            <form action="controlleurFormateurs.php?action=validationModif" method="POST" id="formAjoutFormateur">
                    <input type="hidden" name="idFormateur" value="<?php echo $_POST['idFormateur'];?>">
                    <input type="hidden" name="idContact" value="<?php echo $_POST['idContact'];?>">
                    <input type="hidden" name="oldMailContact" value="<?php echo $_POST['oldMailContact'];?>">
                <label for="newName" class="inputLabel">Saisissez un Nom :</label>
                    <input value="<?php echo $_POST['nomContact'];?>" type="text" name="nouveauNom" id="newName" class="inputText">
                    <br />
                <label for="newName" class="inputLabel">Saisissez un Prénom :</label>
                    <input value="<?php echo $_POST['prenomContact'];?>" type="text" name="nouveauPrenom" id="newSurname" class="inputText">
                    <br />
                <label for="newName" class="inputLabel">Saisissez une Adresse :</label>
                    <input value="<?php echo $_POST['adresseContact'];?>" type="text" name="nouvelleAdresse" id="newAdress" class="inputText">
                    <br />
                <label for="newName" class="inputLabel">Saisissez un n° de téléphone :</label>
                    <input value="<?php echo $_POST['telContact'];?>" type="text" name="nouveauTel" id="newPhone" class="inputText">
                    <br />
                <label for="newName" class="inputLabel">Saisissez un n° de portable :</label>
                    <input value="<?php echo $_POST['portContact'];?>" type="text" name="nouveauPort" id="newMob" class="inputText">
                    <br />
                <label for="newName" class="inputLabel">Saisissez une adresse mail :</label>
                    <input value="<?php echo $_POST['mailContact'];?>" type="email" name="nouveauMail" id="newMail" class="inputText">
                    <br />
                <label for="newName" class="inputLabel">Sélectionnez un métier :</label>
                    <select name="formationSelected" id="newForma" class="inputText">
<?php
    $tFormations = Formation_Manager::getListFormations();
    // var_dump($tFormations);
    for ($i = 0 ; $i<count($tFormations) ; $i++) {
        echo 
            '<option>' . $tFormations[$i]['Libéllé_Formation'] . '</option>';
    }
?>
                    </select>
                    <br />
                <button type="submit" name="action" value="validationModif" id="btnValider" class="btnSubmit">Valider</button>
            </form>
        </div>
    </div>



    <?php
  
    
    ?>
</body>
</html>
<?php }
else header("Location: Index.php"); ?>