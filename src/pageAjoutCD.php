<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/pagesLoginInscriptions.scss">
    <title>Ajout CD</title>
</head>
<body>
    <a href="../index.php">Page principale</a>
    <article>
        <h1>Votre album</h1>
        <form action="pageAjoutCD.php" method="POST" enctype= multipart/form-data>
            <?php
                //Sauvegarde des valeurs entrees lors du dernier submit
                if (isset($_POST["genre"])) $genre = $_POST["genre"]; else $genre = "";
                if (isset($_POST["nom"])) $nom = $_POST["nom"]; else $nom = "";
                if (isset($_POST["auteur"])) $auteur = $_POST["auteur"]; else $auteur = "";
                if (isset($_POST["prix"])) $prix = $_POST["prix"]; else $prix = "";
                if ($_FILES["image"]["name"] != "") $image = $_FILES["image"]; else $image = null;

                $html = '';

                //Verification saisies
                $infosValides = ($genre != "" and  $nom != "" and $auteur != "" and $prix != "" and $image != null);

                if ($infosValides){
                    $imageValide = ($image["type"] == "image/png");
                    if ($imageValide)
                    {
                        //Ajout de l album dans la bdd
                        $lienDonnees = "datas/bdd.json";
                        $bdd = json_decode(file_get_contents($lienDonnees));
                        array_push($bdd->{"cd"}, array("genre"=>$genre,"titre"=>$nom,"auteur_groupe"=>$auteur,"prix"=>intval($prix),"nom_image"=>$image["name"]));
                        file_put_contents($lienDonnees, json_encode($bdd));

                        //Fabrication de la photo
                        $emplacement = $image['tmp_name'];
                        $destination = 'datas/img/pochettes/'.$image['name'];
                        move_uploaded_file($emplacement, $destination);
                        

                        //Remise a 0 des valeurs
                        $genre = "";
                        $nom = "";
                        $auteur = "";
                        $prix = "";
                        $image = null;

                        //Message de validation
                        $html .= '<label>Album bien créé !</label>';
                    }
                }

                //Formulaire
                $html .= '<input type="text" name="genre" placeholder="Genre (Rap,Rock..)" value='.$genre.'>';
                $html .= '<input type="text" name="nom" placeholder="Nom" value='.$nom.'>';
                $html .= '<input type="text" name="auteur" placeholder="Auteur" value='.$auteur.'>';
                $html .= '<input type="number" name="prix" placeholder="Prix (en €)" value='.$prix.'>';
                $html .= '<input type=file name="image">';
                $html .= '<input type="submit" value="Ajouter" id="submit">';

                $champsNonVides = ($genre != "" or  $nom != "" or $auteur != "" or $prix != "" or $image != null);
                if (!$infosValides and $champsNonVides){
                    //S il manque un ou plusieurs champs
                    $html .= "<label>Manque d'information !</label>";
                }
                else if ($champsNonVides){
                    if (!$imageValide){
                        //Le format d image est mauvais
                        $html .= "<label>On n'accepte que les png !</label>";
                    }
                }
                
                

                echo $html;
            ?>
        </form>
    </article>
</body>
</html>