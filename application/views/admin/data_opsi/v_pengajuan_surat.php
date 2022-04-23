<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pengajuan Surat</h1>
  <a href="<?php echo base_url()?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i></i> Kembali</a>
  
</div>

<a href="" onclick="return confirm('Anda yakin mau menghapus item ini ?')"></a>

		<!-- Content Row -->
		<div class="row">

   <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pengaju Surat</h6>
                    </div>
               
                  <div class="card-body">
                     <!-- mulai bagian review tabel  -->
                        <div class="table-responsive">
                            <table class="table table-bordered" id="lain-review-tabel" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th width="2%">No</th>
                                <th width="20%">Pengaju Surat</th>
                                <th width="12%">Nomor Ajuan</th>
                                <th>Jenis Surat</th>
                                <th width="8%">Status</th>

                                <th width="10%">Opsi</th>
                                
                                </tr>
                            </thead> 
                            <tbody>
                               <?php $n=1; foreach ($surat_lain as $sl ) {?>
                                   <?php 
                                        $id_lain=array('id' => $sl->surat_id);
                                        $ops=$this->m_dah->edit_data($id_lain,'jenis_surat')->result();
                                        foreach ($ops as $op) { }
                                   ?>
                                   <tr>
                                   <td><?php echo $n++;?></td>
                                   <td>
                                      <?php
                                            $pxl=array(
                                                'id' => $sl->penduduk_id
                                            );
                                           $penduduks= $this->m_dah->edit_data($pxl,'penduduk')->result();
                                           foreach($penduduks as $pdl){ 
                                        ?>
                                        <span style="line-height:1"> 
                                           <?php echo $pdl->nama ?>     
                                        </span>
                                        <p style="font-size:14px;font-weight:700;top:-20px!important;line-height:1">
                                          NIK: <?php echo $pdl->nik ?>     
                                        </p>
                                
                                           <?php }?>

                                   </td>
                                    <td><?php echo $sl->surat_mohon_id?>
                                       <p style="font-size: 11px;opacity: 0.8">
                                          <?php echo date('d.m.Y',strtotime($sl->tgl_ajukan))?>
                                        </p>
                                    </td>
                                    <td><?php echo $op->nama_surat?></td>
                                    <td>
                                       <?php echo $this->m_dah->status_surat_lain($sl->status_surat)?>
                                    </td>

                                 
                                   
                                    <td>
                                    <a href="<?php echo base_url().'admin/update_surat_lain/'.$sl->surat_mohon_id ?>"> <i class="fa fa-eye"></i> </a>
                                     &nbsp;&nbsp;
                                    <a href="<?php echo base_url().'admin/delete_surat_lain/'.$sl->surat_mohon_id ?>" 
                                      onclick="return confirm('Anda yakin mau menghapus item ini ?')"> 
                                      <i class="fa fa-trash"></i>
                                     </a>

                                   
                                    </td>

                                   </tr>

                              <?php }?> 
                            </tbody> 
                            </table>
                        </div>
                        </div>

                        <!-- end bagian tabel review -->
                   </div> 

             </div>


<!-- end row -->
		</div>

</div>
