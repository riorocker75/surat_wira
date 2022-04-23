<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Arsip Surat</h1>
  <a href="<?php echo base_url()?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i></i> Kembali</a>
  
</div>

<a href="" onclick="return confirm('Anda yakin mau menghapus item ini ?')"></a>

		<!-- Content Row -->
		<div class="row">
         
  <!-- arsip surat lain -->
  <div class="col-lg-12 mb-4">
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Arsip Surat</h6>
          </div>
               
                  <div class="card-body">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
      
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#lain-diterima" role="tab" aria-controls="profile" aria-selected="false">
                             Selesai <span class="labil labil-success count"><?php echo $surat_lain_total_terima;?></span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#lain-ditolak" role="tab" aria-controls="contact" aria-selected="false">
                            Di Tolak <span class="labil labil-danger count"><?php echo $surat_lain_total_tolak;?></span>
                          </a>
                        </li>
                    </ul>
                     <div class="tab-content" id="myTabContent">
                     <!-- mulai bagian diterima lain tabel  -->
                     <div class="tab-pane fade show active" id="lain-diterima" role="tabpanel" aria-labelledby="contact-tab">
                          <div class="table-responsive">
                              <table class="table table-bordered" id="lain-review-tabel" width="100%" cellspacing="0">
                              <thead>
                                  <tr>
                                  <th width="2%">No</th>
                                  <th>Pengaju Surat</th>
                                  <th>Nomor Ajuan</th>
                                  <th>Jenis Surat</th>
                                  <th>Status</th>

                                  <th width="13%">Opsi</th>
                                  
                                  </tr>
                              </thead> 
                              <tbody>
                                 <?php $n=1; foreach ($surat_lain_terima as $sl ) {?>
                               
                                     <?php 
                                          $id_lain=array('id' => $sl->surat_id);
                                          $ops=$this->m_dah->edit_data($id_lain,'jenis_surat')->result();
                                          foreach ($ops as $op) { }
                                     ?>
                                     <tr>
                                     <td><?php echo $n++;?></td>
                                    <td>
                                        <?php
                                            $xl=array(
                                                'id' => $sl->penduduk_id
                                            );
                                           $pendudukx= $this->m_dah->edit_data($xl,'penduduk')->result();
                                           foreach($pendudukx as $psl){ 
                                        ?>
                                        <span style="line-height:1"> 
                                           <?php echo $psl->nama ?>     
                                        </span>
                                        <p style="font-size:14px;font-weight:700;top:-20px!important;line-height:1">
                                          NIK: <?php echo $psl->nik ?>     
                                        </p>
                                
                                           <?php }?>
                                    </td>
                                      <td><?php echo $sl->nomor_surat?>
                                        <p style="font-size: 11px;opacity: 0.8">
                                          <?php echo date('d.m.Y',strtotime($sl->tgl_surat))?>
                                        </p>
                                      </td>
                                      <td><?php echo $op->nama_surat?></td>
                                      <td>
                                         <?php echo $this->m_dah->status_surat_lain($sl->status_surat)?>
                                      </td>

                                      <td>
                                       <a href="<?php echo base_url().'cetak/cetak_surat_lain/'.$sl->surat_mohon_id ?>"><i class='fa fa-print'></i></a>
                                        &nbsp;&nbsp;
                                         <a href="<?php echo base_url().'user/lihat_surat_lain/'.$sl->surat_mohon_id?>"> <i class="fa fa-eye"></i> </a>
                                          &nbsp;&nbsp;
                                          <a href="<?php echo base_url().'admin/delete_surat_lain/'.$sl->surat_mohon_id?>" 
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
                        <!-- end bagian tabel diterima -->

                         <!-- mulai bagian ditolak lain tabel  -->
                         <div class="tab-pane fade" id="lain-ditolak" role="tabpanel" aria-labelledby="contact-tab">
                             <div class="table-responsive">
                                <table class="table table-bordered" id="lain-ditolak-tabel" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                  <th width="2%">No</th>
                                  <th>Pengaju Surat</th>
                                  <th>Nomor Ajuan</th>
                                  <th>Jenis Surat</th>
                                  <th>Status</th>

                                  <th width="13%">Opsi</th>
                                  
                                  </tr>
                                </thead> 
                                <tbody>
                                 <?php $n=1; foreach ($surat_lain_tolak as $slt ) {?>
                                     <?php 
                                          $id_lain_tolak=array('id' => $slt->surat_id);
                                          $ops_tolak=$this->m_dah->edit_data($id_lain_tolak,'jenis_surat')->result();
                                          foreach ($ops_tolak as $opt) { }
                                     ?>
                                     <tr>
                                     <td><?php echo $n++;?></td>
                                   <td>
                                        <?php
                                            $xls=array(
                                                'id' => $slt->penduduk_id
                                            );
                                           $penduduks= $this->m_dah->edit_data($xls,'penduduk')->result();
                                           foreach($penduduks as $psld){ 
                                        ?>
                                        <span style="line-height:1"> 
                                           <?php echo $psld->nama ?>     
                                        </span>
                                        <p style="font-size:14px;font-weight:700;top:-20px!important;line-height:1">
                                          NIK: <?php echo $psld->nik ?>     
                                        </p>
                                
                                           <?php }?>
                                    </td>
                                      <td><?php echo $slt->surat_mohon_id?>
                                        <p style="font-size: 11px;opacity: 0.8">
                                          <?php echo date('d.m.Y',strtotime($slt->tgl_ajukan))?>
                                        </p>
                                      </td>
                                      <td><?php echo $opt->nama_surat?></td>
                                      <td>
                                         <?php echo $this->m_dah->status_surat_lain($slt->status_surat)?>
                                      </td>

                                      <td>
                                      <a href="<?php echo base_url().'user/lihat_surat_lain/'.$slt->surat_mohon_id?>"> <i class="fa fa-eye"></i> </a>
                                       &nbsp;&nbsp;
                                      <a href="<?php echo base_url().'admin/delete_surat_lain/'.$slt->surat_mohon_id?>" 
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
                          <!-- end bagian tabel ditolak -->
                        
                      </div> 
                      </div>  





                   </div> 

             </div>
  <!-- end arsip surat lain -->
<!-- end row -->
		</div>

</div>
