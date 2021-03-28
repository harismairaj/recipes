<?php

namespace humhub\modules\custom\widgets;
use humhub\libs\LogoImage;

class Header extends \yii\base\Widget
{
    public function run()
    {
        return $this->render('header', ['logo' => new LogoImage()]);
    }
}
?>
