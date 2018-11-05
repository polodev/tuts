---
title: php function november 5 2018
layout: post
tags: ['functions']
---

~~~php
array_values()  
json_encode();
json_decode()
array_intersect()
~~~

## `array_values()`

It will give removed key of associated array

~~~php
$a = [
	'f1' => 'banana',
	'f2' => 'apple',
	'f3' => 'orange',
];
print_r (array_values($a));
~~~

Output for state above code 
~~~json
Array
(
    [0] => banana
    [1] => apple
    [2] => orange
)
~~~

## `json_encode()` - encode php to json 
~~~php
$a = [
	'f1' => 'banana',
	'f2' => 'apple',
	'f3' => 'orange',
];

$b = json_encode($a);

print_r( $b );
~~~

output 
~~~js
{
  "f1": "banana",
  "f2": "apple",
  "f3": "orange"
}
~~~


## `json_decode()` - decode json to php 
After encode to json if we require to decode or when we store value as array in mysql or any other database we need to decode to php again. In this case we use `json_decode()`    
~~~php
$b = json_encode($a);
$c = json_decode($b);
print_r( $c );
~~~

output of json_decode 
~~~js
stdClass Object
(
    [f1] => banana
    [f2] => apple
    [f3] => orange
)
~~~

## `array_intersect()` showing common elements from 2 or more array (in Bengali language it means ga, sa, gu)

~~~php
$a = ['a', 'b', 'c', 'd', 'f', 'g'];
$b = ['a', 'b', 'd', 'g', 'h'];
$c = array_intersect($a, $b);
print_r($c);
~~~

output of the state above code     

~~~php
Array
(
    [0] => a
    [1] => b
    [3] => d
    [5] => g
)
~~~












