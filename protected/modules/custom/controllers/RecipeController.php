<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\custom\controllers;

use Yii;
use yii\helpers\Url;
use humhub\components\Controller;
use humhub\modules\space\models\Space;

class RecipeController extends Controller
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
}
