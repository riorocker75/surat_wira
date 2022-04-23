<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <a href="<?php echo base_url().'admin/surat_keluar'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
</div>

		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Surat Keluar</h6>
                    </div>
                    <div class="card-body">
                    <form action="<?php echo base_url().'admin/surat_keluar_update'?>" method="post" enctype='multipart/form-data'>

                        <?php foreach($data as $dt){?>
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Pengirim</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $dt->pengirim?>" name="pengirim">
                                    <input type="hidden" name="id" value="<?php echo $dt->id?>">
                                     <?php echo form_error('pengirim', '<div class="form-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="">Nomor Surat</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $dt->no_surat?>" name="no_surat" >
                                     <?php echo form_error('no_surat', '<div class="form-error">', '</div>'); ?>

                                </div>

                                    <div class="form-group">
                                    <label for="">Isi Ringkas</label>
                                    <textarea name="deskripsi"  cols="30" rows="10" class="form-control form-control-user"><?php echo $dt->deskripsi?></textarea>
                                     <?php echo form_error('deskripsi', '<div class="form-error">', '</div>'); ?>

                                </div>
                            

                                
                            </div>

                            <div class="col-lg-6">
                                       <div class="form-group">
                                    <label for="">Tanggal Surat</label>
                                    <input type="date" class="form-control form-control-user" name="tgl_surat" value="<?php echo date('Y-m-d',strtotime($dt->tgl_surat))?>" >
                                </div>

                                       <div class="form-group">
                                    <label for="">Tanggal Keluar</label>
                                    <input type="date" class="form-control form-control-user" name="tgl_keluar" value="<?php echo date('Y-m-d',strtotime($dt->tgl_keluar))?>">
                                </div>

                                    <div class="form-group">
                                     <label for="">Lampiran</label>
                                    <input type="file" class="form-control form-control-user" name="lampiran" >
                                </div>
                              
                            </div>
                           <!-- end row form -->
                        </div>
                        <?php } ?>
                        
                        <button class="btn btn-primary float-right" type="submit"><i class="fas fa-save"></i> Ubah Data</button>        
                    </div>

                        </form>
                </div>
		    </div>
		</div>
</div>
