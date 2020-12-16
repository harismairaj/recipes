<?php
  \humhub\modules\custom\assets\RecipePostAsset::register($this);
?>

<ul class="inline-list">
  <?php
  if(isset($details['serve']))
  {
    ?>
    <li>
      <?= $details['serve'] ?> </br><small>Serving</small>
    </li>
    <?php
  }

  if(isset($details['prepTime']))
  {
    ?>
    <li>
      <?= $details['prepTime'] ?> </br><small>Preparation Time</small>
    </li>
    <?php
  }

  if(isset($details['cookTime']))
  {
    ?>
    <li>
      <?= $details['cookTime'] ?> </br><small>Cooking Time</small>
    </li>
    <?php
  }
  ?>
</ul>
<div class="row">
  <div class="col-md-4 col-media" style="height:320px">
    <canvas height="300" width="300" class="chart" id="chart_<?= $id ?>"></canvas>
    <div id="embededVideo_<?= $id ?>" class="youtube-iframe" data-embed="<?= $details['embededVideo'] ?>"></div>
  </div>
  <div class="col-md-8">
      <?php
      if(isset($details['ingredient']))
      {
        ?>
        <div class="col-sm-4">
          <ul class="list">
            <li class="head">
              Ingredient
            </li>
            <?php
            foreach ($details['ingredient'] as $ingredient)
            {
            ?>
            <li>
              <?= $ingredient ?>
            </li>
            <?php
            }
            ?>
          </ul>
        </div>
        <?php
      }
      if(isset($details['instruction']))
      {
        ?>
        <div class="col-sm-8">
          <ul class="list">
            <li class="head">
              Instruction
            </li>
            <?php
            foreach ($details['instruction'] as $instruction)
            {
            ?>
            <li>
              <?= $instruction ?>
            </li>
            <?php
            }
            ?>
          </ul>
        </div>
        <?php
      }
      ?>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
      recipePost.youtube("#embededVideo_<?= $id ?>");
      recipePost.chart("#chart_<?= $id ?>",<?= json_encode($details['instruction']) ?>);
    });
</script>
