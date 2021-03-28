<?php
  use yii\helpers\Html;
?>
<div class="recipe-details">
  <div class="recipe-header">
    <div style="height:320px">
      <!-- canvas height="300" width="300" class="chart" id="chart_< ?= $object->content->object_id ?>"></canvas -->
      <div id="embededVideo_<?= $object->content->object_id ?>" class="youtube-iframe" data-embed="<?= $details['embededVideo'] ?>"></div>
    </div>
  </div>
  <div class="recipe-body">
    <a class="recipe-title" href="<?= $permalink ?>"><?= $content ?></a>
    <div class="share-links">
      <?php
        $option = "var width=575,height=400,left=($(window).width()-width)/2,top=($(window).height()-height)/2,url=this.href;opts='status=1'+',width='+width+',height='+height+',top='+top+',left=' + left;window.open(url, 'share', opts);return false;";
      ?>
      <?= Html::a('<i class="fa fa-facebook"></i>', 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($permalink) . '&description=' . urlencode($object->getContentDescription()),['onclick'=> $option]);?>
      <?= Html::a('<i class="fa fa-twitter"></i>', 'https://twitter.com/intent/tweet?text=' . urlencode($object->getContentDescription()) . '&url=' . urlencode($permalink),['onclick'=> $option]);?>
      <?= Html::a('<i class="fa fa-linkedin"></i>', 'https://www.linkedin.com/shareArticle?summary=&mini=true&source=&title=' . urlencode($object->getContentDescription()) . '&url=' . urlencode($permalink) . '&ro=false', ['onclick'=> $option]);?>
    </div>
    <div class="root-details">
      <ul>
          <li class="serve">Serving: <?= $details['serve'].' people' ?></li>
          <li class="prep-time">Preparation time: <?= $details['prepTime'] ?></li>
          <li class="cook-time">Cooking time: <?= $details['cookTime'] ?></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-sm-8">
        <ul class="list instructions">
          <li class="head">Instruction</li>
          <?php
          foreach ($details['instruction'] as $instruction)
          {
          ?>
          <li><?= $instruction ?></li>
          <?php
          }
          ?>
        </ul>
      </div>
      <div class="col-sm-4">
        <ul class="list ingredient">
          <li class="head">Ingredient</li>
          <?php
          foreach ($details['ingredient'] as $ingredient)
          {
          ?>
          <li><?= $ingredient ?></li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
  <script type="text/javascript">
      $(document).ready(function ()
      {
        recipePost.youtube("#embededVideo_<?= $object->content->object_id ?>");
        //recipePost.chart("#chart_< ?= $object->content->object_id ?>",< ?= json_encode($details['instruction']) ?>);
      });
  </script>
</div>
