<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>



  </div>


  
  <!-- Content Row -->

  

  <div class="row">
    <!-- end total penduduk -->
   




    <div class="col-lg-12 mb-4">
    <?php show_alert() ?>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary" style="line-height: 1.5">Data Surat Keterangan Tidak Silang Sengketa</h6>


        </div>

        <div class="card-body">
          <div class="float-right">
            <?php if ($this->session->userdata('level') == "admin") { ?>
              <a href="<?php echo base_url().'admin/surat_sengketa_add' ?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-envelope" aria-hidden="true"></i> Tambah surat</a>
              <a href="<?php echo base_url().'admin/surat_sengketa_cetak' ?>" class="d-sm-inline-block btn btn-sm btn-default shadow-sm"><i class="fa fa-print" aria-hidden="true"></i> Print</a>

            <?php } else {
            } ?>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="2%">No</th>
                  <th>Tanggal Surat</th>
                  <th>Nomor Surat</th>
                  <th>Jenis Surat</th>
                  <th>Pemohon</th>
                  <th>Lampiran</th>

                  <th width="12%" style="text-align: center;">Aksi</th>

                </tr>
              </thead>
              <tbody>
                <?php $n = 1;
                foreach ($data as $dt) { ?>
                  <tr>
                    <td><?php echo $n++; ?></td>
                    <td><?php echo date('Y-m-d',strtotime($dt->tanggal)) ?></td>
                    <td><?php echo $dt->no_surat ?></td>
                    <td>
                      <?php echo $dt->jenis_surat ?>
                    </td>
                    <td><?php echo $dt->pemohon ?></td>

                    <td><?php echo $this->m_dah->preview_file($dt->lampiran) ?></td>

                    <td style="text-align: center;">
                      <a title="Lihat data" href="<?php echo base_url() . 'admin/surat_sengketa_view/'.$dt->id ?>"><i class="fa fa-eye" aria-hidden="true"></i> </a>
                      <?php if ($this->session->userdata('level') == "admin") { ?>
                        <a href="<?php echo base_url() . 'admin/surat_sengketa_edit/'.$dt->id ?>"> <i class="fas fa-pen-alt    "></i></a>
                        <a href="<?php echo base_url() . 'admin/surat_sengketa_delete/' . $dt->id ?>" onclick="return confirm('Apa Anda Yakin Hapus Data Ini?')"> <i class="fas fa-trash-alt    "></i></a>
                      <?php } else {
                      } ?>
                    </td>

                  </tr>

                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>