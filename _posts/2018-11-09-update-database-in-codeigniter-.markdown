---
title: update database in codeigniter 
layout: post
---

~~~php
 public function upload_doc() {
    $id = $this->session->userdata( 'id' );
    $data = array(
      'heading' => $this->input->post('heading'),
    );
    $this->db->where( 'id', $id );
    $this->db->update( 'clients_web', $data );
    $this->session->set_flashdata( 'success', 'All updated successfully' );
    redirect( '/account/upload' );
}
~~~