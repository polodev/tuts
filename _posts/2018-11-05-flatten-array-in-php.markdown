---
title: flatten array in php
layout: post
---

### following code for `int` type in my case. just change function appropriately when you want to change     


~~~php
public function flattenUnique(array $array) {
  $return = array();
  array_walk_recursive($array, function($a) use (&$return) { $return[] = intval($a); });
  return array_unique( $return );
}
~~~

