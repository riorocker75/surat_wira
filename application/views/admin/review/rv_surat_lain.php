<div class="container-fluid">


      <?php foreach($surat as $sr){?>  
     <?php 
            $wu= array('id' => $sr->surat_id);
            $ops =$this->m_dah->edit_data($wu,'jenis_surat')->result();
            foreach ($ops as $op) { } 
        ?>


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Review Pemohon <?php echo $op->nama_surat ?></h1>
  <a href="<?php echo base_url().'user/arsip_surat/'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i></i> Kembali</a>
  
</div>

		<!-- Content Row -->
         <form action="<?php echo base_url().'admin/update_surat_lain_act'?>" method="post">
		<div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <form action="" method="post">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pengaju</h6>
                        
                    </div>
                    <div class="card-body">
                         <div class="row">

                                <!-- format surat start  -->
                            <div class="col-lg-12 col-md-12 col-12">

                                <div class="form-group">
                                    <label for="">Format Print Surat <span style="color:red;font-size: 10px">* Wajib isi format </span></label>
                                  <textarea id="editor1" name="format" class="form-control" style="min-height:500px" ><?php echo $op->format_surat?></textarea>
                                   
                                </div>
                            </div>    
                              <!-- end format surat -->
                                <!-- data diri -->
                                <div class="col-lg-6 col-md-12 col-12">
                                    <div class="syarat">
                                        <div class="title-syarat">
                                            Data Diri
                                        </div> 

                                           <?php 
                                           $where_user=array('id' => $sr->penduduk_id);
                                            $data_diri=$this->m_dah->edit_data($where_user, 'penduduk')->result();
                                            foreach($data_diri as $dd ){
                                            ?>
                                                <div class="form-group">
                                                    <label for="">Nama</label>
                                                    <input type="text" class="form-control form-control-user" value="<?php echo $dd->nama?>" disabled>
                                                   
                                                </div>

                                                <div class="form-group">
                                                    <label for="">NIK</label>
                                                    <input type="text" class="form-control form-control-user" value="<?php echo $dd->nik?>" disabled>
                                                   
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Tempat & tanggal lahir</label>
                                                    <input type="text" class="form-control form-control-user" value="<?php echo $dd->tempat_lahir?> / <?php $tgl=date('d-m-Y', strtotime($dd->tgl_lahir)); echo $tgl?>" disabled>
                                                   
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Jenis Kelamin</label>
                                                    <input type="text" class="form-control form-control-user" value="<?php echo $this->m_dah->jenis_kelamin($dd->jenis_kelamin) ?>" disabled>
                                                   
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Agama</label>
                                                    <input type="text" class="form-control form-control-user" value="<?php echo $dd->agama?>" disabled>
                                                   
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Pekerjaan</label>
                                                    <input type="text" class="form-control form-control-user" value="<?php echo $dd->pekerjaan?>" disabled>
                                                   
                                                </div>

                                                
                                            <?php }?>   

                                    </div>  

                                 </div>  
                                <!-- end data diri -->

                                  <!-- persyaratan -->
                                <div class="col-lg-6 col-md-12 col-12">
                                <div class="syarat">
                                            <div class="title-syarat">
                                                File Persyaratan 
                                            </div> 
                                               
                                            <label>
                                                    <?php echo $op->syarat_surat?>
                                            </label>
                                            <div class="form-group">
                                              
                                                <?php echo $this->m_dah->preview_file($sr->upload)?>   
                                            </div>

                                    </div>

                                 <input type="hidden" name="surat_id" value="<?php echo $sr->surat_mohon_id?>">  
                                
                                 <div class="syarat">
                                        <div class="title-syarat">
                                                Keterangan
                                            </div> 
                                            <?php 
                                            $datx=$this->m_dah->last_record_surat('surat_mohon','diterima')->result();
                                            foreach($datx as $xr){}
                                            ?>
                                            <div class="form-group">
                                                <label for="">Nomor Surat </label>
                                                <input type="number" class="form-control form-control-user" name="no_surat"
                                                value="<?php echo $this->m_dah->auto_nomor_surat($xr->nomor_surat)?>" required>
                                                <!-- end input nomor surat -->
                                                <?php echo form_error('no_surat', '<div class="form-error">', '</div>'); ?>

                                            </div>  
                                                <div class="form-group">
                                                    <label for="">Pemberitahuan </label>
                                                    <textarea class="form-control" name="ket_surat" placeholder="di isi apabila menolak atau ada pemberitahuan lanjut ke bersangkutan" rows="3" required=""></textarea>
                                                </div>  
                                                <?php echo form_error('ket_surat', '<div class="form-error">', '</div>'); ?>

                                    </div>  


                                    <div class="float-right">
                                        <input class="btn btn-danger" type="submit" name="tolak" value="Tolak">
                                        <input class="btn btn-success" type="submit" name="setuju" value="Setujui">
                                        <!-- <button type="submit" class="btn btn-success"> Setujui</button> -->
                                    </div>    
                                </div> 

                                <!-- end syarat -->

                         </div>  
                      

                     
                </div>
                
		    </div>
		</div>
                </form>
<?php }?>
</div>
