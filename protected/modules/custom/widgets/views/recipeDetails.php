<?php
  \humhub\modules\custom\assets\RecipePostAsset::register($this);
?>
<div class="row">
  <div class="col-md-6">
  <?php
  if(isset($details['embededVideo']))
  {
    ?>
      <div class="youtube-iframe" data-embed="<?= $details['embededVideo'] ?>">
        <div class="play-button"></div>
      </div>
    <?php
  }
  ?>
  </div>
  <div class="col-md-6">
    <?php
    if(isset($details['serve']))
    {
      ?>
      <div class="col-md-4">
        <?= $details['serve'] ?> </br><small>Serve</small>
      </div>
      <?php
    }

    if(isset($details['prepTime']))
    {
      ?>
      <div class="col-md-4">
        <?= $details['prepTime'] ?> </br><small>Preparation Time</small>
      </div>
      <?php
    }

    if(isset($details['cookTime']))
    {
      ?>
      <div class="col-md-4">
        <?= $details['cookTime'] ?> </br><small>Cooking Time</small>
      </div>
      <?php
    }
    ?>
    </br>
    <?php
    if(isset($details['instruction']))
    {
      ?>
      <div class="col-md-4">
        <canvas id="chart_<?= $id ?>" width="400" height="400"></canvas>
      </div>
    <?php
    } ?>
    </br>
    <?php
    if(isset($details['ingredient']))
    {
      ?>
      <div class="col-md-4">
        <table>
          <thead>
            <tr>
              <th>Ingredient</th>
            </tr>
          </thead>
          <tbody>
          <?php
          foreach ($details['ingredient'] as $ingredient)
          {
          ?>
            <tr>
              <td>
                <?= $ingredient ?>
              </td>
            </tr>
          <?php
          }
          ?>
          </tbody>
        </table>
      </div>
      <?php
    }
  ?>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
      recipePost.youtube();
      recipePost.chart("#chart_<?= $id ?>",<?= json_encode($details['instruction']) ?>);
    });
</script>
