<?php

use yii\helpers\Html;

humhub\modules\like\assets\LikeAsset::register($this);
?>

<span class="likeLinkContainer" id="likeLinkContainer_<?= $id ?>">

    <?php if (Yii::$app->user->isGuest): ?>
        <i class="fa fa-thumbs-o-up"></i>
        <?php echo Html::a(Yii::t('LikeModule.widgets_views_likeLink', 'Like'), Yii::$app->user->loginUrl, ['data-target' => '#globalModal']); ?>
    <?php else: ?>
        <a href="#" data-action-click="like.toggleLike" data-action-url="<?= $likeUrl ?>" class="like likeAnchor" style="<?= (!$currentUserLiked) ? '' : 'display:none'?>">
            <i class="fa fa-thumbs-o-up"></i>
            <span><?= Yii::t('LikeModule.widgets_views_likeLink', 'Like') ?></span>
        </a>
        <a href="#" data-action-click="like.toggleLike" data-action-url="<?= $unlikeUrl ?>" class="unlike likeAnchor" style="<?= ($currentUserLiked) ? '' : 'display:none'?>">
            <i class="fa fa-thumbs-up"></i>
            <span><?= Yii::t('LikeModule.widgets_views_likeLink', 'You Liked') ?></span>
        </a>
    <?php endif; ?>

    <?php if (count($likes) > 0) { ?>
        <!-- Create link to show all users, who liked this -->
        <a href="<?php echo $userListUrl; ?>" data-target="#globalModal">
            <span class="likeCount tt" data-placement="top" data-toggle="tooltip" title="<?= $title ?>">(<?= count($likes) ?>)</span>
        </a>
    <?php } else { ?>
        <span class="likeCount"></span>
    <?php } ?>

</span>
