---
title: deleting in database and unlink file in codeigniter
layout: post
---
# controller code 
~~~php
public function attachments_by_clients_web_id()
{
  $id = $this->session->userdata( 'id' );
  $attachments = $this->user_model->attachments_by_clients_web_id($id);
  echo json_encode($attachments);
}
public function delete_attachment() {
  $id = $this->input->post( 'id') ;
  $this->db->select( '*' );
  $this->db->where( 'id',  $id);
  $q = $this->db->get( 'attachments' );
  $first = $q->row();
  $this->db->delete('attachments', array('id' => $id));
  if($this->db->affected_rows() >= 1){
      $upload_path = './assets/user/images/' . $first->path;
      if(unlink($upload_path)) {
        $this->attachments_by_clients_web_id();
      }
  } else {
      $this->attachments_by_clients_web_id();
  }
  return;
}
~~~


# model 

~~~php
// return whole results after deleting 
public function attachments_by_clients_web_id($clients_web_id)
{
   $where['clients_web_id'] = $clients_web_id;
   $result_set = $this->db->get_where('attachments', $where);
   return $result_set->result_array();
}
~~~




