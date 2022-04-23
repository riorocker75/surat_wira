<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pelayanan Surat</h1>
  <?php if($this->session->userdata('level') == "admin"){?>
  <a href="<?php echo base_url().'admin/pelayanan_surat_edit'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"> <i class="fas fa-pen-alt"></i> Ubah Data pelayanan Surat</a>
  <?php }else{} ?>
  
</div>
    <?php show_alert()?>
		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">

                        <h6 class="m-0 font-weight-bold text-primary" style="line-height:1.5!important">Jenis Surat Yang Dapat Dilayani</h6>
                    </div>
                    <div class="card-body">
                    <?php echo $this->m_dah->get_option('pelayanan_surat'); ?>
                    </div>
                </div>
		    </div>
		</div>
</div>
