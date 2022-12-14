<?php
    if (isset($_GET["id"]) and isset($_GET["action"]))
    {
        $lienDonnees = "../datas/bdd.json";
        $bdd = json_decode(file_get_contents($lienDonnees));
        $idArticle = strval($_GET["id"]);
        $action = $_GET["action"];
        $utilisateur = "Nico"; //$_SESSION["user"];

        if ($action == "add")
        {   
            //Simple ajout et tri
            array_push($bdd->{"utilisateurs"}->{$utilisateur}->{"panier"}, $idArticle);
            sort($bdd->{"utilisateurs"}->{$utilisateur}->{"panier"});
        }
        else if ($action == "supp")
        {
            //Recherche de l article
            $emplacementArticle =  array_search($idArticle, $bdd->{"utilisateurs"}->{$utilisateur}->{"panier"});
            echo $emplacementArticle;
            if ($emplacementArticle == false)
            {
                //Si l article existe suppression puis tri
                unset($bdd->{"utilisateurs"}->{$utilisateur}->{"panier"}[$emplacementArticle]);
                sort($bdd->{"utilisateurs"}->{$utilisateur}->{"panier"});
            }
        }

        $newFile = json_encode($bdd);
        file_put_contents($lienDonnees, $newFile);
    }
    header("Location: http://localhost/PROGRAMMATION/HTML_CSS_PHP_JS/PHP/TP8-9/miniProjetPhp/src/pagePrincipale.php");
    // echo "coucou";
    
?>