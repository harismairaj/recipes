<?php
namespace humhub\modules\custom\widgets;
use yii\helpers\Url;

class CustomMeta extends \humhub\widgets\BaseMenu
{
    public $title;
    public function run()
    {
        $desc = "";
        $keywords = "";
        $visualAsset = "";
        if(!empty($_GET['contentId']))
        {
           $content = \humhub\modules\content\models\Content::find()->where(['content.id' => $_GET['contentId']])->asArray()->one();
           if(!empty($content['object_id']))
           {
             $details = \humhub\modules\custom\models\Recipe::find()
             ->where(['object_id' => $content['object_id']])
             ->andWhere(['!=', 'object_model', 'humhub\modules\post\models\Post'])
             ->orderBy("id ASC")
             ->all();

             foreach ($details as $detail)
             {
               switch ($detail['object_model'])
               {
                 case 'instruction':
                   $desc .= ($desc==""?"":" ").$detail['message'];
                   break;
                 case 'ingredient':
                   $keywords .= ($keywords==""?"":" ").$detail['message'];
                   break;
                 case 'embededVideo':
                   $visualAsset = 'https://img.youtube.com/vi/'.$detail['message'].'/sddefault.jpg';
                   break;
               }
             }

             $post = \humhub\modules\post\models\Post::find()->where(['id' => $content['object_id']])->asArray()->one();
             if(!empty($post['message']))
             {
               $this->title = $post['message'].' - MasalaJaat';
             }

             // $file = \humhub\modules\file\models\File::find()->where(['object_id' => $content['object_id']])->asArray()->one();
             // if(!empty($file['file_name']))
             // {
             //   $file = Url::toRoute('/file/file/download?guid='.$file['guid'],true);
             // }
           }
        }
        return $this->render('customMeta', array(
          'title' => $this->title, 'desc' => $desc, 'keywords' => $keywords, 'visualAsset' => $visualAsset
        ));
    }
}
?>
