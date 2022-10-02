<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function cache(){
		$nama="umam";
		$this->m_dah->simpan_cache($nama);
	}

	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper('url');
		$this->load->helper('dah_helper');
		$this->load->library(array('session','form_validation','cart'));	
		$this->load->model('m_dah');
		if($this->session->userdata('status') != "login"){
			redirect(base_url().'xlog');
		}
	}	

	public function index(){
		$this->load->database();			
		
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_index');
		$this->load->view('admin/v_footer');
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}


	function settings(){
		$this->load->database();
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_settings');
		$this->load->view('admin/v_footer');
	}

	function settings_act(){
		$this->load->database();		
		$blog_name = $this->input->post('blog_name');
		$blog_description = $this->input->post('blog_description');	
		$blog_welcome = $this->input->post('blog_welcome');		

		$this->m_dah->update_data(array('option_name' => 'blog_name'),array('option_value' => $blog_name),'dah_options');
		$this->m_dah->update_data(array('option_name' => 'blog_description'),array('option_value' => $blog_description),'dah_options');
		$this->m_dah->update_data(array('option_name' => 'blog_welcome'),array('option_value' => $blog_welcome),'dah_options');

		$rand = rand();
		$config['upload_path'] = './dah_image/system/';
		$config['allowed_types'] = 'gif|jpg|png';				
		$config['file_name'] = $rand.'_'.$_FILES['blog_logo']['name'];				
		$this->load->library('upload', $config);

		if($_FILES['blog_logo']['name'] != ""){			
			if(!$this->upload->do_upload('blog_logo')){			
				$error = array('error' => $this->upload->display_errors());			
				$this->load->view('admin/v_header');
				$this->load->view('admin/v_settings',$error);
				$this->load->view('admin/v_footer');
			}else{
				$data = array('upload_data' => $this->upload->data());			
				$file_name = $data['upload_data']['file_name'];
				@chmod("./dah_image/system/" . $this->m_dah->get_option('blog_logo'), 0777);
				@unlink('./dah_image/system/' . $this->m_dah->get_option('blog_logo'));
				$this->m_dah->update_data(array('option_name' => 'blog_logo'),array('option_value' => $file_name),'dah_options');			
				redirect('admin/settings/?alert=setting-update');			
			}
		}else{			
			redirect('admin/settings/?alert=setting-update');			
		}		
	}

	// page

	
	
	// end menu

	

	function cek_username_ajax(){
		$this->load->database();
		$val = $this->input->post('val');		
		echo $this->m_dah->edit_data(array('user_login' => $val),'user')->num_rows();
	}

	function cek_email_ajax(){
		$this->load->database();
		$val = $this->input->post('valemail');		
		echo $this->m_dah->edit_data(array('user_email' => $val),'user')->num_rows();
	}

	function user_edit($id){
		$this->load->database();	
		if($id == ""){
			redirect(base_url());
		}else{			
			$where = array(
				'user_id' => $id
				);				
			$data['user'] = $this->m_dah->edit_data($where,'user')->result();			
			$this->load->view('admin/v_header');
			$this->load->view('admin/v_users_edit',$data);
			$this->load->view('admin/v_footer');
		}
	}

	
	// end user

	
	function update_option(){
		$this->load->database();
		$option = $this->input->post('option');
		$value = $this->input->post('value');
		$where = array(
			'option_name' => $option
			);
		$data = array(
			'option_value' => $value
			);
		$this->m_dah->update_data($where,$data,'dah_options');
	}


/*
|---------------------------------
|	Bagian tambah data surat masuk
|----------------------------------
*/

 function surat_masuk(){
	 	$this->load->database();
	
	$data['data']=$this->m_dah->get_data_desc('id','surat_masuk')->result();
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/surat_masuk_data',$data);
	$this->load->view('admin/v_footer');
 }


 function surat_masuk_add(){
	 	$this->load->database();
	
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/surat_masuk_add',$data);
	$this->load->view('admin/v_footer');
 }

  function surat_masuk_act(){
	 	$this->load->database();

		$this->form_validation->set_rules('pengirim','Pengirim harus terisi','required');
		$this->form_validation->set_rules('no_surat','Nomor Surat harus terisi','required');
		$this->form_validation->set_rules('tgl_surat','Tanggal Surat harus terisi','required');
		$this->form_validation->set_rules('tgl_masuk','Tanggal Surat Masuk harus terisi','required');
		

		if($this->form_validation->run() != true){
			 redirect(base_url().'admin/surat_masuk_add');
		}else{
		
			$data_pd=array(
				'pengirim' => $this->input->post('pengirim'),
				'no_surat' => $this->input->post('no_surat'),
				'deskripsi' => $this->input->post('deskripsi'),
				'tanggal' => $this->input->post('tgl_surat'),
				'tgl_masuk' => $this->input->post('tgl_masuk'),

			);
			$this->m_dah->insert_data($data_pd,'surat_masuk');
			$id_terakhir = $this->db->insert_id();

			$config['upload_path'] = './upload/foto/';
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$lampiran = "lampiran";
			if($_FILES["lampiran"]["name"]){
				$rand1=rand(1000,9999);
				$config['file_name'] = $rand1.'_'.$_FILES['lampiran']['name'];				
				$this->load->library('upload', $config);
				$lampiran = $this->upload->do_upload('lampiran');
				if (!$lampiran){
					$error = array('error' => $this->upload->display_errors());
				}else{
					$lampiran = $this->upload->data("file_name");
					$data = array('upload_data' => $this->upload->data());
					$this->m_dah->update_data(array('id' => $id_terakhir),array('lampiran' => $lampiran),'surat_masuk');			
				}
			
			}
			redirect(base_url().'admin/surat_masuk/?alert=add');

		}

 }

 
		function surat_masuk_view($id){
			$this->load->database();
			$where=array(
				'id' =>	$id
			);
			$data['data']=$this->m_dah->edit_data($where,'surat_masuk')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('admin/surat/surat_masuk_view',$data);
			$this->load->view('admin/v_footer');

		}

		function surat_masuk_edit($id){
			$this->load->database();
			$where=array(
				'id' =>	$id
			);
			$data['data']=$this->m_dah->edit_data($where,'surat_masuk')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('admin/surat/surat_masuk_edit',$data);
			$this->load->view('admin/v_footer');

		}

		function surat_masuk_update(){
				$this->load->database();

			$this->form_validation->set_rules('pengirim','Pengirim harus terisi','required');
			$this->form_validation->set_rules('no_surat','Nomor Surat harus terisi','required');
			$this->form_validation->set_rules('tgl_surat','Tanggal Surat harus terisi','required');
			$this->form_validation->set_rules('tgl_masuk','Tanggal Surat Masuk harus terisi','required');
			$id = $this->input->post('id');
			$where=array(
				'id' =>$id
			);

			if($this->form_validation->run() != true){
				redirect(base_url().'admin/surat_masuk_add');
			}else{
			
				$data_pd=array(
					'pengirim' => $this->input->post('pengirim'),
					'no_surat' => $this->input->post('no_surat'),
					'deskripsi' => $this->input->post('deskripsi'),
					'tanggal' => $this->input->post('tgl_surat'),
					'tgl_masuk' => $this->input->post('tgl_masuk'),
				);
				$this->m_dah->update_data($where,$data_pd,'surat_masuk');

				$config['upload_path'] = './upload/foto/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$lampiran = "lampiran";
				if($_FILES["lampiran"]["name"]){
					$rand1=rand(1000,9999);
					$config['file_name'] = $rand1.'_'.$_FILES['lampiran']['name'];				
					$this->load->library('upload', $config);
					$lampiran = $this->upload->do_upload('lampiran');
					if (!$lampiran){
						$error = array('error' => $this->upload->display_errors());
					}else{
						$data_s = $this->m_dah->edit_data($where,'surat_masuk')->row();
						@chmod("./upload/foto/" . $data_s->lampiran, 0777);
						@unlink('./upload/foto/' . $data_s->lampiran);
						$lampiran = $this->upload->data("file_name");
						$data = array('upload_data' => $this->upload->data());
						$this->m_dah->update_data(array('id' => $id),array('lampiran' => $lampiran),'surat_masuk');			
					}
				
				}
				redirect(base_url().'admin/surat_masuk/?alert=update');

			}
		}


		function surat_masuk_delete($id){
			$this->load->database();
			if($id == ""){
				redirect('base_url()');
			}else{
				$where = array(
					'id' => $id
					);

				$data = $this->m_dah->edit_data($where,'surat_masuk')->row();
				// hapus di direktori upload/syarat

				@chmod("./upload/foto/" . $data->lampiran, 0777);
				@unlink('./upload/foto/' . $data->lampiran);

				// hapus di table 
			
				$this->m_dah->delete_data($where,'surat_masuk');

				redirect('admin/surat_masuk/?alert=post-delete');
			}
		}

