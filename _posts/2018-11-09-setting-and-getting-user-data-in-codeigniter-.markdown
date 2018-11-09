---
title: setting and getting user data in session, session flash codeigniter 
layout: post
---

# setting user data
~~~php
 $session_data = array(
	 'type' => "admin",
	 'email'     =>     $email,
	 'id'   => $res->id,
	 'username'   => $res->username,
	 'password'   => $res->password,
);
$this->session->set_userdata($session_data);
~~~

# getting user data 
~~~php
$id = $this->session->userdata( 'id' );
~~~


# setting flash message in session 

~~~php
$this->session->set_flashdata( 'success', 'All updated successfully' );
~~~

# getting flash message from session 

~~~html
<?php if ($this->session->flashdata('success')) { ?>
	<div class="alert alert-success"> <?= $this->session->flashdata('success') ?> </div>
<?php } ?>

<?php if ($this->session->flashdata('error')) { ?>
	<div class="alert alert-danger"> <?= $this->session->flashdata('error') ?> </div>
<?php } ?>
~~~


