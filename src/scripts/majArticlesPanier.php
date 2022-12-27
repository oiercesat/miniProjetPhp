<?php
/**
 * @brief Script ajoutant ou supprimant un element de la base de donnee (bdd.json)
 * @param id numero de l image dans la bdd 
 * @param action add ou remove en fonction de ce qu on veut faire
 */
// echo $_POST["id"]."   ".$_POST["action"];
    if (isset($_POST["id"]) && isset($_POST["action"]))
    {
        //Si les deux parametres sont bien definis
        $lienDonnees = "../datas/bdd.json";
        $bdd = json_decode(file_get_contents($lienDonnees));
        $idArticle = (int)$_POST["id"];
        $action = $_POST["action"];
        /** @warning Il faut retirer "Nico" et faire marrcher les variables de session*/
        $utilisateur = "Nico"; //$_SESSION["user"];

        $success = true;
        if ($action == "add")
        {
            //Simple ajout et tri
            array_push($bdd->{"utilisateurs"}->{$utilisateur}->{"panier"}, $idArticle);
            sort($bdd->{"utilisateurs"}->{$utilisateur}->{"panier"});
        }
        else if ($action == "remove")
        {
            //Recherche de l article
            $emplacementArticle =  array_search($idArticle, $bdd->{"utilisateurs"}->{$utilisateur}->{"panier"});
            if ($emplacementArticle !== false)
            {
                //Si l article existe suppression puis tri
                unset($bdd->{"utilisateurs"}->{$utilisateur}->{"panier"}[$emplacementArticle]);
                sort($bdd->{"utilisateurs"}->{$utilisateur}->{"panier"});
            }
            else
            {
                $success = false;
            }
        }
        
        $newFile = json_encode($bdd);
        file_put_contents($lienDonnees, $newFile);

        $rep = ["success" => $success];
        echo json_encode($rep);
    }
    /** @warning Lien non dynamique */
    // header("Location: http://localhost/PROGRAMMATION/HTML_CSS_PHP_JS/PHP/TP8-9/miniProjetPhp/src/pagePrincipale.php");
?>