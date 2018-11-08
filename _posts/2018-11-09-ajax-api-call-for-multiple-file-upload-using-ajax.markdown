---
title: ajax api call for multiple file upload using ajax
layout: post
---
# upload php view file 

~~~html
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Important Owl stylesheet -->
	<!-- <link rel="stylesheet" href="<?php/// echo base_url('/assets/site/css/owl.carousel.css'); ?>"> -->

	<!-- Default Theme -->
	<!-- <link rel="stylesheet" href="<?php// echo base_url('/assets/site/css/owl.theme.default.min.css'); ?>"> -->

	<!-- <link rel="stylesheet" type="text/css" href="<?php///echo base_url('/assets/site/css/style.css'); ?>"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/site/css/style.css'); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src='https://code.jquery.com/jquery-3.3.1.js'></script>
<style>
form h2 {
  color: #379e01;
  font-size: 25px;
  padding: 50px 0;
}
form {
  width: 80%;
  margin: 0 auto;
}
.heading-div {}
.heading-div label {
  color: #379e01;
}
.heading-div input {
  display: block;
  text-align: center;
  width: 100%;
  margin: 0 auto;
  border: 2px solid #a3a3a3;
  padding: 5px;
  color: #666;
  font-weight: bold;
}
input#image_upload {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.image-div {}
input#image_upload + label {
    font-size: 1.25em;
    cursor: pointer;
    font-weight: 700;
    color: #379e01;
    padding: 5px;
    background-color: transparent;
    border: 2px solid #a3a3a3;
    width: 100%;
    display: block;
    text-align: center;
}

input#image_upload:focus + label {}
input#image_upload + label:hover {
    background-color: gray;
    color: white;
}
#image_upload + label * {
  pointer-events: none;
}
button.submit {
 background: #379e01;
 color: white;
 border: none;
 padding: 5px 10px;
 outline: none;
}

#selectedFiles li {
  color: gray;
  font-size: 14px;
}

#selectedFiles li span{
  padding-left: 20px;
  cursor: pointer;
  display: inline-block;
}
#selectedFiles li span:hover{
  color: tomato;
}
</style>

</head>
<body>

<div class="site-section">
	<div class="container">
		<div class="main-content">
			<h1 class="my-account">Document Upload</h1>
			<div class="row">
				<div class="col-md-3">
					<?php $this->load->view('front/left_menus'); ?>
				</div>
				<div class="col-md-9">
					<div  class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title" style="text-transform: uppercase;"><?php echo $this->session->userdata('firstname');?></h3>
						</div>
						<div class="panel-body">
                  <form
                    data-action="<?php echo base_url('front/upload_doc_ajax/');?>"
                   role="form" id="form" action="<?php echo base_url('front/upload_doc/');?>" method="POST" enctype="multipart/form-data">
                      <div class="box-body">

                          <div class="form-group heading-div">
                              <label for="exampleInputEmail1">Heading</label>
                              <input id="heading_input" type="text" name="heading" placeholder="Enter Heading" value="<?php if(isset($user['heading'])) echo $user['heading']; ?>" id="heading" placeholder="Enter Heading">
                          </div>

                          <div class="form-group image-div">
                              <input
                                data-action="<?php echo base_url('front/upload_attachments_by_ajax/');?>"
                                data-attachments="<?php echo base_url('front/attachments_by_clients_web_id/');?>"
                                data-image_root="<?php echo base_url('/assets/user/images/');?>"
                                data-delete="<?php echo base_url('front/delete_attachment/');?>"
                                id="image_upload"
                                multiple
                                name="image"
                                placeholder=""
                                type="file">
                              <label id="image_upload_label" for="image_upload"><i class="fa fa-paperclip" aria-hidden="true"></i> Add File</label>
                          </div>
                          <div class='form-group'>
                              <div id="selectedFiles"></div>
                          </div>
                          <!--


                           -->

                          <!-- <?php // if(isset($user['upload_file']) && $user['upload_file'] != "") {?> -->
                              <!-- <img src="<?php // echo base_url('/assets/user/images/'.$user['upload_file']); ?>"> -->
                          <!-- <?php // }?> -->

                          <!--                 <div class="form-group">
