<?php
// use yii\helpers\Html;
  \humhub\modules\custom\assets\RecipeFormAsset::register($this);
?>
<div class="modal-dialog modal-dialog-large animated fadeIn">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h5 class="modal-title"><strong><? ($mode=="new"?"Create":"Edit")?> Your Recipe</strong></h5>
            <small class="text-muted">All fields are important</small>
        </div>
        <div class="modal-body">
          <form id="recipeModalForm" onSubmit="return false;">
            <div class="row">
              <?php if($mode=="new"){ ?>
                <input type="hidden" name="contentcontainer_id" value="<?= $contentcontainer_id ?>">
              <?php }else{ ?>
                <input type="hidden" name="object_id" value="<?= $object_id ?>">
              <?php } ?>
              <div class="col-md-12">
                <div class="form-heading">
                  Title
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="message"
                  <?= (isset($message)?'data-id="'.$message["id"].'"':'') ?>
                  value="<?= (isset($message)?$message["text"]:"") ?>">
                  <p class="help-block help-block-error"></p>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-heading">
                  Serving
                </div>
                <div class="form-group">
                  <input type="number" min="0" class="form-control" name="serve"
                   <?= (isset($serve)?'data-id="'.$serve["id"].'"':'') ?>
                    value="<?= (isset($serve)?$serve["text"]:0) ?>">
                  <p class="help-block help-block-error"></p>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-heading">
                  Cooking Time
                </div>
                <div class="form-group">
                  <input type="number" min="0" class="form-control" name="cookTime"
                  <?= (isset($cookTime)?'data-id="'.$cookTime["id"].'"':'') ?>
                   value="<?= (isset($cookTime)?$cookTime["text"]:0) ?>">
                  <p class="help-block help-block-error"></p>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-heading">
                  Preparation Time
                </div>
                <div class="form-group">
                  <input type="number" min="0" class="form-control" name="prepTime"
                  <?= (isset($prepTime)?'data-id="'.$prepTime["id"].'"':'') ?>
                  value="<?= (isset($prepTime)?$prepTime["text"]:0) ?>">
                  <p class="help-block help-block-error"></p>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-heading">
                  YouTube Link
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="embededVideo"
                  <?= (isset($embededVideo)?'data-id="'.$embededVideo["id"].'"':'') ?>
                  value="<?= (isset($embededVideo)?$embededVideo["text"]:"") ?>">
                  <p class="help-block help-block-error"></p>
                </div>
              </div>

              <div class="col-md-6 custom-table">
                <table id="instructionsTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="width:50px">To</th>
                            <th style="width:50px">From</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="btn-group btn-group-justified" role="group" aria-label="Add Instruction">
                  <div class="btn-group" role="group">
                    <button id="addInstructions" class="btn btn-info">Add Instruction</button>
                    <!-- small class="muted-text">Type `#` before ingredient to autocomplete ingredient chart</small -->
                  </div>
                </div>
              </div>

              <div class="col-md-6 custom-table">
                <table id="ingredientTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="width:50px">Quantity</th>
                            <th style="width:50px">Unit</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="btn-group btn-group-justified" role="group" aria-label="Add Ingredient">
                  <div class="btn-group" role="group">
                    <button id="addIngredient" class="btn btn-info">Add Ingredient</button>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="btn-group btn-group-justified" role="group" aria-label="Add Ingredient">
                  <div class="btn-group" role="group">
                    <?php if($mode=="new"){ ?>
                      <a data-ui-loader href="javascript:recipeForm.create()" class="btn btn-primary">Create</a>
                    <?php }else{ ?>
                      <a data-ui-loader href="javascript:recipeForm.edit()" class="btn btn-primary">Update</a>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function ()
    {
      var data = {
        instruction:[],
        ingredient:[]
      };
      <?php if(isset($instruction)){ ?>
        data.instruction = <?= json_encode($instruction) ?>;
      <?php } ?>
      <?php if(isset($ingredient)){ ?>
        data.ingredient = <?= json_encode($ingredient) ?>;
      <?php } ?>
      recipeForm.init(data);
    });
</script>
