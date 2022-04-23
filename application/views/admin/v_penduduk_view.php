<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lihat Data Penduduk</h1>
        <a href="<?php echo base_url() . 'admin/penduduk' ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <?php foreach ($penduduk as $pd) { ?>

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Penduduk</h6>
                        <?php if ($this->session->userdata('level') == "admin") { ?>
                            <a href="<?php echo base_url() . 'admin/penduduk_edit/' . $pd->id ?>" class="btn btn-sm btn-danger shadow-sm float-right">Ubah Data</a>
                        <?php } else {
                        } ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input type="hidden" class="form-control form-control-user" value="<?php echo $pd->id ?>">

                                    <input type="text" class="form-control form-control-user" value="<?php echo $pd->nik ?>" disabled>
                                    <?php echo form_error('nik', '<div class="form-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="">No. Kartu Keluarga</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $pd->nomor_kk ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $pd->nama ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Tempat Lahir</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $pd->tempat_lahir ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="date" class="form-control form-control-user" value="<?php echo $pd->tgl_lahir ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    <select class="form-control form-control-user" disabled>
                                        <option value="pria" <?php if ($pd->jenis_kelamin == "pria") {
                                                                    echo "selected";
                                                                } ?>>Laki-laki</option>
                                        <option value="wanita" <?php if ($pd->jenis_kelamin == "wanita") {
                                                                    echo "selected";
                                                                } ?>>Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Agama</label>
                                    <select class="form-control form-control-user" disabled>
                                        <option value="<?php echo $pd->agama ?>" <?php if ($pd->agama == $pd->agama) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $pd->agama ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Kewarganegaraan</label>
                                    <select class="form-control form-control-user" disabled>
                                        <option value=""> <?php echo $this->m_dah->cek_wn($pd->status_warga_negara) ?></option>


                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Nama Ayah</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $pd->nama_ayah ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Ibu</label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo $pd->nama_ibu ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Golongan Darah</label>
                                    <select class="form-control form-control-user" disabled>
                                        <option value=""> <?php echo $this->m_dah->status_darah($pd->gol_darah) ?></option>

                                    </select>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Nomor Hp/Telp</label>
                                    <input type="text" class="form-control form-control-user" name="no_hp" value="<?php echo $pd->no_hp ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Pendidikan Terakhir</label>
                                    <select class="form-control form-control-user" name="pendidikan" disabled>
                                        <option value="<?php echo $pd->pendidikan ?>"><?php echo $pd->pendidikan ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Pekerjaan</label>
                                    <select class="form-control form-control-user" name="pekerjaan" disabled>
                                        <option value="<?php echo $pk->pekerjaan ?>"><?php echo $pd->pekerjaan ?></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Status Perkawinan</label>
                                    <select class="form-control form-control-user" name="status_nikah" disabled>
                                        <option value="<?php echo $this->m_dah->cek_nikah($pk->status_nikah) ?>"><?php echo $this->m_dah->cek_nikah($pd->status_nikah)  ?></option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Status Dalam Keluarga</label>
                                    <input class="form-control form-control-user" name="status_hub_keluarga" value="<?php echo $this->m_dah->status_keluarga($pd->status_hub_keluarga) ?>" disabled>
                                </div>
                                                                                  

                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea  class="form-control form-control-user" name="alamat" disabled=""><?php echo $pd->alamat ?></textarea>
                                </div>


                            </div>
                            <!-- end row form -->
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>