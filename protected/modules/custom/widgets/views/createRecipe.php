<?php
use yii\helpers\Html;
\humhub\modules\custom\assets\RecipeFormAsset::register($this);
?>

<div id="createRecipeCarousel" class="carousel slide" data-ride="carousel" style="display:none">

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">

    <div class="item active">
      <div class="carousel-heading">
        <h3>Serving <small>How many people can be serve?</small></h3>
      </div>
      <div class="form-group">
        <input type="number" min="0" class="form-control" id="recipeServing" name="recipeServing" value="0">
        <p class="help-block help-block-error"></p>
      </div>
    </div>

    <div class="item">
      <div class="carousel-heading">
        <h3>Instructions <small>How to cook and what steps are included?</small></h3>
      </div>
      <div class="form-group">
        <textarea class="form-control" rows="10" id="recipeInstructions" name="recipeInstructions"></textarea>
        <p class="help-block help-block-error"></p>
      </div>
    </div>

    <div class="item">
      <div class="carousel-heading">
        <h3>Ingredients <small>How many ingredients are used?</small></h3>
      </div>
      <div class="form-group">
        <div class="btn-group" role="group">
          <button type="button" id="addIngredient" class="btn btn-primary">Add</button>
        </div>
        <table id="ingredientTable">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div class="input-group" id="ingredientRow" style="display:none">
          <input type="text" class="form-control ingredient-title" placeholder="Ingredient">
          <span class="input-group-addon">
            <input type="number" min="0" class="form-control ingredient-qty" value="0">
          </span>
          <div class="input-group-btn">
            <!-- select class="form-control ingredient-unit">

            </select -->
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">kg <span class="caret"></span></button>
            <ul class="dropdown-menu dropdown-menu-right ingredient-unit">

            </ul>
          </div>
        </div>
      </div>
    </div>

    <nav>
      <ul class="pager back-next">
        <li class="previous"><a href="javascript:;"><span aria-hidden="true">&larr;</span> Back</a></li>
        <li class="next"><a href="javascript:;">Next <span aria-hidden="true">&rarr;</span></a></li>
      </ul>
    </nav>

  </div>

</div>

<?= Html::hiddenInput("containerGuid", $contentContainer->guid); ?>
<?= Html::hiddenInput("containerClass", get_class($contentContainer)); ?>

<ul id="contentFormError"></ul>

<div class="controls pull-right">
  <button type="button" id="createRecipeBtn" class="btn btn-info" tabindex="1">Create A Recipe</button>
</div>
