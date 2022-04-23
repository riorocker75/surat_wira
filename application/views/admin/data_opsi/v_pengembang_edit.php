<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Ubah Data Pengembang</h1>
  <a href="<?php echo base_url().'admin/developer'?>" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i></i> Kembali</a>
  
</div>

		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Diri </h6>
                    </div>

                    <div class="card-body">
                        <?php show_alert(); ?>
                        
                         <?php echo form_open_multipart('admin/developer_update');?>

                                <?php
                                   $where=array(
                                    'option_name' => 'foto_dev'
                                     );
                                  $cek_foto=$this->m_dah->edit_data($where, 'dah_options')->result();
                                  foreach ($cek_foto as $f) {} 
                                    if($f->option_value != ""){
                                ?>
                               <!-- foto nya ada  -->
                                <div class="foto-dev-edit">
                                    <img src="<?php echo base_url()?>upload/foto/<?php echo $f->option_value; ?>">
                                     <p style="margin-top:5px">
                                        <a id="18" class="btn btn-danger hapus-foto" style="color:#fff">Ganti Photo</a>
                                     </p>
                                 </div>

                               <!-- end foto ada -->
                                <?php }else{?>
                                 <div class="form-group">
                                    <label style="font-weight:800">Foto </label>
                                        <input class="form-control-file" type="file" name="foto_dev" id="file_2">
                                </div>
                                <div class="file_show" id="file_show_2"></div>
                                <?php } ?>    
                               

                                <?php echo form_error('foto_dev', '<div class="form-error">', '</div>'); ?>
                        <br>
                        <textarea id="editor1" name="developer" class="form-control" ><?php echo $this->m_dah->get_option('pengembang'); ?></textarea>
                        <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Simpan </button>
                    </form>
                    </div>
                </div>
		    </div>
		</div>
</div>