/*
|---------------------------------
|	Bagian tambah data surat keluar
|----------------------------------
*/

 function surat_keluar(){
	 	$this->load->database();
	
	$data['data']=$this->m_dah->get_data_desc('id','surat_keluar')->result();
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/surat_keluar_data',$data);
	$this->load->view('admin/v_footer');
 }

 function surat_keluar_add(){
	 	$this->load->database();
	
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/surat_keluar_add',$data);
	$this->load->view('admin/v_footer');
 }

  function surat_keluar_act(){
	 	$this->load->database();

		$this->form_validation->set_rules('pengirim','Pengirim harus terisi','required');
		$this->form_validation->set_rules('no_surat','Nomor Surat harus terisi','required');
		$this->form_validation->set_rules('tgl_surat','Tanggal Surat harus terisi','required');
		$this->form_validation->set_rules('tgl_keluar','Tanggal Surat keluar harus terisi','required');
		

		if($this->form_validation->run() != true){
			 redirect(base_url().'admin/surat_keluar_add');
		}else{
		
			$data_pd=array(
				'pengirim' => $this->input->post('pengirim'),
				'no_surat' => $this->input->post('no_surat'),
				'deskripsi' => $this->input->post('deskripsi'),
				'tanggal' => $this->input->post('tgl_surat'),
				'tgl_keluar' => $this->input->post('tgl_keluar'),

			);
			$this->m_dah->insert_data($data_pd,'surat_keluar');
			$id_terakhir = $this->db->insert_id();

			$config['upload_path'] = './upload/foto/';
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$lampiran = "lampiran";
			if($_FILES["lampiran"]["name"]){
				$rand1=rand(1000,9999);
				$config['file_name'] = $rand1.'_'.$_FILES['lampiran']['name'];				
				$this->load->library('upload', $config);
				$lampiran = $this->upload->do_upload('lampiran');
				if (!$lampiran){
					$error = array('error' => $this->upload->display_errors());
				}else{
					$lampiran = $this->upload->data("file_name");
					$data = array('upload_data' => $this->upload->data());
					$this->m_dah->update_data(array('id' => $id_terakhir),array('lampiran' => $lampiran),'surat_keluar');			
				}
			
			}
			redirect(base_url().'admin/surat_keluar/?alert=add');

		}

 }

 
		function surat_keluar_view($id){
			$this->load->database();
			$where=array(
				'id' =>	$id
			);
			$data['data']=$this->m_dah->edit_data($where,'surat_keluar')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('admin/surat/surat_keluar_view',$data);
			$this->load->view('admin/v_footer');

		}

		function surat_keluar_edit($id){
			$this->load->database();
			$where=array(
				'id' =>	$id
			);
			$data['data']=$this->m_dah->edit_data($where,'surat_keluar')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('admin/surat/surat_keluar_edit',$data);
			$this->load->view('admin/v_footer');

		}

		function surat_keluar_update(){
			$this->load->database();

			$this->form_validation->set_rules('pengirim','Pengirim harus terisi','required');
			$this->form_validation->set_rules('no_surat','Nomor Surat harus terisi','required');
			$this->form_validation->set_rules('tgl_surat','Tanggal Surat harus terisi','required');
			$this->form_validation->set_rules('tgl_keluar','Tanggal Surat keluar harus terisi','required');
			$id = $this->input->post('id');
			$where=array(
				'id' =>$id
			);

			if($this->form_validation->run() != true){
				redirect(base_url().'admin/surat_keluar_add');
			}else{
			
				$data_pd=array(
					'pengirim' => $this->input->post('pengirim'),
					'no_surat' => $this->input->post('no_surat'),
					'deskripsi' => $this->input->post('deskripsi'),
					'tanggal' => $this->input->post('tgl_surat'),
					'tgl_keluar' => $this->input->post('tgl_keluar'),
				);
				$this->m_dah->update_data($where,$data_pd,'surat_keluar');

				$config['upload_path'] = './upload/foto/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$lampiran = "lampiran";
				if($_FILES["lampiran"]["name"]){
					$rand1=rand(1000,9999);
					$config['file_name'] = $rand1.'_'.$_FILES['lampiran']['name'];				
					$this->load->library('upload', $config);
					$lampiran = $this->upload->do_upload('lampiran');
					if (!$lampiran){
						$error = array('error' => $this->upload->display_errors());
					}else{
						$data_s = $this->m_dah->edit_data($where,'surat_keluar')->row();
						@chmod("./upload/foto/" . $data_s->lampiran, 0777);
						@unlink('./upload/foto/' . $data_s->lampiran);
						$lampiran = $this->upload->data("file_name");
						$data = array('upload_data' => $this->upload->data());
						$this->m_dah->update_data(array('id' => $id),array('lampiran' => $lampiran),'surat_keluar');			
					}
				
				}
				redirect(base_url().'admin/surat_keluar/?alert=update');

			}
			
		}


		function surat_keluar_delete($id){
			$this->load->database();
			if($id == ""){
				redirect('base_url()');
			}else{
				$where = array(
					'id' => $id
					);

				$data = $this->m_dah->edit_data($where,'surat_keluar')->row();
				// hapus di direktori upload/syarat

				@chmod("./upload/foto/" . $data->lampiran, 0777);
				@unlink('./upload/foto/' . $data->lampiran);

				// hapus di table 
			
				$this->m_dah->delete_data($where,'surat_keluar');

				redirect('admin/surat_keluar/?alert=post-delete');
			}
		}


