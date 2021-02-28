var recipePost;
humhub.module('recipePost', function(module, require, $)
{
  recipePost = {
    youtube:function(id,embedCode)
    {
      var youtubeFrame = $(id);
      youtubeFrame.html("<div class='play-button'></div><div class='img' style='background-image:url(https://img.youtube.com/vi/"+youtubeFrame.data("embed")+"/sddefault.jpg)'></div>");
      youtubeFrame.click(function()
      {
        $(this).html("<iframe allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' height='100%' width='100%' frameborder='0' allowfullscreen='' class='youtube-styling' src='https://www.youtube.com/embed/" + $(this).data("embed") + "?rel=0&showinfo=0&autoplay=1'></iframe>");
      });
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
                data: datasets,
                backgroundColor:["#004d80","#0076ba","#00a2ff","#56c1ff","#bae4fc","#e8f5fd","#e4bfba","#d08c83","#d15e4d","#d43d27","#a31804","#640e02"]
            }],
            labels: data
          },
          options: {
            responsive: false,
            maintainAspectRatio: false,
            cutoutPercentage:90,
            legend:{
              display:false
            }
          }
      });
    },
    parallax:function()
    {
      lax.init();
      lax.addDriver('scrollY', function () {
        return window.scrollY
      });
      lax.addElements(".recipe.panel", {
        scrollY: {
          translateX: [
            ["elInY", "elCenterY", "elOutY"],
            ['screenWidth', 0, 0],
            {
              easing: 'easeInOutQuart',
            }
          ],
          opacity: [
            ["elInY", "elCenterY", "elOutY"],
            [0, 1, 0],
            {
              easing: 'easeInOutCubic'
            }
          ],
          "box-shadow": [
            ["elInY+200", "elCenterY", "elOutY-200"],
            [0, 50, 0],
            {
              easing: 'easeInOutQuint',
              cssFn: (val) => {
                return `${val}px ${val}px ${val}px rgba(0,0,0,0.5)`
              }
            }
          ],
        }
      });
    }
  };
});
