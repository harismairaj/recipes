humhub.module('recipeForm', function(module, require, $)
{
  var self = {
    props:{
      ingredients:{}
    },
    init:function()
    {
      self.props.t = $('#ingredientTable').DataTable();
      self.carousel();
      self.recipeServing();
      self.createRecipe();
      self.instructions();
    },
    carousel:function()
    {
      $('#createRecipeCarousel').carousel({
        wrap:false,
        keyboard:false,
        interval:false
      });

      $('nav .back-next .previous a').on("click",function()
      {
        self.back();
      });
      $('nav .back-next .next a').on("click",function()
      {
        self.next();
      });
    },
    ingredient:function(data)
    {
      self.props.t.clear();
      $.each(data,function(key, value)
      {
        var options = "";
        $.each(value.tags,function(k, v)
        {
          options += "<option value='"+v+"'>"+v+"</option>";
        });
        self.addRow(key,0,options);
      });
      $('#addIngredient').off();
      $('#addIngredient').on('click',function()
      {
        self.addRow();
      });

      $('.remove-btn').off();
      $('.remove-btn').on('click',function(event)
      {
        $(this).parent().parent().remove();

        // var row = self.props.t.row($(this).parent().parent());
        // var rowNode = row.node();
        // row.remove();
      });
    },
    addRow:function(title,qty,options)
    {
      title = title||"";
      qty = qty||0;
      options = options||"";
      if(options == "")
      {
        options = "<option value='kg'>kg</option>"+
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
        '<select class="form-control">'+options+'</select>'
      ];
      self.props.t.row.add(row).draw(false);
      if(title != "")
      {
        self.props.ingredients[title] = row;
      }
    },
    instructions:function()
    {
      var already = false;
      $("#recipeInstructions")
      .on("blur",function(event)
      {
        already = true;
        inputInstruction($(this));
      })
      .on("keydown",function(event)
      {
        already = true;
        if(event.keyCode == 13)
        {
          inputInstruction($(this));
        }
      });

      function inputInstruction(trg)
      {
        if(already && trg.val() != "")
        {
          $.ajax({
            url:window.location.origin+"/deepfrypan/custom/recipe/",
            data:{
              instructions:trg.val()
            },
            dataType:"json",
            type:"POST",
            success:function(data)
            {
              self.ingredient(data);
              self.next();
            }
          });
        }
        already = false;
      }
    },
    recipeServing:function()
    {
      var already = false;
      $("#recipeServing")
      .on('blur', function (event)
      {
        inputServing($(this));
      })
      .on('keydown', function (event)
      {
        if(event.keyCode == 13)
        {
          inputServing($(this));
        }
      });
      function inputServing(trg)
      {
        if(trg.val() != 0)
        {
          console.log("inputServing");
          self.next();
          $("#recipeInstructions").focus();
        }
      }
    },
    createRecipe:function()
    {
      $("#createRecipeBtn")
      .on('click', function ()
      {
        createRecipe();
      })
      .on('keydown', function (event)
      {
        if(event.keyCode == 13)
        {
          createRecipe();
        }
      });

      function createRecipe()
      {
        console.log("createRecipe");
        $("#createRecipeBtn").hide();
        $("#createRecipeCarousel").show();
        $("#recipeServing").focus();
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
    },
    next:function()
    {
      $('#createRecipeCarousel').carousel('next');
      $('#createRecipeCarousel').carousel('pause');
    },
    back:function()
    {
      $('#createRecipeCarousel').carousel('prev');
      $('#createRecipeCarousel').carousel('next');
    }
  };
  self.init();
});
