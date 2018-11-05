---
title: next and previous element in php array
layout: post
language: ['php']
---

# getting next element from array 

~~~php
function get_next_element ($needle, $haystack) {
  $index = array_search($needle, $haystack);
  if (count($haystack) < 2) {
    return false;
  }
  if ($index < (count($haystack) - 1)) {
    $index++;
  }else {
    $index = 0;
  }
  return $haystack[$index];
}
~~~

## Previous Element 
~~~php
function get_prev_elemnt($needle, $haystack) {

  if (count($haystack) < 2) {
    return false;
  }
  $index = array_search($needle, $haystack);
  if ($index == 0 || $index < 1) {
    $index = count($haystack) - 1;
  }else {
    $index--;
  }
  return $haystack[$index];
}

~~~

## Testing 

~~~php
$needle = 3;
$haystack = [3, 2, 4, 5, 6];
echo get_prev_elemnt($needle, $haystack);
~~~

