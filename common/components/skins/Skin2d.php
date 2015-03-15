<?php

namespace common\components\skins;

/**
 * Exception class
 */
use Yii;
use yii\base\Exception;

/**
 * Class for cropping/cutting original skin images
 * for render it in normal for human mode
 *
 * @author Alex Solomaha <cyanofresh@gmail.com>
 */
class Skin2d
{
    /**
     * @var string Resource with skin
     */
    public $image = null;

    /**
     * @vars int Image information about skin
     */
    public $ratio = null;
    public $height = null;
    public $width = null;

    /**
     * Free the memory
     */
    public function __destruct()
    {
        if (!is_null($this->image)) {
            imagedestroy($this->image);
        }
    }

    /**
     * Set skin image
     *
     * @param string $file
     * @return bool
     * @throws Exception If skin file doesn't exist
     */
    public function setFile($file)
    {
        if (!file_exists($file)) {
            //throw new Exception('Skin file doesn\'t exist (' . $file . ')');
            $file = Yii::getAlias('@frontend/web/uploads/char.png');
        }

        $this->__destruct();

        $this->image = imagecreatefrompng($file);
    }

    /**
     * Render front side of skin
     *
     * @return string Resource with built skin on it
     */
    public function frontImage()
    {
        $wrapper = imagecreatetruecolor(16 * $this->ratio(), 32 * $this->ratio());
        $background = imagecolorallocatealpha($wrapper, 255, 255, 255, 127);
        imagefill($wrapper, 0, 0, $background);

        imagecopy($wrapper, $this->image, 4 * $this->ratio(), 0 * $this->ratio(), 8 * $this->ratio(),
            8 * $this->ratio(), 8 * $this->ratio(), 8 * $this->ratio());
        //arms
        imagecopy($wrapper, $this->image, 0 * $this->ratio(), 8 * $this->ratio(), 44 * $this->ratio(),
            20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
        $this->imageflip($wrapper, $this->image, 12 * $this->ratio(), 8 * $this->ratio(), 44 * $this->ratio(),
            20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
        //chest
        imagecopy($wrapper, $this->image, 4 * $this->ratio(), 8 * $this->ratio(), 20 * $this->ratio(),
            20 * $this->ratio(), 8 * $this->ratio(), 12 * $this->ratio());
        //legs
        imagecopy($wrapper, $this->image, 4 * $this->ratio(), 20 * $this->ratio(), 4 * $this->ratio(),
            20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
        $this->imageflip($wrapper, $this->image, 8 * $this->ratio(), 20 * $this->ratio(), 4 * $this->ratio(),
            20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
        //hat
        imagecopy($wrapper, $this->image, 4 * $this->ratio(), 0 * $this->ratio(), 40 * $this->ratio(),
            8 * $this->ratio(), 8 * $this->ratio(), 8 * $this->ratio());

        return $wrapper;
    }

    /**
     * Render back side of skin
     *
     * @return string Resource with built skin on it
     */
    public function backImage()
    {
        $wrapper = imagecreatetruecolor(16 * $this->ratio(), 32 * $this->ratio());
        $background = imagecolorallocatealpha($wrapper, 255, 255, 255, 127);
        imagefill($wrapper, 0, 0, $background);

        imagecopy($wrapper, $this->image, 4 * $this->ratio(), 8 * $this->ratio(), 32 * $this->ratio(),
            20 * $this->ratio(), 8 * $this->ratio(), 12 * $this->ratio());
        // Head back
        imagecopy($wrapper, $this->image, 4 * $this->ratio(), 0 * $this->ratio(), 24 * $this->ratio(),
            8 * $this->ratio(), 8 * $this->ratio(), 8 * $this->ratio());
        // Arms back
        $this->imageflip($wrapper, $this->image, 0 * $this->ratio(), 8 * $this->ratio(), 52 * $this->ratio(),
            20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
        imagecopy($wrapper, $this->image, 12 * $this->ratio(), 8 * $this->ratio(), 52 * $this->ratio(),
            20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
        // Legs back
        $this->imageflip($wrapper, $this->image, 4 * $this->ratio(), 20 * $this->ratio(), 12 * $this->ratio(),
            20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
        imagecopy($wrapper, $this->image, 8 * $this->ratio(), 20 * $this->ratio(), 12 * $this->ratio(),
            20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
        // Hat back
        imagecopy($wrapper, $this->image, 4 * $this->ratio(), 0 * $this->ratio(), 56 * $this->ratio(),
            8 * $this->ratio(), 8 * $this->ratio(), 8 * $this->ratio());

        return $wrapper;
    }

    /**
     * Create wrapper for the skin with given height and width
     *
     * @param integer $width
     * @param integer $height
     * @return string Resource with transparent background
     */
    public function wrapper($width, $height)
    {
        $wrapper = imagecreatetruecolor($width, $height);
        imagesavealpha($wrapper, true);
        $background = imagecolorallocatealpha($wrapper, 255, 255, 255, 127);
        imagefill($wrapper, 0, 0, $background);

        return $wrapper;
    }

    /**
     * Get width of the skin image
     *
     * @return integer
     */
    public function width()
    {
        if (is_null($this->width)) {
            $this->width = imagesx($this->image);
        }

        return $this->width;
    }

    /**
     * Get height of the skin image
     *
     * @return integer
     */
    public function height()
    {
        if (is_null($this->height)) {
            $this->height = imagesy($this->image);
        }

        return $this->height;
    }

    /**
     * Get ratio of the skin image
     *
     * @return integer
     */
    public function ratio()
    {
        if (is_null($this->ratio)) {
            $this->ratio = $this->width() / 64;
        }

        return $this->ratio;
    }

    /**
     * Custom image flip function
     */
    private function imageflip(&$result, &$img, $rx = 0, $ry = 0, $x = 0, $y = 0, $size_x = null, $size_y = null)
    {
        if ($size_x < 1) {
            $size_x = imagesx($img);
        }

        if ($size_y < 1) {
            $size_y = imagesy($img);
        }

        imagecopyresampled($result, $img, $rx, $ry, ($x + $size_x - 1), $y, $size_x, $size_y, 0 - $size_x, $size_y);
    }
}