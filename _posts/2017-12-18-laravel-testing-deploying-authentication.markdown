---
title: laravel-testing-deploying-authentication
layout: post
---

### creating user and permission

~~~sql
CREATE DATABASE databasename;
CREATE USER 'user'@'localhost' IDENTIFIED BY 'password'

GRANT ALL ON database.* TO 'user'@'localhost';

mysql -uusername -ppassword -D databasename
~~~


### setting up old laravel project

~~~php
composer install
php artisan cache:clear
php artisan config:cache
php artisan migrate
~~~

### importing database
~~~sql
mysql -uroot -ppassword -D databasename < database.sql
~~~

# TTD

* Unit test 
* functional test

### tdd tools
* phpunit - most popular unit test    
* phpSpec behavior driven test. test like a story
* Codeception - unit, functional, acceptance test
* Selenium browser test
* Behat symphony based component which heavily used  for Behavior driven development 

### tdd deployment workflow
Staging environment just like production without real customer data in the database 

### Unit test => Isolated component test

~~~php
public function testTitlesModelCount()
{
  $titles = new Title;
  $this->assertTrue(count($titles->all()) === 6, 'It should have 6 titles');
}
public function testLastTitleMustBeProfessor()
{
  $titles = new Title;
  $titles_array = $titles->all();
  $this->assertEqual('Professor', array_pop($titles_array), 'Titles last element must to be professor');
}
~~~

### functional test  - Grouped component test

~~~php

public function testNewClientForm()
{
  $response = $this->get('/clients/new');
  $response->assertStatus(200);
}
public function testProfessorOption()
{
  $response = $this->get('/clients/new');
  $this->assertContains('Professor', $response->getContent(), 'HTML should have Professor');
}
~~~


### handle volatile data
Using session
* Temporary data
* Based on cookies

~~~php
$request->session()->put('key', 'value');
$request->session()->pull('key');
$request->session()->get('key');
$request->session()->has('key');
$request->session()->forget('key');
~~~


### csrf token 
we can disable from karnel or inside VerifyCsrfToken.php 
~~~php
protected $except = ['*']
~~~
csrf token inside form

~~~php
{% raw %}
{{csrf_field()}}
{% endraw %}
~~~

### adding middle ware 

~~~php
# Process 1
Route::get('/', 'PageController@index')->name('home')->middleware('auth');
# Process 2
Route::middleware('auth')->group(function () {
  Route::get('/', 'PageController@index')->name('home');
});
# Process 3
Route::group(['middleware' => 'auth'], function () {
  Route::get('/', 'PageController@index')->name('home');
  });
# Process 4
Route::get('/', [
  'uses' => 'PageController@index',
  'as' => 'home',
  'middleware' => 'auth'
]);
~~~

### exporting table 
It will export html table
~~~php
public function export()

{
  $data = [];
  $data['clients'] = $this->client->all();
  header('Content-disposition: attachment;filename=export.xls');
  return view('client/export', $data);
}
~~~

### uploading file

cheking method type 
~~~php
$request->isMethod('post');
~~~

html part

~~~html
{% raw %}
<form action="/upload" method="post" enctype="multipart/form-data" > 
  <div class="form-group">
      {{csrf_field()}}
      <label for="file">Upload</label>
      <input type="text" name="file" id="file" class="form-control">
      <input type="submit" class="btn btn-info">
  </div>
  
</form>
{% endraw %}
~~~
php part

~~~php
use Illuminate\Support\Facade\Input;
class GenericController {
  public function upload(Request $request)
  {
    $data = [];
    if ($request->isMethod('post')) {
      $this->validate($request, [
        'file' => 'mimes:jpeg,bmp,png'
      ]);
      Input::file('file')->move('images_folder which is inside public folder', 'imagename.jpg');

    }
  }
}
~~~


# Seeder

make a seeder class using php artisan 

~~~bash
php artisan make:seeder artisan 
~~~

seeding data  inside seeder class

~~~php
public function run()
{
  DB::table('users')->insert([
    'name' => 'shibu',
    'email' => 'polodev10@gmail.com'
  ]);
}
~~~
calling seeder class from  databaseSeeder class 
~~~php
public function run()
{
  $this->call(UserTableSeeder::class);
}
~~~
to seed database 

~~~bash
php artisan db:seed
~~~

migration with seed
~~~php
php artisan migrate --seed
php artisan migrate:refresh --seed
~~~

### homested and  vagrant

download homested vagrant box
~~~php
vagrant box add laravel/homestead
~~~

git clone homestead from laravel official website     

~~~php
git clone https://homestead_link 
~~~

checkout to laravel stable one
~~~bash
git checkout v5.5.0
~~~

run `init.sh` file for linux or mac user. run `init.bat` for windows user to generate Homestead.yaml file       

~~~php
bash init.sh
~~~

Now generate rsa key (in windows we have to use puttyGen)
~~~bash
mkdir ssh_vagrant
cd ssh_vagrant
ssh-keygen -t rsa 
~~~ 

after typing `ssh-keygen -t rsa` we will pass the `ssh_vagrant folder` absolute path which can be found by `pwd` command . with suffix `/id_rsa`
~~~bash
/Users/polodev/Desktop/ssh_vagrant/id_rsa
~~~


inside Homestead.yaml file 

~~~yml
authorize: /Users/polodev/Desktop/ssh_vagrant/id_rsa.pub
keys: 
  - /Users/polodev/Desktop/ssh_vagrant/id_rsa
~~~
configure `folders` and `sites` also inside Homestead.yaml file    

now give credential to `.env` file.

now start vagrant and do followings 

~~~php
vagrant up
vagrant ssh
cd code
php artisan cache:clear
php artisan config
php artisan migrate
php artisan db:seed
~~~















 














