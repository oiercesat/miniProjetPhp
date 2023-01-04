<?php
    if (isset($_POST['nb_carte']) && isset($_POST['date'])) {
        $_POST=array();
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Paiement</title>
        <meta name="description" content="Page de paiement du disque">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles/pagePaiement.css">
    </head>
    <body>
        <form action="./scripts/paiement.php" method="POST">
            <p>Numéros de carte :</p>
            <input type="number" name="nb_carte" id="nb_carte" placeholder="1234 5678 9101 1121">
            <p>Date d'expiration :</p>
            <input type="date" name="date" id="date">
            <input type="submit" value="Valider">
        </form>


    </body>
</html>