<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Surat</title>

	<link href="<?php echo base_url(); ?>assets_f/css/custom.css" rel="stylesheet">

</head>
<body onload="window.print();">
<!-- <body> -->

   
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
        

   

    
    