/*
|---------------------------------
|	Bagian surat keterangan Desan kebun balok
|----------------------------------
*/		

 function surat_ket(){
	 	$this->load->database();
	
	$data['data']=$this->m_dah->get_data_desc('id','surat_ket')->result();
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/surat_ket_data',$data);
	$this->load->view('admin/v_footer');
 }

 function surat_ket_add(){
	 	$this->load->database();
	
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/surat_ket_add',$data);
	$this->load->view('admin/v_footer');
 }


 function surat_ket_act(){
	 	$this->load->database();

		$this->form_validation->set_rules('jenis_surat','Data harus terisi','required');
		$this->form_validation->set_rules('no_surat','Data harus terisi','required');
		$this->form_validation->set_rules('tanggal','Data harus terisi','required');
		$this->form_validation->set_rules('pemohon','Data harus terisi','required');
		$this->form_validation->set_rules('keperluan','Data harus terisi','required');
		$this->form_validation->set_rules('alamat','Data harus terisi','required');

		

		if($this->form_validation->run() != true){
			 redirect(base_url().'admin/surat_ket_add');
		}else{
		
			$data_pd=array(
				'pemohon' => $this->input->post('pemohon'),
				'no_surat' => $this->input->post('no_surat'),
				'keperluan' => $this->input->post('keperluan'),
				'tanggal' => $this->input->post('tanggal'),
				'alamat' => $this->input->post('alamat'),
				'jenis_surat' => $this->input->post('jenis_surat')

			);
			$this->m_dah->insert_data($data_pd,'surat_ket');
			$id_terakhir = $this->db->insert_id();

			$config['upload_path'] = './upload/foto/';
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$lampiran = "lampiran";
			if($_FILES["lampiran"]["name"]){
				$rand1=rand(1000,9999);
				$config['file_name'] = $rand1.'_'.$_FILES['lampiran']['name'];				
				$this->load->library('upload', $config);
				$lampiran = $this->upload->do_upload('lampiran');
				if (!$lampiran){
					$error = array('error' => $this->upload->display_errors());
				}else{
					$lampiran = $this->upload->data("file_name");
					$data = array('upload_data' => $this->upload->data());
					$this->m_dah->update_data(array('id' => $id_terakhir),array('lampiran' => $lampiran),'surat_ket');			
				}
			
			}
			redirect(base_url().'admin/surat_ket/?alert=add');

		}

 }

 		function surat_ket_view($id){
			$this->load->database();
			$where=array(
				'id' =>	$id
			);
			$data['data']=$this->m_dah->edit_data($where,'surat_ket')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('admin/surat/surat_ket_view',$data);
			$this->load->view('admin/v_footer');

		}

		function surat_ket_edit($id){
			$this->load->database();
			$where=array(
				'id' =>	$id
			);
			$data['data']=$this->m_dah->edit_data($where,'surat_ket')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('admin/surat/surat_ket_edit',$data);
			$this->load->view('admin/v_footer');

		}

		function surat_ket_update(){
			$this->load->database();

	    $this->form_validation->set_rules('jenis_surat','Data harus terisi','required');
		$this->form_validation->set_rules('no_surat','Data harus terisi','required');
		$this->form_validation->set_rules('tanggal','Data harus terisi','required');
		$this->form_validation->set_rules('pemohon','Data harus terisi','required');
		$this->form_validation->set_rules('keperluan','Data harus terisi','required');
		$this->form_validation->set_rules('alamat','Data harus terisi','required');

			$id = $this->input->post('id');
			$where=array(
				'id' =>$id
			);

			if($this->form_validation->run() != true){
				redirect(base_url().'admin/surat_ket_add');
			}else{
			
				$data_pd=array(
                    'pemohon' => $this->input->post('pemohon'),
                    'no_surat' => $this->input->post('no_surat'),
                    'keperluan' => $this->input->post('keperluan'),
                    'tanggal' => $this->input->post('tanggal'),
                    'alamat' => $this->input->post('alamat'),
                    'jenis_surat' => $this->input->post('jenis_surat')
				);
				$this->m_dah->update_data($where,$data_pd,'surat_ket');

				$config['upload_path'] = './upload/foto/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$lampiran = "lampiran";
				if($_FILES["lampiran"]["name"]){
					$rand1=rand(1000,9999);
					$config['file_name'] = $rand1.'_'.$_FILES['lampiran']['name'];				
					$this->load->library('upload', $config);
					$lampiran = $this->upload->do_upload('lampiran');
					if (!$lampiran){
						$error = array('error' => $this->upload->display_errors());
					}else{
						$data_s = $this->m_dah->edit_data($where,'surat_ket')->row();
						@chmod("./upload/foto/" . $data_s->lampiran, 0777);
						@unlink('./upload/foto/' . $data_s->lampiran);
						$lampiran = $this->upload->data("file_name");
						$data = array('upload_data' => $this->upload->data());
						$this->m_dah->update_data(array('id' => $id),array('lampiran' => $lampiran),'surat_ket');			
					}
				
				}
				redirect(base_url().'admin/surat_ket/?alert=update');

			}
			
		}

	  function surat_ket_delete($id){
			$this->load->database();
			if($id == ""){
				redirect('base_url()');
			}else{
				$where = array(
					'id' => $id
					);

				$data = $this->m_dah->edit_data($where,'surat_ket')->row();
				// hapus di direktori upload/syarat

				@chmod("./upload/foto/" . $data->lampiran, 0777);
				@unlink('./upload/foto/' . $data->lampiran);

				// hapus di table 
			
				$this->m_dah->delete_data($where,'surat_ket');

				redirect('admin/surat_ket/?alert=post-delete');
			}
		}


