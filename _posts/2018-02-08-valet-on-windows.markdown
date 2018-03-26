---
title: valet-on-windows
layout: post
---
first you need to install php above 7.0 and added php in your environment variable. If you don't have php install you can install from your power shell by executing following command     

~~~php
# PHP 7.1
Set-ExecutionPolicy RemoteSigned; Invoke-WebRequest -Uri "https://github.com/cretueusebiu/valet-windows/raw/master/bin/php71.ps1" -OutFile $env:temp\php71.ps1; ."$env:temp\php71.ps1"

# PHP 7.2
Set-ExecutionPolicy RemoteSigned; Invoke-WebRequest -Uri "https://github.com/cretueusebiu/valet-windows/raw/master/bin/php72.ps1" -OutFile $env:temp\php72.ps1; ."$env:temp\php72.ps1"
~~~

download laravel globally   

~~~bash
composer global require "laravel/installer"
~~~

download valet for windows package globally   (https://github.com/cretueusebiu/valet-windows)

~~~php
composer global require cretueusebiu/valet-windows
~~~

### Setting up network adapter for valet  
go to open network and internet settings > change adapter options > click on any of your adapter you are using.
double click on `Internet protocol version 4` and choose `use the following dns server addresses`. Now put `127.0.0.1` as preferred dns server. click ok.     
now click on `Internet protocol version 6` and choose `use the following dns server addresses`. Now put `::1` as preferred dns server. click ok.     



### installing valet    
Open power shell or cmd as `administrator`. do following commands

~~~bash
valet install
~~~

It will install valet in your pc   

### to park valet

~~~bash
valet park
~~~



