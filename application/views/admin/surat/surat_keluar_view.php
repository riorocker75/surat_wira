<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <a href="<?php echo base_url().'admin/surat_keluar'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
</div>

		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Surat Keluar</h6>
                    </div>
                    <div class="card-body">
                        <?php foreach($data as $dt){?>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table">
                                <tr>
                                    <td>Pengirim</td>
                                    <td><?php echo $dt->pengirim?></td>
                                </tr>

                                 <tr>
                                    <td>Nomor Surat</td>
                                    <td><?php echo $dt->no_surat?></td>
                                </tr>
                                 <tr>
                                    <td>Isi Ringkas</td>
                                    <td><?php echo $dt->deskripsi?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>
                                        <?php echo date('Y-m-d',strtotime($dt->tgl_surat))?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Tanggal Keluar</td>
                                    <td>

                                        <?php echo date('Y-m-d',strtotime($dt->tgl_keluar))?>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <?php $this->m_dah->preview_file($dt->lampiran)?>

                                    </td>
                                </tr>


                            </table>
                              
                            </div>
                           <!-- end row form -->
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>
		    </div>
		</div>
</div>
