<?php
    define("larg_vign", 150);
    define("long_vign", 150);

    header("Content-type: image/png");
    $src = '../'.$_GET["cheminImage"];
    $image = imagecreatefrompng($src);
    $imgReduite = imagecreatetruecolor(larg_vign, long_vign);
    $ancienneDimensions = getimagesize($src);
    imageCopyResized($imgReduite, $image, 0,0,0,0, larg_vign, long_vign, $ancienneDimensions[0], $ancienneDimensions[1]);
    
    imagepng($imgReduite);
    imagedestroy($imgage);
    imagedestroy($imgReduite);
?>