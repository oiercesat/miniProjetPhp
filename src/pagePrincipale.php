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
            <?php
                // -- Initialisation page --
                session_start();
                if (isset($_SESSION['id'])){
                    // Utilisateur connecte
                    $estConnecte = true; 
                    $user = $_SESSION['id'];    
                }
                else{
                    // Aucun utilisateur connecte
                    $estConnecte = false; 
                    $user = null;
                }
               
                // -- zone login + supprimer panier --
                $html = '<section id="zoneLogin">';
                if ($estConnecte){
                    // Utilisateur connecte   
                    $html .= "<a id='btnInscription' href='scripts/deconnect.php'>Se déconnecter</a>";
                    $html .= '</section>';
                    $html .= '<a id="viderPanier" href="scripts/viderPanier.php?id='.$user.'">Vider panier</a>';
                }
                else{
                    // Aucun utilisateur connecte
                    $html .= "<a id='btnInscription' href='pageInscription.html'>S'inscrire</a>";
                    $html .= "<a id='btnInscription' href='../index.html'>Se login</a>";
                    $html .= '</section>';
                }
                
                

                echo $html;
            ?>
            <h1>Albums</h1>
        </header>
        <main>
            <?php
                $bdd = json_decode(file_get_contents("datas/bdd.json"));
                $html = '';
                if ($estConnecte)
                {
                    $panier = $bdd->{"utilisateurs"}->{$user}->{"panier"};
                }

                $nbImages = count(glob("img/pochettes/*"));
                $html .= '<section id="zoneCD">';            
                for ($i=0; $i < $nbImages; $i++) { 
                    //Pour chaque image
                    $cdCourant = $bdd->{"cd"}[$i];
                    
                    //Recherche du nombre d article de ce type dans le panier
                    $nbDansPanier = 0;                      //Nombre d occurences

                    if ($user != null)
                    {
                        //Si aucun utilisateur n est connecte
                        $k = 0;                                 //Indice courant de recherche
                        $taillePanier = count($panier);
                        while ($k != $taillePanier) {
                            if ($panier[$k] == $i){
                                //L indice pointe sur l element recherche
                                $nbDansPanier += 1;
                            }
                            $k += 1;
                        }
                    }
                    
                    
                    $html .= '<article id='.$i.'>';
                    $html .= '<img src=scripts/generateurCD.php?cheminImage='.$cdCourant->{"image"}.'>';                  
                    $html .= '<h2>'.$cdCourant->{"titre"}."</h2>";
                    $html .= '<p>'.$cdCourant->{"auteur_groupe"}."</p>";
                    $html .= '<section class="zoneAjoutPanier">';
                    if ($user != null){
                        $html .= '<button class="btnAjouterPanier btnPanier" >+</button>';    
                        $html .= '<p class="nbArticlesPanier">'.$nbDansPanier.'</p>';
                        $html .= '<button class="btnRetirerPanier btnPanier" >-</button>';   
                    }
                    $html .= '</section></article>';
                }
                $html .= '</section>';                
                
                // BOUTON VALIDER PANIER
                $html .= '<nav id="zoneValidationPanier">';
                if ($estConnecte){
                    $html .= '<a id="bValidationPanier" href="panier.php">Valider le panier</a>';
                }
                $html .= '</nav>';
            
                echo $html;
            ?>

            
        </main>
        <footer>

        </footer>
    </body>
</html>