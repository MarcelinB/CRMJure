<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examens</title>
    <link rel="stylesheet" href="../assets/examens_style.css">
</head>
<body>
<header class="HEADER">
        <h1>EXAMENS // Page en construction !</h1>
    </header>
    <div class="CONNECTED-AS">

                <center><a href="../class/deco.php">Déconnexion</a></center>
    </div>

    <div class="CHOICES">
        <form action="../Acceuil.php" method="POST">
            <button type="submit" name="action" value="Accueil" id="btn">Accueil</button>
        </form>
        <form action="../controlleur\controlleurSF.class.php" method="post">
        <button type="submit" name="action" value="afficheSessionForm" id="btn">Formation</button></a></form>
        </form>
        <form action="../controlleur/controlleurFormateurs.php" method="POST">
            <button type="submit" name="action" value="afficheListeFormateurs" id="btn">Formateurs</button>
        </form>
        <form action="../vues/Jures.vue.php" method="POST">
            <button type="submit" value="Jurés" id="btn">Jurés</button>
        </form>
    </div>
</body>
</html>