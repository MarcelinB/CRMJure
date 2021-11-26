<?php 

if ($_SESSION['droit'] = 2)
{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ceci est la page du formateur !</h1>
    <center><a href="../class/deco.php">Déconnexion</a></center>
</body>
</html>
<?php } 
else header("Location: Index.php"); 
