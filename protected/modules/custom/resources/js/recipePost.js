var recipePost;
humhub.module('recipePost', function(module, require, $)
{
  recipePost = {
    // init:function(data)
    // {
      // recipePost.youtube();
      // recipePost.chart();
    // },
    youtube:function()
    {
      var youtubeFrame = $(".youtube-iframe");
      if(youtubeFrame.length > 0)
      {
        youtubeFrame.each(function()
        {
          youtubeFrame.append("<div class='img' style='background-image:url(https://img.youtube.com/vi/"+$(this).data("embed")+"/sddefault.jpg)'></div>");
        });
        youtubeFrame.click(function()
        {
          $(this).html("<iframe allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' height='100%' width='100%' frameborder='0' allowfullscreen='' class='youtube-styling' src='https://www.youtube.com/embed/" + $(this).data("embed") + "?rel=0&showinfo=0&autoplay=1'></iframe>");
        });
      }
    },
    chart:function(id,data)
    {
      var datasets = [];
      $.each(data,function()
      {
        datasets.push(100/data.length);
      });

      var myDoughnutChart = new Chart($(id), {
          type: 'doughnut',
          data: {
            datasets: [{
                data: datasets
            }],
            labels: data
          },
          options: {
            legend:{
              display:false
            }
          }
      });
    }
  };
});
