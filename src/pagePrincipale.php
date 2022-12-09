<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Albums</title>
        <meta name="description" content="Page principale avec chaque album">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles/stylePagePrincipale.css">
    </head>
    <body>
        <header>
            <h1>Albums</h1>
        </header>
        <main>
            <?php
                $nbImages = count(glob("img/pochettes/*" ));
                $bdd = json_decode(file_get_contents("datas/bdd.json"));

                $html = '<section id="containerZoneCD"><section id="zoneCD">';            
                for ($i=0; $i < $nbImages; $i++) { 
                    $cdCourant = $bdd->{"cd"}[$i];
                    $html .= '<article>';
                    $html .= '<img src=scripts/generateurCD.php?cheminImage='.$cdCourant->{"image"}.'>';                  
                    $html .= '<h2>'.$cdCourant->{"titre"}."</h2>";
                    $html .= '<p>'.$cdCourant->{"auteur_groupe"}."</p>";
                    $html .= '</article>';
                }                
                $html .= '</section></section>';

                echo $html;
            ?>
        </main>
        <footer>

        </footer>
    </body>
</html>