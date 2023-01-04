<?php
session_start();
$dateValide = new DateTime('now');
$dateValide->modify('+3 month');
$dateValide->format('Y-m-d');
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./../styles/scriptPaiement.css">
</head>

<body>
    <?php
    if (isset($_POST['nb_carte']) && isset($_POST['date'])) {
        $dateSaisie= new DateTime($_POST['date']);
        if (strlen($_POST['nb_carte']) == 16 && substr($_POST['nb_carte'],0,4) == substr($_POST['nb_carte'],12,4) && $dateSaisie >= $dateValide) {
            echo "<h1>Paiement effectué</h1>";
            echo "<a href='viderPanier.php'>Retour à l'accueil</a>";

        } else {
            header("Location: ./../pagePaiement.php");
        }
    } else {
        header("Location: ./../pagePaiement.php");
    }
    ?>
</body>

</html>