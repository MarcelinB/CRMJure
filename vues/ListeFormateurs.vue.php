<?php 
if ($_SESSION['droit'] == 1)
{?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/formateurs_style.css">
    <title>Gestion Formateurs</title>
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
        <button type="submit" name="action" value="afficheSessionForm" id="btn">Formation</button></a></form>
        </form>
        <form action="../vues/Examens.vue.php" method="POST">
            <button type="submit" value="Examens" id="btn">Examens</button>
        </form>
        <form action="../vues/Jures.vue.php" method="POST">
            <button type="submit" value="Jurés" id="btn">Jurés</button>
        </form>
    </div>

<!--Formulaire champ de saisie recherche par nom-->
    <div class="rechercheParNom">
        <form action="controlleurFormateurs.php?action=rechercherFormateur" method="POST">
            <div>
                <label for="inputSeekNom">Rechercher un/des formateurs par nom :</label>
            </div>
            <div class="barreEtBouton">
                <input type="text" placeholder="ex : Dupuy" name="seekNom" id="inputSeekNom">
                <button type="submit" name="action" value="rechercherFormateur" id="BtnRecherche">- Rechercher -</button>
            </div>           
        </form>
    </div>
<!--Affichage tableau liste complète des formateurs-->
    <div id="affichage">
        <table>           
                <form action="controlleurFormateurs.php?action=ajouterFormateur" method="POST">              
                    <label for="btnAjouter" id="LabelAjouterFormateur">Cliquez pour ajouter un formateur</label>              
                    <button type="submit" name="action" value="ajouterFormateur" id="btnAjouter">Ajouter</button>
                </form>           
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Métier</th>        
                    <th>Mail</th>
                </tr>
                <?php $tSessForma = Formation_Session_Manager::getListSessionFormations();?>
<!--Génération tableau dynamique en PHP-->
                <?php 
                $tFormateurs = FormateurMgr::getListFormateurs();
                for ($i = 0 ; $i<count($tFormateurs) ; $i++) {
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
                                <input type="hidden" name="idContact" value="'. $tFormateurs[$i]['ID_Contact'].'">
                                <input type="hidden" name="nomContact" value="'. $tFormateurs[$i]['Nom'].'">
                                <input type="hidden" name="prenomContact" value="'. $tFormateurs[$i]['Prénom'].'">
                                <input type="hidden" name="adresseContact" value="'. $tFormateurs[$i]['Adresse'].'">
                                <input type="hidden" name="telContact" value="'. $tFormateurs[$i]['Téléphone'].'">
                                <input type="hidden" name="portContact" value="'. $tFormateurs[$i]['Portable'].'">    
                                <input type="hidden" name="mailContact" value="'. $tFormateurs[$i]['Mail'].'"> 
                                <input type="hidden" name="oldMailContact" value="'. $tFormateurs[$i]['Mail'].'"> 
                                <input type="hidden" name="libMetier" value="'. $tFormateurs[$i]['Libéllé_Métier'].'">                  
                            </form>
                        </td>';
                        $bFormaExist = false;
                    for ($j = 0 ; $j<count($tSessForma) ; $j++ ) {
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
                ?>
            </table>
        </div>
</body>
</html>
<?php }
else header("Location: Index.php"); ?>