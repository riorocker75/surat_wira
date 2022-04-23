<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Jabatan</h1>
</div>
<?php show_alert()?>

		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-5 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ubah jabatan</h6>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url().'admin/jabatan_update'?>" method="post">
                        <?php foreach ($edit as $ak) {?>
                            <div class="form-group">
                                 <input type="hidden" name="id" value="<?php echo $ak->id ?>">

                                <input type="text" class="form-control form-control-user" name="jabatan" placeholder="Isi jabatan disini" value="<?php echo $ak->jabatan?>" required>
                            </div>
                            <?php echo form_error('jabatan', '<div class="form-error">', '</div>'); ?>
                        <?php } ?>   
                            <button class="btn btn-primary" type="submit"><i class="fas fa-pen-alt    "></i> Ubah</button>
                        </form>
                    </div>
                </div>
		    </div>

            <div class="col-lg-7 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data jabatan</h6>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>jabatan</th>
                                <th width="20%">Opsi</th>
                                </tr>
                            </thead> 
                            <tbody>
                               <?php foreach ($jabatan as $jb ) {?>
                                   <tr>
                                    <td><?php echo $jb->jabatan?></td>
                                   
                                    <td>
                                           <?php switch ($jb->id) {
                                            case 1: case 2:
                                          echo "";
                                          break; 
                                          default:

                                        ?>
                                        <a href="<?php echo base_url().'admin/jabatan_edit/'.$jb->id ?>"> <i class="fas fa-pen-alt    "></i></a>
                                        <a href="<?php echo base_url().'admin/jabatan_delete/'.$jb->id?>"> <i class="fas fa-trash-alt    "></i></a>
                                        <?php break;}?>
                                       
                                    </td>

                                   </tr>

                              <?php }?> 
                            </tbody> 
                            </table>
                        </div>
                    </div>
                </div>
		    </div>
		</div>
</div>
