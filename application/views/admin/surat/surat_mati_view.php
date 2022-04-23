<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Detail Surat Kematian</h1>
  <a href="<?php echo base_url().'admin/surat_mati'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
</div>

		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Surat Kematian</h6>
                    </div>
                    <div class="card-body">
                        <?php foreach($data as $dt){?>
                    <!-- <form action="<?php echo base_url().'admin/surat_mati_act'?>" method="post" enctype='multipart/form-data'> -->
                        <div class="row">
                            <div class="col-lg-6">
                           

                                <div class="form-group">
                                    <label for="">Nomor Surat</label>
                                    <input type="text" class="form-control form-control-user" name="no_surat" value="<?php echo $dt->no_surat?>" disabled>
                                     <?php echo form_error('no_surat', '<div class="form-error">', '</div>'); ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Nama Kepala Keluarga</label>
                                    <input type="text" class="form-control form-control-user" name="nama_kepala" value="<?php echo $dt->nama_kepala?>" disabled>
                                     <?php echo form_error('nama_kepala', '<div class="form-error">', '</div>'); ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Nama Keluarga yang Meninggal</label>
                                    <input type="text" class="form-control form-control-user" name="nama_meninggal" value="<?php echo $dt->nama_meninggal?>" disabled>
                                     <?php echo form_error('nama_meninggal', '<div class="form-error">', '</div>'); ?>

                                </div>

                               
                               <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    <select class="form-control form-control-user" name="jenis_kelamin" disabled>
                                    <option value="<?php echo $dt->jenis_kelamin?>" selected hidden><?php echo $this->m_dah->jenis_kelamin($dt->jenis_kelamin) ?></option>
                                    <option value="pria" >Laki-laki</option>
                                    <option value="wanita" >Perempuan</option>
                                
                                    </select>
                                </div>

                             <div class="form-group">
                                    <label for="">Nomor Kartu Keluarga</label>
                                    <input type="number" class="form-control form-control-user" name="no_kk" value="<?php echo $dt->no_kk?>" disabled>
                                     <?php echo form_error('no_kk', '<div class="form-error">', '</div>'); ?>
                                </div>

                                 <div class="form-group">
                                    <label for="">Nomor Induk Kependudukan (Meniggal)</label>
                                    <input type="text" class="form-control form-control-user" name="nik" value="<?php echo $dt->nik?>" disabled>
                                     <?php echo form_error('nik', '<div class="form-error">', '</div>'); ?>
                                </div>

                                
                            </div>

                            <div class="col-lg-6">
                                       <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" class="form-control form-control-user" name="tanggal" value="<?php echo date("Y-m-d",strtotime($dt->tanggal));?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="date" class="form-control form-control-user" name="tgl_lhr" value="<?php echo date("Y-m-d",strtotime($dt->tgl_lhr));?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Tanggal Meninggal</label>
                                    <input type="date" class="form-control form-control-user" name="tgl_meninggal" value="<?php echo date("Y-m-d",strtotime($dt->tgl_meninggal));?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="text" class="form-control form-control-user" name="alamat" value="<?php echo $dt->alamat ?>" disabled>
                                </div>

                                 <div class="form-group">
                                    <label for="">Pelapor</label>
                                    <input type="text" class="form-control form-control-user" name="pelapor" value="<?php echo $dt->pelapor ?>" disabled>
                                </div>

                                    <div class="form-group">
                                    <label for="">Lampiran</label><br>
                                    <?php echo $this->m_dah->preview_file($dt->lampiran)?>
                                    <!-- <input type="file" class="form-control form-control-user" name="lampiran" > -->
                                </div>
                              
                            </div>
                           <!-- end row form -->
                        </div>
                                <!-- <button class="btn btn-primary float-right" type="submit"><i class="fas fa-save"></i> Simpan Data</button>         -->
                        
                        <!-- </form> -->
                        <?php } ?>
                    </div>
                </div>
		    </div>
		</div>
</div>
