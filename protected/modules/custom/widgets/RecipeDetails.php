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

        foreach ($details as $detail)
        {
          echo $detail['object_model'].' -- '.$detail['message'].'</br>';
        }

        return $this->render('recipeDetails', [
            'object' => $this->object_id,
        ]);
    }

}

?>
