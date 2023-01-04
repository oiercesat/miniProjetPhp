<?php
$bdd= json_decode(file_get_contents("../../datas/bdd.json"));
$utilisateurs = $bdd->{"utilisateurs"};

if (isset($_POST['id']) && isset($_POST['password'])) {    
    foreach ($utilisateurs as $utilisateur => $informations) {
        if ($utilisateur == $_POST['id'] && $informations->{"pass"} == $_POST['password']) {
            session_start();
            $_SESSION["id"] = $_POST['id'];
            header("Location: ../../../index.php");
            exit();
        }
    }
    
    header("Location: ../../pageConexion.php?erreur=Identifiant ou mot de passe incorrect");
    exit();

}

else {
    header("Location: ../../pageConexion.php?erreur=Parametre de page non renseigne. On n'a besoins de l'identifiant et du mot de passe");
    exit();
}


?>