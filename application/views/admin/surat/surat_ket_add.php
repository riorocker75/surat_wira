<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Tambah Data Surat Keterangan Desa Kebun Balok</h1>
  <a href="<?php echo base_url().'admin/surat_ket'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
</div>

		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Surat Keterangan Desa Kebun Balok</h6>
                    </div>
                    <div class="card-body">
                    <form action="<?php echo base_url().'admin/surat_ket_act'?>" method="post" enctype='multipart/form-data'>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Jenis Surat</label>
                                    <input type="text" class="form-control form-control-user" name="jenis_surat">
                                     <?php echo form_error('jenis_surat', '<div class="form-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="">Nomor Surat</label>
                                    <input type="text" class="form-control form-control-user" name="no_surat" >
                                     <?php echo form_error('no_surat', '<div class="form-error">', '</div>'); ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Pemohon</label>
                                    <input type="text" class="form-control form-control-user" name="pemohon" >
                                     <?php echo form_error('pemohon', '<div class="form-error">', '</div>'); ?>

                                </div>

                                    <div class="form-group">
                                    <label for="">Keperluan</label>
                                    <textarea name="keperluan"  cols="20" rows="10" class="form-control form-control-user"></textarea>
                                     <?php echo form_error('keperluan', '<div class="form-error">', '</div>'); ?>

                                </div>
                            

                                
                            </div>

                            <div class="col-lg-6">
                                       <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" class="form-control form-control-user" name="tanggal" value="<?php echo date("Y-m-d");?>">
                                </div>

                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="text" class="form-control form-control-user" name="alamat" >
                                </div>

                                    <div class="form-group">
                                    <label for="">Lampiran</label>
                                    <input type="file" class="form-control form-control-user" name="lampiran" >
                                </div>
                              
                            </div>
                           <!-- end row form -->
                        </div>
                                <button class="btn btn-primary float-right" type="submit"><i class="fas fa-save"></i> Simpan Data</button>        
                        
                        </form>
                    </div>
                </div>
		    </div>
		</div>
</div>
