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
            <h1>Albums</h1>
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
                    $html .= "<a id='btnInscription' href='src/scripts/utilisateur/deconnect.php'>Se déconnecter</a>";
                    $html .= '<a id="viderPanier" href="src/scripts/panier/viderPanier.php?id='.$user.'">Vider panier</a>';
                    $html .= '<a id="bValidationPanier" href="src/pagePanier.php">Valider le panier</a>';
                    $html .= '</section>';
                }
                else{
                    // Aucun utilisateur connecte
                    $html .= "<a id='btnInscription' href='src/pageInscription.html'>S'inscrire</a>";
                    $html .= "<a id='btnInscription' href='src/pageConexion.html'>Se connecter</a>";
                    $html .= '</section>';
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

                $nbImages = count(glob("src/datas/img/pochettes/*"));
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
                    $html .= '<img src=src/scripts/generateurCD.php?nomImage='.$cdCourant->{"nom_image"}.'>';
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
                
            
                echo $html;
            ?>

            
        </main>
        <footer>

        </footer>
    </body>
</html>