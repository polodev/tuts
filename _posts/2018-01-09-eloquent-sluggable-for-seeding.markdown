---
title: eloquent-sluggable-for-seeding
layout: post
---
#### First Download eloquent-sluggable package for laravel 5.5
~~~bash
composer require cviebrock/eloquent-sluggable:^4.3
~~~

#### added following code in model 
~~~php
# importing
use Cviebrock\EloquentSluggable\Sluggable;
~~~
~~~php
# method
public function sluggable()
{
    return [
        'slug' => [
            'source' => 'name'
        ]
    ];
}
~~~

#### inside seeder class
~~~php
#importing
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
~~~
~~~php
use Sluggable;

public function sluggable()
{
    return [
        'slug' => [
            'source' => 'name'
        ]
    ];
}

# using SlugService
'slug' => SlugService::createSlug(Hospital::class, 'slug', $company),
~~~







