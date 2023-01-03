<?php

$bdd= json_decode(file_get_contents("./../datas/bdd.json"));
$utilisateurs = $bdd->{"utilisateurs"};

if (isset($_POST['id']) && isset($_POST['password'])) {    
    foreach ($utilisateurs as $utilisateur) {
        if ($utilisateur->{"id"} == $_POST['id'] && $utilisateur->{"pass"} == $_POST['password']) {
            session_start();
            $_SESSION["id"] = $_POST['id'];
            header("Location: ./../pagePrincipale.php");
            exit();
        }
    }
    
    header("Location: ./../../index.html");
    exit();

}

else {
    header("Location: ./../../index.html");
    exit();
}


