<div id="topbar-first" class="topbar">
    <div class="container" style="position:relative;">
        <div class="topbar-brand">
          <?php if ($logo->hasImage()){ ?>
              <a class="animated fadeIn navbar-brand" href="<?= Yii::$app->homeUrl; ?>">
                  <img class="img-rounded" src="<?= $logo->getUrl(); ?>" alt="MasalaJaat"/>
              </a>
          <?php } ?>
        </div>

        <div class="top-actions">
          <div class="add-recipe">
            <a href="javascript:;" data-action-click="ui.modal.load" data-action-url="<?= yii\helpers\Url::toRoute('/custom/modals/create/2') ?>">Create Recipe</a>
          </div>

          <div class="top-notification">
              <?= \humhub\widgets\NotificationArea::widget(); ?>
          </div>
        </div>

        <div class="topbar-actions">
            <?= \humhub\modules\user\widgets\AccountTopMenu::widget(); ?>
        </div>
    </div>
</div>
