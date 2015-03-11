<?php

$path_skin = "http://skins.minecraft.net/MinecraftSkins/";

$fx = 200;
$fy = $fx*2;
function customimageflip(&$result, &$img, $rx = 0, $ry = 0, $x = 0, $y = 0, $size_x = null, $size_y = null) {
 if ($size_x  < 1) $size_x = imagesx($img);
 if ($size_y  < 1) $size_y = imagesy($img);
 
 imagecopyresampled($result, $img, $rx, $ry, ($x + $size_x-1), $y, $size_x, $size_y, 0-$size_x, $size_y);
}

$way_skif = $_GET['url'];

$skif= getimagesize($way_skif);
$h=$skif['0'];
$w=$skif['1'];
$ratio=$h/64;

/*

mode
1 - перед
2 - задняя часть скина

*/
$mode = $_GET["mode"];

header ("Content-type: image/png");

$way_skin = $_GET['url'];

$skin = imagecreatefrompng($way_skin);

$preview = imagecreatetruecolor(16*$ratio, 32*$ratio);

$transparent = imagecolorallocatealpha($preview, 255, 255, 255, 127);
imagefill($preview, 0, 0, $transparent);

if ($mode == 7) {

imagecopy($preview, $skin, 4*$ratio, 0*$ratio, 8*$ratio, 8*$ratio, 8*$ratio, 8*$ratio);
//arms
imagecopy($preview, $skin, 0*$ratio, 8*$ratio, 44*$ratio, 20*$ratio, 4*$ratio, 12*$ratio);
customimageflip($preview, $skin, 12*$ratio, 8*$ratio, 44*$ratio, 20*$ratio, 4*$ratio, 12*$ratio);
//chest
imagecopy($preview, $skin, 4*$ratio, 8*$ratio, 20*$ratio, 20*$ratio, 8*$ratio, 12*$ratio);
//legs
imagecopy($preview, $skin, 4*$ratio, 20*$ratio, 4*$ratio, 20*$ratio, 4*$ratio, 12*$ratio);
customimageflip($preview, $skin, 8*$ratio, 20*$ratio, 4*$ratio, 20*$ratio, 4*$ratio, 12*$ratio);
//hat
imagecopy($preview, $skin, 4*$ratio, 0*$ratio, 40*$ratio, 8*$ratio, 8*$ratio, 8*$ratio);

} elseif ($mode == 8) {

imagecopy($preview, $skin, 4*$ratio, 8*$ratio, 32*$ratio, 20*$ratio, 8*$ratio, 12*$ratio);
//head back
imagecopy($preview, $skin, 4*$ratio, 0*$ratio, 24*$ratio, 8*$ratio, 8*$ratio, 8*$ratio);
//back arms
customimageflip($preview, $skin, 0*$ratio, 8*$ratio, 52*$ratio, 20*$ratio, 4*$ratio, 12*$ratio);
imagecopy($preview, $skin, 12*$ratio, 8*$ratio, 52*$ratio, 20*$ratio, 4*$ratio, 12*$ratio);

//back legs
customimageflip($preview, $skin, 4*$ratio, 20*$ratio, 12*$ratio, 20*$ratio, 4*$ratio, 12*$ratio);
imagecopy($preview, $skin, 8*$ratio, 20*$ratio, 12*$ratio, 20*$ratio, 4*$ratio, 12*$ratio);

//hat back
imagecopy($preview, $skin, 4*$ratio, 0*$ratio, 56*$ratio, 8*$ratio, 8*$ratio, 8*$ratio);

}

$fullsize = imagecreatetruecolor($fx,$fy);

imagesavealpha($fullsize, true);
$transparent = imagecolorallocatealpha($fullsize, 255, 255, 255, 127);
imagefill($fullsize, 0, 0, $transparent);

imagecopyresized($fullsize, $preview, 0, 0, 0, 0, imagesx($fullsize), imagesy($fullsize), imagesx($preview), imagesy($preview));

imagepng($fullsize);

imagedestroy($fullsize);
imagedestroy($preview);
imagedestroy($skin);