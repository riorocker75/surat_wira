<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Tambah Surat</h1>
  <a href="<?php echo base_url()?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i></i> Kembali</a>
  
</div>

<a href="" onclick="return confirm('Anda yakin mau menghapus item ini ?')"></a>

		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data List Surat</h6>
                       
                    </div>
                    <div class="card-body">
                    <?php show_alert(); ?>
                       <div class="float-right">
                          <a href="<?php echo base_url().'admin/tambah_surat'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">Tambah Surat</a>
                        </div>
                    <div class="table-responsive">

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th width="2%">No</th>
                                <th>Kode Surat</th>
                                <th>Nama Surat</th>
                              

                                <th width="15%">Opsi</th>
                                
                                </tr>
                            </thead> 
                            <tbody>
                               <?php $n=1; foreach($surat as $ds){?>

                                   <tr>
                                  <td><?php echo $n++;?></td>
                                  <td><?php echo $ds->kode_surat ?> </td>
                                  <td> <?php echo $ds->nama_surat ?> </td>
                                  <td>
                                    <a href="<?php echo base_url().'admin/tambah_surat_edit/'.$ds->id?>" >
                                     <i class="fa fa-pen"></i>
                                    </a>
                                    &nbsp;
                                    
                                      <a onclick="return confirm('Apakah Data ingin dihapus?')" href="<?php echo base_url().'admin/tambah_surat_hapus/'.$ds->id?>" >
                                     <i class="fa fa-trash"></i>
                                    </a>
                                   </td>



                                
                                   </tr>

                              <?php }?> 
                            </tbody> 
                            </table>
                        </div>
                    </div>
                </div>
		    </div>
<!-- end pengajuan surat -->

 <!-- end arsip surat -->

<!-- end row -->
		</div>

</div>
