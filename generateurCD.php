<?php
    define("larg_vign", 200);
    define("long_vign", 200);

    header("Content-type: image/jpeg");   
    $image = imageCreate(larg_vign, long_vign);
    // $image = imagecreatefromjpeg('img/pochettes/dark_bear.jpeg');       //$_GET["cheminImage"]
    // $imgReduite = imagecreatetruecolor(larg_vign, long_vign);
    // imageCopyResized($image, $imgReduite, 0,0,0,0, larg_vign, long_vign);
    $couleur = ImageColorAllocate($image,255,0,0);
    imagefill($image,larg_vign,long_vign,$couleur);
    imagejpeg($image);
    imagedestroy($image);
?>