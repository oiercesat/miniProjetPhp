<?php

session_start();
$id = $_SESSION["id"];
$bdd = json_decode(file_get_contents("datas/bdd.json"));
$cd = $bdd->{"cd"};
$panier = $bdd->{"utilisateurs"}->{$id}->{"panier"};
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/pagePanier.css">
    <title>Document</title>
</head>

<body>
    <header>
        <span>Mon panier</span>
        <ul>
            <li>
                <a href="../index.php">Accueil</a>
            </li>
            <li>
                <a href="scripts/utilisateur/deconnect.php">Deconnexion</a>
            </li>
        </ul>
    </header>
    <main>
        <h1>Mon panier</h1>
        <?php

        $cdPanier= array_count_values($panier);

        foreach($cdPanier as $key => $value){
            $quantite = $value;
            $rangCD = $key;
            echo "<article>";
            echo "<img src='datas/img/pochettes/" . $cd[$rangCD]->{"nom_image"} . "'>";
            echo "<section>";
            echo "<h2>Titre : " . $cd[$rangCD]->{"titre"} . "</h2>";
            echo "<h3> Auteur : " . $cd[$rangCD]->{"auteur_groupe"} . "</h3>";
            echo "<p>Prix : " . $cd[$rangCD]->{"prix"} . " €</p>";
            echo "<br>";
            echo "<p>Quantité : " .$quantite . "</p>";
            echo "</section>";
            echo "</article>";
        }
        ?>

        <a href="./pagePaiement.php" id="paiement">Passer au paiement</a>
    </main>
</body>

</html>