<?php 
if ($_SESSION['droit'] == 1)
{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher Formateur</title>
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
<?php $tSessForma = Formation_Session_Manager::getListSessionFormations();?>
        <?php 
            $paramNom = $_POST['seekNom'];
            $tFormateurs = FormateurMgr::getFormateursByName($paramNom);
            if (empty($tFormateurs)) {
                echo 
                    '<div class="ERR">Oups... Malheureusement, la recherche n\'a rien donné... :\'( </div>';
            } else {?>
<!--Affichage tableau liste complète des formateurs-->
    <div id="affichage">
        <table>                  
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Métier</th>        
                    <th>Mail</th>
                </tr>
<!--Génération tableau dynamique en PHP-->
            <?php
                    for ($i = 0; $i<count($tFormateurs); $i++) {
                        echo  
                        '<tr>
                            <td>'. $tFormateurs[$i]['Nom'] . '</td>
                            <td>'. $tFormateurs[$i]['Prénom'].'</td>
                            <td>'. $tFormateurs[$i]['Libéllé_Métier'].'</td>
                            <td>'. $tFormateurs[$i]['Mail'].'</td>
                            <td>
                                <form action="controlleurFormateurs.php?action=modifierFormateur" method="post">
                                        <button type="submit" name="action" value="modifierFormateur">Modifier</button>
                                    <input type="hidden" name="idFormateur" value="'. $tFormateurs[$i]['ID_Formateur'].'">
                                    <input type="hidden" name="nomContact" value="'. $tFormateurs[$i]['Nom'].'">
                                    <input type="hidden" name="prenomContact" value="'. $tFormateurs[$i]['Prénom'].'">
                                    <input type="hidden" name="idContact" value="'. $tFormateurs[$i]['ID_Contact'].'">
                                    <input type="hidden" name="adresseContact" value="'. $tFormateurs[$i]['Adresse'].'">
                                    <input type="hidden" name="telContact" value="'. $tFormateurs[$i]['Téléphone'].'">
                                    <input type="hidden" name="portContact" value="'. $tFormateurs[$i]['Portable'].'"> 
                                    <input type="hidden" name="oldMailContact" value="'.$tFormateurs[$i]['Mail'].'">  
                                    <input type="hidden" name="mailContact" value="'.$tFormateurs[$i]['Mail'].'">                      
                                </form>
                            </td>';
                            $bFormaExist = false;
                        for ($j = 0; $j<count($tSessForma); $j++ ) {
                            if (($tFormateurs[$i]['ID_Formateur'] == $tSessForma[$j]['ID_Formateur'])) {
                                $bFormaExist = true;      
                                break;
                            }
                        }       
                        if ($bFormaExist == false) {
                            echo    
                                '<td>
                                    <form action="controlleurFormateurs.php?action=deleteFormateur" method="post">
                                        <button type="submit" name="action" value="deleteFormateur" >Supprimer</button>
                                        <input type="hidden" name="idFormateur" value="'. $tFormateurs[$i]['ID_Formateur'].'">
                                        <input type="hidden" name="NomFormateur" value="'. $tFormateurs[$i]['Nom'].'">
                                        <input type="hidden" name="PrenomFormateur" value="'. $tFormateurs[$i]['Prénom'].'">
                                        <input type="hidden" name="LibMetier" value="'. $tFormateurs[$i]['Libéllé_Métier'].'">
                                        <input type="hidden" name="adresseContact" value="'. $tFormateurs[$i]['Adresse'].'">
                                        <input type="hidden" name="telContact" value="'. $tFormateurs[$i]['Téléphone'].'">
                                        <input type="hidden" name="portContact" value="'. $tFormateurs[$i]['Portable'].'">
                                    </form>
                                </td>
                            </tr>';  
                        } 
                    } 
                }
            ?>
        </table>
    </div>    
</body>
</html>
<?php }
else header("Location: Index.php"); ?>