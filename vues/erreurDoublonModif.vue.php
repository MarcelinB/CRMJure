<?php 
if ($_SESSION['droit'] == 1)
{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur...</title>   
    <link rel="stylesheet" href="../assets/erreur_style.css">
</head>
<body>
<header class="HEADER">
        <h1>ERREUR</h1>
    </header>
    <div class="CONNECTED-AS">
        <span>Connecté en tant que :</span>
        <form action="../index.php" method="POST">
            <input type="submit" value="Se déconnecter" id="btnDeco">
        </form>
    </div>
    <div class="CHOICES">
        <form action="../index.php" method="POST">
            <input type="submit" value="Accueil" id="btn">
            <input type="hidden" name="identifiant" value="">
        </form>
        <form action="../controlleur/controlleurFormateurs.php" method="POST">
            <button type="submit" name="action" value="afficheListeFormateurs" id="btn">Formateurs</button>
            <input type="hidden" name="identifiant" value="">
        </form>
        <form action="../vues/SessionFormation.vues.php" method="POST">
            <input type="submit" value="Formations" id="btn">
            <input type="hidden" name="identifiant" value="">
        </form>
        <form action="Examens.php" method="POST">
            <input type="submit" value="Examens" id="btn">
            <input type="hidden" name="identifiant" value="">
        </form>
        <form action="Jurés.php" method="POST">
            <input type="submit" value="Jurés" id="btn">
            <input type="hidden" name="identifiant" value="">
        </form>
    </div>
    <div class="deleteFormaMsg"> 
        <p>       
        <?php 
            $msg =  'Le formateur n\'a pas pu être modifié car l\'adresse mail  saisie existe déjà... C\'est vraiment très dommage, oui.';
            echo $msg;
        ?>
        </p>
    </div>
</body>
</html>
<?php }
else header("Location: Index.php"); ?>