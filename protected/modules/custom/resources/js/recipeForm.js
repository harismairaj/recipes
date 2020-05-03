var recipeForm;
humhub.module('recipeForm', function(module, require, $)
{
  recipeForm = {
    props:{

    },
    init:function()
    {
      console.log("init");
      recipeForm.instructions.init();
      recipeForm.ingredient.init();
    },
    ingredient:{
      elm:null,
      init:function(){
        recipeForm.ingredient.elm = $('#ingredientTable').DataTable({
          "paging": false,
          "ordering": false,
          "info": false,
          "searching": false
        });
        recipeForm.ingredient.setData([]);
        $('#addIngredient').off();
        $('#addIngredient').on('click',function()
        {
          recipeForm.ingredient.addRow();
        });
        recipeForm.ingredient.removeEvent();
      },
      addRow:function (title,qty,units)
      {
        title = title||"";
        qty = qty||0;
        units = units||"";
        if(units == "")
        {
          units = "<option value='kg'>kg</option>"+
          "<option value='cup'>cup</option>"+
          "<option value='tablespoon'>table spoon</option>"+
          "<option value='teaspoon'>tea spoon</option>"+
          "<option value='quantity'>quantity</option>"+
          "<option value='liter'>liter</option>"+
          "<option value='ounce'>ounce</option>"+
          "<option value='pinch'>pinch / چوٹکی</option>";
        }
        var row = [
          '<button class="fa fa-minus remove-btn"></button><input type="text" class="form-control" placeholder="Ingredient" value="'+title+'" />',
          '<input type="number" min="0" class="form-control" value="'+qty+'" />',
          '<select class="form-control">'+units+'</select>'
        ];
        recipeForm.ingredient.elm.row.add(row).draw(false);
        if(title == "")
        {
          recipeForm.ingredient.removeEvent();
        }
      },
      removeEvent:function()
      {
        $('#ingredientTable .remove-btn').off();
        $('#ingredientTable .remove-btn').on('click',function(event)
        {
          $(this).parent().parent().remove();
          var row = recipeForm.ingredient.elm.row($(this).parent().parent());
          var rowNode = row.node();
          row.remove();
        });
      },
      setData:function(data)
      {
        recipeForm.ingredient.elm.clear();
        $.each(data,function(key, value)
        {
          var units = "";
          $.each(value.tags,function(k, v)
          {
            units += "<option value='"+v+"'>"+v+"</option>";
          });
          recipeForm.ingredient.addRow(key,0,units);
        });
      }
    },
    instructions:{
      elm:null,
      init:function(){
        recipeForm.instructions.elm = $('#instructionsTable').DataTable({
          "paging": false,
          "ordering": false,
          "info": false,
          "searching": false
        });
        recipeForm.instructions.setData([]);
        $('#addInstructions').off();
        $('#addInstructions').on('click',function()
        {
          recipeForm.instructions.addRow();
        });
        recipeForm.instructions.removeEvent();
      },
      addRow:function (text,from,to)
      {
        text = text||"";
        to = to||0;
        from = from||0;
        var row = [
          '<button class="fa fa-minus remove-btn"></button><input type="text" class="form-control" placeholder="Instruction" value="'+text+'" />',
          '<input type="number" min="0" class="form-control" value="'+from+'" />',
          '<input type="number" min="0" class="form-control" value="'+to+'" />'
        ];
        recipeForm.instructions.elm.row.add(row).draw(false);
        if(text == "")
        {
          recipeForm.instructions.removeEvent();
        }
      },
      removeEvent:function()
      {
        $('#instructionsTable .remove-btn').off();
        $('#instructionsTable .remove-btn').on('click',function(event)
        {
          $(this).parent().parent().remove();
          var row = recipeForm.instructions.elm.row($(this).parent().parent());
          var rowNode = row.node();
          row.remove();
        });
      },
      setData:function(data)
      {
        // var trg = $("#recipeInstructions");
        // if(trg.val() != "")
        // {
        //   $.ajax({
        //     url:window.location.origin+"/deepfrypan/custom/recipe/",
        //     data:{
        //       instructions:trg.val()
        //     },
        //     dataType:"json",
        //     type:"POST",
        //     success:function(data)
        //     {
        //       recipeForm.ingredient(data);
        //     }
        //   });
        // }
        recipeForm.instructions.elm.clear();
        $.each(data,function(key, value)
        {
          recipeForm.instructions.addRow(key,0,0);
        });
      }
    },
    auto:function()
    {
      var categoryTags = ["rice", "cup", "pani", "water", "egg", "tomato", "potato", "onion", "banaspati rice", "sela rice","Carrot","salt","sugar","Dal Masor", "Malka Dal", "Chicken", "Beef", "Fish", "canola", "sunflower", "vegetable oil","red chili powder","turmeric powder","baking powder", "gram", "table spoon", "tea spoon"];

      tagState = categoryTags;

      function split(val)
      {
        return val.split( / \s*/ );
      }

      function extractLast(term)
      {
        return split(term).pop();
      }

      $("#recipeInstructions")
      .on( "keydown", function( event )
      {
        if ( (event.keyCode === $.ui.keyCode.TAB) &&
          $( this ).autocomplete( "instance" ).menu.active )
        {
          event.preventDefault();
          return;
        }
        else if(event.keyCode === $.ui.keyCode.SPACE)
        {
          console.log(1);
        }

        // Code to position and move the selection box as the user types
        var newY = $(this).textareaHelper('caretPos').top + (parseInt($(this).css('font-size'), 10) * 1.5);
        var newX = $(this).textareaHelper('caretPos').left;
        var posString = "left+" + newX + "px top+" + newY + "px";
        $(this).autocomplete("option", "position", {
          my : "left top",
          at : posString
        });
      })
      .autocomplete({
        minLength:2,
        autoFocus:true,
        close: function( event, ui )
        {
          //console.log(1);
        },
        source:function(request, response)
        {
          lastEntry = extractLast(request.term);
          if(lastEntry.length < 2)
          {
            return;
          }
          var filteredArray = $.map(tagState, function(item)
          {
            return item;
          });
          response($.ui.autocomplete.filter(filteredArray, lastEntry));
        },
        focus:function()
        {
          return false;
        },
        select:function(event, ui)
        {
          var terms = split(this.value);
          terms.pop();
          terms.push("("+ui.item.value+")");
          terms.push("");
          this.value = terms.join(" ");

          $("#ingredients").append("<li>"+ui.item.value+"</li>");

          return false;
        }
      });
    }
  };
});
