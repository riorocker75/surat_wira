<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Tambah Data Penduduk</h1>
  <a href="<?php echo base_url().'admin/penduduk'?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
</div>

		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Penduduk</h6>
                    </div>
                    <div class="card-body">
                    <form action="<?php echo base_url().'admin/penduduk_act'?>" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control form-control-user check-nik" name="nik" minlength="16" maxlength="16">
                                     <?php echo form_error('nik', '<div class="form-error">', '</div>'); ?>
                                    <span class="check-nik-output"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">No. Kartu Keluarga</label>
                                    <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control form-control-user" name="no_kk"  maxlength="16"  minlength="16" >
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-user" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tempat Lahir</label>
                                    <input type="text" class="form-control form-control-user" name="tmpt_lhr">
                                </div>

                                <div class="form-group">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="date" class="form-control form-control-user" name="tgl_lhr" value="<?php echo date("Y-m-d");?>">
                                </div>

                                <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    <select class="form-control form-control-user" name="jk">
                                    <option value="">--Pilih Jenis Kelamin--</option>
                                    <option value="pria">Laki-laki</option>
                                    <option value="wanita">Perempuan</option>
                                
                                    </select>
                                </div>

                                <div class="form-group">
                                        <label for="">Agama</label>
                                        <select class="form-control form-control-user" name="agama">
                                    <option value="">--Pilih Agama--</option>
                                    <?php foreach ($agama as $ag) {?>
                                        <option value="<?php echo $ag->agama?>"><?php echo $ag->agama?></option>
                                    <?php }?>
                                        </select>
                                </div> 
                                <div class="form-group">
                                    <label for="">Kewarganegaraan</label>
                                    <select class="form-control form-control-user" name="warga_negara">
                                    <option value="">--Pilih Kewarganegaraan--</option> 
                                    <option value="wni">Warga Negara Indonesia (WNI)</option>
                                    <option value="wna">Warga Negara Asing (WNA)</option>
                                
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Nama Ayah</label>
                                    <input type="text" class="form-control form-control-user" name="nama_ayah">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Ibu</label>
                                    <input type="text" class="form-control form-control-user" name="nama_ibu">
                                </div>

                                <div class="form-group">
                                    <label for="">Golongan Darah</label>
                                    <select class="form-control form-control-user" name="gol_darah">
                                       <option value="">--Pilih Golongan Darah--</option>
                                        <option value="a">Golongan Darah (A)</option>
                                        <option value="b">Golongan Darah (B)</option>
                                        <option value="ab">Golongan Darah (AB)</option>
                                        <option value="o">Golongan Darah (O)</option>
                                    </select>
                                </div>
                            
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Nomor Hp/Telp</label>
                                    <input type="text" class="form-control form-control-user" name="no_hp" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="15">
                                </div>

                                <div class="form-group">
                                    <label for="">Pendidikan Terakhir</label>
                                    <select class="form-control form-control-user" name="pendidikan">
                                       <option value="">--Pilih Pendidikan--</option>
                                   
                                    <?php foreach($pendidikan as $pd){?> 
                                        <option value="<?php echo $pd->pendidikan?>"><?php echo $pd->pendidikan?></option>
                                    <?php }?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Pekerjaan</label>
                                    <select class="form-control form-control-user" name="pekerjaan">
                                       <option value="">--Pilih Pekerjaan--</option>
                                   
                                    <?php foreach($pekerjaan as $pk){?> 
                                        <option value="<?php echo $pk->pekerjaan?>"><?php echo $pk->pekerjaan?></option>
                                    <?php }?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Status Perkawinan</label>
                                    <select class="form-control form-control-user" name="status_nikah">
                                       <option value="">--Pilih Status Kawin--</option>
                                       
                                        <option value="belum_menikah">Belum Kawin</option>
                                        <option value="menikah">Kawin</option>
                                        <option value="cerai_hidup">Cerai Hidup</option>
                                        <option value="cerai_mati">Cerai Mati</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Status Dalam Keluarga</label>
                                     <select class="form-control form-control-user" name="status_hub_keluarga" required>
                                       <option value="">--Pilih Status Keluarga--</option>
                                        
                                        <option value="kepala">Kepala Keluarga</option>
                                        <option value="istri">Istri</option>
                                        <option value="anak">Anak</option>
                                        <option value="menantu">Menantu</option>
                                        <option value="cucu">Cucu</option>
                                        <option value="orangtua">Orang Tua</option>
                                        <option value="mertua">Mertua</option>
                                        <option value="famili">Famili Lain</option>
                                        <option value="pembantu">Pembantu</option>
                                        <option value="lain">Lainya</option>
                                    </select>
                                </div>
                               
                                 <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea class="form-control form-control-user" name="alamat"></textarea>
                                 </div> 
                                   
                            </div>
                           <!-- end row form -->
                        </div>
                                <button class="btn btn-primary float-right" type="submit"><i class="fas fa-save"></i> Simpan Data</button>        
                        
                        </form>
                    </div>
                </div>
		    </div>
		</div>
</div>
