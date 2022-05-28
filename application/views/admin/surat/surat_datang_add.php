<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Tambah Data Surat Datang/Menetap</h1>
  <a href="<?php echo base_url().'admin/surat_datang'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
</div>

		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Surat Datang</h6>
                    </div>
                    <div class="card-body">
                    <form action="<?php echo base_url().'admin/surat_datang_act'?>" method="post" enctype='multipart/form-data'>
                        <div class="row">
                            <div class="col-lg-6">
                                

                                <div class="form-group">
                                    <label for="">Nomor Surat Pindah Asal</label>
                                    <input type="text" class="form-control form-control-user" name="no_surat_pindah" >
                                     <?php echo form_error('no_surat_pindah', '<div class="form-error">', '</div>'); ?>

                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" class="form-control form-control-user" name="tanggal" value="<?php echo date("Y-m-d");?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Anggota keluarga yang datang</label>
                                    <input type="text" class="form-control form-control-user" name="nama_datang">
                                     <?php echo form_error('nama_datang', '<div class="form-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    <select class="form-control form-control-user" name="jenis_kelamin" require>
                                    <option value="">--Pilih Jenis Kelamin--</option>
                                    <option value="pria">Laki-laki</option>
                                    <option value="wanita">Perempuan</option>
                                
                                    </select>
                                </div>

                                 <div class="form-group">
                                    <label for="">Tempat, Tanggal Lahir</label>
                                    <input type="text" class="form-control form-control-user" name="tmp_tgl_lhr">
                                     <?php echo form_error('tmp_tgl_lhr', '<div class="form-error">', '</div>'); ?>
                                </div>

                                 <div class="form-group">
                                    <label for="">Nomor Induk Kependudukan</label>
                                    <input type="number" class="form-control form-control-user" name="nik">
                                     <?php echo form_error('nik', '<div class="form-error">', '</div>'); ?>
                                </div>


                                
                            </div>

                            <div class="col-lg-6">
                

                                <div class="form-group">
                                    <label for="">Daerah Asal (Desa)</label>
                                    <input type="text" class="form-control form-control-user" name="daerah_asal" >
                                     <?php echo form_error('daerah_asal', '<div class="form-error">', '</div>'); ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Kecamatan</label>
                                    <input type="text" class="form-control form-control-user" name="kecamatan" >
                                     <?php echo form_error('kecamatan', '<div class="form-error">', '</div>'); ?>

                                </div>
                                 <div class="form-group">
                                    <label for="">Kabupaten</label>
                                    <input type="text" class="form-control form-control-user" name="kabupaten" >
                                     <?php echo form_error('kabupaten', '<div class="form-error">', '</div>'); ?>

                                </div>

                                 <div class="form-group">
                                    <label for="">Provinsi</label>
                                    <input type="text" class="form-control form-control-user" name="provinsi" >
                                     <?php echo form_error('provinsi', '<div class="form-error">', '</div>'); ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Alamat Sekarang</label>
                                    <input type="text" class="form-control form-control-user" name="alamat" >
                                     <?php echo form_error('alamat', '<div class="form-error">', '</div>'); ?>

                                </div>

                                    <div class="form-group">
                                    <label for="">Lampiran</label>
                                    <input type="file" class="form-control form-control-user" name="lampiran" >
                                     <?php echo form_error('lampiran', '<div class="form-error">', '</div>'); ?>

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
