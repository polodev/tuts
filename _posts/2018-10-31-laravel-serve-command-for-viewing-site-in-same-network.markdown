---
title: laravel serve command for viewing site in same network
layout: post
tags: ['snippet']
---

# to find ip address // inet will be host
~~~bash
ifconfig | grep 192.168
~~~
# to serve 
~~~bash
sudo php artisan serve --host=192.168.31.254 --port=80
~~~

