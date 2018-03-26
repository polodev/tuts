---
title: Vagrant and Virtual box
layout: post
---

### how to initialize vagrant

~~~bash
vagrant init
~~~

### how to add new box in vagrant 
all box can be found <a href="https://app.vagrantup.com/boxes/search">https://app.vagrantup.com/boxes/search</a>
~~~html
vagrant box add <boxname>
~~~


### to see all box 

~~~bash
vagrant box list
~~~

### change boxed inside `Vagrantfile`

~~~bash
config.vm.box = "<boxname>"  
~~~

### to bootup up virtual machine 

~~~bash
vagrant up
~~~

### to login to guest machine 

~~~bash
vagrant ssh
~~~

### some linux command
~~~bash
#  to know information
uname -a 

# to know physical storage, ram 

df -h

# to see memory
free -m

# to back to host machine

exit

# to see all running process in linux 
ps -ef | grep apache
~~~


### to increase guest machine ram size 
open `Vagrantfile` and memory value

~~~bash
vb.memory = "2048"
~~~

### to restart guest machine with new `Vagrantfile` configuration with `provision` flag

~~~bash
vagrant reload --provision
~~~

### to hault vagrant guest machine 

~~~bash
vagrant halt
~~~

### file sync

All file and folder of project folder can be found `/vagrant` directory in guest machine. It will automatically synchronize  between guest machine and host machine. you can modify  in `vagrantfile`
~~~bash
config.vm.synced_folder "<host_machine_folder>", "<guest_machine_folder>"
~~~


### to write provision 
~~~bash
config.vm.provision :shell, path: "bootstrap.sh"
~~~

this means, default provision script write in `shell` and path of shell script is `bootstrap.sh`     

### code inside `bootstrap.sh`

~~~bash
#!/usr/bin/env bash
apt-get update
apt-get install -y apache2
ln -fs /vagrant /var/www/html

~~~

### wget website viewed in terminal

~~~bash
wget -q0- 127.0.0.1/vagrant
~~~
 
### Networking between host machine and guest machine in `Vagrantfile`
~~~bash
config.vm.network "forwarded_port", guest: 80, host: 8080
~~~


### static ip configure using `private network`
~~~bash
config.vm.network "private_network", ip: "192.168.33.10"
~~~

### share you vagrant static ip to everyone. dependancy `ngrok`

~~~bash
vagrant share
~~~


### to destroy vagrant 

~~~bash
vagrant destroy
~~~



















