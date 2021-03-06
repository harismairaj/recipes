<?php

namespace humhub\modules\custom\widgets;

use humhub\modules\custom\models\Recipe;
use yii\helpers\Url;
use humhub\modules\custom\helpers\Seo as SeoHelper;

class RecipeDetails extends \yii\base\Widget
{
    /**
     * Content Object with SIContentBehaviour
     * @var type
     */
    public $object;
    public $content;
    /**
     * Executes the widget.
     */
    public function run()
    {
        $details = Recipe::find()
        ->where(['object_id' => $this->object->content->object_id])
        ->andWhere(['!=', 'object_model', 'humhub\modules\post\models\Post'])
        ->orderBy("id ASC")
        ->all();

        $managedArr = [];
        foreach ($details as $detail)
        {
          switch ($detail['object_model'])
          {
            case 'ingredient':
            case 'instruction':
              $managedArr[$detail['object_model']][] = $detail['message'];
              break;
            default:
              $managedArr[$detail['object_model']] = $detail['message'];
              break;
          }
        }
        return $this->render('recipeDetails', [
            'object' => $this->object,
            'permalink' => SeoHelper::recipeURL(Url::base(true),$this->object->content->id,strip_tags($this->content)),
            'content' => $this->content,
            'details' => $managedArr
        ]);
    }

}

?>
