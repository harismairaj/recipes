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
use humhub\modules\qs\models\forms\GuestLogin;
use humhub\modules\qs\models\forms\GuestRegister;

class GuestController extends Controller
{
  public function actionRegister()
  {
    $request = Yii::$app->request;
    $model = new GuestRegister;
    $postId = $request->get('postId');
    $contentId = $request->get('contentId');
    $sguid = $request->get('sguid');
    if ($model->load($request->post()) && $model->validate())
    {

    }

    return $this->renderAjax('modals/register',['model'=>$model]);
  }
}
