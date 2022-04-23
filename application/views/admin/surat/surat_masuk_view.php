<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <a href="<?php echo base_url().'admin/surat_masuk'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
</div>

		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Surat Masuk</h6>
                    </div>
                    <div class="card-body">
                        <?php foreach($data as $dt){?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Pengirim</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $dt->pengirim?>" disabled>
                                     <?php echo form_error('pengirim', '<div class="form-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="">Nomor Surat</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $dt->no_surat?>" disabled >
                                     <?php echo form_error('no_surat', '<div class="form-error">', '</div>'); ?>

                                </div>

                                    <div class="form-group">
                                    <label for="">Isi Ringkas</label>
                                    <textarea name="deskripsi"  cols="30" rows="10" class="form-control form-control-user" disabled><?php echo $dt->deskripsi?></textarea>
                                     <?php echo form_error('deskripsi', '<div class="form-error">', '</div>'); ?>

                                </div>
                            

                                
                            </div>

                            <div class="col-lg-6">
                                       <div class="form-group">
                                    <label for="">Tanggal Surat</label>
                                    <input type="date" class="form-control form-control-user" name="tgl_surat" value="<?php echo date('Y-m-d',strtotime($dt->tgl_surat))?>" disabled>
                                </div>

                                       <div class="form-group">
                                    <label for="">Tanggal Masuk</label>
                                    <input type="date" class="form-control form-control-user"value="<?php echo date('Y-m-d',strtotime($dt->tgl_masuk))?>" disabled>
                                </div>

                                    <div class="form-group">
                                    <label for="">Lampiran</label><br>
                                   <?php $this->m_dah->preview_file($dt->lampiran)?>
                                </div>
                              
                            </div>
                           <!-- end row form -->
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>
		    </div>
		</div>
</div>