<label for="exampleInputPassword1">Description</label>
<textarea id="editor1" name="content" rows="10" cols="80"><?php// if ($this->session->flashdata('error')){//  echo $this->session->userdata('content'); }elseif(isset($result)){ echo $result['content'];}?></textarea>
</div> -->

                      </div>
                      <!-- /.box-body -->

                      <div class="box-footer">
                          <button type="submit" class="submit">Submit</button>
                      </div>
                  </form>

						</div>

					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<script>
(function () {
var app = {
  files: [

  ],
  loading: false,
  render: function () {
    var html = '';
    this.files.forEach(file => {
      html+= `
      <li>
        <i class="fa fa-paperclip" aria-hidden="true"></i>
        <a href='${this.$input.attr('data-image_root') + file.path }' download>
          ${this.text_truncate(file.name, 25)}
        </a>
        <span class='close-file' data-id=${file.id}>X</span>
      </li>`;
    });
    this.$selectedFiles.html(html);
  },
  init: function () {
    this.domCached();
    this.bindThis();
    this.bindEvents();
    // this.onLoadFiles();
    this.render();
  },
  onLoadFiles: function() {
    var url = this.$input.attr('data-attachments');
    $.ajax({
      type: 'GET',
      url,
      success: (response) => {
        let data = JSON.parse(response);
        this.files = data;
        this.render();
      }
    })
  },
  bindThis: function() {
    this.fileChange = this.fileChange.bind(this);
  },
  domCached: function () {
   this.$input = $('#image_upload');
   this.$label = $('#image_upload_label');
   this.label_spinner = '<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>'
   this.label_content = `<i class="fa fa-paperclip" aria-hidden="true"></i> Add File`
   this.$selectedFiles = $('#selectedFiles');
   this.$form = $('#form')
   this.$heading_input = $('#heading_input');
  },
  bindEvents: function () {
    this.$input.on('change', this.fileChange);
    this.$form.on('click', '.close-file', this.deleteFile.bind(this));
    this.$form.on('submit', this.submit.bind(this));
  },
  submit: function (e) {
    e.preventDefault();
    var heading = this.$heading_input.val();
    var attachments = [];
    this.files.forEach(file => {
      attachments.push(file.id);
    })
    var data = {
      heading,
      attachments: attachments.join(',')
    }
    this.formSubmit(data)
  },
  formSubmit: function (data) {
    $.ajax({
      type: 'POST',
      data,
      url: this.$form.attr('data-action'),
      success: (response) => {
        this.$form.html(
          `<h2>Document uploaded successfully. We are processing ASAP, You will hear back Shortly</h2>`
          )
      }
    })
  },
  deleteFile: function(e) {
    var id = $(e.currentTarget).attr('data-id');
    this.files = this.files.filter(file => file.id != id);
    this.render();
    $.ajax({
      type: 'POST',
      url: this.$input.attr('data-delete'),
      data: {id: id},
      success:  (response) => {
        console.log('removed')
      }
    })
  },
  fileChange: function (e) {
    e.preventDefault();
    var files = e.target.files;
    console.log('flies', files);
    for (var i = 0; i < files.length; i++) {
        var eachFile = files[i];
        var formData = new FormData();
        formData.append("image", eachFile);
        this.uploadThisFile(formData);
    }
  },
  uploadThisFile: function (formData) {
     this.$label.html(this.label_spinner);
    $.ajax({
        type: "POST",
        url: this.$input.attr('data-action'), // Upload URL Here
        data: formData,
        processData: false,
        contentType: false,
        xhr:  () => {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress",  (evt) => {
                if (evt.lengthComputable) {
                    //=================================================
                    // this is the upload progress in percentage
                    //=================================================
                    var percentComplete = (evt.loaded / evt.total) * 100;
                    console.log('percentComplete', percentComplete);
                    this.$label.html(this.label_spinner + ' ' + percentComplete + '%');
                    if (percentComplete > 99) {
                       this.$label.html(this.label_content);
                    }
                }
            }, false);
            return xhr;
        },
        success:  (response) => {
            //=================================================
            // Ajax return Response
            //=================================================
            this.files.push(JSON.parse(response))
            this.render();
        }
    });

  },
  text_truncate: function(str, length, ending) {
    if (length == null) {
      length = 100;
    }
    if (ending == null) {
      ending = '...';
    }
    return str.length > length ? str.substring(0, length - ending.length) + ending : str;
  },

}
app.init();
}());

