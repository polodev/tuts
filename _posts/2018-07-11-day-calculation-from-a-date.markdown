---
title: day calculation from a date
layout: post
---

# main law
we are planning to calculate Einstein date of birth (14 march, 1897)
~~~
(century code + year code + month code + day - leap year) % 7
~~~

* 0 - sun
* 1 - mon
* 2 - tue
* 3 - wed
* 4 - thu
* 5 - fri
* 6 - sat


# century code of Gregorian  (4206420)

* 1700 - 4
* 1800 - 2
* 1900 - 0
* 2000 - 6
* 2100 - 4
* 2200 - 2
* 2200 - 0

### `1897` belongs to 1800 century so year code is `2`

# year code 

law of the year code 

~~~

(YY + (YY / 4)) % 7
~~~
here YY is last 2 digit of the year    
in case of `1897`, `YY` is `97`   
since `(97 + (97 / 4)) % 7)` is 2, So **year code** is `2` 

## month code `033614625035`

* January - 0
* February - 3
* march - 3
* April - 6
* may - 1
* June - 4
* July - 6
* august - 2
* September - 5
* October - 0
* November - 3
* December - 5

Since Einstein born in march so **month code** is `3`

# leapyear code 

~~~
YYYY % 4 == 0 ? 'leapyear' : 'not leapyear' ;
&&
YYYY % 100 != 0 || YYYY % 400 == 0 ? 'leapyear' : 'not leapyear'
~~~

Since `1897` is not divisible by `4` so its not leap year. So **leap year code** `0`

# final calculation

~~~
Einstein date of birth : 14 march, 1897
century code for 1800 = 2
year code (97 + (97 / 4)) % 7 = 2
month code march = 3
day of the month = 14
leap year code = 0
(century code + year code + month code + day - leap year) % 7
(2 + 2 + 3 + 14 - 0) % 7
21 % 7 = 0
0 means Sunday
~~~





