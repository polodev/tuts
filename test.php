<?php 

$a = ['a', 'b', 'c', 'd', 'f', 'g'];
$b = ['a', 'b', 'd', 'g', 'h'];
$c = array_intersect($a, $b);
print_r($c);
