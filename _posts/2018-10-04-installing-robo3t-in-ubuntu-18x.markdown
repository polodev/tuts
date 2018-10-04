---
title: installing robo3t in ubuntu 18.X
layout: post
---


download robomongo 3t from their website. Let downloaded file name is `robomongo-0.9.0-rc8-linux-x86_64-c113244.tar.gz`     


extract `robomongo-0.9.0-rc8-linux-x86_64-c113244.tar.gz`  file      



move extracted folder to `/usr/bin` directory by following command 
~~~bash
sudo mv robomongo-0.9.0-rc8-linux-x86_64-c113244/ /usr/bin/robomongo
~~~

add `export PATH=/usr/bin/robomongo/bin:$PATH` in your .bashrc or .zshrc

If you are using fish shell, you need to change the last line to:

`set PATH $PATH /usr/bin/robomongo/bin`


now start robo3t by typing following in command prompt
~~~bash
robo3t
~~~
