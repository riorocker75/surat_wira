<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pengembang Aplikasi</h1>
  <?php if($this->session->userdata('level') == "admin"){?>
  <a href="<?php echo base_url().'admin/developer_edit'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"> <i class="fas fa-pen-alt"></i> Ubah Data Pengembang</a>
  <?php }else{} ?>
  
</div>
    <?php show_alert()?>
		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profile Pembuat</h6>
                    </div>
                    <div class="card-body">

                      <?php
                      $where=array(
                        'option_name' => 'foto_dev'
                      );
                      $cek_foto=$this->m_dah->edit_data($where, 'dah_options')->result();
                      foreach ($cek_foto as $f) {}
                      ?>
                      <?php if($f->option_value != ""){ ?>
                      <div class="foto-dev">
                        <img src="<?php echo base_url()?>upload/foto/<?php echo $f->option_value; ?>">
                      </div>
                      <?php }else{}?>
                     
                     <div class="d-flex justify-content-center">
                        <?php echo $this->m_dah->get_option('pengembang'); ?>
                       
                     </div>
                        
                    
                    </div>
                </div>
		    </div>
		</div>
</div>
