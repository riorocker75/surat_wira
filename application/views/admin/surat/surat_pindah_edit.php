<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Ubah Data Surat Pindah</h1>
  <a href="<?php echo base_url().'admin/surat_pindah'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
</div>

		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Surat Pindah</h6>
                    </div>
                    <div class="card-body">
                        <?php foreach($data as $dt){?>
                    <form action="<?php echo base_url().'admin/surat_pindah_update'?>" method="post" enctype='multipart/form-data'>
                        <div class="row">
                            <div class="col-lg-6">
                                

                                <div class="form-group">
                                    <label for="">Nomor Surat</label>
                                    <input type="text" class="form-control form-control-user" name="no_surat" value="<?php echo $dt->no_surat?>">
                                    <input type="hidden" class="form-control form-control-user" name="id" value="<?php echo $dt->id?>">

                                     <?php echo form_error('no_surat', '<div class="form-error">', '</div>'); ?>

                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" class="form-control form-control-user" name="tanggal" value="<?php echo date("Y-m-d", strtotime($dt->tanggal));?>">
                                </div>
                                  <div class="form-group">
                                    <label for="">Kepala Keluarga</label>
                                    <input type="text" class="form-control form-control-user" name="nama_kepala" value="<?php echo $dt->nama_kepala ?>" >
                                     <?php echo form_error('nama_kepala', '<div class="form-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Anggota keluarga yang pindah</label>
                                    <input type="text" class="form-control form-control-user" name="nama_pindah" value="<?php echo $dt->nama_pindah?>">
                                     <?php echo form_error('nama_pindah', '<div class="form-error">', '</div>'); ?>
                                </div>
                                 <div class="form-group">
                                    <label for="">Nomor Kartu Keluarga</label>
                                    <input type="number" class="form-control form-control-user" name="no_kk" value="<?php echo $dt->no_kk?>">
                                     <?php echo form_error('no_kk', '<div class="form-error">', '</div>'); ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Nomor Induk Kependudukan</label>
                                    <input type="number" class="form-control form-control-user" name="nik" value="<?php echo $dt->nik?>">
                                     <?php echo form_error('nik', '<div class="form-error">', '</div>'); ?>

                                </div>
                               
                            

                                
                            </div>

                            <div class="col-lg-6">
                

                                <div class="form-group">
                                    <label for="">Daerah Tujuan (Desa)</label>
                                    <input type="text" class="form-control form-control-user" name="daerah_tujuan" value="<?php echo $dt->daerah_tujuan?>">
                                     <?php echo form_error('daerah_tujuan', '<div class="form-error">', '</div>'); ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Kecamatan</label>
                                    <input type="text" class="form-control form-control-user" name="kecamatan" value="<?php echo $dt->kecamatan?>">
                                     <?php echo form_error('kecamatan', '<div class="form-error">', '</div>'); ?>

                                </div>
                                 <div class="form-group">
                                    <label for="">Kabupaten</label>
                                    <input type="text" class="form-control form-control-user" name="kabupaten" value="<?php echo $dt->kabupaten?>">
                                     <?php echo form_error('kabupaten', '<div class="form-error">', '</div>'); ?>

                                </div>

                                 <div class="form-group">
                                    <label for="">Provinsi</label>
                                    <input type="text" class="form-control form-control-user" name="provinsi" value="<?php echo $dt->provinsi?>">
                                     <?php echo form_error('provinsi', '<div class="form-error">', '</div>'); ?>

                                </div>

                                    <div class="form-group">
                                    <label for="">Lampiran</label><br>
                                    <!-- <?php echo $this->m_dah->preview_file($dt->lampiran)?> -->

                                    <input type="file" class="form-control form-control-user" name="lampiran" >
                                     <?php echo form_error('lampiran', '<div class="form-error">', '</div>'); ?>

                                </div>
                              
                            </div>
                           <!-- end row form -->
                        </div>
                                <button class="btn btn-primary float-right" type="submit"><i class="fas fa-save"></i> Simpan Data</button>        
                        
                        </form>
                        <?php } ?>
                    </div>
                </div>
		    </div>
		</div>
</div>
