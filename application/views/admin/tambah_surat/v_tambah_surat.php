<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Surat Baru</h1>
</div>
<?php show_alert(); ?>

		<!-- Content Row -->
	<div class="row">
		<div class="col-lg-12 mb-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Tambah</h6>
				</div>
				<div class="card-body">
				<?php echo form_open_multipart('admin/tambah_surat_act');?>	
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th>Nama Surat</th>			
						<td><input type="text" name="nama" class="form-control" required></td>
					</tr>
					<tr>
						<th>Kode Surat</th>			
						<td>
							<input type="text" name="kode" class="form-control"  required>
							<small class="text-danger">* diisi dengan singkatan dari nama surat atau dengan kode surat tersendiri</small>

						</td>

					</tr>

					<tr>
						<th>Persyaratan surat</th>			
						<td>
							<textarea id="editor2" name="syarat" class="form-control" ></textarea>
							<small class="text-danger">* diisi dengan persyaratan yang buat di upload ke sistem, buatlah list filenya dan jika lebih dari 1 file maka arahkan menggabungkanya menjadi pdf</small>

						</td>
					</tr>

					<tr>
						<th>Format Cetak Surat</th>			
						<td>
							<textarea id="editor1" name="format" class="form-control" style="min-height:500px" ></textarea>
							<br>
							<small class="text-danger">* bisa diisi dengan format di word tapi wajib di lihat <b>preview template</b> untuk melihat kerapihanya, tapi setelah ini di ubah di fasilitas edit</small>

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
