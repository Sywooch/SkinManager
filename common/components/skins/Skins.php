<?php

namespace common\components\skins;

use Yii;
use yii\base\Component;
use yii\helpers\Html;

class Skins extends Component
{

	public function save($src, $id, $folder)
	{
		if (!file_exists($src)) {
			return false;
		}

		$skins = new Skin2d();

		if (!$skins->setFile($src)) {
			throw new Exception('No SRC');
		}

		// FRONTSIDE
		$frontside = $skins->frontImage();

		// Save with 90px width
		$front_dest_90 = $skins->fullWrapper(90, 180);

		imagecopyresized($front_dest_90, $frontside, 0, 0, 0, 0, imagesx($front_dest_90), imagesy($front_dest_90), imagesx($frontside), imagesy($frontside));
		imagepng($front_dest_90, Yii::getAlias('@frontend/web/uploads/' . $folder . '/' . $id . '_front_90.png'));

		imagedestroy($front_dest_90);

		// Save with 200px width
		$front_dest_200 = $skins->fullWrapper(200, 400);

		imagecopyresized($front_dest_200, $frontside, 0, 0, 0, 0, imagesx($front_dest_200), imagesy($front_dest_200), imagesx($frontside), imagesy($frontside));
		imagepng($front_dest_200, Yii::getAlias('@frontend/web/uploads/' . $folder . '/' . $id . '_front_200.png'));

		imagedestroy($front_dest_200);
		imagedestroy($frontside);
		// End FRONTSIDE
		
		// BACKSIDE
		$backside = $skins->backImage();

		// Save with 90px width
		$back_dest_90 = $skins->fullWrapper(90, 180);

		imagecopyresized($back_dest_90, $backside, 0, 0, 0, 0, imagesx($back_dest_90), imagesy($back_dest_90), imagesx($backside), imagesy($backside));
		imagepng($back_dest_90, Yii::getAlias('@frontend/web/uploads/' . $folder . '/' . $id . '_back_90.png'));

		imagedestroy($back_dest_90);

		// Save with 200px width
		$back_dest_200 = $skins->fullWrapper(200, 400);

		imagecopyresized($back_dest_200, $backside, 0, 0, 0, 0, imagesx($back_dest_200), imagesy($back_dest_200), imagesx($backside), imagesy($backside));
		imagepng($back_dest_200, Yii::getAlias('@frontend/web/uploads/' . $folder . '/' . $id . '_back_200.png'));

		imagedestroy($back_dest_200);
		imagedestroy($backside);
		// End BACKSIDE
	}

	public function saveCloak($src, $id)
	{
		if (!file_exists($src)) {
			return false;
		}

		$skins = new Skin2d();

		$skins->setFile(Yii::getAlias('@frontend/web/uploads/cloaks/char.png'));

		$skin = $skins->cloakImage($src);

		// Preview
		$preview = $skins->fullWrapper(90, 180);
		imagecopyresized($preview, $skin, 0, 0, 0, 0, imagesx($preview), imagesy($preview), imagesx($skin), imagesy($skin));
		imagepng($preview, Yii::getAlias('@frontend/web/uploads/cloaks/' . $id . '_preview.png'));
		imagedestroy($preview);

		// Full
		$full = $skins->fullWrapper(200, 400);
		imagecopyresized($full, $skin, 0, 0, 0, 0, imagesx($full), imagesy($full), imagesx($skin), imagesy($skin));
		imagepng($full, Yii::getAlias('@frontend/web/uploads/cloaks/' . $id . '_full.png'));

		imagedestroy($full);
		imagedestroy($skin);
	}

	public function cloakUrl($id, $full = false)
	{
		$mode = $full ? 'full' : 'preview';
		return Yii::$app->params['frontendUrl'] . '/uploads/cloaks/' . $id . '_' . $mode . '.png';
	}

	public function skinUrl($id, $folder = 'skins', $mode = 'front', $width = 90)
	{
		return Yii::$app->params['frontendUrl'] . '/uploads/' . $folder .  '/' . $id . '_' . $mode . '_' . $width . '.png';
	}

	public function skinImage($id, $folder = 'skins', $mode = 'front', $width = 90, $options = [])
	{
		return Html::img(
			$this->skinUrl($id, $folder, $mode, $width),
			$options
		);
	}

}
