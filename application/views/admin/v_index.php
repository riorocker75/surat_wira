

  <!-- Begin Page Content -->
  <div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	</div>

		
		<?php if($this->session->userdata('level') == "admin"){?>
		<div class="row">
				<div class="col-lg-4 mb-4">
			<div class="card bg-primary text-white shadow">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col-auto">
					<i class="fas fa-envelope  fa-2x text-gray-300 "></i>
					</div>
					<div class="col mr-3" style="margin-left:20px">
						<?php echo $this->m_dah->tot_surat_masuk(1)->num_rows(); ?> Surat Masuk
						<div class="text-white-50">Jumlah Surat Masuk</div>
						</div>
					</div>

					<div style="position:absolute;bottom:5px;right:10px">
						<a href="<?php echo base_url().'admin/surat_masuk'?>" class="text-white-50" style="text-decoration:none;">Selengkapnya <i class="fa fa-angle-right" aria-hidden="true"></i></a>
					</div>
				
				</div>
			</div>
		</div>

		<!-- end jumlah kk -->
		<div class="col-lg-4 mb-4">
			<div class="card bg-primary text-white shadow">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col-auto">
						<i class="fa fa-envelope-open fa-2x text-gray-300" aria-hidden="true"></i>
						<!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
					</div>
					<div class="col mr-3" style="margin-left:20px">
						<?php echo $this->m_dah->tot_surat_keluar(1)->num_rows(); ?> Surat Keluar
						<div class="text-white-50">Jumlah Surat Keluar</div>
						</div>
					</div>
					<div style="position:absolute;bottom:5px;right:10px">
						<a href="<?php echo base_url().'admin/surat_keluar'?>" class="text-white-50" style="text-decoration:none;">Selengkapnya <i class="fa fa-angle-right" aria-hidden="true"></i></a>
					</div>
				
				</div>
			</div>
		</div>

		<div class="col-lg-4 mb-4">
			<div class="card bg-primary text-white shadow">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col-auto">
						<i class="fa fa-envelope-open fa-2x text-gray-300" aria-hidden="true"></i>
						<!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
					</div>
					<div class="col mr-3" style="margin-left:20px">
						<?php echo $this->m_dah->tot_surat('surat_ket',1)->num_rows(); ?> Surat Keterangan
						<div class="text-white-50">Jumlah Surat Keterangan</div>
						</div>
					</div>
					<div style="position:absolute;bottom:5px;right:10px">
						<a href="<?php echo base_url().'admin/surat_ket'?>" class="text-white-50" style="text-decoration:none;">Selengkapnya <i class="fa fa-angle-right" aria-hidden="true"></i></a>
					</div>
				
				</div>
			</div>
		</div>
		<div class="col-lg-4 mb-4">
			<div class="card bg-primary text-white shadow">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col-auto">
						<i class="fa fa-envelope-open fa-2x text-gray-300" aria-hidden="true"></i>
						<!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
					</div>
					<div class="col mr-3" style="margin-left:20px">
						<?php echo $this->m_dah->tot_surat('surat_sengketa',1)->num_rows(); ?> Surat Sengketa
						<div class="text-white-50">Jumlah Surat Sengketa</div>
						</div>
					</div>
					<div style="position:absolute;bottom:5px;right:10px">
						<a href="<?php echo base_url().'admin/surat_sengketa'?>" class="text-white-50" style="text-decoration:none;">Selengkapnya <i class="fa fa-angle-right" aria-hidden="true"></i></a>
					</div>
				
				</div>
			</div>
		</div>

		<div class="col-lg-4 mb-4">
			<div class="card bg-primary text-white shadow">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col-auto">
						<i class="fa fa-envelope-open fa-2x text-gray-300" aria-hidden="true"></i>
						<!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
					</div>
					<div class="col mr-3" style="margin-left:20px">
						<?php echo $this->m_dah->tot_surat('surat_mati',1)->num_rows(); ?> Surat Kematian
						<div class="text-white-50">Jumlah Surat Kematian</div>
						</div>
					</div>
					<div style="position:absolute;bottom:5px;right:10px">
						<a href="<?php echo base_url().'admin/surat_mati'?>" class="text-white-50" style="text-decoration:none;">Selengkapnya <i class="fa fa-angle-right" aria-hidden="true"></i></a>
					</div>
				
				</div>
			</div>
		</div>

		<div class="col-lg-4 mb-4">
			<div class="card bg-primary text-white shadow">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col-auto">
						<i class="fa fa-envelope-open fa-2x text-gray-300" aria-hidden="true"></i>
						<!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
					</div>
					<div class="col mr-3" style="margin-left:20px">
						<?php echo $this->m_dah->tot_surat('surat_pindah',1)->num_rows(); ?> Surat Pindah
						<div class="text-white-50">Jumlah Surat Pindah</div>
						</div>
					</div>
					<div style="position:absolute;bottom:5px;right:10px">
						<a href="<?php echo base_url().'admin/surat_pindah'?>" class="text-white-50" style="text-decoration:none;">Selengkapnya <i class="fa fa-angle-right" aria-hidden="true"></i></a>
					</div>
				
				</div>
			</div>
		</div>

		<div class="col-lg-4 mb-4">
			<div class="card bg-primary text-white shadow">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col-auto">
						<i class="fa fa-envelope-open fa-2x text-gray-300" aria-hidden="true"></i>
						<!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
					</div>
					<div class="col mr-3" style="margin-left:20px">
						<?php echo $this->m_dah->tot_surat('surat_datang',1)->num_rows(); ?> Surat Datang
						<div class="text-white-50">Jumlah Surat Datang</div>
						</div>
					</div>
					<div style="position:absolute;bottom:5px;right:10px">
						<a href="<?php echo base_url().'admin/surat_datang'?>" class="text-white-50" style="text-decoration:none;">Selengkapnya <i class="fa fa-angle-right" aria-hidden="true"></i></a>
					</div>
				
				</div>
			</div>
		</div>



		<!-- end jumlah penduduk -->

		<!-- end jumlah surat -->

		  </div>
		<?php } ?>	
		<!-- end card info untuk admin -->

	<!-- Content Row -->
	<div class="row">

	  <!-- Pending Requests Card Example -->
	  <div class="col-xl-12 col-md-12 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
		  <div class="card-body">
			<div class="row no-gutters align-items-center">
			  <div class="col mr-2">

				
				<div class="h5 mb-0 font-weight ">
					<?php echo $this->m_dah->get_option('blog_welcome')?>
				</div>
			  </div>
			 
			</div>
		  </div>
		</div>
	  </div>
	</div>

	<!-- Content Row -->


	<!-- Content Row -->
	

  </div>
  <!-- /.container-fluid -->
