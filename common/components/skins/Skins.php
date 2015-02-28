<?php

namespace common\components\skins;

use Yii;
use yii\base\Component;
use yii\helpers\Html;

class Skins extends Component
{
	/**
	 * Skin2d library to cut&crop skins
	 *
	 * @var object common\components\skins\Skin2d
	 */
	public $skin2d = null;

	/**
	 * Save files from original skin
	 *
	 * @param mixed $model
	 */
	public function save($model)
	{
		$this->check($model, true);
	}

	/**
	 * Delete files from original skin
	 * 
	 * @param mixed $model
	 */
	public function delete($model)
	{
		@unlink($model->basePath . $model->id . '_full_front.png');
		@unlink($model->basePath . $model->id . '_mini_front.png');
		@unlink($model->basePath . $model->id . '_full_back.png');
		@unlink($model->basePath . $model->id . '_mini_back.png');
	}

	/**
	 * Get url of the skin with requested ID, render Mode and image size
	 *
	 * @param mixed $model
	 * @param string $mode
	 * @param bool $full
	 * @return string
	 */
	public function url($model, $mode = 'front', $full = false)
	{
		$this->check($model);
		
		$full_name = $full ? 'full' : 'mini';
		$mode_name = ($mode == 'front') ? 'front' : 'back';
		
		return $model->baseUrl . $model->id . '_' . $full_name . '_' . $mode_name . '.png';
	}

	/**
	 * Get html image with skin
	 *
	 * @param mixed $model
	 * @param string $mode ('front'|'back')
	 * @param boolean $full
	 * @param array $options
	 * @return string Html image
	 */
	public function image($model, $mode = 'front', $full = false, $options = [])
	{
		$src = $this->url($model, $mode, $full);

		return Html::img($src, $options);
	}

	/**
	 * Check if images of the skin exists. If no - generetes it.
	 *
	 * @param mixed $model Model with required inforamtion
	 * @param bool $overwrite If files exists - will overwrite them
	 */
	public function check($model, $overwrite = false)
	{
		// File paths
		$skin = $model->basePath . $model->id . '.png';
		$full_front = $model->basePath . $model->id . '_full_front.png';
		$mini_front = $model->basePath . $model->id . '_mini_front.png';
		$full_back = $model->basePath . $model->id . '_full_back.png';
		$mini_back = $model->basePath . $model->id . '_mini_back.png';

		// Set original skin image to the Skin2d library
		$this->skin2d = new Skin2d();
		$this->skin2d->setFile($skin);

		if ($overwrite) {
			// Overwrite files
			$this->saveFullFront($full_front);
			$this->saveMiniFront($mini_front);
			$this->saveFullBack($full_back);
			$this->saveMiniBack($mini_back);
		} else {
			// Generete files if not exist
			if (!file_exists($full_front)) {
				$this->saveFullFront($full_front);
			}
			if (!file_exists($mini_front)) {
				$this->saveMiniFront($mini_front);
			}
			if (!file_exists($full_back)) {
				$this->saveFullBack($full_back);
			}
			if (!file_exists($mini_back)) {
				$this->saveMiniBack($mini_back);
			}
		}
	}

	/**
	 * Save frontside of skin in full mode
	 *
	 * @param str $dest Path to result image
	 */
	public function saveFullFront($dest)
	{
		// Skin image
		$skin = $this->skin2d->frontImage();
		// Result resized image with skin
		$result = $this->skin2d->wrapper(200, 400);

		// Copy skin image on the result
		imagecopyresized($result, $skin, 0, 0, 0, 0, imagesx($result), imagesy($result), imagesx($skin), imagesy($skin));

		// Save result image to the destination folder
		imagepng($result, $dest);

		// Free memory
		imagedestroy($result);
		imagedestroy($skin);
	}

	/**
	 * Save frontside of skin in mini mode
	 *
	 * @param str $dest Path to result image
	 */
	public function saveMiniFront($dest)
	{
		// Skin image
		$skin = $this->skin2d->frontImage();
		// Result resized image with skin
		$result = $this->skin2d->wrapper(90, 180);

		// Copy skin image on the result
		imagecopyresized($result, $skin, 0, 0, 0, 0, imagesx($result), imagesy($result), imagesx($skin), imagesy($skin));

		// Save result image to the destination folder
		imagepng($result, $dest);

		// Free memory
		imagedestroy($result);
		imagedestroy($skin);
	}

	/**
	 * Save backside of skin in full mode
	 *
	 * @param str $dest Path to result image
	 */
	public function saveFullBack($dest)
	{
		// Skin image
		$skin = $this->skin2d->backImage();
		// Result resized image with skin
		$result = $this->skin2d->wrapper(200, 400);

		// Copy skin image on the result
		imagecopyresized($result, $skin, 0, 0, 0, 0, imagesx($result), imagesy($result), imagesx($skin), imagesy($skin));

		// Save result image to the destination folder
		imagepng($result, $dest);

		// Free memory
		imagedestroy($result);
		imagedestroy($skin);
	}

	/**
	 * Save backside of skin in mini mode
	 *
	 * @param str $dest Path to result image
	 */
	public function saveMiniBack($dest)
	{
		// Skin image
		$skin = $this->skin2d->backImage();
		// Result resized image with skin
		$result = $this->skin2d->wrapper(90, 180);

		// Copy skin image on the result
		imagecopyresized($result, $skin, 0, 0, 0, 0, imagesx($result), imagesy($result), imagesx($skin), imagesy($skin));

		// Save result image to the destination folder
		imagepng($result, $dest);

		// Free memory
		imagedestroy($result);
		imagedestroy($skin);
	}

}