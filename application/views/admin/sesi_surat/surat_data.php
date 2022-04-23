<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">List Pengajuan Surat</h1>
  <a href="<?php echo base_url()?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i></i> Kembali</a>
  
</div>
<?php show_alert()?>
		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Pilihan Surat</h6>
                    </div>
                    <div class="card-body list_surat">
                    <ul style="list-style:none;margin:0;padding-left:0">
                    
                        <?php $no=1;foreach($surat as $sr){?>
                            <li>
                            <a href="<?php echo base_url().'user/mohon_surat/'.$sr->id ?>" class="btn btn-default"><i class="fa fa-plus"></i>
                                <?php echo $no++?>.&nbsp;&nbsp;
                                <?php echo $sr->nama_surat ?>
                            </a>
                        </li>
                        <?php }?>   

                    </ul>

                    
                    </div>
                </div>
		    </div>



		</div>
</div>
