<?php

namespace humhub\modules\custom\widgets;

class CreateRecipe extends \yii\base\Widget
{
    public $contentContainer;

    public function run()
    {
        return $this->render('createRecipe', [
            'contentContainer' => $this->contentContainer
        ]);
    }
}

?>
