<?php 

var_dump($_SESSION);
if ($_SESSION['droit'] == 1)
{?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Session examen</h1>

    <table>
			<tr>
				<th>Libéllé Session Examen</th>
				<th>Libéllé Session de Formation</th>
				<th>Date de début</th>
                <th>Date de fin</th>
			</tr>
            <?php 
            $tsessionE = Examen_Session_Manager::getListSessionExamens();
            print_r($tsessionE[0]);
            for ($i = 0; $i<count($tsessionE); $i++){
    echo 
    '<tr>
                
    <td>'. $tsessionE[$i]['Libéllé_Session_Examen'] . '</td>
    <td>'. $tsessionE[$i]['Libéllé_Session_de_Formation'].'</td>
    <td>'. $tsessionE[$i]['Date_Début'].'</td>
    <td>'. $tsessionE[$i]['Date_Fin'].'</td>
    
    <td><form action="controlleurSF.class.php?action=delSessionForm" method="post">
    <button type="submit" name="action" value="delSessionForm">Supprimer</button>
   
    </form></td>
    <td><form action="index.php?action=modSessionForm" method="post">
    <button type="submit" name="action" value="modSessionForm">Modifier</button></form>
    

            
    </td>
</tr>';
     }?>
            
           
        </table>
</body>
</html>
<?php }
else header("Location: Index.php"); ?>