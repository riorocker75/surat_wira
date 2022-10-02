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
          <h6 class="m-0 font-weight-bold text-primary" style="line-height: 1.5">Data Surat Keluar </h6>


        </div>

        <div class="card-body">
          <div class="row">
              <div class="col-lg-4 col-md-6 col-12">
                    <form action="<?php echo base_url().'admin/surat_keluar_cetak_filter'?>" method="post">
                        <div class="form-group">
                                <label for="">Dari Tanggal</label>
                                <input type="date" class="form-control form-control-user" name="dari" value="<?php echo date('Y-m-d')?>" required>
                        </div>
                        <div class="form-group">
                                <label for="">Sampai Tanggal</label>
                                <input type="date" class="form-control form-control-user" name="sampai" value="<?php echo date('Y-m-d')?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                      </form>
                </div>
            </div>

          <div class="float-right">
            <?php if ($this->session->userdata('level') == "admin") { ?>
              <a href="<?php echo base_url().'admin/surat_keluar_add' ?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-user-plus" aria-hidden="true"></i> Tambah Surat keluar</a>

            <?php } else {
            } ?>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="2%">No</th>
                  <th>Tujuan</th>
                  <th>Nomor Surat</th>
                  <th>Tanggal Surat</th>
                  <th>Tanggal Keluar</th>
                  <th>Lampiran</th>

                  <th width="12%" style="text-align: center;">Aksi</th>

                </tr>
              </thead>
              <tbody>
                <?php $n = 1;
                foreach ($data as $dt) { ?>
                  <tr>
                    <td><?php echo $n++; ?></td>
                    <td>
                      <?php echo $dt->pengirim ?>
                    </td>

                    <td><?php echo $dt->no_surat ?></td>
                    <td><?php echo date('Y-m-d',strtotime($dt->tanggal)) ?></td>
                    <td><?php echo date('Y-m-d',strtotime($dt->tgl_keluar)) ?></td>
                    <td><?php echo $this->m_dah->preview_file($dt->lampiran) ?></td>

                    <td style="text-align: center;">
                      <a title="Lihat data" href="<?php echo base_url() . 'admin/surat_keluar_view/' . $dt->id ?>"><i class="fa fa-eye" aria-hidden="true"></i> </a>
                      <?php if ($this->session->userdata('level') == "admin") { ?>
                        <a href="<?php echo base_url() . 'admin/surat_keluar_edit/' . $dt->id ?>"> <i class="fas fa-pen-alt    "></i></a>
                        <a href="<?php echo base_url() . 'admin/surat_keluar_delete/' . $dt->id ?>" onclick="return confirm('Apa Anda Yakin Hapus Data Ini?')"> <i class="fas fa-trash-alt    "></i></a>
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