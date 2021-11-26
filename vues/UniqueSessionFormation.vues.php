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
    <title>Document</title>
</head>
<body>
<header class="HEADER">
        <h1>Formations</h1>
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
    <center><form action="../controlleur/controlleurSF.class.php?rechercher" method="post">
            <input type="text" name="recherche" id=""> Rechercher une session de formation
            <button type="submit" name="action" value="rechercher">Rechercher</button>
        </form></div></center>
    <center><div><form action="" method="post"><button type="submit" name="" value="">AJouter</button></form></div></center>
    <center><div>
    <div id ='Affichage'>
    <center><table>
			<tr>
				<th>Nom de la session</th>
				<th>Titre Formation</th>
				<th>Formateur</th>
                
                <th>Date début formation</th>
                <th>Date fin formation</th>
			</tr>
            <?php

                $id = ($_POST['recherche']);
                // echo $id;
                
                $info = Formation_Session_Manager::getSessionByName($id);
                // var_dump($info);
                for ($i = 0; $i<count($info); $i++){
                echo    '<tr>
                                    
                    <td>'. $info[$i]['Libéllé_Session_de_Formation'] . '</td>
                    <td>'.  $info[$i]['Libéllé_Formation'].'</td>
                    <td>'.  $info[$i]['Prénom'].$info[$i]['Nom'].'</td>

                    <td>'.  $info[$i]['date_debut'].'</td>
                    <td>'.  $info[$i]['date_fin'].'</td>';
                    if ($info[$i]['date_fin']>date('Y-m-d')){
                        echo
                    '
                    <td><form action="controlleurSF.class.php?action=modSessionForm" method="post">
                    <input type="hidden" name="Libéllé_Session_de_Formation" value="'. $info[$i]['Libéllé_Session_de_Formation'].'">
                    <input type="hidden" name="libsession" value="'.  $info[$i]['Libéllé_Formation'].'">
                    <input type="hidden" name="presession" value="'.  $info[$i]['Prénom'].'">
                    <input type="hidden" name="nomsession" value="'.  $info[$i]['Nom'].'">
                    <input type="hidden" name="datedeb" value="'.  $info[$i]['date_debut'].'">
                    <input type="hidden" name="datefin" value="'. $info[$i]['date_fin'].'">
                    <button type="submit" name="action" value="modSessionForm">Modifier</button> </form></td>';
                    if ($info[$i]['date_debut']>date('Y-m-d')){ echo
                    '<td><form action="controlleurSF.class.php?action=delSessionForm" method="post">
                    <input type="hidden" name="libsession" value="'.  $info[$i]['Libéllé_Formation'].'">
                    <input type="hidden" name="presession" value="'.  $info[$i]['Prénom'].'">
                    <input type="hidden" name="nomsession" value="'.  $info[$i]['Nom'].'">
                    <button type="submit" name="action" value="delSessionForm">Supprimer</button>
                    </form></td>
                    
                    
                            
                    
                    </tr>';
                    }
                }
                }
            ?>
    </table></center>
    
  
</body>
</html>
<?php }
else header("Location: Index.php"); ?>