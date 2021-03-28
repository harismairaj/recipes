var recipeForm;
humhub.module('recipeForm', function(module, require, $)
{
  recipeForm = {
    init:function(data)
    {
      recipeForm.instructions.init(data.instruction);
      recipeForm.ingredient.init(data.ingredient);
      recipeForm.google.init();
    },
    ingredient:{
      elm:null,
      init:function(data)
      {
        recipeForm.ingredient.elm = $('#ingredientTable').DataTable({
          "paging": false,
          "ordering": false,
          "info": false,
          "searching": false
        });
        // recipeForm.ingredient.setData([]);
        $('#addIngredient').off();
        $('#addIngredient').on('click',function()
        {
          recipeForm.ingredient.addRow();
        });
        $.each(data,function(i,obj)
        {
          recipeForm.ingredient.addRow(obj.text);
        });
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
          '<button class="fa fa-minus remove-btn"></button><input type="text" name="ingredient[]" class="form-control" placeholder="Ingredient" value="'+title+'" />',
          '<input type="number" min="0" name="qty[]" class="form-control" value="'+qty+'" />',
          '<select name="unit[]" class="form-control">'+units+'</select>'
        ];
        recipeForm.ingredient.elm.row.add(row).draw(false);
        recipeForm.ingredient.removeEvent();
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
      tags:{},
      elm:null,
      init:function(data)
      {
        recipeForm.instructions.elm = $('#instructionsTable').DataTable({
          "paging": false,
          "ordering": false,
          "info": false,
          "searching": false
        });
        // recipeForm.instructions.setData([]);
        $('#addInstructions').off();
        $('#addInstructions').on('click',function()
        {
          recipeForm.instructions.addRow();
        });
        recipeForm.instructions.removeEvent();
        $.each(data,function(i,obj)
        {
          recipeForm.instructions.addRow(obj.text);
        });
      },
      addRow:function (text,from,to)
      {
        text = text||"";
        to = to||0;
        from = from||0;
        var row = [
          // '<button class="fa fa-minus remove-btn"></button><div class="inputor hashTag form-control" contentEditable="true">'+text+'</div>',
          '<button class="fa fa-minus remove-btn"></button><input type="text" name="instruction[]" class="form-control" placeholder="Instruction" value="'+text+'" />',
          '<input type="number" name="from[]" min="0" class="form-control" value="'+from+'" />',
          '<input type="number" name="to[]" min="0" class="form-control" value="'+to+'" />'
        ];
        recipeForm.instructions.elm.row.add(row).draw(false);
        recipeForm.instructions.removeEvent();
        // recipeForm.instructions.applyHashTag();
      },
      applyHashTag:function()
      {
        $('.hashTag').atwho({
          at: "#",
          // data: recipeForm.instructions.tags,
          limit: 200,
          // headerTpl: "<small>Select ingredient</small>",
          // displayTpl: "<li><img src='/masalajaat/uploads/profile_image/${name}.jpg' height='20' width='20'/> ${name} </li>",
          // insertTpl: "<a href='#'>${name}</a>",
          callbacks: {
            // beforeInsert: function(value, $li)
            // {
            //   var v = value.slice(1);
            //   if(typeof recipeForm.instructions.tags[v] == "undefined" && v != "")
            //   {
            //     recipeForm.ingredient.addRow(v);
            //   }
            //   return value;
            // },
            afterMatchFailed: function(at, el)
            {
              if(at=='#')
              {
                var t = el.text().trim().slice(1);
                if(typeof recipeForm.instructions.tags[t] == "undefined"
                 && t != "")
                {
                  recipeForm.instructions.tags[t] = t;
                  // var arr = $.map(recipeForm.instructions.tags, function(value, i)
                  // {
                  //   return {'id':i,'name':value};
                  // });
                  // this.model.save(arr);
                  recipeForm.ingredient.addRow(t);
                  // this.insert("#"+t,$("<li class='cur'>"+t+"</li>"));
                }
                return true;
              }
            }
          }
        });
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
        //     url:window.location.origin+"/masalajaat/custom/recipe/",
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
    create:function()
    {
      $.ajax({
        url:window.location.origin+"/masalajaat/custom/recipe/create",
        data:$("#recipeModalForm").serializeArray(),
        dataType:"json",
        showLoader:true,
        type:"POST",
        success:function(data)
        {
          $("#globalModal").modal('hide');
          window.location.reload();
        }
      });
    },
    edit:function()
    {
      $.ajax({
        url:window.location.origin+"/masalajaat/custom/recipe/edit",
        data:$("#recipeModalForm").serializeArray(),
        dataType:"json",
        showLoader:true,
        type:"POST",
        success:function(data)
        {
          $("#globalModal").modal('hide');
          window.location.reload();
        }
      });
    },
    google:{
      authenticate:function()
      {
        return gapi.auth2.getAuthInstance()
            .signIn({scope: "https://www.googleapis.com/auth/youtube.readonly"})
            .then(function()
            {
              console.log("Sign-in successful");
            },
            function(err)
            {
              console.error("Error signing in", err);
            });
      },
      loadClient:function()
      {
        gapi.client.setApiKey("AIzaSyDwV6Wut9SUXYbFLywjWyXDx9Lv5CUxFT8");
        return gapi.client.load("https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest")
            .then(function()
            {
              console.log("GAPI client loaded for API");
            },
            function(err)
            {
              console.error("Error loading GAPI client for API", err);
            });
      },
      execute:function()
      {
        return gapi.client.youtube.channels.list({
          "part": [
            "contentDetails"
          ],
          "mine": true
        }).then(function(response)
        {
          // Handle the results here (response.result has the parsed body).
          console.log("Response", response);
        },
        function(err)
        {
          console.error("Execute error", err);
        });
      },
      init:function()
      {
          gapi.load("client:auth2", function()
          {
            gapi.auth2.init({client_id: "737047011901-8k7lq8g4oiuqdkii0rue1rmb5i2vrpkl.apps.googleusercontent.com"});
          });
        }
    }
  };
});
