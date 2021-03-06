<?php

namespace humhub\modules\custom\helpers;
use Yii;
class Seo
{
  public static function recipeURL($baseURL,$contentId,$msg)
  {
    $msg = preg_replace('/[^a-zA-Z0-9\']/', '-', strtolower(trim($msg)));
    return $baseURL.'/recipe/'.$contentId.'/'.$msg;
  }
}

?>
