<?php 
// var_dump($_SESSION);
if (isset($_SESSION['droit'])){
    if ($_SESSION['droit'] == 1)
        {?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../assets\formations_style.css">
            <title>Document</title>
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





            <center><form action="../controlleur/controlleurSF.class.php?rechercher" method="post">
                    <input type="text" name="recherche" id=""> Rechercher une session de formation
                    <button type="submit" name="action" value="rechercher">Rechercher</button>
                </form></div></center>
            <center><div><form action="../controlleur/controlleurSF.class.php?action=ajouter" method="post">
                    <button type="submit" name="action" value="ajouter">AJouter</button></form></div></center>
            <center><div id="affichage">
            <table>
                    <tr>
                        <th>Nom de la session</th>
                        <th>Titre Formation</th>
                        <th>Formateur</th>
                        
                        <th>Date début formation</th>
                        <th>Date fin formation</th>
                    </tr>
                    <?php 
                    $tsessionF = Formation_Session_Manager::getListSessionFormations();
                    // print_r($tsessionF[0]);
                    for ($i = 0; $i<count($tsessionF); $i++){
            echo 
                    
                        '<tr>
                        
                            <td>'. $tsessionF[$i]['Libéllé_Session_de_Formation'] . '</td>
                            <td>'. $tsessionF[$i]['Libéllé_Formation'].'</td>
                            <td>'. $tsessionF[$i]['Prénom'].$tsessionF[$i]['Nom'].'</td>
                            
                            <td>'. $tsessionF[$i]['date_debut'].'</td>
                            <td>'. $tsessionF[$i]['date_fin'].'</td>';
                            if ($tsessionF[$i]['date_fin']>date('Y-m-d')){
                echo        '<td><form action="controlleurSF.class.php?action=modSessionForm" method="post">
                            <input type="hidden" name="idsession" value="'. $tsessionF[$i]['ID_Session'].'">
                            <input type="hidden" name="Libéllé_Session_de_Formation" value="'. $tsessionF[$i]['Libéllé_Session_de_Formation'].'">
                            <input type="hidden" name="libsession" value="'. $tsessionF[$i]['Libéllé_Formation'].'">
                            <input type="hidden" name="presession" value="'. $tsessionF[$i]['Prénom'].'">
                            <input type="hidden" name="nomsession" value="'. $tsessionF[$i]['Nom'].'">
                            <input type="hidden" name="datedeb" value="'. $tsessionF[$i]['date_debut'].'">
                            <input type="hidden" name="datefin" value="'. $tsessionF[$i]['date_fin'].'">
                            <input type="hidden" name="Idformation" value="'. $tsessionF[$i]['ID_Formation'].'">
                            <button type="submit" name="action" value="modSessionForm">Modifier</button> </form>
                            </td>';
                            if ($tsessionF[$i]['date_debut']>date('Y-m-d')){ echo
                            '<td><form action="controlleurSF.class.php?action=delSessionForm" method="post">
                            <input type="hidden" name="idsession" value="'. $tsessionF[$i]['ID_Session'].'">
                            <input type="hidden" name="libsession" value="'. $tsessionF[$i]['Libéllé_Formation'].'">
                            <input type="hidden" name="presession" value="'. $tsessionF[$i]['Prénom'].'">
                            <input type="hidden" name="nomsession" value="'. $tsessionF[$i]['Nom'].'">
                            <button type="submit" name="action" value="delSessionForm">Supprimer</button>
                            </form></td>
                            
                        </tr>';
                            }
                            }
                    }
                    ?>
                </table>
                </div></center>
        </body>
        </html>
        <?php }
    else header("Location: Index.php"); 
}
else header("Location: Index.php"); ?>                         
                    