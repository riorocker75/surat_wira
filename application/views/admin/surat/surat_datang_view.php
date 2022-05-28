<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Tambah Data Surat Datang/Menetap</h1>
  <a href="<?php echo base_url().'admin/surat_datang'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
</div>

		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Surat Datang</h6>
                    </div>
                    <div class="card-body">
                        <?php foreach($data as $dt){?>
                    <!-- <form action="<?php echo base_url().'admin/surat_datang_act'?>" method="post" enctype='multipart/form-data'> -->
                        <div class="row">
                            <div class="col-lg-12">
                                

                              <table class="table">

                                 <tr>
                                    <td>Nomor Surat Pindah (Asal)</td>
                                    <td><?php echo $dt->no_surat_pindah?></td>
                                </tr>

                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>
                                        <?php echo date('Y-m-d',strtotime($dt->tanggal))?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Kepala Keluarga</td>
                                    <td><?php echo $dt->nama_kepala?></td>
                                </tr>

                                 <tr>
                                    <td>Anggota Keluarga yang datang</td>
                                    <td><?php echo $dt->nama_datang?></td>
                                </tr>

                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td><?php echo $this->m_dah->jenis_kelamin($dt->jenis_kelamin)?></td>
                                </tr>

                                <tr>
                                    <td>Tempat, Tanggal Lahir</td>
                                    <td><?php echo $dt->tmp_tgl_lhr?></td>
                                </tr>

                                <tr>
                                    <td>Nomor Induk Kependudukan</td>
                                    <td><?php echo $dt->nik?></td>
                                </tr>

                                 <tr>
                                    <td>Daerah Asal</td>
                                    <td><?php echo $dt->daerah_asal?></td>
                                </tr>

                                <tr>
                                    <td>Kecamatan</td>
                                    <td><?php echo $dt->kecamatan?></td>
                                </tr>

                                 <tr>
                                    <td>Kabupaten</td>
                                    <td><?php echo $dt->kabupaten?></td>
                                </tr>

                                 <tr>
                                    <td>Provinsi</td>
                                    <td><?php echo $dt->provinsi?></td>
                                </tr>

                                <tr>
                                    <td>Alamat Sekarang</td>
                                    <td><?php echo $dt->alamat?></td>
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
                                <!-- <button class="btn btn-primary float-right" type="submit"><i class="fas fa-save"></i> Simpan Data</button>         -->
                        
                        <!-- </form> -->
                        <?php } ?>
                    </div>
                </div>
		    </div>
		</div>
</div>
