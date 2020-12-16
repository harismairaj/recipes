<?php
// use yii\helpers\Html;
// \humhub\modules\custom\assets\RecipeFormAsset::register($this);
?>
<div class="modal-dialog modal-dialog-extra-small animated pulse">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h5 class="modal-title"><strong>Confirm</strong> Delete This Recipe</h5>
        </div>
        <div class="modal-body text-center">
          Do you really want to delete this recipe? All likes and comments will be lost!
        </div>
        <div class="modal-footer">
            <button data-modal-cancel data-modal-close class="btn btn-default">Cancel</button>
            <button id="confirmDeleteRecipe" class="btn btn-primary">Delete</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function ()
    {
      $("#confirmDeleteRecipe").click(function()
      {
        $.ajax({
          url:window.location.origin+"/masalajaat/custom/recipe/delete",
          data:{
            content_id:<?= $content_id ?>,
            object_id:<?= $object_id ?>
          },
          dataType:"json",
          type:"POST",
          success:function(data)
          {
            $("#globalModal").modal('hide');
            window.location.reload();
          }
        });
      });
    });
</script>
