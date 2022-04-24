<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Detail Surat Keterangan Tidak Silang Sengketa</h1>
  <a href="<?php echo base_url().'admin/surat_sengketa'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
</div>

		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Surat Keterangan Tidak Silang Sengketa</h6>
                    </div>
                    <div class="card-body">
                        <?php foreach($data as $dt){?>
                    <!-- <form action="<?php echo base_url().'admin/surat_sengketa_update'?>" method="post" enctype='multipart/form-data'> -->
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table">
                                <tr>
                                    <td>Jenis Surat</td>
                                    <td><?php echo $dt->jenis_surat?></td>
                                </tr>

                                 <tr>
                                    <td>Nomor Surat</td>
                                    <td><?php echo $dt->no_surat?></td>
                                </tr>
                                 <tr>
                                    <td>Pemohon</td>
                                    <td><?php echo $dt->pemohon?></td>
                                </tr>
                                <tr>
                                    <td>Keperluan</td>
                                    <td>
                                        <?php echo $dt->keperluan?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Tanggal</td>
                                    <td>

                                        <?php echo date('Y-m-d',strtotime($dt->tanggal))?>
                                    </td>

                                </tr>

                                 <tr>
                                    <td>Alamat</td>
                                    <td>
                                        <?php echo $dt->alamat?>
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
                                <!-- <button class="btn btn-primary float-right" type="submit"><i class="fas fa-save"></i> Simpan Data</button>        
                        
                        </form> -->
                        <?php } ?>
                    </div>
                </div>
		    </div>
		</div>
</div>
