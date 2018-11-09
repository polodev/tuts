---
title: getting single result from codeigniter
layout: post
---

~~~php

public function single_result($id)
{
    $this->db->select( '*' );
    $this->db->where( 'id',  $id);
    $q = $this->db->get( 'attachments' );
    $first = $q->row();
    return $first;
}
~~~