<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */
namespace humhub\modules\custom\assets;
use yii\web\AssetBundle;
class RecipeFormAsset extends AssetBundle
{
    public $sourcePath = '@custom/resources';
    public $css = ['css/recipeForm.css'];
    public $js = [
        'js/recipeForm.js'
    ];

    public $depends = [
        'humhub\assets\AtJsAsset',
        //'humhub\modules\custom\assets\textAreaHelperAsset',
        'humhub\modules\custom\assets\DataTableAsset'
    ];
}
?>
