---
title: create a google column chart 
layout: post
---

## html part 
~~~html
<div class="col-lg-6 pull-left grpahinformation">
  <div id="restaurant_rating"></div>
</div>
~~~

## calling setOnLoadCallback function with callback parameter 
~~~js
google.charts.setOnLoadCallback(restaurant_rating);
~~~

## define callback

~~~js
function restaurant_rating() {
		// Create the data table.
		var data = new google.visualization.DataTable();
		data.addColumn('string' , 'Topping');
		data.addColumn('number' , 'Count');
		data.addColumn({ type: 'string', role: 'style' });
		var colors=['salmon', 'teal', 'brown', 'cadetblue', 'burlywood'];
		data.addRows([<?php if(isset($ratings)){
      foreach($ratings as $rating){ ?>
		['Rating <?= $rating->rating ?>' , <?= $rating->c ?>, colors.shift()] ,
      <?php }
      }?>
		]);
		var options = {
				'title' : 'Restaurant Rating' ,
				'width' : '100%',
				'height' : 400,
				vAxis: {
          minValue: 0,
        },

		};
		var chart = new google.visualization.ColumnChart(document.getElementById('restaurant_rating'));
		chart.draw(data , options);
}

~~~

for 3 column `topping`, `count`, `style` we are passing 3 value in `addRows` method. for colors of the column we take a `colors` variable and give a color to each row using array `shift` constructor functions 

# rating array which is coming  from laravel controller 

~~~php
Array
(
    [0] => stdClass Object
        (
            [c] => 18
            [rating] => 1
        )

    [1] => stdClass Object
        (
            [c] => 21
            [rating] => 2
        )

    [2] => stdClass Object
        (
            [c] => 21
            [rating] => 3
        )

    [3] => stdClass Object
        (
            [c] => 18
            [rating] => 4
        )

    [4] => stdClass Object
        (
            [c] => 18
            [rating] => 5
        )

)
~~~

### for pie chart we don't need 3rd column (style column where I add color)
~~~js
var chart = new google.visualization.PieChart(document.getElementById('restaurant_rating'));
~~~
