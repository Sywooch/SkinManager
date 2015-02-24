<?php

namespace common\components;

use Yii;
use yii\base\Component;
//use yii\base\InvalidConfigException;

class ShowSkin extends Component
{

	public function saveSkin($from, $id)
	{
		if (!file_exists($from)) {
			return 'From file doesnt exists';
		}

		// Saved file width and height
		$render_width = 90;
		$render_height = $render_width * 2;

		// Get skin ratio
		$size = getimagesize($from);
		$ratio = $size[0] / 64;

		// Skin image from png
		$skin = imagecreatefrompng($from);

		/* Prepare wrapper */
		// Create empty image for skin placing
		$preview = imagecreatetruecolor(16 * $ratio, 32 * $ratio);
		// Fill this image with transparent background
		$transparent = imagecolorallocatealpha($preview, 255, 255, 255, 127);
		imagefill($preview, 0, 0, $transparent);

		// Build skin's front side to the wrapper
		$preview = self::buildFront($preview, $skin, $ratio);

		// Create displaying wrapper
		$fullsize = imagecreatetruecolor($render_width, $render_height);
		// Enable alpha
		imagesavealpha($fullsize, true);
		// Fill displaying wrapper with transparent background
		$transparent = imagecolorallocatealpha($fullsize, 255, 255, 255, 127);
		imagefill($fullsize, 0, 0, $transparent);

		// Copy skin wrapper $preview on displaying wrapper $fullsize
		imagecopyresized($fullsize, $preview, 0, 0, 0, 0, imagesx($fullsize), imagesy($fullsize), imagesx($preview), imagesy($preview));
		// Save result to the file
		imagepng($fullsize, Yii::getAlias('@frontend/web/uploads/skins/' . $id . '_front.png'));

		// Free the memory
		imagedestroy($fullsize);
		imagedestroy($preview);
		imagedestroy($skin);

		return true;
	}

	/**
	 * Build skin's front side on the $preview by
	 *
	 * @param resource $preview - Transparent image
	 * @param resource $skin - PNG file with skin
	 * @param int $ratio - Skin's ratio
	 * @return resource - $preview with built skin's front side
	 */
	private function buildFront($preview, $skin, $ratio)
	{
		imagecopy($preview, $skin, 4 * $ratio, 0 * $ratio, 8 * $ratio, 8 * $ratio, 8 * $ratio, 8 * $ratio);
		// Arms
		imagecopy($preview, $skin, 0 * $ratio, 8 * $ratio, 44 * $ratio, 20 * $ratio, 4 * $ratio, 12 * $ratio);
		self::imageflip($preview, $skin, 12 * $ratio, 8 * $ratio, 44 * $ratio, 20 * $ratio, 4 * $ratio, 12 * $ratio);
		// Chest
		imagecopy($preview, $skin, 4 * $ratio, 8 * $ratio, 20 * $ratio, 20 * $ratio, 8 * $ratio, 12 * $ratio);
		// Legs
		imagecopy($preview, $skin, 4 * $ratio, 20 * $ratio, 4 * $ratio, 20 * $ratio, 4 * $ratio, 12 * $ratio);
		self::imageflip($preview, $skin, 8 * $ratio, 20 * $ratio, 4 * $ratio, 20 * $ratio, 4 * $ratio, 12 * $ratio);
		// Hat
		imagecopy($preview, $skin, 4 * $ratio, 0 * $ratio, 40 * $ratio, 8 * $ratio, 8 * $ratio, 8 * $ratio);

		return $preview;
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