/*
|---------------------------------
|	Bagian Surat keterangan tidak silang sengketa
|----------------------------------
*/
function surat_sengketa(){
	 	$this->load->database();
	
	$data['data']=$this->m_dah->get_data_desc('id','surat_sengketa')->result();
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/surat_sengketa_data',$data);
	$this->load->view('admin/v_footer');
 }

 function surat_sengketa_add(){
	 	$this->load->database();
	
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/surat_sengketa_add',$data);
	$this->load->view('admin/v_footer');
 }

 function surat_sengketa_act(){
	 	$this->load->database();

		$this->form_validation->set_rules('jenis_surat','Data harus terisi','required');
		$this->form_validation->set_rules('no_surat','Data harus terisi','required');
		$this->form_validation->set_rules('tanggal','Data harus terisi','required');
		$this->form_validation->set_rules('pemohon','Data harus terisi','required');
		$this->form_validation->set_rules('keperluan','Data harus terisi','required');
		$this->form_validation->set_rules('alamat','Data harus terisi','required');

		

		if($this->form_validation->run() != true){
			 redirect(base_url().'admin/surat_sengketa_add');
		}else{
		
			$data_pd=array(
				'pemohon' => $this->input->post('pemohon'),
				'no_surat' => $this->input->post('no_surat'),
				'keperluan' => $this->input->post('keperluan'),
				'tanggal' => $this->input->post('tanggal'),
				'alamat' => $this->input->post('alamat'),
				'jenis_surat' => $this->input->post('jenis_surat')

			);
			$this->m_dah->insert_data($data_pd,'surat_sengketa');
			$id_terakhir = $this->db->insert_id();

			$config['upload_path'] = './upload/foto/';
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$lampiran = "lampiran";
			if($_FILES["lampiran"]["name"]){
				$rand1=rand(1000,9999);
				$config['file_name'] = $rand1.'_'.$_FILES['lampiran']['name'];				
				$this->load->library('upload', $config);
				$lampiran = $this->upload->do_upload('lampiran');
				if (!$lampiran){
					$error = array('error' => $this->upload->display_errors());
				}else{
					$lampiran = $this->upload->data("file_name");
					$data = array('upload_data' => $this->upload->data());
					$this->m_dah->update_data(array('id' => $id_terakhir),array('lampiran' => $lampiran),'surat_sengketa');			
				}
			
			}
			redirect(base_url().'admin/surat_sengketa/?alert=add');

		}

 }

 		function surat_sengketa_view($id){
			$this->load->database();
			$where=array(
				'id' =>	$id
			);
			$data['data']=$this->m_dah->edit_data($where,'surat_sengketa')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('admin/surat/surat_sengketa_view',$data);
			$this->load->view('admin/v_footer');

		}

		function surat_sengketa_edit($id){
			$this->load->database();
			$where=array(
				'id' =>	$id
			);
			$data['data']=$this->m_dah->edit_data($where,'surat_sengketa')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('admin/surat/surat_sengketa_edit',$data);
			$this->load->view('admin/v_footer');

		}

		function surat_sengketa_update(){
			$this->load->database();

	    $this->form_validation->set_rules('jenis_surat','Data harus terisi','required');
		$this->form_validation->set_rules('no_surat','Data harus terisi','required');
		$this->form_validation->set_rules('tanggal','Data harus terisi','required');
		$this->form_validation->set_rules('pemohon','Data harus terisi','required');
		$this->form_validation->set_rules('keperluan','Data harus terisi','required');
		$this->form_validation->set_rules('alamat','Data harus terisi','required');

			$id = $this->input->post('id');
			$where=array(
				'id' =>$id
			);

			if($this->form_validation->run() != true){
				redirect(base_url().'admin/surat_sengketa_add');
			}else{
			
				$data_pd=array(
                    'pemohon' => $this->input->post('pemohon'),
                    'no_surat' => $this->input->post('no_surat'),
                    'keperluan' => $this->input->post('keperluan'),
                    'tanggal' => $this->input->post('tanggal'),
                    'alamat' => $this->input->post('alamat'),
                    'jenis_surat' => $this->input->post('jenis_surat')
				);
				$this->m_dah->update_data($where,$data_pd,'surat_sengketa');

				$config['upload_path'] = './upload/foto/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$lampiran = "lampiran";
				if($_FILES["lampiran"]["name"]){
					$rand1=rand(1000,9999);
					$config['file_name'] = $rand1.'_'.$_FILES['lampiran']['name'];				
					$this->load->library('upload', $config);
					$lampiran = $this->upload->do_upload('lampiran');
					if (!$lampiran){
						$error = array('error' => $this->upload->display_errors());
					}else{
						$data_s = $this->m_dah->edit_data($where,'surat_sengketa')->row();
						@chmod("./upload/foto/" . $data_s->lampiran, 0777);
						@unlink('./upload/foto/' . $data_s->lampiran);
						$lampiran = $this->upload->data("file_name");
						$data = array('upload_data' => $this->upload->data());
						$this->m_dah->update_data(array('id' => $id),array('lampiran' => $lampiran),'surat_sengketa');			
					}
				
				}
				redirect(base_url().'admin/surat_sengketa/?alert=update');

			}
			
		}

	  function surat_sengketa_delete($id){
			$this->load->database();
			if($id == ""){
				redirect('base_url()');
			}else{
				$where = array(
					'id' => $id
					);

				$data = $this->m_dah->edit_data($where,'surat_sengketa')->row();
				// hapus di direktori upload/syarat

				@chmod("./upload/foto/" . $data->lampiran, 0777);
				@unlink('./upload/foto/' . $data->lampiran);

				// hapus di table 
			
				$this->m_dah->delete_data($where,'surat_sengketa');

				redirect('admin/surat_sengketa/?alert=post-delete');
			}
		}


		
/*
|---------------------------------
|	Bagian tambah surat Kematian
|----------------------------------
*/

