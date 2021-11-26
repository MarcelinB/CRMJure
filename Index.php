<?php
$_POST['identifiant'] = '';
$_POST['mdp'] = '';


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/login_style.css">
    <title>Connexion</title>
</head>
<body>
    <br/>
    <br/>
    <div class="PAGE-TITLE">
        <h1>BONJOUR</h1>
    </div>

    <br/>
    <div class="FORM">
        <div class="LOGIN-FORM">
            <form method="POST" action="controlleur\controlleurLogin.class.php" class="LOGIN">
                <div class="formTitle">
                    <p>Veuillez vous connecter : </p>
                </div>
                <br />

                <div class="inputLabel">
                    <label for="userId">Identifiant :</label>
                </div>
                <br />

                <div class="inputText">
                    <input required placeholder="Saisissez votre identifiant" type="text" name="identifiant" id="userId">
                </div>
                <br />
                <div class="inputLabel">
                    <label for="userPassword">Mot de passe :</label>
                </div>
                <br />

                <div class="inputText">
                    <input required placeholder="Saisissez votre mot de passe" type="password" name="mdp" id="userPassword">
                </div>
                <br />
                <div class="btnSubmit">
                    <input type="submit" value="SE CONNECTER" id="btnSubmit">
                </div>
            </form>
        </div>
    </div>

</body>
</html>