// $('#image_upload').on('change', function (e) {
//   $file = $('#image_upload').val();
//   console.log($file);
// })

// input.onchange = function () {
//   var file = input.files[0];
//   drawOnCanvas(file);   // see Example 6
//   displayAsImage(file); // see Example 7
// };

</script>
</body>
</html>

~~~

# controller file 
~~~php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper( 'url' );
		$this->load->database();
		$this->load->model( 'user_model' );
		$this->load->library( 'session' );
	}


	public function index() {
		$this->load->view( 'front/layouts/header' );
		$data['final'] = $this->user_model->get_card();
		$this->load->view( 'front/front_view', $data );

		$this->load->view( 'front/layouts/footer' );
	}

	public function signup() {
		if ( $this->session->userdata( 'email' ) && ( $this->session->userdata( 'type' ) !== 'admin' ) ) {
			redirect( 'account' );
		} else {
			$this->load->view( 'front/layouts/header' );
			$this->load->view( 'front/signup' );
			$this->load->view( 'front/layouts/footer' );
		}
	}

	public function login() {
		if ( $this->session->userdata( 'email' ) && ( $this->session->userdata( 'type' ) !== 'admin' ) ) {
			redirect( 'account' );
		} else {
			$this->load->view( 'front/layouts/header' );
			$this->load->view( 'front/login' );
			$this->load->view( 'front/layouts/footer' );
		}
	}

	public function forgottenPassword() {
		$this->load->view( 'front/forgotten_password' );


	}

	public function about_us() {

		$this->load->view( 'front/layouts/header-about' );
		$this->load->view( 'front/about_us' );
		$this->load->view( 'front/layouts/footer' );
	}


	public function aboutus() {
		$url = $this->uri->segment( 1 );

		$this->db->select( '*' );
		$this->db->where( 'slug', $url );
		$q = $this->db->get( 'pages' );
		$res['data'] = $q->row();
		// echo "<pre>"; print_r($data); die();
		$this->load->view( 'front/layouts/header-about' );
		$this->load->view( 'front/about_us', $res );
		$this->load->view( 'front/layouts/footer' );
	}

	public function pages() {
		$url = $this->uri->segment( 2 );
		// echo "<pre>"; print_r($url);
		$this->db->select( '*' );
		$this->db->where( 'slug', $url );
		$q           = $this->db->get( 'pages' );
		$res['data'] = $q->row();
		// echo "<pre>"; print_r($res['data']); die();
		$this->load->view( 'front/layouts/header' );
		$this->load->view( 'front/about_us', $res );
		$this->load->view( 'front/layouts/footer' );
	}

	public function contactus() {
		$url = $this->uri->segment( 1 );
		$this->db->select( '*' );
		$this->db->where( 'slug', $url );
		$q           = $this->db->get( 'pages' );
		$res['data'] = $q->row();
		//echo "<pre>"; print_r($data); die();
		$this->load->view( 'front/layouts/header' );
		$this->load->view( 'front/contact-us' );
		$this->load->view( 'front/layouts/footer' );
	}

	public function add_user() {

		// if($_FILES["upload_file"]['name']!=""){


		// $config['upload_path']          = './assets/site/images/';
		// $config['allowed_types']        = 'gif|jpg|png|pdf|doc|txt|csv|xml|mp3|mp4';
		// $config['overwrite']            = TRUE;
		// $config['max_size']             = 2048000; // Can be set to particular file size , here it is 2 MB(2048 Kb)
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		// $this->load->library('upload', $config);

		// if ( ! $this->upload->do_upload('upload_file'))
		//   {
		//           $error = array('error' => $this->upload->display_errors());

		//           // echo '<pre>';
		//           // print_r($error);
		//           // die;

		//           // $this->load->view('manage_profile', $error);
		//   	   $this->session->set_flashdata('error', $error);
		//   }else{

		// $image_data = $this->upload->data();
		// $image = time().$image_data['file_name'];

		$this->db->select( '*' );
		$this->db->from( 'clients_web' );
		$this->db->where( 'email', $this->input->post( 'email' ) );
		$query = $this->db->get();
		$res   = $query->row_array();

		if ( $res > 0 ) {

			$this->session->set_flashdata( 'error', 'Email Already exits please enter a unique Email. ' );
			redirect( 'sign-up' );
			die;
		}


		$this->load->library( 'form_validation' );
		$this->form_validation->set_rules( 'firstname', 'Firstname', 'required' );
		$this->form_validation->set_rules( 'lastname', 'Lastname', 'required' );
		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email' );
		$this->form_validation->set_rules( 'password', 'Password', 'required' );
		$this->form_validation->set_rules( 'country', 'Country', 'required' );
		$this->form_validation->set_rules( 'phone', 'phone Number ', 'required|regex_match[/^[0-9]{10}$/]' );
		//$this->form_validation->set_rules('telegram', 'Telegram', 'required');
		$this->form_validation->set_rules( 'hear_about_us', 'Hear about us', 'required' );
		$this->form_validation->set_rules( 'daily_amount', 'Daily amount needed', 'required' );
		if ( $this->form_validation->run() ) {
			$data = array(
				'firstname'     => $this->input->post( 'firstname' ),
				'lastname'      => $this->input->post( 'lastname' ),
				'email'         => $this->input->post( 'email' ),
				'password'      => md5( $this->input->post( 'password' ) ),
				'country'       => $this->input->post( 'country' ),
				'phone'         => $this->input->post( 'phone' ),
				'telegram'      => $this->input->post( 'telegram' ),
				'hear_about_us' => $this->input->post( 'hear_about_us' ),
				'daily_amount'  => $this->input->post( 'daily_amount' ),
				//'upload_file'=>$image, // add this for image
				"created"       => date( 'Y-m-d H:i:s' )
			);

			//echo '<pre>';print_r($data); die();
			$this->user_model->insert_users( $data );
			$this->sendEmail( $data );
			$this->session->set_flashdata( 'success', 'Thank you for your request, we are processing ASAP, you will hear back shortly. </br> or please join our <a href="https://t.me/dhaka" target="_blank" class="light-purple"><i class="fa fa-telegram"></i> Telegram</a> group to hear about awesomeness. </br>Didn\'t get the email? Please try to check the spam folder else connect us on support@dhaka.co.' );
			redirect( 'login' );


		} else {
			//echo "error";

			$this->session->set_flashdata( 'error', 'you have enter some wrong inputs in signup.' );
			redirect( 'sign-up' );
		}
		//}
		// }else{
		// 						$data = array(
		// 						'firstname'    => $this->input->post('firstname'),
		// 						'lastname'     => $this->input->post('lastname'),
		// 						'email'      => $this->input->post('email'),
		// 						'password'      => md5($this->input->post('password')),
		// 						'country'      => $this->input->post('country'),
		// 						'phone'      => $this->input->post('phone'),
		// 						'telegram'      => $this->input->post('telegram'),
		// 						'hear_about_us'      => $this->input->post('hear_about_us'),
		// 						'daily_amount'      => $this->input->post('daily_amount'),
		// 						//'upload_file'=>$image, // add this for image
		// 						"created" => date('Y-m-d H:i:s')
		// 				);

		// 				echo '<pre>';print_r($data); die();
		// 				$this->user_model->insert_users($data);
		// 				$this->session->set_flashdata('success', 'signup successfully now enter to login.');
		// 				redirect('login');
		// }


	}

	public function contact_us() {

		$this->load->library( 'form_validation' );
		$this->form_validation->set_rules( 'fullname', 'Fullname', 'required' );
		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email' );
		$this->form_validation->set_rules( 'phone', 'phone Number ', 'required|regex_match[/^[0-9]{10}$/]' );
		$this->form_validation->set_rules( 'message', 'Message', 'required' );
		if ( $this->form_validation->run() ) {
			$data = array(
				'fullname' => $this->input->post( 'fullname' ),
				'email'    => $this->input->post( 'email' ),
				'phone'    => $this->input->post( 'phone' ),
				'message'  => $this->input->post( 'message' )
			);

			//echo '<pre>';print_r($data); die();
			$this->user_model->insert_contact( $data );
			$this->session->set_flashdata( 'success', 'Thanks for Contacting us we will contact you soon' );
			redirect( '/thank-you' );

		} else {

			$this->session->set_flashdata( 'error', 'you have enter some wrong inputs in contact us please check' );
			redirect( 'contact-us' );
		}


	}


	public function thank_you() {
		$this->load->view( 'front/layouts/header' );
		$this->load->view( 'front/thankyou' );
		$this->load->view( 'front/layouts/footer' );
	}

	public function user_login() {
		$this->load->library( 'form_validation' );
		$this->form_validation->set_rules( 'email', 'Email', 'required' );
		$this->form_validation->set_rules( 'password', 'Password', 'required' );
		if ( $this->form_validation->run() ) {
			//true
			$email    = $this->input->post( 'email' );
			$password = md5( $this->input->post( 'password' ) );
			//model function
			if ( $this->user_model->can_login( $email, $password ) ) {
				$res = $this->user_model->getall( $email );

				if ( isset( $res->activated_at ) ) {
					$session_data = array(
						'type'         => "user",
						'email'        => $email,
						'id'           => $res->id,
						'firstname'    => $res->firstname,
						'lastname'     => $res->lastname,
						'phone'        => $res->phone,
						'telegram'     => $res->telegram,
						'daily_amount' => $res->daily_amount,

					);
					$this->session->set_userdata( $session_data );
					redirect( 'account' );
				} else {
					$this->session->set_flashdata( 'error', 'Thank you for your request, we are processing ASAP, you will hear back shortly.
or please join our <a href="https://t.me/thedhaka" target="_blank" class="light-purple">
            <i class="fa fa-telegram"></i>Telegram
          </a> group to hear about awesomeness. </br>Didn\'t get the email? Please try to check the spam folder else connect us on support@dhaka.co.' );
					redirect( 'login' );
				}
			} else {
				$this->session->set_flashdata( 'error', 'Invalid Username and Password please enter a valid details' );
				redirect( 'login' );
			}
		} else {
			$this->session->set_flashdata( 'error', 'please fill all the fields to Enter Club' );
			redirect( 'login' );
		}
	}


	public function account_page() {
		if ( ! $this->session->userdata( 'email' ) ) {
			redirect( '/' );
		} else {
			$this->load->view( 'front/layouts/header' );
			$this->load->view( 'front/user_account' );
			$this->load->view( 'front/layouts/footer' );
		}
	}

	public function logout() {
		$this->session->unset_userdata( 'email' );
		$this->session->sess_destroy();
		redirect( '/' );
	}


	public function giftCard() {
		if ( ! $this->session->userdata( 'email' ) && ( $this->session->userdata( 'type' ) !== 'admin' ) ) {
			redirect( '/' );
		} else {
			$this->load->view( 'front/layouts/header' );
			$this->load->view( 'front/gift_card' );
			$this->load->view( 'front/layouts/footer' );
		}
	}

	public function get_slug() {

		$this->user_model->about_us();

	}

	public function get_data() {

		$data = $this->user_model->users();

		echo "<pre>";
		print_r( $data );
		die();

	}

	public function update_password() {


		$id = $this->session->userdata( 'id' );
		$this->load->library( 'form_validation' );
		$this->form_validation->set_rules( 'password', 'Password', 'required' );
		if ( $this->form_validation->run() ) {
			$new_password = $this->input->post( 'password' );
			$data         = array( 'password' => md5( $new_password ) );

			$this->db->where( 'id', $id );
			$this->db->update( 'clients_web', $data );

			$this->session->set_flashdata( 'success', 'Password change sucessfully' );


			redirect( '/account' );

		} else {
			$this->session->set_flashdata( 'error', 'Invalid Username and Password please enter a valid details' );


			redirect( 'front/changePassword' );

		}

	}

	public function updatePassword() {

		if ( ! $this->session->userdata( 'email' ) ) {
			redirect( 'front' );
		} else {
			$this->load->view( 'front/layouts/header' );
			$this->load->view( 'front/changePasword' );
			$this->load->view( 'front/layouts/footer' );
		}

	}


	public function reset_password() {

		$this->load->view( 'front/layouts/header' );
		$this->load->view( 'front/reset_password' );
		$this->load->view( 'front/layouts/footer' );

	}


	public function forgotPassword() {

		$email = $this->input->post( 'email' );

		// echo '<pre>';
		// print_r($email); die();

		$find_email = $this->user_model->ForgotPassword( $email );

		if ( ! $find_email ) {

			$this->session->set_flashdata( 'msg', ' Email not found please enter a valid email!' );
			redirect( 'reset-password' );
			// redirect(base_url().'user/Login','refresh');
		} else {

			// echo "found";
			$this->sendpassword( $find_email );

			//      echo '<pre>';
			// print_r($data); die();


		}


	}

	public function sendEmail( $data ) {


		$email = $data['email'];

		$mail_message = 'Dear ' . $data['firstname'] . ',' . "\r\n";
		$mail_message .= 'Thank you for your request, we are processing ASAP, you will hear back shortly.';
		$mail_message .= "\r\n";
		$mail_message .= 'Or';
		$mail_message .= "\r\n";
		$mail_message .= "Please join our Telegram group to hear about awesomeness";
		$mail_message .= "\r\n";
		$mail_message .= "Click the link: https://t.me/thedhaka";
		$mail_message .= "\r\n";
		$mail_message .= 'Thanks & Regards';
		$mail_message .= "\r\n";
		$mail_message .= 'dhaka';

		$config = array(
			'mailtype' => 'html',
			'charset'  => 'utf-8',
			'priority' => '1'
		);
		$this->load->library( 'email', $config );

		$this->email->set_newline( "\r\n" );

		$this->email->from( 'support@dhaka.co', 'dhaaka' );
		$this->email->to( $email );

		$this->email->subject( 'From dhaka' );
		$this->email->message( $mail_message );
		$this->email->send();


	}
	public function sendpassword( $data ) {

		$email = $data['email'];
		$sql   = $this->db->query( "SELECT *  from clients_web where email = '" . $email . "' " );
		$row   = $sql->result_array();
		if ( $sql->num_rows() > 0 ) {

			$passwordplain       = "";
			$passwordplain       = rand( 999999999, 9999999999 );
			$newpass['password'] = md5( $passwordplain );
			$this->db->where( 'email', $email );
			$this->db->update( 'clients_web', $newpass );
			$mail_message = 'Dear ' . $row[0]['firstname'] . ',' . "\r\n";
			$mail_message .= 'Thanks for contacting regarding to forgot password,</br> Your <b>Password</b> is <b>' . $passwordplain . '</b>' . "\r\n";
			$mail_message .= '</br>Please Update your password.';
			$mail_message .= '</br>Thanks & Regards';
			$mail_message .= '</br>dhaka';

			$config = array(
				'mailtype' => 'html',
				'charset'  => 'utf-8',
				'priority' => '1'
			);


			$this->load->library( 'email', $config );

			$this->email->set_newline( "\r\n" );

			//Add file directory if you need to attach a file
			//$this->email->attach($file_dir_name);

			$this->email->from( 'support@dhaka.co', 'dhaka' );
			$this->email->to( $email );

			$this->email->subject( 'From dhaka' );
			$this->email->message( $mail_message );

			if ( $this->email->send() ) {
				//Success email Sent
				$this->session->set_flashdata( 'success', 'A new password willl be send to your email id please check.' );
				redirect( 'reset-password' );
			} else {
				//Email Failed To Send
				echo "<script>alert('Failed to send password, please try again!')</script>";
			}


		} else {
			echo "error";
		}

	}


	public function get_users() {

		$this->db->select( '*' );
		$this->db->from( 'clients_web' );
		$query      = $this->db->get();
		$final_data = $query->result_array();
		echo '<pre>';
		print_r( $final_data );
		die();

	}


	public function discount1() {

		$this->load->view( 'front/layouts/header' );
		$this->load->view( 'front/buy_discount' );
		$this->load->view( 'front/layouts/footer' );
	}

	public function discount() {
		$url = $this->uri->segment( 2 );
		// echo "<pre>"; print_r($url);
		$url = str_replace( '-', ' ', $url );
		$this->db->select( '*' );
		$this->db->where( 'title', $url );
		$q            = $this->db->get( 'gift_card' );
		$res['card']  = $q->row();
		$res['title'] = $url;
		//echo "<pre>"; print_r($res['card']); die();


		$this->db->select( '*' );
		$this->db->where( 'gift_id', $res['card']->id );

		$q             = $this->db->get( 'discount_coupons' );
		$res['coupon'] = $q->result();

		//echo "<pre>"; print_r($res['coupon']); die();

		$this->load->view( 'front/layouts/header' );
		$this->load->view( 'front/buy_discount', $res );
		$this->load->view( 'front/layouts/footer' );
	}


	    public function upload_page(){
		    if(!$this->session->userdata('email')){
			    redirect('front');
		    }
		    else
		    {
		    	$id = $this->session->userdata( 'id' );
			    $this->db->select( '*' );
			    $this->db->from( 'clients_web' );
			    $this->db->where( 'id', $id );
			    $query = $this->db->get();
			    $res['user']   = $query->row_array();
			    $this->load->view('front/layouts/header');
			    $this->load->view('front/upload_doc',$res);
			    $this->load->view('front/layouts/footer');
		    }
		}

    public function upload_attachments_by_ajax () {
      $config['upload_path']          = './assets/user/images/';
      $config['overwrite']            = TRUE;
      $config['allowed_types']        = '*';
      $config['max_size']             = 2048000; // Can be set to particular file size , here it is 2 MB(2048 Kb)
      $original_image_name = $_FILES["image"]['name'];
      $new_name = time().$original_image_name;
      $config['file_name'] = $new_name;
      $this->load->library('upload', $config);
      if ( ! $this->upload->do_upload('image'))
      {
        $error = "File cannot be uploaded, please upload image file.";
        $this->session->set_flashdata('error', $error);
        echo json_encode(['error' => $error], 401);
        return ;
      } else
      {
        $image_data = $this->upload->data();
        $image = $image_data['file_name'];
        $id = $this->session->userdata( 'id' );
        $data = array(
          'user_id' => $id,
          'path'=> $image,
          'name' => $original_image_name,
        );
        $attachments = $this->user_model->insert_attachment($original_image_name, $image, $id);
        echo json_encode($attachments, 201);
      }
    }
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
      /*
      if($this->db->affected_rows() >= 1){
          if(unlink($path))
          return TRUE;
      } else {
          return FALSE;
      }
      */

      // $this->db->delete('attachments', array('id' => $id));
      // return $this->attachments_by_clients_web_id($clients_web_id);
    }
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
       $r[] = $value;
     }
     // echo json_encode();
     echo json_encode($r);
    }

    public function upload_doc_ajax() {
        $id = $this->session->userdata( 'id' );
        $heading = $this->input->post('heading');
        $attachments = $this->input->post('attachments');

        $data = array(
          'heading' => $heading,
          'attachments' => $attachments,
          'clients_web_id' => $id
        );

       $this->db->insert('user_upload', $data);
       echo json_encode(['status' => 200]);
       return;
    }

		public function upload_doc_original_for_back_up() {
			$config['upload_path']          = './assets/user/images/';
			$config['allowed_types']        = 'gif|jpg|png|pdf|doc|txt|csv|xml|mp3|mp4';
			$config['overwrite']            = TRUE;
			$config['max_size']             = 2048000; // Can be set to particular file size , here it is 2 MB(2048 Kb)
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$new_name = time().$_FILES["image"]['name'];
			$config['file_name'] = $new_name;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('image'))
			{
				//$error = array('error' => $this->upload->display_errors());
				$error = "File cannot be uploaded, please upload image file.";
				$this->session->set_flashdata('error', $error);
				redirect( '/account/upload' );
			}else{
				$image_data = $this->upload->data();
				$image = $image_data['file_name'];
				$data = array(
					'heading' => $this->input->post('heading'),
					'upload_file'=>$image,
				);

				$id = $this->session->userdata( 'id' );
				$this->db->where( 'id', $id );
				$this->db->update( 'clients_web', $data );

				$this->session->set_flashdata( 'success', 'File Uploaded Successfully.' );
				redirect( '/account/upload' );

			}
		}


}
~~~

