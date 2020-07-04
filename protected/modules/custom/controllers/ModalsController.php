<?php

namespace humhub\modules\custom\controllers;

use Yii;
use humhub\components\Controller;
use humhub\modules\custom\models\Recipe;
use humhub\modules\post\models\Post;

class ModalsController extends Controller
{
  public function actionCreate($contentcontainer_id)
  {
    return $this->renderAjax('recipeForm',[
      "mode"=>"new",
      "contentcontainer_id"=>$contentcontainer_id
    ]);
  }

  public function actionEdit($object_id)
  {
    $post = Post::findOne(['id' => $object_id]);
    $formArr = [
      "mode"=>"edit",
      "object_id"=>$object_id,
      "message"=>['id'=>$post['id'],'text'=>$post['message']]
    ];

    $details = Recipe::find()
    ->where(['object_id' => $object_id])
    ->andWhere(['!=', 'object_model', 'humhub\modules\post\models\Post'])
    ->orderBy("id ASC")
    ->all();
    foreach ($details as $detail)
    {
      if($detail['object_model'] == "instruction"
       || $detail['object_model'] == "ingredient")
      {
        if(empty($formArr[$detail['object_model']]))
        {
          $formArr[$detail['object_model']] = [];
        }
        $formArr[$detail['object_model']][] = ['id'=>$detail['id'],'text'=>$detail['message']];
      }
      else
      {
        $formArr[$detail['object_model']] = ['id'=>$detail['id'],'text'=>$detail['message']];
      }
    }

    return $this->renderAjax('recipeForm',$formArr);
  }
}
