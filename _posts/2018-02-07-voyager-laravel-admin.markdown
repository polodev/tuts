---
title: voyager-laravel-admin
layout: post
---

## Installing voyager   

~~~bash
composer require tcg/voyager
~~~

adding credentials to `.env` file  must put value for `app_url`. Do voyager command

~~~bash
php artisan voyager:install --with-dummy
~~~

login to app_url/admin 


# configurations 

configuration file will be `config/voyager.php`        
available configuration      


* default role
* custom controller
* model namespace 
* voyager assets
* storage (public/s3/google cloud)
* media hidden fies
* if I hide any table from voyager admin
* admin prefix
* multi lingual  
* dashboard 
* widgets
* dev tips
* additional css
* additional js



## voyager routing package    
I can change prefix from
~~~
web.php
config/voyager.php
~~~
If I change slug from bread I need to update slug in menu builder as well     

## media    
actually linking in our local storage (storage/app/public)    

## Menu builder 
Its drag and drop menu builder. we can call menu from our frontend by menu name    

~~~php
{!! menu('main', 'bootstrap') !!}
~~~

## database manager    

create new table

## bread (for crud functionality )

after making bread we have to add bread to menu builder in order to showing in admin menu list   

## relationships   

will be found inside bread. model relationship, which field will be shown(generally name), which field will be value(id)

## settings 

showing image in our frontend   

~~~bash
{% raw %}
{{ Voyager::image("site.logo")}}
{% endraw %}
~~~

## compass   
Can make artisan command from compass   

## roles and permissions
~~~
## permissions  
<?php $page = TCG\Voyager\Models\Page::first();  ?>
@can('browse', $page)
  You can brows page
@else 
  You do not have permission to view this page
@endcan

# or
<?php $browsePage = Voyager::can('browse_pages') ?>

@if($browsePage)
  You can browse pages
@else
  You can not browse pages
@endif
~~~

## google anlytics     

go to console.developers.google.com/apis/dashboard and make new credentials   

~~~bash
credentials > create credentials ^ OAuth client ID
in create client id  page 
application type web application 
Name : voyager analytics
url: http://voyager.dev
~~~
go to my admin area and paste google analytics client id. It will show analytics in your dashboard   

### advanced bread options for  additional options       
optional details like changing image size when uploading. There are lot of options. we should look into documentations      

## widgets on dashboard    

In dashboard there are some widgets I can change from `config/voygager.php` file. In order to add additional widgets copy from voyager any of built in widget and paste inside `App\Widget\YourWidgetName.php`. Update as per as you need and adding this widget inside `config\voyager.php` file    

## custom menu template 
copy menu template from tcg/resources/views/menu/default.php  and make a file in our resources and paste it there.    
in order to use menu template   
~~~php
{!! menu('menu_name', 'template-location')!!}
~~~

##  custom view   
make a following file and writing appropriate content under our resources/view

~~~
vendor/voyager/products/browse.blade.php

# for reference go to composer vendor directory and copy from bread browse
resource/views/bread/browse.blade.php
~~~























