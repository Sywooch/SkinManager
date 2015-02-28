<?php

namespace common\components\cloaks;

use yii\base\Component;

class Cloak2d extends Component
{
	public $skin = null;
	public $cloak = null;

	public function setSkin($file)
	{
		if (!file_exists($file)) {
			throw new \yii\base\Exception('Base skin image for cloak doesn\'t exist (' . $file . ')');
		}
		if ($this->skin) {
			$this->__destruct();
		}

		return $this->skin = imagecreatefrompng($file);
	}

	public function setCloak($file)
	{
		if (!file_exists($file)) {
			throw new \yii\base\Exception('Cloak image doesn\'t exist (' . $file . ')');
		}
		if ($this->cloak) {
			$this->__destruct();
		}

		return $this->cloak = imagecreatefrompng($file);
	}

	public function image()
	{
		$wrapper = $this->skin;

		imagecopy($wrapper, $this->cloak, 3 * $this->ratio(), 8 * $this->ratio(), 1 * $this->ratio(), 1 * $this->ratio(), 10 * $this->ratio(), 16 * $this->ratio());

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
		if ($this->skin != null) {
			return imagesx($this->skin);
		}
		return false;
	}

	public function height()
	{
		if ($this->skin != null) {
			return imagesy($this->skin);
		}
		return false;
	}

	public function ratio()
	{
		if ($this->skin != null) {
			return $this->width() / 64;
		}
		return false;
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

	public function __destruct()
	{
		if ($this->skin != null) {
			return imagedestroy($this->skin);
		}
		if ($this->cloak != null) {
			return imagedestroy($this->cloak);
		}
		return true;
	}

}