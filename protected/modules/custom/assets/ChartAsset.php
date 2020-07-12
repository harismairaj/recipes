<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */
namespace humhub\modules\custom\assets;
use yii\web\AssetBundle;
class ChartAsset extends AssetBundle
{
    public $sourcePath = '@custom/resources';
    public $css = [];
    public $js = [
        'js/chart.min.js'
    ];
}
?>
