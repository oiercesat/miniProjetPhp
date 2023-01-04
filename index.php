<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Albums</title>
        <meta name="description" content="Page principale avec chaque album">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="src/styles/index.css">
        <script src="src/scripts/panier/modifPanier.js" async defer></script>
        
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
                }
                
                $html = "";
                
                if ($estConnecte){
                    // Utilisateur connecte   
                    $html .= '<section id="zoneLogin">';
                    $html .=    "<a id='btnDeconexion' href='src/scripts/utilisateur/deconnect.php'>Se déconnecter</a>";
                    $html .= '</section>';
                    $html .= "<h1>Albums</h1>";
                    $html .= '<section id="zoneDroite">';
                    $html .=    '<a id="btnAjouterCd" href="src/pageAjoutCD.php">Ajouter un CD</a>';
                    $html .=    '<section id="zonePanier">';
                    $html .=       '<a id="btnViderPanier" href="src/scripts/panier/viderPanier.php?id='.$user.'">Vider panier</a>';
                    $html .=       '<a id="btnValidationPanier" href="src/pagePanier.php">Valider le panier</a>';
                    $html .=    '</section>';
                    $html .= '</section">';
                }
                else{
                    // Aucun utilisateur connecte
                    $html .= '<section id="zoneLogin">';
                    $html .=    "<a id='btnConexion' href='src/pageConexion.php'>Se connecter</a>";
                    $html .= '</section>';
                    $html .= "<h1>Albums</h1>";
                    $html .= '<section id="zonePanier"></section>';
                }

                echo $html;
            ?>
        </header>
        <main>
            <?php
                $bdd = json_decode(file_get_contents("src/datas/bdd.json"));
                $html = '';
                if ($estConnecte)
                {
                    $panier = $bdd->{"utilisateurs"}->{$user}->{"panier"};
                }

                $nbImages = count($bdd->{"cd"});
                $html .= '<section id="zoneCD">';     
                for ($i=0; $i < $nbImages; $i++) { 
                    //Pour chaque image
                    $cdCourant = $bdd->{"cd"}[$i];
                    
                    //Recherche du nombre d article de ce type dans le panier
                    $nbDansPanier = 0;                      //Nombre d occurences

                    if ($estConnecte)
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
                    $html .= '<img src=src/scripts/generateurCD.php?nomImage='.$cdCourant->{"nom_image"}.'>';
                    $html .= '<h2>'.$cdCourant->{"titre"}."</h2>";
                    $html .= '<p>'.$cdCourant->{"auteur_groupe"}."</p>";
                    $html .= '<section class="zoneAjoutPanier">';
                    if ($estConnecte){
                        $html .= '<button class="btnAjouterPanier btnPanier" >+</button>';
                        $html .= '<p class="nbArticlesPanier">'.$nbDansPanier.'</p>';
                        $html .= '<button class="btnRetirerPanier btnPanier" >-</button>';
                    }
                    $html .= '</section></article>';
                }
                $html .= '</section>';                
            
                echo $html;
            ?>            
        </main>
    </body>
</html>