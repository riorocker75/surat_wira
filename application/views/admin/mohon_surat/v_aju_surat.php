<div class="container-fluid">

<!-- Page Heading -->
<?php foreach($surat as $sr){}?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Permohonan <?php echo $sr->nama_surat?></h1>
  <a href="<?php echo base_url().'admin/sesi_surat'?>" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i></i> Kembali</a>
</div>
<?php show_alert(); ?>

		<!-- Content Row -->
	<div class="row">
		<div class="col-lg-6 mb-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Ajukan Permohonan </h6>

				</div>
				<div class="card-body">
				<?php echo form_open_multipart('user/mohon_surat_act');?>	
					
					<div class="syarat">
						<div class="title-syarat">Persyaratan</div>
						<div>
							Persyaratan
							<br>
							<?php echo $sr->syarat_surat ?>
							<br>
							
						</div>
						<div class="line2" style="margin-bottom:10px"></div>
						<div class="form-group">
						    <label style="font-weight:800">Upload Syarat</label>
						        <input class="form-control-file" type="file" name="upload" id="file_1" required>
						</div>
						<div class="file_show" id="file_show_1"></div>

						<?php echo form_error('upload', '<div class="form-error">', '</div>'); ?>
						<div class="line2" style="margin-bottom:10px"></div>

					</div>

					<input type="text" name="kode_surat" value="<?php echo $sr->kode_surat?>" hidden>
					<input type="text" name="id_surat" value="<?php echo $sr->id?>" hidden>


					<!-- data diri penduduk -->
                        <div class="syarat">
                            <div class="title-syarat">
                                Data Diri 
                            </div>

                            <?php foreach($data_diri as $dd ){?>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $dd->nama?>" disabled>
                                   
                                </div>

                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $dd->nik?>" disabled>
                                   
                                </div>

                                <div class="form-group">
                                    <label for="">Tempat & tanggal lahir</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $dd->tempat_lahir?> / <?php $tgl=date('d-m-Y', strtotime($dd->tgl_lahir)); echo $tgl?>" disabled>
                                   
                                </div>

                                <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $this->m_dah->jenis_kelamin($dd->jenis_kelamin)?>" disabled>
                                   
                                </div>

                                <div class="form-group">
                                    <label for="">Agama</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $dd->agama?>" disabled>
                                   
                                </div>

                                <div class="form-group">
                                    <label for="">Pekerjaan</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $dd->pekerjaan?>" disabled>
                                   
                                </div>

                               
                            <?php }?>       
                        </div>
                        <!-- end data diri-->

                        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Ajukan Surat </button>
				</form>	
				</div>
			</div>
		</div>

	</div>


		<!-- Content Row -->
		
</div>
