<?php
    define("larg_vign", 200);
    define("long_vign", 200);

    header('Content-type: image/jpeg');   
    // $image = imagecreatefromjpeg('img/pochettes/dark_bear.jpeg');       //$_GET["cheminImage"]
    // $imgReduite = imagecreatetruecolor(larg_vign, long_vign);
    // imageCopyResized($image, $imgReduite, 0,0,0,0, larg_vign, long_vign);

    $image = imagecreate(larg_vign, long_fen);
    imagefill($image,100,100,ImageColorAllocate($image,255,0,0));

    imagejpeg($image);
    imagedestroy($image);
?>