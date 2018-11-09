---
title: order by clause in and manipulate database result  codeigniter 
layout: post
---    

~~~php
  public function getUserInfoById($id) {
    $this->db->select( '*' );
    $this->db->where( 'id', $id );
    $q = $this->db->get( 'clients_web' );
    return $q->row();
  }
  public function getAllUpload() {
   $this->db->select('*');
   $this->db->from('user_upload');
   $this->db->order_by("id", "desc");
   $query=$this->db->get();
   $attachments =  $query->result_array();
   $r = [];
   foreach ($attachments as $value) {
     $id = explode(',', $value['attachments']);
     $this->db->select('*');
     $this->db->from('attachments');
     $this->db->where_in('id', $id);
     $value['file_list'] = $this->db->get();
     $value['file_list'] = $value['file_list']->result_array();
     $value['user_details'] = $this->getUserInfoById($value['clients_web_id']);
     $r[] = $value;
   }
   // echo json_encode();
   // echo json_encode($r);
   return $r;
  }
~~~