function surat_mati(){
	 	$this->load->database();
	
	$data['data']=$this->m_dah->get_data_desc('id','surat_mati')->result();
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/surat_mati_data',$data);
	$this->load->view('admin/v_footer');
 }

 function surat_mati_add(){
	 	$this->load->database();
	
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/surat_mati_add',$data);
	$this->load->view('admin/v_footer');
 }

 function surat_mati_act(){
	 	$this->load->database();

         $this->form_validation->set_rules('no_surat','Data harus terisi','required');
		$this->form_validation->set_rules('nama_kepala','Data harus terisi','required');
		$this->form_validation->set_rules('nama_meninggal','Data harus terisi','required');
		$this->form_validation->set_rules('jenis_kelamin','Data harus terisi','required');
		$this->form_validation->set_rules('no_kk','Data harus terisi','required');
		$this->form_validation->set_rules('nik','Data harus terisi','required');
		$this->form_validation->set_rules('tanggal','Data harus terisi','required');

		$this->form_validation->set_rules('umur','Data harus terisi','required');
		$this->form_validation->set_rules('tgl_meninggal','Data harus terisi','required');
		$this->form_validation->set_rules('alamat','Data harus terisi','required');

		$this->form_validation->set_rules('pelapor','Data harus terisi','required');

		

		if($this->form_validation->run() != true){
			 redirect(base_url().'admin/surat_mati_add');
		}else{
		
			$data_pd=array(
				'no_surat' => $this->input->post('no_surat'),
				'nama_kepala' => $this->input->post('nama_kepala'),
				'nama_meninggal' => $this->input->post('nama_meninggal'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'no_kk' => $this->input->post('no_kk'),
				'nik' => $this->input->post('nik'),
				'tanggal' => $this->input->post('tanggal'),
				'umur' => $this->input->post('umur'),
				'tgl_meninggal' => $this->input->post('tgl_meninggal'),

				'alamat' => $this->input->post('alamat'),
				'pelapor' => $this->input->post('pelapor')

			);
			$this->m_dah->insert_data($data_pd,'surat_mati');
			$id_terakhir = $this->db->insert_id();

			$config['upload_path'] = './upload/foto/';
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$lampiran = "lampiran";
			if($_FILES["lampiran"]["name"]){
				$rand1=rand(1000,9999);
				$config['file_name'] = $rand1.'_'.$_FILES['lampiran']['name'];				
				$this->load->library('upload', $config);
				$lampiran = $this->upload->do_upload('lampiran');
				if (!$lampiran){
					$error = array('error' => $this->upload->display_errors());
				}else{
					$lampiran = $this->upload->data("file_name");
					$data = array('upload_data' => $this->upload->data());
					$this->m_dah->update_data(array('id' => $id_terakhir),array('lampiran' => $lampiran),'surat_mati');			
				}
			
			}
			redirect(base_url().'admin/surat_mati/?alert=add');

		}

 }

 		function surat_mati_view($id){
			$this->load->database();
			$where=array(
				'id' =>	$id
			);
			$data['data']=$this->m_dah->edit_data($where,'surat_mati')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('admin/surat/surat_mati_view',$data);
			$this->load->view('admin/v_footer');

		}

        function surat_mati_edit($id){
			$this->load->database();
			$where=array(
				'id' =>	$id
			);
			$data['data']=$this->m_dah->edit_data($where,'surat_mati')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('admin/surat/surat_mati_edit',$data);
			$this->load->view('admin/v_footer');

		}

        function surat_mati_update(){
			$this->load->database();

            $this->form_validation->set_rules('no_surat','Data harus terisi','required');
            $this->form_validation->set_rules('nama_kepala','Data harus terisi','required');
            $this->form_validation->set_rules('nama_meninggal','Data harus terisi','required');
            $this->form_validation->set_rules('jenis_kelamin','Data harus terisi','required');
            $this->form_validation->set_rules('no_kk','Data harus terisi','required');
            $this->form_validation->set_rules('nik','Data harus terisi','required');
            $this->form_validation->set_rules('tanggal','Data harus terisi','required');

            $this->form_validation->set_rules('umur','Data harus terisi','required');
            $this->form_validation->set_rules('tgl_meninggal','Data harus terisi','required');
            $this->form_validation->set_rules('alamat','Data harus terisi','required');

            $this->form_validation->set_rules('pelapor','Data harus terisi','required');

			$id = $this->input->post('id');
			$where=array(
				'id' =>$id
			);

			if($this->form_validation->run() != true){
				redirect(base_url().'admin/surat_mati_add');
			}else{
			
				$data_pd=array(
                    'no_surat' => $this->input->post('no_surat'),
                    'nama_kepala' => $this->input->post('nama_kepala'),
                    'nama_meninggal' => $this->input->post('nama_meninggal'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'no_kk' => $this->input->post('no_kk'),
                    'nik' => $this->input->post('nik'),
                    'tanggal' => $this->input->post('tanggal'),
                    'umur' => $this->input->post('umur'),
                    'tgl_meninggal' => $this->input->post('tgl_meninggal'),

                    'alamat' => $this->input->post('alamat'),
                    'pelapor' => $this->input->post('pelapor')
				);
				$this->m_dah->update_data($where,$data_pd,'surat_mati');

				$config['upload_path'] = './upload/foto/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$lampiran = "lampiran";
				if($_FILES["lampiran"]["name"]){
					$rand1=rand(1000,9999);
					$config['file_name'] = $rand1.'_'.$_FILES['lampiran']['name'];				
					$this->load->library('upload', $config);
					$lampiran = $this->upload->do_upload('lampiran');
					if (!$lampiran){
						$error = array('error' => $this->upload->display_errors());
					}else{
						$data_s = $this->m_dah->edit_data($where,'surat_mati')->row();
						@chmod("./upload/foto/" . $data_s->lampiran, 0777);
						@unlink('./upload/foto/' . $data_s->lampiran);
						$lampiran = $this->upload->data("file_name");
						$data = array('upload_data' => $this->upload->data());
						$this->m_dah->update_data(array('id' => $id),array('lampiran' => $lampiran),'surat_mati');			
					}
				
				}
				redirect(base_url().'admin/surat_mati/?alert=update');

			}
			
		}

        function surat_mati_delete($id){
			$this->load->database();
			if($id == ""){
				redirect('base_url()');
			}else{
				$where = array(
					'id' => $id
					);

				$data = $this->m_dah->edit_data($where,'surat_mati')->row();
				// hapus di direktori upload/syarat

				@chmod("./upload/foto/" . $data->lampiran, 0777);
				@unlink('./upload/foto/' . $data->lampiran);

				// hapus di table 
			
				$this->m_dah->delete_data($where,'surat_mati');

				redirect('admin/surat_mati/?alert=post-delete');
			}
		}



/*
|---------------------------------
|	Bagian surat Pindah
|----------------------------------
*/

function surat_pindah(){
	 	$this->load->database();
	
	$data['data']=$this->m_dah->get_data_desc('id','surat_pindah')->result();
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/surat_pindah_data',$data);
	$this->load->view('admin/v_footer');
 }

 function surat_pindah_add(){
	 	$this->load->database();
	
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/surat_pindah_add',$data);
	$this->load->view('admin/v_footer');
 }

 function surat_pindah_act(){
	 	$this->load->database();

		$this->form_validation->set_rules('nama_pindah','Data harus terisi','required');
		$this->form_validation->set_rules('no_surat','Data harus terisi','required');
		$this->form_validation->set_rules('tanggal','Data harus terisi','required');
		$this->form_validation->set_rules('no_kk','Data harus terisi','required');
		$this->form_validation->set_rules('nik','Data harus terisi','required');
		$this->form_validation->set_rules('daerah_tujuan','Data harus terisi','required');
		$this->form_validation->set_rules('kecamatan','Data harus terisi','required');
		$this->form_validation->set_rules('kabupaten','Data harus terisi','required');
		$this->form_validation->set_rules('provinsi','Data harus terisi','required');

		

		if($this->form_validation->run() != true){
			 redirect(base_url().'admin/surat_pindah_add');
		}else{
		
			$data_pd=array(
				'nama_pindah' => $this->input->post('nama_pindah'),
				'no_surat' => $this->input->post('no_surat'),
				'tanggal' => $this->input->post('tanggal'),
				'nama_kepala' => $this->input->post('nama_kepala'),

				'no_kk' => $this->input->post('no_kk'),
				'nik' => $this->input->post('nik'),
				'daerah_tujuan' => $this->input->post('daerah_tujuan'),
				'kecamatan' => $this->input->post('kecamatan'),
				'kabupaten' => $this->input->post('kabupaten'),
				'provinsi' => $this->input->post('provinsi'),

			);
			$this->m_dah->insert_data($data_pd,'surat_pindah');
			$id_terakhir = $this->db->insert_id();

			$config['upload_path'] = './upload/foto/';
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$lampiran = "lampiran";
			if($_FILES["lampiran"]["name"]){
				$rand1=rand(1000,9999);
				$config['file_name'] = $rand1.'_'.$_FILES['lampiran']['name'];				
				$this->load->library('upload', $config);
				$lampiran = $this->upload->do_upload('lampiran');
				if (!$lampiran){
					$error = array('error' => $this->upload->display_errors());
				}else{
					$lampiran = $this->upload->data("file_name");
					$data = array('upload_data' => $this->upload->data());
					$this->m_dah->update_data(array('id' => $id_terakhir),array('lampiran' => $lampiran),'surat_pindah');			
				}
			
			}
			redirect(base_url().'admin/surat_pindah/?alert=add');

		}

 }

 		function surat_pindah_view($id){
			$this->load->database();
			$where=array(
				'id' =>	$id
			);
			$data['data']=$this->m_dah->edit_data($where,'surat_pindah')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('admin/surat/surat_pindah_view',$data);
			$this->load->view('admin/v_footer');

		}

		function surat_pindah_edit($id){
			$this->load->database();
			$where=array(
				'id' =>	$id
			);
			$data['data']=$this->m_dah->edit_data($where,'surat_pindah')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('admin/surat/surat_pindah_edit',$data);
			$this->load->view('admin/v_footer');

		}

		function surat_pindah_update(){
			$this->load->database();
            $this->form_validation->set_rules('nama_pindah','Data harus terisi','required');
            $this->form_validation->set_rules('no_surat','Data harus terisi','required');
            $this->form_validation->set_rules('tanggal','Data harus terisi','required');
            $this->form_validation->set_rules('no_kk','Data harus terisi','required');
            $this->form_validation->set_rules('nik','Data harus terisi','required');
            $this->form_validation->set_rules('daerah_tujuan','Data harus terisi','required');
            $this->form_validation->set_rules('kecamatan','Data harus terisi','required');
            $this->form_validation->set_rules('kabupaten','Data harus terisi','required');
            $this->form_validation->set_rules('provinsi','Data harus terisi','required');

			$id = $this->input->post('id');
			$where=array(
				'id' =>$id
			);

			if($this->form_validation->run() != true){
				redirect(base_url().'admin/surat_pindah_add');
			}else{
			
				$data_pd=array(
                    'nama_pindah' => $this->input->post('nama_pindah'),
                    'no_surat' => $this->input->post('no_surat'),
                    'tanggal' => $this->input->post('tanggal'),
					'nama_kepala' => $this->input->post('nama_kepala'),

                    'no_kk' => $this->input->post('no_kk'),
                    'nik' => $this->input->post('nik'),
                    'daerah_tujuan' => $this->input->post('daerah_tujuan'),
                    'kecamatan' => $this->input->post('kecamatan'),
                    'kabupaten' => $this->input->post('kabupaten'),
                    'provinsi' => $this->input->post('provinsi'),

				);
				$this->m_dah->update_data($where,$data_pd,'surat_pindah');

				$config['upload_path'] = './upload/foto/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$lampiran = "lampiran";
				if($_FILES["lampiran"]["name"]){
					$rand1=rand(1000,9999);
					$config['file_name'] = $rand1.'_'.$_FILES['lampiran']['name'];				
					$this->load->library('upload', $config);
					$lampiran = $this->upload->do_upload('lampiran');
					if (!$lampiran){
						$error = array('error' => $this->upload->display_errors());
					}else{
						$data_s = $this->m_dah->edit_data($where,'surat_pindah')->row();
						@chmod("./upload/foto/" . $data_s->lampiran, 0777);
						@unlink('./upload/foto/' . $data_s->lampiran);
						$lampiran = $this->upload->data("file_name");
						$data = array('upload_data' => $this->upload->data());
						$this->m_dah->update_data(array('id' => $id),array('lampiran' => $lampiran),'surat_pindah');			
					}
				
				}
				redirect(base_url().'admin/surat_pindah/?alert=update');

			}
			
		}

	  function surat_pindah_delete($id){
			$this->load->database();
			if($id == ""){
				redirect('base_url()');
			}else{
				$where = array(
					'id' => $id
					);

				$data = $this->m_dah->edit_data($where,'surat_pindah')->row();
				// hapus di direktori upload/syarat

				@chmod("./upload/foto/" . $data->lampiran, 0777);
				@unlink('./upload/foto/' . $data->lampiran);

				// hapus di table 
			
				$this->m_dah->delete_data($where,'surat_pindah');

				redirect('admin/surat_pindah/?alert=post-delete');
			}
		}


/*
|---------------------------------
|	Bagian surat datang/menetap
|----------------------------------
*/

function surat_datang(){
	 	$this->load->database();
	
	$data['data']=$this->m_dah->get_data_desc('id','surat_datang')->result();
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/surat_datang_data',$data);
	$this->load->view('admin/v_footer');
 }

 function surat_datang_add(){
	 	$this->load->database();
	
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/surat_datang_add',$data);
	$this->load->view('admin/v_footer');
 }

 function surat_datang_act(){
	 	$this->load->database();

		$this->form_validation->set_rules('nama_datang','Data harus terisi','required');
		$this->form_validation->set_rules('no_surat_pindah','Data harus terisi','required');
		$this->form_validation->set_rules('tanggal','Data harus terisi','required');
		$this->form_validation->set_rules('jenis_kelamin','Data harus terisi','required');
		$this->form_validation->set_rules('tmp_tgl_lhr','Data harus terisi','required');
		$this->form_validation->set_rules('nik','Data harus terisi','required');

		$this->form_validation->set_rules('daerah_asal','Data harus terisi','required');
		$this->form_validation->set_rules('kecamatan','Data harus terisi','required');
		$this->form_validation->set_rules('kabupaten','Data harus terisi','required');
		$this->form_validation->set_rules('provinsi','Data harus terisi','required');
		$this->form_validation->set_rules('alamat','Data harus terisi','required');

		

		if($this->form_validation->run() != true){
			 redirect(base_url().'admin/surat_datang_add');
		}else{
		
			$data_pd=array(
				'nama_datang' => $this->input->post('nama_datang'),
				'no_surat_pindah' => $this->input->post('no_surat_pindah'),
				'tanggal' => $this->input->post('tanggal'),
				'nik' => $this->input->post('nik'),
				'tmp_tgl_lhr' => $this->input->post('tmp_tgl_lhr'),
				'nama_kepala' => $this->input->post('nama_kepala'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),

				'daerah_asal' => $this->input->post('daerah_asal'),
				'kecamatan' => $this->input->post('kecamatan'),
				'kabupaten' => $this->input->post('kabupaten'),
				'provinsi' => $this->input->post('provinsi'),
				'alamat' => $this->input->post('alamat'),
				'status' => 1,

			);
			$this->m_dah->insert_data($data_pd,'surat_datang');
			$id_terakhir = $this->db->insert_id();

			$config['upload_path'] = './upload/foto/';
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$lampiran = "lampiran";
			if($_FILES["lampiran"]["name"]){
				$rand1=rand(1000,9999);
				$config['file_name'] = $rand1.'_'.$_FILES['lampiran']['name'];				
				$this->load->library('upload', $config);
				$lampiran = $this->upload->do_upload('lampiran');
				if (!$lampiran){
					$error = array('error' => $this->upload->display_errors());
				}else{
					$lampiran = $this->upload->data("file_name");
					$data = array('upload_data' => $this->upload->data());
					$this->m_dah->update_data(array('id' => $id_terakhir),array('lampiran' => $lampiran),'surat_datang');			
				}
			
			}
			redirect(base_url().'admin/surat_datang/?alert=add');

		}

 }

 		function surat_datang_view($id){
			$this->load->database();
			$where=array(
				'id' =>	$id
			);
			$data['data']=$this->m_dah->edit_data($where,'surat_datang')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('admin/surat/surat_datang_view',$data);
			$this->load->view('admin/v_footer');

		}

		function surat_datang_edit($id){
			$this->load->database();
			$where=array(
				'id' =>	$id
			);
			$data['data']=$this->m_dah->edit_data($where,'surat_datang')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('admin/surat/surat_datang_edit',$data);
			$this->load->view('admin/v_footer');

		}

		function surat_datang_update(){
			$this->load->database();
            $this->form_validation->set_rules('nama_datang','Data harus terisi','required');
            $this->form_validation->set_rules('no_surat_pindah','Data harus terisi','required');
            $this->form_validation->set_rules('tanggal','Data harus terisi','required');
            $this->form_validation->set_rules('jenis_kelamin','Data harus terisi','required');
            $this->form_validation->set_rules('tmp_tgl_lhr','Data harus terisi','required');
            $this->form_validation->set_rules('nik','Data harus terisi','required');

            $this->form_validation->set_rules('daerah_asal','Data harus terisi','required');
            $this->form_validation->set_rules('kecamatan','Data harus terisi','required');
            $this->form_validation->set_rules('kabupaten','Data harus terisi','required');
            $this->form_validation->set_rules('provinsi','Data harus terisi','required');
            $this->form_validation->set_rules('alamat','Data harus terisi','required');

			$id = $this->input->post('id');
			$where=array(
				'id' =>$id
			);

			if($this->form_validation->run() != true){
				redirect(base_url().'admin/surat_datang');
			}else{
			
				$data_pd=array(
          			'nama_datang' => $this->input->post('nama_datang'),
                    'no_surat_pindah' => $this->input->post('no_surat_pindah'),
                    'tanggal' => $this->input->post('tanggal'),
                    'nik' => $this->input->post('nik'),
                    'tmp_tgl_lhr' => $this->input->post('tmp_tgl_lhr'),
					'nama_datang' => $this->input->post('nama_datang'),

					'nama_kepala' => $this->input->post('nama_kepala'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'daerah_asal' => $this->input->post('daerah_asal'),
                    'kecamatan' => $this->input->post('kecamatan'),
                    'kabupaten' => $this->input->post('kabupaten'),
                    'provinsi' => $this->input->post('provinsi'),
                    'alamat' => $this->input->post('alamat'),

				);
				$this->m_dah->update_data($where,$data_pd,'surat_datang');

				$config['upload_path'] = './upload/foto/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$lampiran = "lampiran";
				if($_FILES["lampiran"]["name"]){
					$rand1=rand(1000,9999);
					$config['file_name'] = $rand1.'_'.$_FILES['lampiran']['name'];				
					$this->load->library('upload', $config);
					$lampiran = $this->upload->do_upload('lampiran');
					if (!$lampiran){
						$error = array('error' => $this->upload->display_errors());
					}else{
						$data_s = $this->m_dah->edit_data($where,'surat_datang')->row();
						@chmod("./upload/foto/" . $data_s->lampiran, 0777);
						@unlink('./upload/foto/' . $data_s->lampiran);
						$lampiran = $this->upload->data("file_name");
						$data = array('upload_data' => $this->upload->data());
						$this->m_dah->update_data(array('id' => $id),array('lampiran' => $lampiran),'surat_datang');			
					}
				
				}
				redirect(base_url().'admin/surat_datang/?alert=update');

			}
			
		}

	  function surat_datang_delete($id){
			$this->load->database();
			if($id == ""){
				redirect('base_url()');
			}else{
				$where = array(
					'id' => $id
					);

				$data = $this->m_dah->edit_data($where,'surat_datang')->row();
				// hapus di direktori upload/syarat

				@chmod("./upload/foto/" . $data->lampiran, 0777);
				@unlink('./upload/foto/' . $data->lampiran);

				// hapus di table 
			
				$this->m_dah->delete_data($where,'surat_datang');

				redirect('admin/surat_datang/?alert=post-delete');
			}
		}


/*
|---------------------------------
|	Bagian cetak surat
|----------------------------------
*/

		function surat_masuk_cetak(){
			$this->load->database();
			$data['data']=$this->m_dah->get_year('surat_masuk','tgl_masuk')->result();

			$this->load->view('admin/cetak/cetak_surat_masuk',$data);

		}

		function surat_masuk_cetak_filter(){
			$this->load->database();
            $this->form_validation->set_rules('dari','Data harus terisi','required');
            $this->form_validation->set_rules('sampai','Data harus terisi','required');

			$dari=$this->input->post('dari');
			$sampai=$this->input->post('sampai');

			$fdari['dari']=$this->input->post('dari');
			$fsampai['sampai']=$this->input->post('sampai');


			if($this->form_validation->run() != true){
				redirect(base_url().'admin/surat_masuk');
			}else{
				$data['data']=$this->m_dah->cetak_filter($dari,$sampai,'surat_masuk')->result();
				$this->load->view('admin/cetak/cetak_surat_masuk',$data,$fdari,$fsampai);

			}

		}

		function surat_keluar_cetak(){
			$this->load->database();
			$data['data']=$this->m_dah->get_year('surat_keluar','tgl_keluar')->result();

			$this->load->view('admin/cetak/cetak_surat_keluar',$data);

		}

		function surat_keluar_cetak_filter(){
			$this->load->database();
            $this->form_validation->set_rules('dari','Data harus terisi','required');
            $this->form_validation->set_rules('sampai','Data harus terisi','required');

			$dari=$this->input->post('dari');
			$sampai=$this->input->post('sampai');

			$fdari['dari']=$this->input->post('dari');
			$fsampai['sampai']=$this->input->post('sampai');


			if($this->form_validation->run() != true){
				redirect(base_url().'admin/surat_keluar');
			}else{
				$data['data']=$this->m_dah->cetak_filter($dari,$sampai,'surat_keluar')->result();
				$this->load->view('admin/cetak/cetak_surat_keluar',$data,$fdari,$fsampai);

			}

		}

		
		function surat_ket_cetak(){
			$this->load->database();
			$data['data']=$this->m_dah->get_year('surat_ket','tanggal')->result();

			$this->load->view('admin/cetak/cetak_surat_ket',$data);

		}

		function surat_ket_cetak_filter(){
			$this->load->database();
            $this->form_validation->set_rules('dari','Data harus terisi','required');
            $this->form_validation->set_rules('sampai','Data harus terisi','required');

			$dari=$this->input->post('dari');
			$sampai=$this->input->post('sampai');

			$fdari['dari']=$this->input->post('dari');
			$fsampai['sampai']=$this->input->post('sampai');


			if($this->form_validation->run() != true){
				redirect(base_url().'admin/surat_ket');
			}else{
				$data['data']=$this->m_dah->cetak_filter($dari,$sampai,'surat_ket')->result();
				$this->load->view('admin/cetak/cetak_surat_ket',$data,$fdari,$fsampai);

			}

		}


		function surat_sengketa_cetak(){
			$this->load->database();
			$data['data']=$this->m_dah->get_year('surat_sengketa','tanggal')->result();

			$this->load->view('admin/cetak/cetak_surat_sengketa',$data);

		}

		function surat_sengketa_cetak_filter(){
			$this->load->database();
            $this->form_validation->set_rules('dari','Data harus terisi','required');
            $this->form_validation->set_rules('sampai','Data harus terisi','required');

			$dari=$this->input->post('dari');
			$sampai=$this->input->post('sampai');

			$fdari['dari']=$this->input->post('dari');
			$fsampai['sampai']=$this->input->post('sampai');


			if($this->form_validation->run() != true){
				redirect(base_url().'admin/surat_sengketa');
			}else{
				$data['data']=$this->m_dah->cetak_filter($dari,$sampai,'surat_sengketa')->result();
				$this->load->view('admin/cetak/cetak_surat_sengketa',$data,$fdari,$fsampai);

			}

		}
		

		function surat_mati_cetak(){
			$this->load->database();
			$data['data']=$this->m_dah->get_year('surat_mati','tanggal')->result();

			$this->load->view('admin/cetak/cetak_surat_mati',$data);

		}

		function surat_mati_cetak_filter(){
			$this->load->database();
            $this->form_validation->set_rules('dari','Data harus terisi','required');
            $this->form_validation->set_rules('sampai','Data harus terisi','required');

			$dari=$this->input->post('dari');
			$sampai=$this->input->post('sampai');

			$fdari['dari']=$this->input->post('dari');
			$fsampai['sampai']=$this->input->post('sampai');


			if($this->form_validation->run() != true){
				redirect(base_url().'admin/surat_mati');
			}else{
				$data['data']=$this->m_dah->cetak_filter($dari,$sampai,'surat_mati')->result();
				$this->load->view('admin/cetak/cetak_surat_mati',$data,$fdari,$fsampai);

			}

		}

		function surat_pindah_cetak(){
			$this->load->database();
			$data['data']=$this->m_dah->get_year('surat_pindah','tanggal')->result();

			$this->load->view('admin/cetak/cetak_surat_pindah',$data);

		}

		function surat_pindah_cetak_filter(){
			$this->load->database();
            $this->form_validation->set_rules('dari','Data harus terisi','required');
            $this->form_validation->set_rules('sampai','Data harus terisi','required');

			$dari=$this->input->post('dari');
			$sampai=$this->input->post('sampai');

			$fdari['dari']=$this->input->post('dari');
			$fsampai['sampai']=$this->input->post('sampai');


			if($this->form_validation->run() != true){
				redirect(base_url().'admin/surat_pindah');
			}else{
				$data['data']=$this->m_dah->cetak_filter($dari,$sampai,'surat_pindah')->result();
				$this->load->view('admin/cetak/cetak_surat_pindah',$data,$fdari,$fsampai);

			}

		}
		
		function surat_datang_cetak(){
			$this->load->database();
			$data['data']=$this->m_dah->get_year('surat_datang','tanggal')->result();

			$this->load->view('admin/cetak/cetak_surat_datang',$data);

		}

		function surat_datang_cetak_filter(){
			$this->load->database();
            $this->form_validation->set_rules('dari','Data harus terisi','required');
            $this->form_validation->set_rules('sampai','Data harus terisi','required');

			$dari=$this->input->post('dari');
			$sampai=$this->input->post('sampai');

			$fdari['dari']=$this->input->post('dari');
			$fsampai['sampai']=$this->input->post('sampai');


			if($this->form_validation->run() != true){
				redirect(base_url().'admin/surat_datang');
			}else{
				$data['data']=$this->m_dah->cetak_filter($dari,$sampai,'surat_datang')->result();
				$this->load->view('admin/cetak/cetak_surat_datang',$data,$fdari,$fsampai);

			}

		}




/*
|---------------------------------
|	Bagian tambah data penduduk
|----------------------------------
*/
	function cek_nik_ajax(){
		$this->load->database();
		$val = $this->input->post('val');		
		echo $this->m_dah->edit_data(array('nik' => $val),'penduduk')->num_rows();
	}

	

	// end

/*
|----------------------------------------
|	Bagian ubah data penduduk dari rakyat
|----------------------------------------
*/	
	function data_pribadi($id){
		$this->load->database();
		
		if($id == ""){
			redirect(base_url());
		}else{
			$where = array(
				'id' => $this->session->userdata('penduduk_id')
			);				
				$data['agama']=$this->m_dah->get_data('agama')->result();
				$data['pendidikan']=$this->m_dah->get_data('pendidikan')->result();
				$data['pekerjaan']=$this->m_dah->get_data('pekerjaan')->result();
				$data['penduduk']=$this->m_dah->edit_data($where,'penduduk')->result();
			
			$this->load->view('admin/v_header');
			$this->load->view('user/v_data_pribadi',$data);
			$this->load->view('admin/v_footer');

		}
	}

	function data_pribadi_update(){
		$this->load->database();		

		$id = $this->input->post('id');
		$this->form_validation->set_rules('nik','Nomor Induk Kependudukan','required|edit_unique[penduduk.nik.'.$id.']|max_length[16]|min_length[16]');
		$this->form_validation->set_rules('no_kk','Nomor Kartu Keluarga','required|max_length[16]|min_length[16]');

		$this->form_validation->set_rules('nama','Nama','required');
		
		if($this->form_validation->run() != true){
			$where = array(
				'id' => $id
				);				
				$data['agama']=$this->m_dah->get_data('agama')->result();
				$data['pendidikan']=$this->m_dah->get_data('pendidikan')->result();
				$data['pekerjaan']=$this->m_dah->get_data('pekerjaan')->result();
				$data['penduduk']=$this->m_dah->edit_data($where,'penduduk')->result();
				
				$this->load->view('admin/v_header');
				$this->load->view('user/v_data_pribadi',$data);
				$this->load->view('admin/v_footer');
			// redirect(base_url().'admin/penduduk_add');
		}else{
			$where = array(
				'id' => $id
				);
			$where_user = array(
				'penduduk_id' => $id
				);		

			$data=array(
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'nomor_kk' => $this->input->post('no_kk'),
				'tempat_lahir' => $this->input->post('tmpt_lhr'),
				'tgl_lahir' => $this->input->post('tgl_lhr'),
				'jenis_kelamin' => $this->input->post('jk'),
				'agama' => $this->input->post('agama'),
				'status_warga_negara' => $this->input->post('warga_negara'),
				'nama_ayah' => $this->input->post('nama_ayah'),
				'nama_ibu' => $this->input->post('nama_ibu'),
				'gol_darah' => $this->input->post('gol_darah'),
				'no_hp' => $this->input->post('no_hp'),
				'pendidikan' => $this->input->post('pendidikan'),
				'pekerjaan' => $this->input->post('pekerjaan'),
				'status_nikah' => $this->input->post('status_nikah'),
				'status_hub_keluarga' => $this->input->post('status_hub_keluarga'),
				'alamat' => $this->input->post('alamat')

			);

			$data_u=array('user_name' => $this->input->post('nama'));

			$this->m_dah->update_data($where_user,$data_u,'user');

			$this->m_dah->update_data($where,$data,'penduduk');

			redirect(base_url().'admin/data_pribadi/'.$id.'/?alert=update');

		}
	}


/*
|---------------------------------
|	Bagian Organisasi
|----------------------------------
*/
function user_update(){
		$this->load->database();		
		$id = $this->input->post('id');
		$this->form_validation->set_rules('user_login','Username','required');
		if($this->form_validation->run() == false){
			$where = array(
				'user_id' => $id
				);				
			$data['user'] = $this->m_dah->edit_data($where,'user')->result();			
			$this->load->view('admin/v_header');
			$this->load->view('admin/v_users_edit',$data);
			$this->load->view('admin/v_footer');
		}else{			
			$password = $this->input->post('password');
			$where = array(
				'user_id' => $id
				);
			if($password != ""){
				$data = array(
					'user_login' => $this->input->post('user_login'),
					'user_email' => $this->input->post('email'),
					'user_pass' => md5($password)
					);				
			}else{
				$data = array(
					'user_login' => $this->input->post('user_login'),
					'user_email' => $this->input->post('email')
				
					);		
			}			
			$this->m_dah->update_data($where,$data,'user');			
			redirect('admin/user_edit/'.$id.'/?alert=user-update');	
		}				
	}


/*
|---------------------------------
|	Bagian Pengembang
|----------------------------------
*/






/*--------------------------
| Bagian untuk Preview file bisa pdf dan gambar
----------------------------*/
 function viewfile(){
        $file='upload/syarat/pdfaja.pdf';

        header('Content-Type: application/pdf');
        readfile($file);
	}
	
function viewfile_pdf($id){
	$this->load->database();

    $file='upload/foto/'.$id.'.pdf';
 
    header('Content-Type: application/pdf');
    readfile($file);
}
	

    
}