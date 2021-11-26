<?php
$action = 'acceuil'; 
if (isset($_POST['action'])) {
    $action = $_POST['action'];
}?>
<?php 
session_start();
// var_dump($_SESSION);
if ($_SESSION['droit'] == 1)
{?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/accueiil_style.css">
</head>
<body>
    <header class="HEADER">
        <h1>ACCUEIL</h1>
    </header>
    <div class="CONNECTED-AS">
    <span>Connecté en tant que : <?php echo $_SESSION['log']; ?></span>
                <center><a href="../class/deco.php">Déconnexion</a></center>
    </div>

    <div class="CHOICES">
        <form action="controlleur\controlleurSF.class.php" method="post">
            <button type="submit" name="action" value="afficheSessionForm" id="btn">Formations</button>
        </form>
        <form action="vues/Examens.vue.php" method="POST">
            <button type="submit" value="Examens" id="btn">Examens</button>
        </form>
        <form action="vues/Jures.vue.php" method="POST">
            <button type="submit" value="Jurés" id="btn">Jurés</button>
        </form>
        <form action="controlleur\controlleurFormateurs.php" method="POST">
            <button type="submit" name="action" value="afficheListeFormateurs" id="btn">Formateurs</button>
        </form>
    </div>

    <?php
// echo 'action : ' . $action;
switch($action)
{
    case 'afficheSessionForm' :
        require('/..controlleur\controlleurSF.class.php');
        break;
    
    case 'afficheExamForm' :
        require('controlleur\controlleurSE.class.php');
        break;
    case 'sf' :
        require('controlleur\controlleurSF.class.php');  
        break;
    case 'formateurs' : 
        require('controlleur\controlleurFormateurs.php');
        break;
}

?>
</body>
</html>
<?php }
else header("Location: Index.php"); ?>
