<?php

namespace humhub\modules\custom\widgets;

use humhub\modules\custom\models\Recipe;

class RecipeDetails extends \yii\base\Widget
{

    /**
     * Content Object with SIContentBehaviour
     * @var type
     */
    public $object_id;

    /**
     * Executes the widget.
     */
    public function run()
    {
        $details = Recipe::find()
        ->where(['object_id' => $this->object_id])
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
            'id' => $this->object_id,
            'details' => $managedArr
        ]);
    }

}

?>
