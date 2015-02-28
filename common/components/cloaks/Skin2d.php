<?php

namespace common\components\cloaks;

use yii\base\Exception;

class Skin2d
{
	public $image = null;

	public $ratio = null;
	public $height = null;
	public $width = null;

	public function __destruct()
	{
		if (!is_null($this->image)) {
			imagedestroy($this->image);
		}
	}

	public function setFile($file)
	{
		if (!file_exists($file)) {
			throw new Exception('Original skin doesn\'t exist (' . $file . ')');
		}
		if ($this->image) {
			$this->__destruct();
		}

		$this->image = imagecreatefrompng($file);
	}

	public function backImage()
	{
		$wrapper = imagecreatetruecolor(16 * $this->ratio(), 32 * $this->ratio());
		$background = imagecolorallocatealpha($wrapper, 255, 255, 255, 127);
		imagefill($wrapper, 0, 0, $background);

		imagecopy($wrapper, $this->image, 4 * $this->ratio(), 8 * $this->ratio(), 32 * $this->ratio(), 20 * $this->ratio(), 8 * $this->ratio(), 12 * $this->ratio());
		// Head back
		imagecopy($wrapper, $this->image, 4 * $this->ratio(), 0 * $this->ratio(), 24 * $this->ratio(), 8 * $this->ratio(), 8 * $this->ratio(), 8 * $this->ratio());
		// Arms back
		$this->imageflip($wrapper, $this->image, 0 * $this->ratio(), 8 * $this->ratio(), 52 * $this->ratio(), 20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
		imagecopy($wrapper, $this->image, 12 * $this->ratio(), 8 * $this->ratio(), 52 * $this->ratio(), 20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
		// Legs back
		$this->imageflip($wrapper, $this->image, 4 * $this->ratio(), 20 * $this->ratio(), 12 * $this->ratio(), 20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
		imagecopy($wrapper, $this->image, 8 * $this->ratio(), 20 * $this->ratio(), 12 * $this->ratio(), 20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
		// Hat back
		imagecopy($wrapper, $this->image, 4 * $this->ratio(), 0 * $this->ratio(), 56 * $this->ratio(), 8 * $this->ratio(), 8 * $this->ratio(), 8 * $this->ratio());

		return $wrapper;
	}

	public function cloakImage($cloak_file)
	{
		if (!file_exists($cloak_file)) {
			throw new Exception('Cloak doesn\'t exist (' . $cloak_file . ')');
		}

		$cloak = imagecreatefrompng($cloak_file);
		$wrapper = imagecreatetruecolor(16 * $this->ratio(), 32 * $this->ratio());
		$background = imagecolorallocatealpha($wrapper, 255, 255, 255, 127);

		imagefill($wrapper, 0, 0, $background);
		imagecopy($wrapper, $this->image, 4 * $this->ratio(), 8 * $this->ratio(), 32 * $this->ratio(), 20 * $this->ratio(), 8 * $this->ratio(), 12 * $this->ratio());
		// Head back
		imagecopy($wrapper, $this->image, 4 * $this->ratio(), 0 * $this->ratio(), 24 * $this->ratio(), 8 * $this->ratio(), 8 * $this->ratio(), 8 * $this->ratio());
		// Arms back
		$this->imageflip($wrapper, $this->image, 0 * $this->ratio(), 8 * $this->ratio(), 52 * $this->ratio(), 20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
		imagecopy($wrapper, $this->image, 12 * $this->ratio(), 8 * $this->ratio(), 52 * $this->ratio(), 20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
		// Legs back
		$this->imageflip($wrapper, $this->image, 4 * $this->ratio(), 20 * $this->ratio(), 12 * $this->ratio(), 20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
		imagecopy($wrapper, $this->image, 8 * $this->ratio(), 20 * $this->ratio(), 12 * $this->ratio(), 20 * $this->ratio(), 4 * $this->ratio(), 12 * $this->ratio());
		// Hat back
		imagecopy($wrapper, $this->image, 4 * $this->ratio(), 0 * $this->ratio(), 56 * $this->ratio(), 8 * $this->ratio(), 8 * $this->ratio(), 8 * $this->ratio());
		imagecopy($wrapper, $cloak, 3 * $this->ratio(), 8 * $this->ratio(), 1 * $this->ratio(), 1 * $this->ratio(), 10 * $this->ratio(), 16 * $this->ratio());

		return $wrapper;
	}

	public function wrapper($width, $height)
	{
		$wrapper = imagecreatetruecolor($width, $height);
		imagesavealpha($wrapper, true);
		$background = imagecolorallocatealpha($wrapper, 255, 255, 255, 127);
		imagefill($wrapper, 0, 0, $background);

		return $wrapper;
	}

	public function width()
	{
		if (is_null($this->width)) {
			$this->width = imagesx($this->image);
		}
		return $this->width;
	}

	public function height()
	{
		if (is_null($this->height)) {
			$this->height = imagesy($this->image);
		}
		return $this->height;
	}

	public function ratio()
	{
		if (is_null($this->ratio)) {
			$this->ratio = $this->width() / 64;
		}
		return $this->ratio;
	}

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