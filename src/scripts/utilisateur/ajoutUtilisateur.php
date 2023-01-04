<?php

    $html = "";

    // -- Si les 3 champs ont bien ete saisis --
    if (isset($_POST["id"]) and isset($_POST["password"]) and isset($_POST["password2"])){
        //Verification mdp > 4 caracteres
        if (strlen($_POST["password"]) >= 4){
            //Verification mots de passes egaux
            if ($_POST["password"] == $_POST["password2"]){
                //Verification identifiant unique
                $utilisateurDejaExistant = false;
                $bdd = json_decode(file_get_contents("../../datas/bdd.json"));
                foreach($bdd->{"utilisateurs"} as $user => $values){
                    if ($user == $_POST["id"]){
                        $utilisateurDejaExistant = true;
                        break;
                    }
                }
                if (!$utilisateurDejaExistant){
                    //ajout de l'utilsateur valide dans la bdd
                    $bdd->{"utilisateurs"}->{$_POST["id"]} = array("pass"=>$_POST["password"], "panier"=>[]);
                    $newFile = json_encode($bdd);
                    file_put_contents("../../datas/bdd.json", $newFile);

                    //Conexion
                    session_start();
                    $_SESSION["id"] = $_POST['id'];
                    header("Location: ../../../index.php");
                }
                else{
                    header("Location: ../../pageInscription.html");
                }
            }
            else{
                header("Location: ../../pageInscription.html");
            }
        }
        else{
            header("Location: ../../pageInscription.html");
        }
    }
    else{
        header("Location: ../../pageInscription.html");
    }
?>