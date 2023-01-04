<?php
    session_start();
    $id=$_SESSION['id'];
    if (isset($id)){
        $lienDonnees = "../datas/bdd.json";
        $bdd = json_decode(file_get_contents($lienDonnees));
        $bdd->{"utilisateurs"}->{$id}->{"panier"} = array();
        file_put_contents($lienDonnees, json_encode($bdd));
    }
    else{
        echo "Parametre de page non renseigne. On n'a besoins de l'identifiant";
    }

    header("Location: ../pagePrincipale.php");
?>