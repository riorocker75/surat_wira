<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Umum</h1>
  <?php if($this->session->userdata('level') == "admin"){?>
  <a href="<?php echo base_url().'admin/umum_edit'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"> <i class="fas fa-pen-alt"></i> Ubah Data Umum</a>
  <?php }else{} ?>
</div>
    <?php show_alert()?>
		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary" style="line-height:1.5!important">Data Umum Desa Ulee Ceubrek Kecamatan Meurah Mulia Kabupaten Aceh Utara</h6>
                    </div>
                    <div class="card-body">
                    <?php echo $this->m_dah->get_option('umum'); ?>
                    <table border="0" cellpadding="6" cellspacing="4" style="margin-top:-30px">
                        <tbody>
                        <tr>
                            <td>Jumlah Penduduk       </td>
                            <td><?php echo $this->m_dah->get_data('penduduk')->num_rows();?> </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Laki Laki : 
                            <?php
                                $pria=array(
                                 'jenis_kelamin' => "pria"   
                                );
                              echo $this->m_dah->edit_data($pria,'penduduk')->num_rows();
                             ?></td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td>Perempuan :
                            <?php
                                $wanita=array(
                                 'jenis_kelamin' => "wanita"   
                                );
                              echo $this->m_dah->edit_data($wanita,'penduduk')->num_rows();
                             ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah KK</td>
                            <td><?php  echo $this->m_dah->kk_total('kepala')->num_rows()?></td>
                        </tr>
                        
                        </tbody>
                    </table>
                    </div>
                </div>
		    </div>
		</div>
</div>
