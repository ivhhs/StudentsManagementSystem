<?php
/**
 * Created by PhpStorm.
 * User: liwei
 * Date: 2017/5/11
 * Time: 20:34
 */

require_once 'string.func.php';

/**
 * @param int $type
 * @param int $length
 * @param int $pixel
 * @param int $line
 * @param string $sess_name
 */

function verifyImage($type = 1, $length = 4, $pixel = 0, $line = 0, $sess_name = 'verify')
{
    $width = 80;
    $height = 28;
    $image = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);

    imagefilledrectangle($image, 1, 1, $width - 2, $height - 2, $white);

    $chars = buildRandomString($type, $length);

    $_SESSION[$sess_name] = $chars;
    $fontfiles = array('simkai.ttf', 'simsun.ttc', 'SIMYOU.TTF', 'STXINWEI.TTF', 'STZHONGS.TTF');
    for ($i = 0; $i < $length; $i++) {
        $size = mt_rand(14, 18);
        $angle = mt_rand(-15, 15);
        $x = 5 + $i * $size;
        $y = mt_rand(20, 28);
        $fontfile = '../fonts/' . $fontfiles[mt_rand(0, count($fontfiles) - 1)];
        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
        $text = substr($chars, $i, 1);
        imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
    }

    if ($pixel) {
        for ($i = 0; $i < $pixel; $i++) {
            imagesetpixel($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), $color);
        }
    }

    if ($line) {
        for ($i = 1; $i < $line; $i++) {
            $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
            imageline($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), mt_rand(0, $width - 1), mt_rand(0, $height - 1), $color);
        }
    }
    header("content-type:image/gif");
    imagegif($image);
    imagedestroy($image);
}