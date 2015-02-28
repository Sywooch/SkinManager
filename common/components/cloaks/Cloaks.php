<?php

namespace common\components\cloaks;

use Yii;
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
		@unlink($model->basePath . $model->id . '_full.png');
		@unlink($model->basePath . $model->id . '_mini.png');
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

	/**
	 * Get html image with skin
	 *
	 * @param mixed $model
	 * @param string $mode ('front'|'back')
	 * @param boolean $full Full mode(true) or mini(false)
	 * @param array $options Html->image options
	 * @return string Html image
	 */
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
		$skin = $model->basePath . 'char.png';
		$full_back = $model->basePath . $model->id . '_full.png';
		$mini_back = $model->basePath . $model->id . '_mini.png';
		$cloak_path = $model->basePath . $model->id . '.png';

		// Set original skin image to the Skin2d library
		$this->skin2d = new Skin2d();
		$this->skin2d->setFile($skin);

		if ($overwrite) {
			// Overwrite files
			$this->saveFullBack($full_back, $cloak_path);
			$this->saveMiniBack($mini_back, $cloak_path);
		} else {
			// Generete files if not exist
			if (!file_exists($full_back)) {
				$this->saveFullBack($full_back, $cloak_path);
			}
			if (!file_exists($mini_back)) {
				$this->saveMiniBack($mini_back, $cloak_path);
			}
		}
	}

	/**
	 * Save backside of skin in full mode
	 *
	 * @param str $dest Path to result image
	 */
	public function saveFullBack($dest, $cloak_path)
	{
		// Skin image
		$skin = $this->skin2d->cloakImage($cloak_path);
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
	public function saveMiniBack($dest, $cloak_path)
	{
		// Skin image
		$skin = $this->skin2d->cloakImage($cloak_path);
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