<?php foreach($surat as $sr){}?>
<?php 
	$wu=array('id' => $sr->surat_id);
	$ops= $this->m_dah->edit_data($wu,'jenis_surat')->result();
    $kode_surat=$this->m_dah->get_option('kode_surat');
	foreach ($ops as $op) {}
?>
<div class="ket_surat">
    <b> <p style="text-decoration:underline;text-transform: uppercase;"> <?php echo $op->nama_surat?>  </p> </b>
    <span>Nomor : <?php echo $sr->nomor_surat ?>/<?php echo $kode_surat ?>/<?php echo $op->kode_surat ?>/<?php echo date(m)?>/<?php echo date(Y)?></span>                           
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