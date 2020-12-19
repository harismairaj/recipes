<?php
/* @var $this \yii\web\View */
/* @var $content string */

\humhub\assets\AppAsset::register($this);
\humhub\modules\custom\assets\RootAsset::register($this);

$isCustomer = !empty(Yii::$app->user->identity->username);
$isAdmin = Yii::$app->user->isAdmin();
$bodyCSS = '';
if(Yii::$app->user->isGuest)
{
  $bodyCSS = 'user';
}
elseif(!$isAdmin)
{
  $bodyCSS = 'user';
}
elseif($isAdmin)
{
  $bodyCSS = 'admin';
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <title><?= strip_tags($this->pageTitle); ?></title>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?php $this->head() ?>
        <?= $this->render('head'); ?>
    </head>
    <body class="<?php echo $bodyCSS; ?>">
        <?php $this->beginBody() ?>

        <!-- start: first top navigation bar -->
        <div id="topbar-first" class="topbar">
            <div class="container">
                <div class="topbar-brand hidden-xs">
                    <?= \humhub\widgets\SiteLogo::widget(); ?>
                </div>

                <div class="topbar-actions pull-right">
                    <?= \humhub\modules\user\widgets\AccountTopMenu::widget(); ?>
                </div>

                <div class="notifications pull-right">
                    <?= \humhub\widgets\NotificationArea::widget(); ?>
                </div>
            </div>
        </div>
        <!-- end: first top navigation bar -->
        <?php if($isAdmin){ ?>
        <!-- start: second top navigation bar -->
        <div id="topbar-second" class="topbar">
            <div class="container">
                <ul class="nav" id="top-menu-nav">
                    <!-- load space chooser widget -->
                    <?= \humhub\modules\space\widgets\Chooser::widget(); ?>

                    <!-- load navigation from widget -->
                    <?= \humhub\widgets\TopMenu::widget(); ?>
                </ul>

                <ul class="nav pull-right" id="search-menu-nav">
                    <?= \humhub\widgets\TopMenuRightStack::widget(); ?>
                </ul>
            </div>
        </div>
        <!-- end: second top navigation bar -->

        <?php }else{ ?>

          <!-- div>
              <div class="container">
                <div class="cntr">
                  <div class="cntr-innr">
                    <label class="search" for="inpt_search">
                      <input id="inpt_search" type="text" placeholder="Search for Recipes" />
                      <i class="fa fa-search"></i>
                      <button type="submit" class="btn btn-default btn-sm" data-ui-loader="">Search</button>
                    </label>
                  </div>
                </div>
              </div>

          </div -->

        <?php } ?>
        <?= $content; ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