# model File
~~~php
class User_model extends CI_Model
  {

    public function insert_users($data){

        $this->db->insert('clients_web', $data);
        return true;

    }
    public function attachments_by_clients_web_id($clients_web_id)
    {
        $where['clients_web_id'] = $clients_web_id;
       $result_set = $this->db->get_where('attachments', $where);
       return $result_set->result_array();
    }
    public function delete_attachment($id, $clients_web_id) {
      $this->db->delete('attachments', array('id' => $id));
      return $this->attachments_by_clients_web_id($clients_web_id);
    }
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

    public function insert_contact($data){

        $this->db->insert('contact_us', $data);
        return true;

    }

    public function can_login($email, $password)
    {
         $this->db->where('email', $email);
         $this->db->where('password', $password);
         $query = $this->db->get('clients_web');
         //SELECT * FROM users WHERE username = '$username' AND password = '$password'
         if($query->num_rows() > 0)
         {
              return true;
         }
         else
         {
              return false;
         }
    }

    public function getall($email)
     {
      $this->db->select('*');
      $this->db->where("email",$email);
      $q=$this->db->get('clients_web');
      return $q->row();
    }

    public function about_us(){

      $this->db->select('*');
      $this->db->where('slug','about-us');
      $q=$this->db->get('pages');
      $data= $q->row();
      echo "<pre>"; print_r($data); die();
    }


   public function get_card(){
     $this->db->select('*');
     $this->db->from('gift_card');
     $this->db->order_by("id", "asc");
     $query=$this->db->get();
     return $final = $query->result_array();
    }


    public function users(){

     $this->db->select('*');
     $this->db->from('clients_web');
     $query=$this->db->get();
     return  $query->result_array();
     //  echo '<pre>'; print_r($final_data); die();

    }

       public function ForgotPassword($email){
       $this->db->select('email');
       $this->db->from('clients_web');
       $this->db->where('email', $email);
       $query=$this->db->get();
        return $query->row_array();

          //   echo '<pre>';
          // print_r($data); die();
     }



  }
?>

~~~
