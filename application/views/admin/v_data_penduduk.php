<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>



  </div>


  
  <!-- Content Row -->

  <div class="row" style="margin-top:-20px">
    <div class="col-lg-4 mb-3 offset-lg-4" >
      <div class="card bg-primary text-white shadow">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <i class="fa fa-users fa-2x text-gray-300"></i>
              <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
            </div>
            <?php

            ?>
            <div class="col mr-3" style="margin-left:20px">
              Total Penduduk
              <div class="text-white-50"><?php echo $this->m_dah->get_data('penduduk')->num_rows() ?> Orang</div>
              <span style="font-size: 12px">Laki-laki: <?php echo $this->m_dah->penduduk_dif_total('pria')->num_rows() ?></span>
              <span>|</span>
              <span style="font-size: 12px">Perempuan: <?php echo $this->m_dah->penduduk_dif_total('wanita')->num_rows() ?></span>
              <p style="font-size: 12px">Total KK:&nbsp;<?php echo $this->m_dah->kk_total('kepala')->num_rows(); ?></p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- end total penduduk -->
   




    <div class="col-lg-12 mb-4">
    <?php show_alert() ?>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary" style="line-height: 1.5">Data Penduduk </h6>


        </div>

        <div class="card-body">
          <div class="float-right">
            <?php if ($this->session->userdata('level') == "admin") { ?>
              <a href="<?php echo base_url().'admin/penduduk_add' ?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-user-plus" aria-hidden="true"></i> Tambah Data</a>
            <?php } else {
            } ?>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="2%">No</th>
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>Kontak</th>
                  <th>Alamat</th>

                  <th width="12%" style="text-align: center;">Opsi</th>

                </tr>
              </thead>
              <tbody>
                <?php $n = 1;
                foreach ($penduduk as $pd) { ?>
                  <tr>
                    <td><?php echo $n++; ?></td>
                    <td>
                      <?php echo ucfirst($pd->nama) ?>
                     

                    </td>

                    <td><?php echo $pd->nik ?></td>
                    <td><?php echo $pd->no_hp ?></td>
                    <td><?php echo $pd->alamat ?></td>




                    <td style="text-align: center;">
                      <a title="Lihat data" href="<?php echo base_url() . 'admin/penduduk_view/' . $pd->id ?>"><i class="fa fa-eye" aria-hidden="true"></i> </a>
                      <?php if ($this->session->userdata('level') == "admin") { ?>
                        <a href="<?php echo base_url() . 'admin/penduduk_edit/' . $pd->id ?>"> <i class="fas fa-pen-alt    "></i></a>
                        <a href="<?php echo base_url() . 'admin/penduduk_delete/' . $pd->id ?>" onclick="return confirm('Apa Anda Yakin Hapus Data Ini?')"> <i class="fas fa-trash-alt    "></i></a>
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