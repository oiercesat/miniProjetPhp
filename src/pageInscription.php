<?php
    if (isset($_GET['erreur'])){
        $erreur = $_GET['erreur'];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Inscription</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles/pagesLoginInscriptions.scss">
    </head>
    <body>
        <article>
            <h1>Inscription</h1>
            <form action="scripts/utilisateur/ajoutUtilisateur.php" method="POST">
                <input type="text" name="id" placeholder="Identifiant">
                <label>Mot de passe de plus de 4 caracteres</label>
                <input type="password" name="password" placeholder="Mot de passe ">
                <input type="password" name="password2" placeholder="Mot de passe x2 ">
                <?php
                    if (isset($erreur)){
                        echo "<p class='erreur'>Erreur : $erreur</p>";
                    }
                ?>
                <input type="submit" value="Connexion" id="submit">
            </form>
        </article>
    </body>
</html>