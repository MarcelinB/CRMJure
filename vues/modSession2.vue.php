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
    <link rel="stylesheet" href="../assets\formations_style.css">
    <title>Document</title>
</head>
<body>
<header class="HEADER">
        <h1>Modification</h1>
    </header>
    <div class="CONNECTED-AS">
    <span>Connecté en tant que : <?php echo $_SESSION['log']; ?></span>
                <center><a href="../class/deco.php">Déconnexion</a></center>
    </div>
    <div class="CHOICES">
        <form action="../index.php" method="POST">
            <input type="submit" value="Accueil" id="btn">
            <input type="hidden" name="identifiant" value="">
        </form>
        <form action="../controlleur\controlleurSF.class.php" method="post">
        <button type="submit" name="action" value="afficheSessionForm" id="btn">Formation</button></a></form>
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
    <?php 
    $flag1 = false;
    $flag2 = false;
    
    if ($_POST['moddatedeb'] > $_POST['momoddatefin'])
    {
        echo 'Erreur : Date de début postérieur à la date de fin 
        <br> <br> <a href="javascript:history.go(-1)">Modifier</a>' ;
        $flag1 = true;
    }

    elseif (rtrim($_POST['modlibsess']) == '')
    {
        echo 'Erreur : Nom de session vide 
        <br> <br> <a href="javascript:history.go(-1)">Modifier</a>' ;
        $flag2 = true;
    }
    $listS = Formation_Session_Manager::getListSessionFormations();
    // var_dump($listS);
    for ($i = 0; $i<count($listS); $i++)
    {
        if (strtoupper($_POST['modlibsess']) == $listS[$i]['Libéllé_Session_de_Formation'] AND (strtoupper($_POST['modlibsess']) <> $_POST['libancien']))
        {
            echo 'Erreur : Nom de session de formation déjà exsitante 
        <br> <br> <a href="javascript:history.go(-1)">Modifier</a>' ;
        $flag2 = true;
        }
    }
    if ($flag1 == false AND $flag2 == false) 
    {
        Formation_Session_Manager::updateSessionFormation($_POST['idsession'], strtoupper($_POST['modlibsess']), $_POST['formateur'],
        $_POST['moddatedeb'], $_POST['momoddatefin'], $_POST['idformation']);
        echo 'Formation modifiée !';
    }
    
    
    
    
    ?>
</body>
</html>
<?php }
else header("Location: Index.php"); ?>
