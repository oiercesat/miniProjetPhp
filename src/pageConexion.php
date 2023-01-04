<?php
    if (isset($_GET['erreur'])) {
        $erreur = $_GET['erreur'];
    }
    ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/pagesLoginInscriptions.scss">
    <title>Connexion</title>
</head>
<body>
    <article>
        <h1>Connectez-vous</h1>
        <form action="scripts/utilisateur/ajouterUtilisateur.php" method="POST">
            <input type="text" name="id" placeholder="Votre id">
            <?php
            if (isset($erreur)) {
                echo "<p class='erreur'>$erreur</p>";
            }
            ?>
            <input type="password" name="password" placeholder="Votre Mot de passe ">
            <?php
            if (isset($erreur)) {
                echo "<p class='erreur'>$erreur</p>";
            }
            ?>
            <a href="pageInscription.php">S'inscrire</a>
            <input type="submit" value="Connexion" id="submit">
        </form>
    </article>
</body>

</html>