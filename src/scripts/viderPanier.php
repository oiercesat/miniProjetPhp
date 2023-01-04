<?php
    //id : identifiant de l'utilisateur dont on doit supprimer le panier
    echo $_GET["id"];
    if (isset($_GET["id"])){
        $lienDonnees = "../datas/bdd.json";
        $bdd = json_decode(file_get_contents($lienDonnees));
        $bdd->{"utilisateurs"}->{$_GET["id"]}->{"panier"} = array();
        file_put_contents($lienDonnees, json_encode($bdd));
    }
    else{
        echo "Parametre de page non renseigne. On n'a besoins de l'identifiant";
    }

    header("Location: ../pagePrincipale.php");
?>