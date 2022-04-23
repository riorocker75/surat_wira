<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Surat</title>

	<link href="<?php echo base_url(); ?>assets_f/css/custom.css" rel="stylesheet">

</head>
<!-- <body onload="window.print();"> -->
<body>

   
    <div class="cetak_surat">
        <div class="kop_surat">

            <div class="logo_surat">
                    <?php
                         $where=array(
                          'option_name' => 'logo_surat'
                           );
                        $cek_foto=$this->m_dah->edit_data($where, 'dah_options')->result();
                        foreach ($cek_foto as $f) {} 
                      ?>
                <img src="<?php echo base_url()?>upload/logo/<?php echo $f->option_value; ?>" alt="" srcset="">
            </div>

         <!--    <div class="judul_surat">
                PEMERINTAH KABUPATEN ACEH UTARA
            <p style="line-height: 0;margin-top:16px">KECAMATAN MEURAH MULIA</p>
               <p style="margin-top:-10px"> GAMPONG ULEE CEUBREK</p>
            </div> -->

              <div class="judul_surat" style="line-height: 0.2;margin-top:-13px;text-transform: uppercase;">
            <?php echo $this->m_dah->get_option('kop_surat'); ?>
            </div>
        </div>
        <div class="line" ></div>
        <div class="line2" ></div>
        

   

    <?php foreach($surat as $sr){}?>
<?php 
    $kode_surat=$this->m_dah->get_option('kode_surat');
 
?>
<div class="ket_surat">
    <b> <p style="text-decoration:underline;text-transform: uppercase;"> <?php echo $sr->nama_surat?>  </p> </b>
    <span>Nomor : 000/<?php echo $kode_surat ?>/<?php echo $sr->kode_surat ?>/<?php echo date(m)?>/<?php echo date(Y)?></span>                           
</div>

<div class="isi_surat">
  <?php echo $sr->format_surat?>
</div>  


<div class="tanda_tangan" style="margin-top:30px">
    <p style="text-align:center;">
    <?php echo $this->m_dah->get_option('nama_desa'); ?>, <?php echo $this->m_dah->format_tanggal(date('Y-m-d',strtotime($sr->tgl_surat)))?>
    </p>
    <p style="text-align:center;margin-top:-15px;">
    <?php echo $this->m_dah->get_option('jab_surat'); ?>&nbsp;<?php echo $this->m_dah->get_option('nama_desa'); ?>
    </p>

    <p style="text-align:center;margin-top:75px;text-decoration:underline">
    <b><?php echo $this->m_dah->get_option('pj_surat'); ?></b> 
    </p>

</div>
    





</div>
<!-- end cetak surat -->
</body>
</html>