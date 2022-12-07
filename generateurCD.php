<?php
    define("larg_vign", 200);
    define("long_vign", 200);

    header('Content-Type: image/jpeg');
    $ficName = "http://localhost/HTML_CSS_PHP_JS/PHP/TP8-9/miniProjetPhp/img/pochettes/mockup.jpeg";
    $image=imagecreatefromjpeg($ficName);      //$_GET["num_disque"]
    // $imgReduite = imagecreatetruecolor(larg_vign, long_vign);
    // imageCopyResized($image, $imgReduite, 0,0,0,0, larg_vign, long_vign);

    // echo $image;
    // $image = imagecreate(larg_vign, long_fen);
    // imagefill($image,100,100,ImageColorAllocate($image,255,0,0));
    imagejpeg($image);
    imagedestroy($image);
?>