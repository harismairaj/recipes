<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */
namespace humhub\modules\custom\assets;
use yii\web\AssetBundle;
class RootAsset extends AssetBundle
{
    public $sourcePath = '@custom/resources';
    public $css = ['css/root.css'];
    public $js = [
        'js/root.js'
    ];
}
?>
