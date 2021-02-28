<?php

use humhub\libs\Html;
use humhub\modules\custom\widgets\RecipeDetails;
use humhub\modules\content\widgets\WallEntryAddons;
use humhub\modules\content\widgets\WallEntryControls;
use humhub\modules\custom\widgets\RecipeControls;
use humhub\modules\content\widgets\WallEntryLabels;
use humhub\modules\space\models\Space;
use humhub\modules\space\widgets\Image as SpaceImage;
use humhub\modules\user\widgets\Image as UserImage;
use humhub\widgets\TimeAgo;
use yii\helpers\Url;
/* @var $object \humhub\modules\content\models\Content */
/* @var $container \humhub\modules\content\components\ContentContainerActiveRecord */
/* @var $renderControls boolean */
/* @var $wallEntryWidget string */
/* @var $user \humhub\modules\user\models\User */
/* @var $showContentContainer \humhub\modules\user\models\User */
$isRecipe = false;
foreach ($object->getLabels() as $label)
{
  if($label->text == "Recipe")
  {
    $isRecipe = true;
    break;
  }
}

?>
<div class="<?= ($isRecipe?"recipe ":"normal-post ") ?>panel panel-default wall_<?= $object->getUniqueId(); ?>">
    <div class="panel-body">
        <div class="media">
            <!-- since v1.2 -->
            <div class="stream-entry-loader"></div>

            <div class="content" id="wall_content_<?= $object->getUniqueId(); ?>">
                <?php if($isRecipe){ ?>
                    <?= RecipeDetails::widget(['object' => $object, 'content' => $content]); ?>
                <?php }else{
                  echo $content;
                } ?>
            </div>

            <!-- start: show wall entry options -->
            <?php if ($renderControls) : ?>
                <ul class="nav nav-pills preferences">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"
                           aria-label="<?= Yii::t('base', 'Toggle stream entry menu'); ?>" aria-haspopup="true">
                            <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="dropdown-menu pull-right">
                          <?php if($isRecipe && ($object->content->created_by == Yii::$app->user->id || Yii::$app->user->isAdmin())){ ?>
                            <li>
                              <a href="#" data-action-click="ui.modal.load" data-action-url="<?= Url::toRoute('/custom/modals/delete/'.$object->content->id.'/'.$object->content->object_id) ?>"><i class="fa fa-trash-o"></i> Delete</a>
                            </li>
                            <li>
                              <a href="#" data-action-click="ui.modal.load" data-action-url="<?= Url::toRoute('/custom/modals/edit/'.$object->content->object_id) ?>"><i class="fa fa-pencil"></i> Edit</a>
                            </li>
                            <?php }else{ ?>
                              <?= WallEntryControls::widget(['object' => $object, 'wallEntryWidget' => $wallEntryWidget]); ?>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            <?php endif; ?>
            <!-- end: show wall entry options -->

        </div>
    </div>
    <div class="panel-bottom">
      <div class="info-panel">
        <?=
        UserImage::widget([
          'user' => $user,
          'width' => 20,
          'htmlOptions' => ['class' => 'author-image','data-contentcontainer-id' => $user->contentcontainer_id]
        ]);
        ?>
        <?= Html::containerLink($user); ?>
        <?php if ($container && $showContentContainer): ?>
          <span class="viaLink">
            <i class="fa fa-caret-right" aria-hidden="true"></i>
            <?= Html::containerLink($container); ?>
          </span>
        <?php endif; ?>
        <div class="media-subheading">
          <?php if ($updatedAt !== null){
            echo "<div>posted at ".TimeAgo::widget(['timestamp' => $updatedAt])."</div>";
          }else{
            echo "<div>modified at ".TimeAgo::widget(['timestamp' => $createdAt])."</div>";
          } ?>
        </div>
        <div class="<?= ($renderControls) ? 'labels' : '' ?>">
          <?= WallEntryLabels::widget(['object' => $object]); ?>
        </div>
      </div>

      <!-- wall-entry-addons class required since 1.2 -->
      <?php if ($renderAddons) : ?>
        <div class="stream-entry-addons clearfix">
          <?= WallEntryAddons::widget($addonOptions); ?>
        </div>
      <?php endif; ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
      recipePost.parallax();
    });
</script>
