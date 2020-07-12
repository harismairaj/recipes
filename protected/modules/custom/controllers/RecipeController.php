<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\custom\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\HttpException;
use humhub\modules\custom\components\ContentContainerController;
use humhub\modules\space\models\Space;
use humhub\modules\custom\models\Recipe;
use humhub\modules\post\models\Post;
use humhub\modules\content\models\Content;

class RecipeController extends ContentContainerController
{
  public function actionIndex()
  {
    /*$words = explode(" ","1.	Fry onions in oil till it gets golden brown
      2.	Add garlic n ginger paste and cook for 5 min
      3.	Add chicken and cook till the chicken gets golden for around 15 min
      4.	Add tomatoes, green chilies and garlic paste
      5.	Add red chili powder, coriander powder  and turmeric
      6.	Add all garam Masala like cloves, black pepper, cinnamon, green and black cardamom and bay leaves cook for 30 mins, add salt after it gets cook
      7.	Soak rice in water for 15 min
      8.	Now boil water with salt, and all garam masalas
      9.	Stir rice in boiling and boil till the rice get half cook
      10.	Stir rice and add masala
      11.	Add masala to pot, then add dhania podina and jaifal javetri as garnish add rice, sprinkle food color and kewra on rice
      12.	Dum pe rkh dien jb tk dum nikal na jae :D
    ");*/
    $words = [];
    if(Yii::$app->request->post())
    {
      $words = explode(" ",Yii::$app->request->post("instructions"));
    }
    $results = [];
    foreach ($words as $title)
    {
        $space = Space::find()->where(['like', 'name', trim($title).'%', false])->one();
        if ($space !== null)
        {
          if($space->id == 1)
          {
            continue;
          }
          $tags = [];
          if(!empty($space->tags))
          {
            $tags = str_replace(' ', '', $space->tags);
            $tags = explode(",",$tags);
          }
          $results[$space->name] = ["tags"=>$tags,"guid"=>$space->guid];
        }
    }
    return json_encode($results);
  }

  public function actionSearch()
  {
    $keyword = "1.	Fry onions in oil till it gets golden brown
                2.	Add garlic n ginger paste and cook for 5 min
                3.	Add chicken and cook till the chicken gets golden for around 15 min
                4.	Add tomatoes, green chilies and garlic paste
                5.	Add red chili powder, coriander powder  and turmeric
                6.	Add all garam Masala like cloves, black pepper, cinnamon, green and black cardamom and bay leaves cook for 30 mins, add salt after it gets cook
                7.	Soak rice in water for 15 min
                8.	Now boil water with salt, and all garam masalas
                9.	Stir rice in boiling and boil till the rice get half cook
                10.	Stir rice and add masala
                11.	Add masala to pot, then add dhania podina and jaifal javetri as garnish add rice, sprinkle food color and kewra on rice
                12.	Dum pe rkh dien jb tk dum nikal na jae :D
                ";

    $keyword = explode(" ",$keyword);
    $results = [];
    foreach ($keyword as $title)
    {
        $searchResultSet = Yii::$app->search->find($title, [
            'model' => Space::class,
            'page' => 1,
            'pageSize' => 10
        ]);

        $spaces = $searchResultSet->getResultInstances();
        foreach ($spaces as $space)
        {
          if($space->id == 1)
          {
            continue;
          }
          $results[$space->name] = ["id"=>$space->id, "tags" => $space->url];
        }
    }
    echo "<pre>";
    print_r (json_encode($results));
    echo "</pre>";
  }

  public function actionCreate()
  {
    $request = Yii::$app->request->post();
    $userId = Yii::$app->user->id;
    if(empty($request["message"]))
    {
      return "error";
    }

    $post = new Post();
    $post->message = $request['message'];
    $post->created_by = $userId;
    $post->updated_by = $userId;
    $post->content->created_by = $userId;
    $post->content->updated_by = $userId;
    $post->content->visibility = 1;
    $post->content->contentcontainer_id = (int) $request['contentcontainer_id'];
    if($post->save())
    {
      // C:\wamp3\www\deepfrypan\protected\humhub\modules\content\widgets\WallCreateContentForm.php line 142
      $topics = [7];//Yii::$app->request->post('postTopicInput');
      if(!empty($topics))
      {
        \humhub\modules\topic\models\Topic::attach($post->content, $topics);
      }
      $this->createLinkedItem($request,$post->id,$userId);
      return true;
    }
    else
    {
      return "error";
    }
  }

  private function createLinkedItem($request,$objectId,$userId)
  {
    foreach($request as $k=>$item)
    {
      if($k == "serve" || $k == "prepTime" || $k == "cookTime" || $k == "instruction" || $k == "ingredient" || $k == "embededVideo")
      {
        if(is_array($request[$k]))
        {
          foreach($request[$k] as $l=>$i)
          {
            $this->linkedItem($k,$request[$k][$l],$objectId,$userId);
          }
        }
        else
        {
          $this->linkedItem($k,$request[$k],$objectId,$userId);
        }
      }
    }
  }

  private function linkedItem($key,$message,$object_id,$userId)
  {
    $serve = new Recipe();
    $serve->message = $message;
    $serve->object_id = $object_id;
    $serve->created_by = $userId;
    $serve->updated_by = $userId;
    $serve->object_model = $key;
    $serve->save();
  }

  public function actionEdit()
  {
    $request = Yii::$app->request->post();
    $userId = Yii::$app->user->id;
    if(empty($request["message"]))
    {
      return "error";
    }

    // $model = Post::findOne(['id' => $id]);
    //
    // if (!$model->content->canEdit()) {
    //     $this->forbidden();
    // }
    //
    // if ($model->load(Yii::$app->request->post())) {
    //     // Reload record to get populated updated_at field
    //     if ($model->validate() && $model->save()) {
    //         $model = Post::findOne(['id' => $id]);
    //         return $this->renderAjaxContent($model->getWallOut());
    //     } else {
    //         Yii::$app->response->statusCode = 400;
    //     }
    // }

    $post = Post::findOne(['id' => $request['object_id']]);
    $post->message = $request["message"];
    $post->content->visibility = 1;
    $post->save();

    $details = Recipe::deleteAll(['AND',
            ['!=', 'object_model', 'humhub\modules\post\models\Post'],
            ['object_id' => $request['object_id']]
          ]);
    $this->createLinkedItem($request,$request['object_id'],$userId);
    return true;
  }

  public function actionDelete()
  {
    $request = Yii::$app->request->post();
    // return json_encode($request);
    $contentObj = Content::findOne(['id' => $request['content_id']]);

    if (!$contentObj) {
        throw new HttpException(404);
    }

    if (!$contentObj->canEdit()) {
        throw new HttpException(400, Yii::t('ContentModule.controllers_ContentController', 'Could not delete content: Access denied!'));
    }

    if ($contentObj !== null && $contentObj->delete()) {
        Recipe::deleteAll(['AND',
          ['!=', 'object_model', 'humhub\modules\post\models\Post'],
          ['object_id' => $request['object_id']]
        ]);
        $json = [
            'success' => true,
            'uniqueId' => $contentObj->getUniqueId(),
            'pk' => $request['content_id']
        ];
    } else {
        throw new HttpException(500, Yii::t('ContentModule.controllers_ContentController', 'Could not delete content!'));
    }

    return json_encode($json);
  }
}
