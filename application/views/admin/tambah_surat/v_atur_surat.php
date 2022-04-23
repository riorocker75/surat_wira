<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pengaturan Template Surat</h1>
</div>
<?php show_alert(); ?>

		<!-- Content Row -->
	<div class="row">
		<div class="col-lg-12 mb-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Atur</h6>
				</div>
				<div class="card-body">
				<?php echo form_open_multipart('admin/atur_surat_update');?>	
			<div class="table-responsive">
				<table class="table">

					<tr>

						<th>Logo Surat</th>			
						<td>
								<?php
								     $where=array(
								      'option_name' => 'logo_surat'
								       );
								    $cek_foto=$this->m_dah->edit_data($where, 'dah_options')->result();
								    foreach ($cek_foto as $f) {} 
								      if($f->option_value != ""){
								  ?>
								 <!-- foto nya ada  -->
								  <div class="foto-dev-edit">
								      <img src="<?php echo base_url()?>upload/logo/<?php echo $f->option_value; ?>">
								       <p style="margin-top:5px">
								          <a id="19" class="btn btn-danger hapus-logo" style="color:#fff">Ganti Photo</a>
								       </p>
								   </div>

								 <!-- end foto ada -->
								  <?php }else{?>
								   <div class="form-group">
								          <input class="form-control-file" type="file" name="logo_surat" id="file_2" required="">
								  </div>
								  <div class="file_show" id="file_show_2"></div>
								  <?php } ?>    
								 

								  <?php echo form_error('logo_surat', '<div class="form-error">', '</div>'); ?>
							<small class="text-danger">* untuk Logo Surat wajib format jpg,png dengan ukuran disarankan tidak kurang dari 106 x 106 px</small>	
						</td>
					</tr>	
					<tr>
						<th>Kode Surat</th>			
						<td><input type="text" name="kode_surat" value="<?php echo $this->m_dah->get_option('kode_surat'); ?>" class="form-control" required>
						<br>
						<small class="text-danger">* ini untuk penomoran surat cukup isi kode surat yang terdiri kode daerah atau ada tambahan kode surat, penomoran surat akan diisi secara otomatis </small>	
						</td>
					</tr>

					<tr>
						<th>Nama Daerah</th>			
						<td><input type="text" name="nama_desa" value="<?php echo $this->m_dah->get_option('nama_desa'); ?>" class="form-control" required>
						<br>
						<small class="text-danger">* ini untuk dibagian nama daerah (kabupaten/kota/kecamatan/desa) surat dikeluarkan</small>	
						</td>
					</tr>	

					<tr>
						<th>Pengesah Surat</th>			
						<td><input type="text" name="pj_surat" value="<?php echo $this->m_dah->get_option('pj_surat'); ?>" class="form-control" required>
						<br>
						<small class="text-danger">* ini nama yang menanda-tangani surat (camat/lurah/bupati)</small>	
						</td>
					</tr>

					<tr>
						<th>Jabatan Pengesah</th>			
						<td><input type="text" name="jab_surat" value="<?php echo $this->m_dah->get_option('jab_surat'); ?>" class="form-control" required>
						<br>
						<small class="text-danger">* ini jabatan yang menanda-tangani surat (camat/lurah/bupati)</small>	
						</td>
					</tr>

					<tr>
						<th>Kop Surat</th>			
						<td><textarea id="editor2" name="kop_surat" class="form-control" required=""><?php echo $this->m_dah->get_option('kop_surat'); ?></textarea>
						<br>
						<small class="text-danger">* isi sesuai format yang sudah dituntun diatas</small>	
						</td>
					</tr>
				
					<tr>
						<th>
							<button type="submit" class="btn btn-primary"> Simpan</button>
						</th>
						<td></td>			
					</tr>
				</table>
			</div>			
		</form>	
				</div>
			</div>
		</div>

	</div>


		<!-- Content Row -->
		
</div>
