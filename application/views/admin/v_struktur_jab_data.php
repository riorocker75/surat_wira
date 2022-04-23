<div class="container-fluid">

<!-- Pjbe Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Pemangku Jabatan</h1>
  <a href="<?php echo base_url();?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> kembali</a>

</div>
<?php show_alert()?>
		<!-- Content Row -->
		<div class="row">
           
        <div class="col-lg-5 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pejabat</h6>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url().'admin/struktur_jab_add'?>" method="post">
                            <div class="form-group">
                              <label for="">Nama calon pejabat</label>
                                <select class="selectpicker form-control form-control-user" name="id_penduduk" data-live-search="true" required>
                                    <?php foreach ($penduduk as $pd){?>
                                        
                                        <option value="<?php echo $pd->id?>" data-tokens="<?php echo $pd->nik?> | <?php echo $pd->nama?>"><?php echo $pd->nik?> | <?php echo $pd->nama?></option>
                                      
                                      <?php  } ?>
                                </select>
                            </div>
                                <?php echo form_error('id_penduduk', '<div class="form-error">', '</div>'); ?>
                            
                            <div class="form-group">
                                <label for="">Pilih Jabatan</label>

                                <select class="selectpicker form-control form-control-user" name="jabatan" data-live-search="true" required>
                                    <?php foreach ($jabatan as $jbt){?>

                                    <option value="<?php echo $jbt->id?>" data-tokens="<?php echo $jbt->jabatan?>"><?php echo $jbt->jabatan?></option>

                                     <?php  } ?>
                                </select>
                            </div>
                            <?php echo form_error('jabatan', '<div class="form-error">', '</div>'); ?>

                            <button class="btn btn-primary" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
                        </form>
                    </div>
                </div>
		    </div>
            <div class="col-lg-7 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Jabatan</h6>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Nama</th>
                                <th>Nik</th>
                                <th>Jabatan</th>

                                <th width="20%">Opsi</th>
                                </tr>
                            </thead> 
                            <tbody>
                               <?php foreach ($pejabat as $us ) {?>
                                   <tr>
                                    <td> <?php echo $us->user_name?></td>
                                    <td>
                                        <?php
                                         $xnik=$this->m_dah->get_penduduk_user($us->penduduk_id)->result();
                                         foreach($xnik as $nik){
                                         ?>
                                          <?php echo $nik->nik?>  
                                         <?php }?>
                                    </td>

                                     <td>
                                     <?php
                                         $xjab=$this->m_dah->get_jabatan_user($us->jabatan)->result();
                                         foreach($xjab as $jbx){
                                         ?>
                                          <?php echo $jbx->jabatan?>  
                                         <?php }?>
                                     </td>
                                   
                                    <td>
                                        <a href="<?php echo base_url().'admin/struktur_jab_delete/'.$us->penduduk_id?>"> <i class="fas fa-trash-alt    "></i></a>
                                     
                                    </td>

                                   </tr>

                              <?php }?> 
                            </tbody> 
                            </table>
                        </div>
                    </div>
                </div>
		    </div>
		</div>
</div>
