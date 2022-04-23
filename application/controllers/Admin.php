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
|	Bagian tambah data agama
|----------------------------------
*/

	function agama(){
		$this->load->database();
		
		$data['agama']=$this->m_dah->get_data('agama')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/data_opsi/v_data_agama',$data);
		$this->load->view('admin/v_footer');
	}

	function agama_add(){
		$this->load->database();
		$this->form_validation->set_rules('agama','Agama','required');
		if($this->form_validation->run() != true){
			$data['agama'] = $this->m_dah->get_data('agama')->result();
			$this->load->view('admin/v_header');
			$this->load->view('admin/data_opsi/v_data_agama',$data);
			$this->load->view('admin/v_footer');
		}else{
			$agama = $this->input->post('agama');
			$data=array(
				'agama' => $agama
			);
			$this->m_dah->insert_data($data,'agama');
			redirect(base_url().'admin/agama?alert=add');
		}
	
	}

	function agama_edit($id){
		$this->load->database();

		if($id == ""){
			// redirect('admin/agama');
		}else{			
			$where = array(
				'id' => $id
				);	
			$data['edit'] = $this->m_dah->edit_data($where,'agama')->result();
			$data['agama']=$this->m_dah->get_data('agama')->result();

			$this->load->view('admin/v_header');
			$this->load->view('admin/data_opsi/v_edit_agama',$data);
			$this->load->view('admin/v_footer');
		}
		
	}
	function agama_update(){
		$this->load->database();
		$id = $this->input->post('id');
		$this->form_validation->set_rules('agama','agama','required');
		if($this->form_validation->run() != true){
			$where = array(
				'id' => $id
				);	
			$data['edit'] = $this->m_dah->edit_data($where,'agama')->result();
			$data['agama'] = $this->m_dah->get_data('agama')->result();
			$this->load->view('admin/v_header');
			$this->load->view('admin/data_opsi/v_edit_agama',$data);
			$this->load->view('admin/v_footer');
		}else{			
			$agama = $this->input->post('agama');
			$data = array(
				'agama' => $agama
				);
			
			$w = array(
				'id' => $id
				);
			$this->m_dah->update_data($w,$data,'agama');
			redirect(base_url().'admin/agama/?alert=update');
		}	
		
	}

	function agama_delete($id){
		$this->load->database();
		if($id == ""){
			redirect('admin/agama');
		}else{
			$wt = array(
				'id' => $id
				);
			$this->m_dah->delete_data($wt,'agama');
			
			redirect('admin/agama/?alert=delete');
		}
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
				'tgl_surat' => $this->input->post('tgl_surat'),
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
					'tgl_surat' => $this->input->post('tgl_surat'),
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
				'tgl_surat' => $this->input->post('tgl_surat'),
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
					'tgl_surat' => $this->input->post('tgl_surat'),
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

		$this->form_validation->set_rules('tgl_lhr','Data harus terisi','required');
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
				'tgl_lhr' => $this->input->post('tgl_lhr'),
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

            $this->form_validation->set_rules('tgl_lhr','Data harus terisi','required');
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
                    'tgl_lhr' => $this->input->post('tgl_lhr'),
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
				redirect(base_url().'admin/surat_datang_add');
			}else{
			
				$data_pd=array(
          			'nama_datang' => $this->input->post('nama_datang'),
                    'no_surat_pindah' => $this->input->post('no_surat_pindah'),
                    'tanggal' => $this->input->post('tanggal'),
                    'nik' => $this->input->post('nik'),
                    'tmp_tgl_lhr' => $this->input->post('tmp_tgl_lhr'),

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
|	Bagian tambah data jabatan
|----------------------------------
*/
function jabatan(){
	$this->load->database();
	
	$data['jabatan']=$this->m_dah->get_data_desc('id','jabatan')->result();
	$this->load->view('admin/v_header');
	$this->load->view('admin/data_opsi/v_data_jabatan',$data);
	$this->load->view('admin/v_footer');
}

function jabatan_add(){
	$this->load->database();
	$this->form_validation->set_rules('jabatan','jabatan','required');
	if($this->form_validation->run() != true){
		$data['jabatan'] = $this->m_dah->get_data('jabatan')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/data_opsi/v_data_jabatan',$data);
		$this->load->view('admin/v_footer');
	}else{
		$jabatan = $this->input->post('jabatan');
		$data=array(
			'jabatan' => $jabatan
		);
		$this->m_dah->insert_data($data,'jabatan');
		redirect(base_url().'admin/jabatan?alert=add');
	}

}

function jabatan_edit($id){
	$this->load->database();

	if($id == ""){
		// redirect('admin/jabatan');
	}else{			
		$where = array(
			'id' => $id
			);	
		$data['edit'] = $this->m_dah->edit_data($where,'jabatan')->result();
		$data['jabatan']=$this->m_dah->get_data('jabatan')->result();

		$this->load->view('admin/v_header');
		$this->load->view('admin/data_opsi/v_edit_jabatan',$data);
		$this->load->view('admin/v_footer');
	}
	
}
function jabatan_update(){
	$this->load->database();
	$id = $this->input->post('id');
	$this->form_validation->set_rules('jabatan','jabatan','required');
	if($this->form_validation->run() != true){
		$where = array(
			'id' => $id
			);	
		$data['edit'] = $this->m_dah->edit_data($where,'jabatan')->result();
		$data['jabatan'] = $this->m_dah->get_data('jabatan')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/data_opsi/v_edit_jabatan',$data);
		$this->load->view('admin/v_footer');
	}else{			
		$jabatan = $this->input->post('jabatan');
		$data = array(
			'jabatan' => $jabatan
			);
		
		$w = array(
			'id' => $id
			);
		$this->m_dah->update_data($w,$data,'jabatan');
		redirect(base_url().'admin/jabatan/?alert=update');
	}	
	
}

function jabatan_delete($id){
	$this->load->database();
	if($id == ""){
		redirect('admin/jabatan');
	}else{
		$wt = array(
			'id' => $id
			);
		$this->m_dah->delete_data($wt,'jabatan');
		
		redirect('admin/jabatan/?alert=delete');
	}
}

/*
|---------------------------------
|	Bagian tambah data struktur Jabatan gampong
|----------------------------------
*/
function struktur_jabatan(){
	$this->load->database();
	$where=array(
		'jabatan_status' => 1
	);
	// $data['user']=$this->m_dah->get_data('user')->result();
	$data['penduduk']=$this->m_dah->get_data('penduduk')->result();
	$data['jabatan']=$this->m_dah->get_data('jabatan')->result();

	$data['pejabat']=$this->m_dah->edit_data($where,'user')->result();
	$this->load->view('admin/v_header');
	$this->load->view('admin/v_struktur_jab_data',$data);
	$this->load->view('admin/v_footer');
}

function struktur_jab_add(){
	$this->load->database();
	$this->form_validation->set_rules('id_penduduk','Nomor Penduduk','required');
	$this->form_validation->set_rules('jabatan','Jabatan','required');
	
	if($this->form_validation->run() != true){
		$where=array(
			'jabatan_status' => 1
		);
		$data['penduduk']=$this->m_dah->get_data('penduduk')->result();
		$data['jabatan']=$this->m_dah->get_data('jabatan')->result();
		$data['pejabat']=$this->m_dah->edit_data($where,'user')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_struktur_jab_data',$data);
		$this->load->view('admin/v_footer');
	}else{
		$jabatan = $this->input->post('jabatan');
		$w=array(
			'penduduk_id' => $this->input->post('id_penduduk')
		);
		

		if($jabatan == 1){
			$data=array(
			'jabatan' => $jabatan,
			'jabatan_status' => 1,
			'user_lvl' => 'lurah'
			);
			$this->m_dah->update_data($w,$data,'user');

		}elseif($jabatan == 2){
			$data=array(
			'jabatan' => $jabatan,
			'jabatan_status' => 1,
			'user_lvl' => 'admin'
			);
			$this->m_dah->update_data($w,$data,'user');

		}else{
			$data=array(
			'jabatan' => $jabatan,
			'jabatan_status' => 1
			);
			$this->m_dah->update_data($w,$data,'user');
		}

		redirect(base_url().'admin/struktur_jabatan?alert=add');
	}

}

function struktur_jab_delete($id){
	$this->load->database();
	if($id == ""){
		redirect('admin/struktur_jabatan');
	}else{
		$w=array(
			'penduduk_id' =>$id
		);
		$data=array(
			'jabatan' => 0,
			'jabatan_status' => 0,
			'user_lvl' => "rakyat"
		);
		$this->m_dah->update_data($w,$data,'user');
		redirect('admin/struktur_jabatan/?alert=delete');
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

	function penduduk(){
		$this->load->database();

		$data['penduduk']=$this->m_dah->get_data('penduduk')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_data_penduduk',$data);
		$this->load->view('admin/v_footer');

	}

	
	function penduduk_add(){
		$this->load->database();
		$data['agama']=$this->m_dah->get_data('agama')->result();
		$data['pendidikan']=$this->m_dah->get_data('pendidikan')->result();
		$data['pekerjaan']=$this->m_dah->get_data('pekerjaan')->result();
		
		
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_penduduk_add',$data);
		$this->load->view('admin/v_footer');

	}


	function penduduk_act(){
		$this->load->database();

		$this->form_validation->set_rules('nik','Nomor Induk Kependudukan','required|is_unique[penduduk.nik]|max_length[16]|min_length[16]');
		$this->form_validation->set_rules('no_kk','Nomor Kartu Keluarga','required|max_length[16]|min_length[16]');
		$this->form_validation->set_rules('nama','Nama','required');
		
		if($this->form_validation->run() != true){
				$data['agama']=$this->m_dah->get_data('agama')->result();
				$data['pendidikan']=$this->m_dah->get_data('pendidikan')->result();
				$data['pekerjaan']=$this->m_dah->get_data('pekerjaan')->result();
				$this->load->view('admin/v_header');
				$this->load->view('admin/v_penduduk_add',$data);
				$this->load->view('admin/v_footer');
			// redirect(base_url().'admin/penduduk_add');
		}else{
		
			$data_pd=array(
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
			$this->m_dah->insert_data($data_pd,'penduduk');

			$id_terakhir = $this->db->insert_id();
			$data_user=array(
				'penduduk_id' => $id_terakhir,
				'user_login' => $this->input->post('nik'),
				'user_pass' => md5($this->input->post('nik')),
				'user_name' => $this->input->post('nama'),
				'user_status' => 1,
				'user_lvl' => "rakyat"
			);

			$this->m_dah->insert_data($data_user,'user');
			redirect(base_url().'admin/penduduk/?alert=add');

		}
	}
	function penduduk_view($id){
		$this->load->database();
		if($id == ""){
			redirect(base_url().'admin/penduduk');
		}else{
			$where=array(
				'id'=> $id
			);
			$data['penduduk'] = $this->m_dah->edit_data($where,'penduduk')->result();
			$this->load->view('admin/v_header');
			$this->load->view('admin/v_penduduk_view',$data);
			$this->load->view('admin/v_footer');
		}
		
	}

	function penduduk_edit($id){
		$this->load->database();

		if($id == ""){
			redirect(base_url().'admin/penduduk');
		}else{
			$where=array(
				'id'=> $id
			);
			$data['agama']=$this->m_dah->get_data('agama')->result();
			$data['pendidikan']=$this->m_dah->get_data('pendidikan')->result();
			$data['pekerjaan']=$this->m_dah->get_data('pekerjaan')->result();
			$data['penduduk'] = $this->m_dah->edit_data($where,'penduduk')->result();
			$this->load->view('admin/v_header');
			$this->load->view('admin/v_penduduk_edit',$data);
			$this->load->view('admin/v_footer');
		}
	}
	function penduduk_update(){
		$this->load->database();		

		$id = $this->input->post('id');
		
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('nik','Nomor Induk Kependudukan','required|edit_unique[penduduk.nik.'.$id.']|max_length[16]|min_length[16]');
		$this->form_validation->set_rules('no_kk','Nomor Kartu Keluarga','required|max_length[16]|min_length[16]');
		if($this->form_validation->run() != true){
			$where = array(
				'id' => $id
				);				
				$data['agama']=$this->m_dah->get_data('agama')->result();
				$data['pendidikan']=$this->m_dah->get_data('pendidikan')->result();
				$data['pekerjaan']=$this->m_dah->get_data('pekerjaan')->result();
				$data['penduduk'] = $this->m_dah->edit_data($where,'penduduk')->result();

				$this->load->view('admin/v_header');
				$this->load->view('admin/v_penduduk_edit',$data);
				$this->load->view('admin/v_footer');
			// redirect(base_url().'admin/penduduk_add');
		}else{
			$where = array(
				'id' => $id
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

			$where_user = array(
				'penduduk_id' => $id
				);
			$data_user=array(
				'user_name'=> $this->input->post('nama')
			);
			$this->m_dah->update_data($where_user,$data_user,'user');

			$this->m_dah->update_data($where,$data,'penduduk');
			redirect(base_url().'admin/penduduk/?alert=update');

		}
	}
	function penduduk_delete($id){
		$this->load->database();
		if($id == ""){
			redirect(base_url().'admin/penduduk');
		}else{
			$wt = array(
				'id' => $id
			);
			$wp = array(
				'penduduk_id' => $id
				);
			$this->m_dah->delete_data($wt,'penduduk');
			$this->m_dah->delete_data($wp,'user');
			
			redirect(base_url().'admin/penduduk/?alert=delete');
		}	
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
|	Bagian Umum
|----------------------------------
*/
function umum(){
	$this->load->database();
	// $this->db->group_by('nomor_kk');
	// $data['total']= $this->db->count_all('penduduk');
	$this->load->view('admin/v_header');
	$this->load->view('admin/data_opsi/v_umum',$data);
	$this->load->view('admin/v_footer');

}

function umum_edit(){
	$this->load->database();

	$this->load->view('admin/v_header');
	$this->load->view('admin/data_opsi/v_umum_edit');
	$this->load->view('admin/v_footer');

}

function umum_update(){
	$this->load->database();
	$umum=$this->input->post('umum');
	$this->m_dah->update_data(array('option_name' => 'umum'),array('option_value' => $umum),'dah_options');

	redirect(base_url().'admin/umum/?alert=update');

}
/*
|---------------------------------
|	Bagian Organisasi
|----------------------------------
*/

function struktur_organisasi(){
	$this->load->database();

	$this->load->view('admin/v_header');
	$this->load->view('admin/data_opsi/v_struktur_organisasi');
	$this->load->view('admin/v_footer');

}

function struktur_edit(){
	$this->load->database();

	$this->load->view('admin/v_header');
	$this->load->view('admin/data_opsi/v_struktur_edit');
	$this->load->view('admin/v_footer');

}

function struktur_update(){
	$this->load->database();
	$struktur=$this->input->post('struktur');
	$this->m_dah->update_data(array('option_name' => 'struktur'),array('option_value' => $struktur),'dah_options');

	redirect(base_url().'admin/struktur_organisasi/?alert=update');

}


/*
|---------------------------------
|	Bagian Pengembang
|----------------------------------
*/

function developer(){
	$this->load->database();

	$this->load->view('admin/v_header');
	$this->load->view('admin/data_opsi/v_pengembang');
	$this->load->view('admin/v_footer');

}

function developer_edit(){
	$this->load->database();

	$this->load->view('admin/v_header');
	$this->load->view('admin/data_opsi/v_pengembang_edit');
	$this->load->view('admin/v_footer');

}

function developer_update(){
	$this->load->database();
	$developer=$this->input->post('developer');
	

		$config['upload_path'] = './upload/foto/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$foto = "foto_dev";
		if($_FILES["foto_dev"]["name"]){
			$rand1=rand(1000,9999);
			$config['file_name'] = $rand1.'_'.$_FILES['foto_dev']['name'];				
			$this->load->library('upload', $config);
			$foto_dev = $this->upload->do_upload('foto_dev');
			if (!$foto_dev){
				$error = array('error' => $this->upload->display_errors());
			}else{
				$foto_dev = $this->upload->data("file_name");
				$data = array('upload_data' => $this->upload->data());
				$this->m_dah->update_data(array('option_name' => 'foto_dev'),array('option_value' => $foto_dev),'dah_options');			
			}
		
		}

	$this->m_dah->update_data(array('option_name' => 'pengembang'),array('option_value' => $developer),'dah_options');

	redirect(base_url().'admin/developer/?alert=update');

}

function hapus_foto_dev(){
	$this->load->database();
		$id = $this->input->post('id');
		$where = array(
			'option_id' => $id
			);
		$data = $this->m_dah->edit_data($where,'dah_options')->row();
		@chmod("./upload/foto/" . $data->option_value, 0777);
		@unlink('./upload/foto/' . $data->option_value);

		$update = array(
			'option_value' => ""
			);
		$this->m_dah->update_data($where,$update,'dah_options');
}
/*
|---------------------------------
|	Bagian Pelayanan Surat
|----------------------------------
*/
function pelayanan_surat(){
	$this->load->database();
	// $this->db->group_by('nomor_kk');
	// $data['total']= $this->db->count_all('penduduk');
	$this->load->view('admin/v_header');
	$this->load->view('admin/data_opsi/v_pelayanan_surat',$data);
	$this->load->view('admin/v_footer');

}

function pelayanan_surat_edit(){
	$this->load->database();

	$this->load->view('admin/v_header');
	$this->load->view('admin/data_opsi/v_pelayanan_surat_edit');
	$this->load->view('admin/v_footer');

}

function pelayanan_surat_update(){
	$this->load->database();
	$surat=$this->input->post('surat');
	$this->m_dah->update_data(array('option_name' => 'pelayanan_surat'),array('option_value' => $surat),'dah_options');

	redirect(base_url().'admin/pelayanan_surat/?alert=update');

}




/*
|---------------------------------
|	Bagian Surat Admin
|----------------------------------
*/

/*
|---------------------------------
|	Bagian Surat rakyat
|----------------------------------
*/

function sesi_surat(){
	$this->load->database();
	$id_penduduk=$this->session->userdata('penduduk_id');
	$data['surat']=$this->m_dah->get_data('jenis_surat')->result();	
	
	$data['surat_review']=$this->m_dah->pilih_surat($id_penduduk,'review','surat_mohon')->result();
	$data['surat_tolak']=$this->m_dah->pilih_surat($id_penduduk,'ditolak','surat_mohon')->result();
	$data['surat_terima']=$this->m_dah->pilih_surat($id_penduduk,'diterima','surat_mohon')->result();
	
	$data['total_terima']=$this->m_dah->pilih_surat($id_penduduk,'diterima','surat_mohon')->num_rows();
	$data['total_tolak']=$this->m_dah->pilih_surat($id_penduduk,'ditolak','surat_mohon')->num_rows();
	$data['total_review']=$this->m_dah->pilih_surat($id_penduduk,'review','surat_mohon')->num_rows();
	

	$this->load->view('admin/v_header');
	$this->load->view('admin/sesi_surat/surat_data',$data);
	$this->load->view('admin/v_footer');

}


/*
|---------------------------------
|	Bagian Pelayanan Surat
|----------------------------------
*/

function permohonan_surat(){
	$this->load->database();
	if($this->session->userdata('level') != "admin"){
			redirect(base_url());
	}

	$data['surat_lain']=$this->m_dah->get_surat_lain_order('review')->result();

	$this->load->view('admin/v_header');
	$this->load->view('admin/data_opsi/v_pengajuan_surat',$data);
	$this->load->view('admin/v_footer');

}

function arsip_surat(){
	$this->load->database();
	if($this->session->userdata('level') != "admin"){
			redirect(base_url());
	}
	
	$data['surat_lain_terima']=$this->m_dah->get_surat_lain_order('diterima')->result();
	$data['surat_lain_tolak']=$this->m_dah->get_surat_lain_order('ditolak')->result();

	$data['surat_lain_total_terima']=$this->m_dah->get_surat_lain_order('diterima')->num_rows();
	$data['surat_lain_total_tolak']=$this->m_dah->get_surat_lain_order('ditolak')->num_rows();
	
	$this->load->view('admin/v_header');
	$this->load->view('admin/data_opsi/v_arsip_surat',$data);
	$this->load->view('admin/v_footer');
}

function arsip_surat_lurah(){
	$this->load->database();
	if($this->session->userdata('level') != "lurah"){
			redirect(base_url());
	}
	$wh=array(
		'status_surat' => "review"
	);
	
	$data['surat_lain_terima']=$this->m_dah->get_surat_lain_order('diterima')->result();
	$data['surat_lain_tolak']=$this->m_dah->get_surat_lain_order('ditolak')->result();

	$data['surat_lain_total_terima']=$this->m_dah->get_surat_lain_order('diterima')->num_rows();
	$data['surat_lain_total_tolak']=$this->m_dah->get_surat_lain_order('ditolak')->num_rows();
	
	
	$this->load->view('admin/v_header');
	$this->load->view('admin/data_opsi/v_arsip_surat_lurah',$data);
	$this->load->view('admin/v_footer');
}
/*--------------------------
| update status surat
----------------------------*/
	
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
	

/*--------------------------
|  Buat Penambahan Surat
----------------------------*/

	function data_surat(){
		$this->load->database();
		if($this->session->userdata('level') != "admin"){
				redirect(base_url());
			}

		$data['surat']=$this->m_dah->get_data('jenis_surat')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/tambah_surat/v_data_surat',$data);
		$this->load->view('admin/v_footer');
	}

	function tambah_surat(){
		$this->load->database();
		if($this->session->userdata('level') != "admin"){
				redirect(base_url().'admin/data_surat');
			}

		$this->load->view('admin/v_header');
		$this->load->view('admin/tambah_surat/v_tambah_surat');
		$this->load->view('admin/v_footer');
	}


	function tambah_surat_act(){
		$this->load->database();
		if($this->session->userdata('level') != "admin"){
				redirect(base_url());
			}
		$nama = $this->input->post('nama');
		$kode = $this->input->post('kode');
		$syarat = $this->input->post('syarat');
		$format = $this->input->post('format');


		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('kode','Kode','required');
		

		if($this->form_validation->run() != true){
			redirect('admin/tambah_surat');
		}else{
			$data= array(
				'nama_surat' => $nama,
				'kode_surat' => $kode,
				'syarat_surat' => $syarat,
				'format_surat' =>$format
			);
			$this->m_dah->insert_data($data,'jenis_surat');
			redirect(base_url().'admin/data_surat/?alert=tambah');
		}
		
	}


	function tambah_surat_edit($id){
		$this->load->database();
		if($this->session->userdata('level') != "admin"){redirect(base_url());}
		
		if($id == ""){
			redirect('admin/data_surat');
		}else{			
			$where = array(
				'id' => $id
				);	
			$data['surat'] = $this->m_dah->edit_data($where,'jenis_surat')->result();
			if(count($data['surat']) > 0){
				$this->load->view('admin/v_header');
				$this->load->view('admin/tambah_surat/v_edit_surat',$data);
				$this->load->view('admin/v_footer');				
			}else{
				redirect(base_url().'admin/data_surat');				
			}
		}
		
	}

	function tambah_surat_update(){
		if($this->session->userdata('level') != "admin"){redirect(base_url());}

		$this->load->database();		
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$kode = $this->input->post('kode');
		$syarat = $this->input->post('syarat');
		$format = $this->input->post('format');

		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('kode','Kode','required');

		if($this->form_validation->run() != true){
			redirect('admin/tambah_surat_edit/'.$id);
		}else{
			$where=array(
				'id' => $id
			);
			$data= array(
				'nama_surat' => $nama,
				'kode_surat' => $kode,
				'syarat_surat' => $syarat,
				'format_surat' =>$format
			);
			$this->m_dah->update_data($where,$data,'jenis_surat');			
			redirect(base_url().'admin/data_surat/?alert=update');
			
			// redirect(base_url().'admin/tambah_surat_edit/'.$id.'/?alert=update');
		}
		

	}


		function tambah_surat_hapus($id){
		$this->load->database();
		if($this->session->userdata('level') != "admin"){redirect(base_url());}
			if($id == ""){
				redirect('base_url()');
			}else{
				$where = array(
				'id' => $id
				);
			}	
			$this->m_dah->delete_data($where,'jenis_surat');
			redirect(base_url().'admin/data_surat/?alert=post-delete');
	}
	// end tambah surat

	// update surat lain review

	function update_surat_lain($id){
		if($this->session->userdata('level') != "admin"){
			redirect(base_url());
		}
		$this->load->database();

		$where=array(
			'surat_mohon_id' =>	$id
		);

		$data['surat']=$this->m_dah->edit_data($where,'surat_mohon')->result();
		
		$this->load->view('admin/v_header');
		$this->load->view('admin/review/rv_surat_lain',$data);
		$this->load->view('admin/v_footer');
	}

	function update_surat_lain_act(){
		if($this->session->userdata('level') != "admin"){
			redirect(base_url());
		}
		$this->load->database();

		$surat_id= $this->input->post('surat_id');

        $where_s=array(
            'surat_mohon_id' => $surat_id
        );

        $ket_s= $this->input->post('ket_surat');
        $no_surat=$this->input->post('no_surat');
        $format= $this->input->post('format');

        
        if($this->input->post('tolak') != ""){
            $this->form_validation->set_rules('ket_surat','Keterangan diisi dengan alasan mengapa menolak permohonan', 'required');

            if($this->form_validation->run() != true){
                redirect('admin/update_surat_lain/'.$surat_id);
            }else{
             
                $data_surat=array(
                    'status_surat' => "ditolak",
                    'info' =>$ket_s,
                    'notif' => 2

                );
                $this->m_dah->update_data($where_s,$data_surat,'surat_mohon');
                redirect(base_url().'admin/permohonan_surat/?alert=update');
            }
        }

        if($this->input->post('setuju') != ""){
            $this->form_validation->set_rules('surat_id','Surat Id wajib ada', 'required');
            $this->form_validation->set_rules('no_surat','Nomor surat Wajib ada!!', 'required');
            if($this->form_validation->run() != true){
                redirect('admin/update_surat_lain/'.$surat_id);
         
            }else{
         
                $data_lain=array(
                    'nomor_surat' => $no_surat,
                    'tgl_surat' => date('Y-m-d'),
                    'info' => $ket_s,
                    'format_surat' => $format,
                    'notif' => 2,
                    'status_surat' => "diterima"
                );
               
                $this->m_dah->update_data($where_s,$data_lain,'surat_mohon');
                redirect(base_url().'admin/permohonan_surat/?alert=update');
                
            }
        }


	}	

		function delete_surat_lain($id){
		if($this->session->userdata('level') != "admin"){
			redirect(base_url());
			}
				$this->load->database();
			if($id == ""){
				redirect('base_url()');
			}else{
				$where = array(
				'surat_mohon_id' => $id
				);

			$data = $this->m_dah->edit_data($where,'surat_mohon')->row();
			// hapus di direktori upload/syarat

			@chmod("./upload/syarat/" . $data->upload, 0777);
			@unlink('./upload/syarat/' . $data->upload);

			// hapus di table 
			$this->m_dah->delete_data($where,'surat_mohon');
			//  hapus tabel surat_mohon

			redirect('admin/arsip_surat/?alert=post-delete');
		}
      }


// pengturan format surat
  function atur_surat(){
  	if($this->session->userdata('level') != "admin"){
			redirect(base_url());
	}
   $this->load->database();

  
	$this->load->view('admin/v_header');
	$this->load->view('admin/tambah_surat/v_atur_surat',$data);
	$this->load->view('admin/v_footer');

  }    


  function atur_surat_update(){
	if($this->session->userdata('level') != "admin"){
			redirect(base_url());
	}
   $this->load->database();

   $jab_surat=$this->input->post('jab_surat');
   $pj_surat=$this->input->post('pj_surat');
   $nama_desa=$this->input->post('nama_desa');
   $logo_surat=$this->input->post('logo_surat');
   $kop_surat=$this->input->post('kop_surat');
   $kode_surat=$this->input->post('kode_surat');
	

		$config['upload_path'] = './upload/logo/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$foto = "foto_dev";
		if($_FILES["logo_surat"]["name"]){
			$rand1=rand(1000,9999);
			$config['file_name'] = $rand1.'_'.$_FILES['logo_surat']['name'];				
			$this->load->library('upload', $config);
			$logo_surat = $this->upload->do_upload('logo_surat');
			if (!$logo_surat){
				$error = array('error' => $this->upload->display_errors());
			}else{
				$logo_surat = $this->upload->data("file_name");
				$data = array('upload_data' => $this->upload->data());
				$this->m_dah->update_data(array('option_name' => 'logo_surat'),array('option_value' => $logo_surat),'dah_options');			
			}
		
		}

	$this->m_dah->update_data(array('option_name' => 'kop_surat'),array('option_value' => $kop_surat),'dah_options');
	$this->m_dah->update_data(array('option_name' => 'kode_surat'),array('option_value' => $kode_surat),'dah_options');
	$this->m_dah->update_data(array('option_name' => 'nama_desa'),array('option_value' => $nama_desa),'dah_options');
	$this->m_dah->update_data(array('option_name' => 'pj_surat'),array('option_value' => $pj_surat),'dah_options');
	$this->m_dah->update_data(array('option_name' => 'jab_surat'),array('option_value' => $jab_surat),'dah_options');

	redirect(base_url().'admin/atur_surat/?alert=update');




  }


  // hapus logo surat

  function hapus_logo_surat(){
	$this->load->database();
		$id = $this->input->post('id');
		$where = array(
			'option_id' => $id
			);
		$data = $this->m_dah->edit_data($where,'dah_options')->row();
		@chmod("./upload/logo/" . $data->option_value, 0777);
		@unlink('./upload/logo/' . $data->option_value);

		$update = array(
			'option_value' => ""
			);
		$this->m_dah->update_data($where,$update,'dah_options');
}

// end braket file admin.php
    
}