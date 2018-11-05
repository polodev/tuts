---
title: getting current month content in laravel  using mysql raw query
layout: post
---
current months result 
~~~php
$this_month = date('n');
$ratings_last_month = DB::select("select count(id) as c, rating from ratings where (user_id=$id and MONTH(created_at) = $this_month  ) group by `rating` order by rating");
~~~

table description 

~~~bash
+------------+------------------+------+-----+---------+----------------+
| Field      | Type             | Null | Key | Default | Extra          |
+------------+------------------+------+-----+---------+----------------+
| id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| rating     | int(11)          | NO   |     | NULL    |                |
| ip_address | varchar(255)     | NO   |     | NULL    |                |
| user_id    | int(11)          | NO   |     | NULL    |                |
| created_at | timestamp        | YES  |     | NULL    |                |
| updated_at | timestamp        | YES  |     | NULL    |                |
+------------+------------------+------+-----+---------+----------------+
~~~