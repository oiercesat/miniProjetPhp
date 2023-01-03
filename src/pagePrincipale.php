<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Albums</title>
        <meta name="description" content="Page principale avec chaque album">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles/pagePrincipale.css">
        <script src="scripts/modifPanier.js" async defer></script>
        
    </head>
    <body>
        <header>
            <h1>Albums</h1>
        </header>
        <main>
            <?php
                session_start();        //A SUPPRIMER, LA SESSION DOIT ETRE LANCEE DPEUIS LA PAGE DE LOGIN
                $_SESSION["cc"] = "Nico";

                $nbImages = count(glob("img/pochettes/*"));
                $bdd = json_decode(file_get_contents("datas/bdd.json"));
                /**@warning retirer "Nico"*/
                $panier = $bdd->{"utilisateurs"}->{"Nico"}->{"panier"};

                $html = '<section id="zoneCD">';            
                for ($i=0; $i < $nbImages; $i++) { 
                    $cdCourant = $bdd->{"cd"}[$i];
                    
                    //Recherche du nombre d article de ce type dans le panier
                    $k = 0;                                 //Indice courant de recherche
                    $nbDansPanier = 0;                      //Nombre d occurences
                    $taillePanier = count($panier);
                    while ($k != $taillePanier) {
                        if ($panier[$k] == $i){
                            //L indice pointe sur l element recherche
                            $nbDansPanier += 1;
                        }
                        $k += 1;
                    }
                    
                    $html .= '<article id='.$i.'>';
                    $html .= '<img src=scripts/generateurCD.php?cheminImage='.$cdCourant->{"image"}.'>';                  
                    $html .= '<h2>'.$cdCourant->{"titre"}."</h2>";
                    $html .= '<p>'.$cdCourant->{"auteur_groupe"}."</p>";
                    $html .= '<section class="zoneAjoutPanier">';
                    $html .= '<button class="btnAjouterPanier btnPanier" >+</button>';    
                    $html .= '<p class="nbArticlesPanier">'.$nbDansPanier.'</p>';
                    $html .= '<button class="btnRetirerPanier btnPanier" >-</button>';    
                    $html .= '</section></article>';
                }                
                $html .= '</section>';
                echo $html;
            ?>

            <nav id="zoneValidationPanier">
                <a id="bValidationPanier" href="panier.php">Valider le panier</a>
            </nav>

            
        </main>
        <footer>

        </footer>
    </body>
</html>