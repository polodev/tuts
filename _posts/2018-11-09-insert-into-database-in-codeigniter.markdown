---
title: insert into database in codeigniter
layout: post
---

~~~php

public function insert_attachment($name, $path, $clients_web_id)
{
    $data =[
      'name' => $name,
      'path' => $path,
      'clients_web_id' => $clients_web_id
    ];

    $this->db->insert('attachments', $data);
    $id = $this->db->insert_id();        // return $this->db->
    $this->db->select( '*' );
    $this->db->where( 'id',  $id);
    $q = $this->db->get( 'attachments' );
    $first = $q->row();
    return $first;
    // return $this->attachments_by_clients_web_id($clients_web_id);
}
~~~   


