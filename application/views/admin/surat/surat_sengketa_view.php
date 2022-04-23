<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Detail Surat Keterangan Tidak Silang Sengketa</h1>
  <a href="<?php echo base_url().'admin/surat_sengketa'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
</div>

		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Surat Keterangan Tidak Silang Sengketa</h6>
                    </div>
                    <div class="card-body">
                        <?php foreach($data as $dt){?>
                    <!-- <form action="<?php echo base_url().'admin/surat_sengketa_update'?>" method="post" enctype='multipart/form-data'> -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Jenis Surat</label>
                                    <input type="text" class="form-control form-control-user" name="jenis_surat" value="<?php echo $dt->jenis_surat?> "disabled>
                                     <?php echo form_error('jenis_surat', '<div class="form-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="">Nomor Surat</label>
                                    <input type="text" class="form-control form-control-user" name="no_surat" value="<?php echo $dt->no_surat?>" disabled>
                                     <?php echo form_error('no_surat', '<div class="form-error">', '</div>'); ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Pemohon</label>
                                    <input type="text" class="form-control form-control-user" name="pemohon" value="<?php echo $dt->pemohon?> "disabled>
                                     <?php echo form_error('pemohon', '<div class="form-error">', '</div>'); ?>

                                </div>

                                    <div class="form-group">
                                    <label for="">Keperluan</label>
                                    <textarea name="keperluan"  cols="20" rows="10" class="form-control form-control-user" disabled><?php echo $dt->keperluan?> </textarea>
                                     <?php echo form_error('keperluan', '<div class="form-error">', '</div>'); ?>

                                </div>
                            

                                
                            </div>

                            <div class="col-lg-6">
                                       <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" class="form-control form-control-user" name="tanggal" value="<?php echo date("Y-m-d",strtotime($dt->tanggal));?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="text" class="form-control form-control-user" name="alamat" value="<?php echo $dt->alamat?> "disabled>
                                </div>

                                    <div class="form-group">
                                    <label for="">Lampiran</label><br>
                                    <?php echo $this->m_dah->preview_file($dt->lampiran)?>
                                    <!-- <input type="file" class="form-control form-control-user" name="lampiran" > -->
                                </div>
                              
                            </div>
                           <!-- end row form -->
                        </div>
                                <!-- <button class="btn btn-primary float-right" type="submit"><i class="fas fa-save"></i> Simpan Data</button>        
                        
                        </form> -->
                        <?php } ?>
                    </div>
                </div>
		    </div>
		</div>
</div>
