<?php

namespace common\components\cloaks;

use yii\base\Component;
use yii\helpers\Html;

/**
 * Cloaks component for working with skins with cloaks
 */
class Cloaks extends Component
{
	/**
	 * Skin2d library to cut&crop skins
	 *
	 * @var object common\components\skins\Skin2d
	 */
	public $cloak2d = null;

	/**
	 * Save files from original skin
	 *
	 * @param type $model
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
	public function url($model, $full = false)
	{
		$this->check($model);

		$full_name = $full ? 'full' : 'mini';

		return $model->baseUrl . $model->id . '_' . $full_name . '.png';
	}

	public function image($model, $full = false, $options = [])
	{
		$src = $this->url($model, $full);

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
		$base_skin_full = $model->basePath . 'char_full.png';
		$base_skin_mini = $model->basePath . 'char_mini.png';

		$cloak = $model->basePath . $model->id . '.png';

		$full_back = $model->basePath . $model->id . '_full.png';
		$mini_back = $model->basePath . $model->id . '_mini.png';

		// Check existing
		if (!file_exists($base_skin_full) or !file_exists($base_skin_mini)) {
			throw new \yii\base\Exception('Base skin images for cloak don\'t exist (' . $base_skin_full . ') + (' . $base_skin_mini . ')');
		}
		if (!file_exists($cloak)) {
			throw new \yii\base\Exception('Original skin image doesn\'t exist (' . $cloak . ')');
		}

		// Set original skin image to the Skin2d library
		$this->cloak2d = new Cloak2d();
		$this->cloak2d->setCloak($cloak);

		if ($overwrite) {
			// Overwrite files
			$this->saveFull($full_back, $base_skin_full);
			$this->saveMini($mini_back, $base_skin_mini);
		} else {
			// Generete files if not exist
			if (!file_exists($full_back)) {
				$this->saveFull($full_back, $base_skin_full);
			}
			if (!file_exists($mini_back)) {
				$this->saveMini($mini_back, $base_skin_mini);
			}
		}
	}

	/**
	 * Save full version of skin with cloak
	 *
	 * @param string $dest
	 * @param string $baseSkin
	 */
	public function saveFull($dest, $baseSkin)
	{
		// Set base skin
		$this->cloak2d->setSkin($baseSkin);
		// Get skin image
		$skin = $this->cloak2d->image();
		// Result resized image with skin
		$result = $this->cloak2d->wrapper(200, 400);

		// Copy skin image on the result
		imagecopyresized($result, $skin, 0, 0, 0, 0, imagesx($result), imagesy($result), imagesx($skin), imagesy($skin));

		// Save result image to the destination folder
		imagepng($result, $dest);

		// Free memory
		imagedestroy($result);
		imagedestroy($skin);
	}
	
	/**
	 * Save mini version of skin with cloak
	 *
	 * @param string $dest
	 * @param string $baseSkin
	 */
	public function saveMini($dest, $baseSkin)
	{
		// Set base skin
		$this->cloak2d->setSkin($baseSkin);
		// Get skin image
		$skin = $this->cloak2d->image();
		// Result resized image with skin
		$result = $this->cloak2d->wrapper(90, 180);

		// Copy skin image on the result
		imagecopyresized($result, $skin, 0, 0, 0, 0, imagesx($result), imagesy($result), imagesx($skin), imagesy($skin));

		// Save result image to the destination folder
		imagepng($result, $dest);

		// Free memory
		imagedestroy($result);
		imagedestroy($skin);
	}

}